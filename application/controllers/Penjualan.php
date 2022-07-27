<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_penjualan');
		$this->load->model('M_detail_penjualan');
		$this->load->model('M_tmp_detail_penjualan');
		$this->load->library("pagination");
	}

	public function index($num = ''){
		if(strtolower($this->uri->segment(3)) == 'penjualan') {
			$currentUri = uri_string();
			if (($pos = strpos($currentUri, 'Penjualan')) !== FALSE) {
				$arrUri = explode('/', $currentUri);
				$arrUri = array_slice($arrUri, 2);
				$newUri = implode('/',$arrUri);
				redirect($newUri);
			}
		}




		$menu['penjualan_menu'] = 'active';
		// $data['dt_penjualan'] = $this->M_penjualan->getpenjualan();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-shopping-cart"></i> Data Penjualan';

		
		
		$config = array();
		$config["base_url"] = base_url() . "Penjualan/index/";
		$config["total_rows"] = $this->M_penjualan->get_count();
		$config["per_page"] = 10;

		$config['attributes'] = ['class' => 'page-link'];
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['dt_penjualan'] = $this->M_penjualan->getpenjualan($config["per_page"], $page);

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('penjualan/penjualan',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		if($this->M_penjualan->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Penjualan');
	}

	public function delete_produk($id){
		$this->M_tmp_detail_penjualan->hapus($id);
		redirect('Penjualan/tambah');
	}

	public function tambah(){

		$menu['penjualan_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-shopping-cart"></i> Data Penjualan';

		$qry =  $this->db->query("select * from penjualan order by no_penjualan desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_penjualan   = substr($row['no_penjualan'],-8);
	          $kd_penjualan=$kd_penjualan+1;
	          if(strlen($kd_penjualan)==1) $kd_penjualan='0000000'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==2) $kd_penjualan='000000'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==3) $kd_penjualan='00000'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==4) $kd_penjualan='0000'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==5) $kd_penjualan='000'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==6) $kd_penjualan='00'.$kd_penjualan;
	          else if(strlen($kd_penjualan)==6) $kd_penjualan='0'.$kd_penjualan;
	          else $kd_penjualan=$kd_penjualan;
	          $id=  'PJ'.$kd_penjualan;
	      }
	      else {
	          $id=  'PJ00000001';
	      }

		$data['mode'] = 'Tambah';
		$data['id'] = $id;	      
  		$data['dt_produk'] = $this->db->query('select * from produk where stok > 0');
  		$plugin['date_plugin'] = 1;
  		$plugin['tabel_plugin'] = 1;
  		$data['dt_detail'] = $this->M_tmp_detail_penjualan->gettmp_detail_penjualan(null,null,$id);

  		$plugin['javascript'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('penjualan/t_penjualan',$data);
		$this->load->view('penjualan/modal_produk',$data['dt_produk']);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function simpan(){       

		if (isset($_POST['tambah_produk'])) {
			// var_dump($this->input->post()); die;
			$data = array(
				'no_penjualan' => $this->input->post('no_jual'),
				'kd_produk' => $this->input->post('kdproduk'),
				'harga' => $this->input->post('harga'),
	           	'jumlah' => $this->input->post('jumlah'),
	           	'subtotal' => (($this->input->post('jumlah'))*($this->input->post('harga')))
	            );


			$this->M_tmp_detail_penjualan->simpan($data);

			redirect('Penjualan/tambah');

		} else if(isset($_POST['simpan_transaksi'])){
	        $data = array(
				'no_penjualan' => $this->input->post('no_jual'),
				'tgl_penjualan' => $this->input->post('tgl_jual'),
				'total' => $this->input->post('hid_total'),
				'uang_bayar' => $this->input->post('uang_bayar'),
	           	'kd_petugas' => $this->input->post('kd_petugas')
	            );

			if($this->M_penjualan->simpan($data)) {
				$no_jual = $this->input->post('no_jual');
				$this->session->set_flashdata('print_popup-jual',$no_jual);
				$this->session->set_flashdata('success', 'Data berhasil disimpan !!');
				
			} else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
			redirect('Penjualan');

		} else{
			redirect('Home');
		} 
	}


	//BATAL
	public function batal($id){
		$this->M_tmp_detail_penjualan->batal($id);
		redirect('Penjualan');
	}

	public function nota($id = null){
		$dt = array('id' => $id);
		$this->load->view('penjualan/nota',$dt);
	}

	public function detPenjualan($noPenjualan){
		$data['dt_penjualan'] = $this->M_penjualan->ubah($noPenjualan);

		// $this->db->where('md5(no_penjualan)',$noPenjualan);
		// $data['dt_detail'] = $this->db->get('detail_penjualan');
		$data['dt_detail'] = $this->M_detail_penjualan->getdetail_penjualan(null,null,$noPenjualan);


		$menu['penjualan_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-shopping-cart"></i> Data Penjualan';
  		$plugin['tabel_plugin'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('penjualan/det_penjualan',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	function paginationInit() {

	}
}
