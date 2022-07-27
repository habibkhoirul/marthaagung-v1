<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_pembelian');
		$this->load->model('M_tmp_detail_pembelian');
		$this->load->model('M_detail_pembelian');
	}

	public function index(){
		$menu['pembelian_menu'] = 'active';
		$data['dt_pembelian'] = $this->M_pembelian->getpembelian();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-dolly"></i> Data Pembelian';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('pembelian/pembelian',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		if($this->M_pembelian->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Pembelian');
	}

	public function delete_produk($id){
		$this->M_tmp_detail_pembelian->hapus($id);
		redirect('Pembelian/tambah');
	}

	public function tambah(){

		$menu['pembelian_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-dolly"></i> Data Pembelian';

		$qry =  $this->db->query("select * from pembelian order by no_pembelian desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_pembelian   = substr($row['no_pembelian'],-8);
	          $kd_pembelian=$kd_pembelian+1;
	          if(strlen($kd_pembelian)==1) $kd_pembelian='0000000'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==2) $kd_pembelian='000000'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==3) $kd_pembelian='00000'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==4) $kd_pembelian='0000'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==5) $kd_pembelian='000'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==6) $kd_pembelian='00'.$kd_pembelian;
	          else if(strlen($kd_pembelian)==6) $kd_pembelian='0'.$kd_pembelian;
	          else $kd_pembelian=$kd_pembelian;
	          $id=  'PB'.$kd_pembelian;
	      }
	      else {
	          $id=  'PB00000001';
	      }

		$data['mode'] = 'Tambah';
		$data['id'] = $id;	      
  		$data['dt_produk'] = $this->db->get('produk');
  		$data['dt_supplier'] = $this->db->get('supplier');
  		$plugin['date_plugin'] = 1;
  		$plugin['tabel_plugin'] = 1;
  		$data['dt_detail'] = $this->M_tmp_detail_pembelian->gettmp_detail_pembelian(null,null,$id);

  		$plugin['javascript'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('pembelian/t_pembelian',$data);
		$this->load->view('pembelian/modal_produk',$data['dt_produk']);
		$this->load->view('pembelian/modal_supplier',$data['dt_supplier']);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function simpan(){       
		// echo "<pre>";print_r($this->input->post()); die;
		if (isset($_POST['tambah_produk'])) {
			$data = array(
				'no_pembelian' => $this->input->post('no_beli'),
				'kd_produk' => $this->input->post('kdproduk'),
				'kd_supplier' => $this->input->post('kdsupplier'),
				'harga' => $this->input->post('harga'),
	           	'jumlah' => $this->input->post('jumlah'),
	           	'subtotal' => (($this->input->post('jumlah'))*($this->input->post('harga')))
	            );

			$this->M_tmp_detail_pembelian->simpan($data);

			redirect('Pembelian/tambah');

		} else if(isset($_POST['simpan_transaksi'])){
	        $data = array(
				'no_pembelian' => $this->input->post('no_beli'),
				'tgl_pembelian' => $this->input->post('tgl_beli'),
				'total' => $this->input->post('hid_total'),
				'uang_bayar' => $this->input->post('uang_bayar'),
	           	'kd_petugas' => $this->input->post('kd_petugas')
	            );

			if($this->M_pembelian->simpan($data)) {
				$no_beli = $this->input->post('no_beli');
				$this->session->set_flashdata('print_popup-beli',$no_beli);
				$this->session->set_flashdata('success', 'Data berhasil disimpan !!');
					
			} else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
			redirect('Pembelian');

		} else{
			redirect('Home');
		}
	}


	//BATAL
	public function batal($id){
		$this->M_tmp_detail_pembelian->batal($id);
		redirect('Pembelian');
	}

	public function nota($id = null){
		$dt = array('id' => $id);
		$this->load->view('pembelian/nota',$dt);
	}

	public function detPembelian($noPembelian){
		$data['dt_pembelian'] = $this->M_pembelian->ubah($noPembelian);
		$data['dt_detail'] = $this->M_detail_pembelian->getdetail_pembelian(null,null,$noPembelian);

		$menu['pembelian_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-dolly"></i> Data Pembelian';
  		$plugin['tabel_plugin'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('pembelian/det_pembelian',$data);
		$this->load->view('dashboard-footer',$plugin);
	}
}
