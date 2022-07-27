<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ikan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ikan');
	}

	public function index(){
		$menu['ikan_menu'] = 'active';
		$data['dt_ikan'] = $this->M_ikan->getikan();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-fish"></i> Data Ikan';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('ikan/ikan',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		$this->hapusGambar($id);
		if($this->M_ikan->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Ikan');
	}

	public function tambah(){

		$qry =  $this->db->query("select * from ikan order by kd_ikan desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_ikan   = substr($row['kd_ikan'], -4);
	          $kd_ikan=$kd_ikan+1;
	          if(strlen($kd_ikan)==1) $kd_ikan='000'.$kd_ikan;
	          else if(strlen($kd_ikan)==2) $kd_ikan='00'.$kd_ikan;
	          else if(strlen($kd_ikan)==3) $kd_ikan='0'.$kd_ikan;
	          else $kd_ikan=$kd_ikan;
	          $id=  'H'.$kd_ikan;
	      }
	      else {
	          $id=  'H0001';
	      }

		$data['mode'] = 'Tambah';
		$data['id'] = $id;
		$menu['ikan_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-fish"></i> Data Ikan';
		  
		$this->load->view('dashboard-header',$menu);
		$this->load->view('ikan/t_ikan',$data);
		$this->load->view('dashboard-footer');

	}

	public function simpan(){
		$mode = $this->input->post('mode');        

		$config['upload_path']  = './uploads/images/';
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size']     = 5000;
		$config['file_name'] 	= $this->input->post('kdikan');
		$this->load->library('upload', $config);
		
		$nama_file_gambar = '';

		if(!empty($_FILES['gambar']['name'])) {
			
			//Jika dalam mode update, maka hapus foto lama terlebih dahulu
			if ($mode == 'Edit') {
				$this->hapusGambar(md5($this->input->post('kdikan')));
			}

			if ( ! $this->upload->do_upload('gambar')) {
				$data['error'] = array('error' => $this->upload->display_errors());
				$data['mode'] = $mode;
				$data['last_data'] = $this->input->post();

				$this->load->view('dashboard-header',$menu);
				$this->load->view('ikan/t_ikan',$data);
				$this->load->view('dashboard-footer');

				return 0;
			
			} else {
				$nama_file_gambar = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar = '';
		}

		$data = array(
			'kd_ikan' => $this->input->post('kdikan'),
			'nm_ikan' => $this->input->post('nama'),
			'gambar' => $nama_file_gambar,
			'harga_modal' => $this->input->post('harga_modal'),
			'harga_jual' => $this->input->post('harga_jual'),
			'stok' => $this->input->post('stok'),		
			'keterangan' => $this->input->post('keterangan')
			);
			
		if($mode == 'Tambah'){
			if($this->M_ikan->simpan($data)) $this->session->set_flashdata('success', 'Data berhasil disimpan !!');
			else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
		} else {
			if($this->M_ikan->ubah_simpan($this->input->post('kdikan'), $data)) $this->session->set_flashdata('success', 'Data berhasil diubah !!');
			else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		}
		redirect('Ikan');

	}

	public function edit($data)
	{
		$edata['mode'] = 'Edit';
		$edata['dt_ikan'] = $this->M_ikan->ubah($data);
		$menu['ikan_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-fish"></i> Data Ikan';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('ikan/t_ikan',$edata);
		$this->load->view('dashboard-footer');
	}

	public function hapusGambar($id) {
		$gambarFilename = $this->db->select('gambar')->from('ikan')->where('md5(kd_ikan)',$id)->get()->row();
		$pathGambar = './uploads/images/';
		$uri = $pathGambar.$gambarFilename->gambar;
		if(file_exists($uri) && is_file($uri) && is_writable($uri)) unlink($uri);
		return true; 
	}
}
