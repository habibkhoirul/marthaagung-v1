<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_produk');
	}

	public function index(){
		$menu['produk_menu'] = 'active';
		$data['dt_produk'] = $this->M_produk->getproduk();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-gift"></i> Data Produk';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('produk/produk',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		$this->hapusGambar($id);
		if($this->M_produk->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Produk');
	}

	public function tambah(){

		$qry =  $this->db->query("select * from produk order by kd_produk desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_produk   = substr($row['kd_produk'], -4);
	          $kd_produk=$kd_produk+1;
	          if(strlen($kd_produk)==1) $kd_produk='000'.$kd_produk;
	          else if(strlen($kd_produk)==2) $kd_produk='00'.$kd_produk;
	          else if(strlen($kd_produk)==3) $kd_produk='0'.$kd_produk;
	          else $kd_produk=$kd_produk;
	          $id=  'H'.$kd_produk;
	      }
	      else {
	          $id=  'H0001';
	      }

		$data['mode'] = 'Tambah';
		$data['id'] = $id;
		$menu['produk_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-gift"></i> Data Produk';
		  
		$this->load->view('dashboard-header',$menu);
		$this->load->view('produk/t_produk',$data);
		$this->load->view('dashboard-footer');

	}

	public function simpan(){
		$mode = $this->input->post('mode');        

		$config['upload_path']  = './uploads/images/';
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size']     = 5000;
		$config['file_name'] 	= $this->input->post('kdproduk');
		$this->load->library('upload', $config);
		
		$nama_file_gambar = '';

		if(!empty($_FILES['gambar']['name'])) {
			
			//Jika dalam mode update, maka hapus foto lama terlebih dahulu
			if ($mode == 'Edit') {
				$this->hapusGambar(md5($this->input->post('kdproduk')));
			}

			if ( ! $this->upload->do_upload('gambar')) {
				$data['error'] = array('error' => $this->upload->display_errors());
				$data['mode'] = $mode;
				$data['last_data'] = $this->input->post();

				$this->load->view('dashboard-header',$menu);
				$this->load->view('produk/t_produk',$data);
				$this->load->view('dashboard-footer');

				return 0;
			
			} else {
				$nama_file_gambar = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar = '';
		}

		$data = array(
			'kd_produk' => $this->input->post('kdproduk'),
			'nm_produk' => $this->input->post('nama'),
			'gambar' => $nama_file_gambar,
			'harga_modal' => $this->input->post('harga_modal'),
			'harga_jual' => $this->input->post('harga_jual'),
			'stok' => $this->input->post('stok'),		
			'keterangan' => $this->input->post('keterangan')
			);
			
		if($mode == 'Tambah'){
			if($this->M_produk->simpan($data)) $this->session->set_flashdata('success', 'Data berhasil disimpan !!');
			else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
		} else {
			if($this->M_produk->ubah_simpan($this->input->post('kdproduk'), $data)) $this->session->set_flashdata('success', 'Data berhasil diubah !!');
			else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		}
		redirect('Produk');

	}

	public function edit($data)
	{
		$edata['mode'] = 'Edit';
		$edata['dt_produk'] = $this->M_produk->ubah($data);
		$menu['produk_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-gift"></i> Data Produk';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('produk/t_produk',$edata);
		$this->load->view('dashboard-footer');
	}

	public function hapusGambar($id) {
		$gambarFilename = $this->db->select('gambar')->from('produk')->where('md5(kd_produk)',$id)->get()->row();
		$pathGambar = './uploads/images/';
		$uri = $pathGambar.$gambarFilename->gambar;
		if(file_exists($uri) && is_file($uri) && is_writable($uri)) unlink($uri);
		return true; 
	}
}
