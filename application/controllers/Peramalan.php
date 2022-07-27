<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan extends CI_Controller {
	
	public $periodeKey = 'Periode Peramalan ';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_peramalan');
		$this->load->model('M_produk');
		$this->load->model('M_penjualan');
		$this->load->model('M_data_toko');
	}

	public function index(){
		$menu['peramalan_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-chart"></i> Peramalan';
		$plugin['date_plugin'] = 1;
		$plugin['select2'] = 1;
		$data['produks'] = $this->M_produk->getproduk();
		$data['config'] = $this->M_data_toko->getdatatoko('DT001')->row();

		$this->load->view('dashboard-header',$menu);
		$this->load->view('peramalan/t_peramalan', $data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function generate(){
		if(!$kd_produk = $this->input->get('kd_produk')) return redirect('Peramalan');
		if(!$jumlah_periode_peramalan = $this->input->get('jumlah_periode_peramalan')) return redirect('Peramalan');

		$data['config'] = $this->M_data_toko->getdatatoko('DT001')->row();

		$menu['peramalan_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-chart"></i> Peramalan';
		$plugin['date_plugin'] = 1;
		$plugin['tabel_plugin'] = 1;
		$plugin['select2'] = 1;
		$data['produks'] = $this->M_produk->getproduk();
		$penjualans = $this->M_penjualan->getFullData(['detail_penjualan.kd_produk' => $kd_produk]);
		$data['selectedProduk'] = $kd_produk;
		$data['selectedJumlahPeriodePeramalan'] = $jumlah_periode_peramalan;
		$use_indeks_musim = $this->M_data_toko->getdatatoko('DT001')->row()->indeks_musim;
		$penjualans = $this->getWeeklySales($penjualans);
		$penjualans = $this->formatData($penjualans);
		$trendMomentResults = array();
		for ($i = 1; $i <=$jumlah_periode_peramalan; $i++) {

			if(!isset($rs)) {
				$rs = $this->trendMoment($penjualans, $use_indeks_musim);
				// echo "<pre> empty";var_dump($rs['jumlah']);
			}
			else {
				$rs = $this->trendMoment($rs, $use_indeks_musim);
				// echo "<pre> not";var_dump($rs['jumlah']);
			}
			$rs = $rs;
			$trendMomentResults = $rs;
		}
		$penjualans = $trendMomentResults;
		
		if(!$penjualans) return redirect('Peramalan');
		$data['penjualans'] = $penjualans;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('peramalan/t_peramalan', $data);
		$this->load->view('dashboard-footer',$plugin);

	}

	private function getWeeklySales($data) {
		if(!is_array($data) || empty($data)) return false;
		$result = array();
		foreach ($data as $key => $value) {
			$currentWeek = ceil((intval(substr($value->tgl_penjualan, -2, 2))) / 7);
			if(isset($result[substr($value->tgl_penjualan,0,-3)][$currentWeek])) {
				$result[substr($value->tgl_penjualan,0,-3)][$currentWeek]->jumlah += $value->jumlah;
			} else {
				$result[substr($value->tgl_penjualan,0,-3)][$currentWeek] = new stdClass();
				$result[substr($value->tgl_penjualan,0,-3)][$currentWeek]->kd_produk = $value->kd_produk;
				$result[substr($value->tgl_penjualan,0,-3)][$currentWeek]->nm_produk = $value->nm_produk;
				$result[substr($value->tgl_penjualan,0,-3)][$currentWeek]->jumlah = $value->jumlah;
			};
		}
		return $result;
	}

	private function formatData($penjualans) {
		if(!is_array($penjualans) || empty($penjualans)) return false;
		$x = 0;
		$jumlah = new stdClass();
		$jumlah->y = 0;
		$jumlah->x = 0;
		$jumlah->xy = 0;
		$jumlah->xkuadrat = 0;

		foreach ($penjualans as $keyPenjualanMonth => $penjualanWeek){
			foreach ($penjualanWeek as $key => $penjualan) {
				//menghitung x, y, x*y, dan xkuadrat
				$penjualans[$keyPenjualanMonth][$key]->x = $x;
				$penjualans[$keyPenjualanMonth][$key]->y = $penjualan->jumlah;
				$penjualans[$keyPenjualanMonth][$key]->xy = $x * $penjualan->jumlah;
				$penjualans[$keyPenjualanMonth][$key]->xkuadrat = pow($x,2);

				//menghitung jumlah
				$jumlah->x += $x;
				$jumlah->y += $penjualan->jumlah;
				$jumlah->xy += ($x * $penjualan->jumlah);
				$jumlah->xkuadrat += pow($x,2);
				
				$x++;
			}
		}

		$jumlah->periode = $x;

		$ratarata = new stdClass();
		$ratarata->y = round($jumlah->y / $jumlah->periode, 2);
		$ratarata->x = round($jumlah->x  / $jumlah->periode, 2);
		$ratarata->xy = round($jumlah->xy  / $jumlah->periode, 2);
		$ratarata->xkuadrat = round($jumlah->xkuadrat  / $jumlah->periode, 2);
		
		$indexMusim = $penjualans[array_key_first($penjualans)][1]->y / $ratarata->y;
		$result = array(
			'data' => $penjualans,
			'jumlah' => $jumlah,
			'ratarata' => $ratarata,
			'indexMusim' => $indexMusim
		);

		// print_r($indexMusim);

		return $result;
	}

	private function trendMoment($data, $use_indeks_musim = true) {
		if(!is_array($data) || empty($data)) return false;

		$persamaan1 = array();
		$persamaan1['jumlah_y'] = $data['jumlah']->xy;
		$persamaan1['a'] = $data['jumlah']->x;
		$persamaan1['b'] = $data['jumlah']->xkuadrat;

		$persamaan2 = array();
		$persamaan2['jumlah_y'] = $data['jumlah']->y;
		$persamaan2['a'] = $data['jumlah']->periode;
		$persamaan2['b'] = $data['jumlah']->x;

		$persamaan1Tmp = array();
		$persamaan1Tmp['jumlah_y'] = $persamaan1['jumlah_y'] * $persamaan2['a'];
		$persamaan1Tmp['a'] = $persamaan1['a'] * $persamaan2['a'];
		$persamaan1Tmp['b'] = $persamaan1['b'] * $persamaan2['a'];

		$persamaan2Tmp = array();
		$persamaan2Tmp['jumlah_y'] = $persamaan2['jumlah_y'] * $persamaan1['a'];
		$persamaan2Tmp['a'] = $persamaan2['a'] * $persamaan1['a'];
		$persamaan2Tmp['b'] = $persamaan2['b'] * $persamaan1['a'];
		
		$hasilPersamaan = array();
		$hasilPersamaan['b'] = ($persamaan1Tmp['jumlah_y'] - $persamaan2Tmp['jumlah_y']) / ($persamaan1Tmp['b'] - $persamaan2Tmp['b']);
		$hasilPersamaan['a'] = ($persamaan1['jumlah_y'] - ($persamaan1['b'] * $hasilPersamaan['b'])) / $persamaan1['a'];
		//Rumus utama Trend Moment
		$hasilPersamaan['y_utama'] = $hasilPersamaan['a'] + ($hasilPersamaan['b'] * ($data['jumlah']->periode));
		
		// Menentukan Indeks musim
		// $hasilPersamaan['indeks_musim'] = $data['data'][array_key_first($data['data'])][1]->y / $data['ratarata']->y;
		$hasilPersamaan['indeks_musim'] = $data['indexMusim'];
		$hasilPersamaan['y_bintang'] = round($hasilPersamaan['indeks_musim'] * $hasilPersamaan['y_utama'], 2); 
		
		// Jika tidak menggunakan indeks musim, maka y bintang = y utama 
		if(!$use_indeks_musim)
			$hasilPersamaan['y_bintang'] = round($hasilPersamaan['y_utama'], 2); 

		//menambahkan hasil permalan ke dalam array
		$lastData = $data['data'][array_key_last($data['data'])][count($data['data'][array_key_last($data['data'])])];
		$newData = $data;
		$newPeriode = $data['jumlah']->periode + 1;
		$newData['data'][$this->periodeKey.($newPeriode - 1)] = array();
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1] = new stdClass();
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->kd_produk = $lastData->kd_produk;
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->nm_produk = $lastData->nm_produk;
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->jumlah = $hasilPersamaan['y_bintang'];
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->x = $lastData->x + 1;
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->y = $hasilPersamaan['y_bintang'];
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->mape = round((abs($lastData->y - $hasilPersamaan['y_bintang']) / $lastData->y) * 100, 2);
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->xy = $lastData->x * $hasilPersamaan['y_bintang'];
		$newData['data'][$this->periodeKey.($newPeriode - 1)][1]->xkuadrat = pow(($lastData->x + 1), 2);


		$x = 0;
		$jumlah = new stdClass();
		$jumlah->y = $data['jumlah']->y;
		$jumlah->x = $data['jumlah']->x;
		$jumlah->xy = $data['jumlah']->xy;
		$jumlah->xkuadrat = $data['jumlah']->xkuadrat;
		$jumlah->mape = isset($data['jumlah']->mape) ? $data['jumlah']->mape : 0;


		//menghitung jumlah
		$jumlah->x += $newData['data'][$this->periodeKey.($newPeriode - 1)][1]->x;
		$jumlah->y += $newData['data'][$this->periodeKey.($newPeriode - 1)][1]->jumlah;
		$jumlah->xy += $newData['data'][$this->periodeKey.($newPeriode - 1)][1]->xy;
		$jumlah->mape += $newData['data'][$this->periodeKey.($newPeriode - 1)][1]->mape;
		$jumlah->xkuadrat += $newData['data'][$this->periodeKey.($newPeriode - 1)][1]->xkuadrat;

		$jumlah->periode = $newPeriode;

		$ratarata = new stdClass();
		$ratarata->y = round($jumlah->y / $jumlah->periode, 2);
		$ratarata->x = round($jumlah->x  / $jumlah->periode, 2);
		$ratarata->xy = round($jumlah->xy  / $jumlah->periode, 2);
		$ratarata->xkuadrat = round($jumlah->xkuadrat  / $jumlah->periode, 2);
		$ratarata->mape = round($jumlah->mape  / $jumlah->periode, 2);

		$result = array(
			'data' => $newData['data'],
			'jumlah' => $jumlah,
			'ratarata' => $ratarata,
			'indexMusim' => $data['indexMusim']
		);

		return $result;
	}

	function weekOfMonth($date) {
    // estract date parts
    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
    
    // current week, min 1
    $w = 1;
    
    // for each day since the start of the month
    for ($i = 1; $i < $d; ++$i) {
        // if that day was a sunday and is not the first day of month
        if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
            // increment current week
            ++$w;
        }
    }
    
    // now return
    return $w;
	}
}
