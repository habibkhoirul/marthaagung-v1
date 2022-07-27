<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_galeri');
	}

	public function index(){
		$menu['galeri_menu'] = 'active';
		$data['dt_galeri'] = $this->M_galeri->getgaleri();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-camera"></i> Data Galeri';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('galeri/galeri',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		$this->hapusGambar($id);
		if($this->M_galeri->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Galeri');
	}

	public function tambah(){

		$qry =  $this->db->query("select * from galeri order by kd_galeri desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_galeri   = substr($row['kd_galeri'], -4);
	          $kd_galeri=$kd_galeri+1;
	          if(strlen($kd_galeri)==1) $kd_galeri='000'.$kd_galeri;
	          else if(strlen($kd_galeri)==2) $kd_galeri='00'.$kd_galeri;
	          else if(strlen($kd_galeri)==3) $kd_galeri='0'.$kd_galeri;
	          else $kd_galeri=$kd_galeri;
	          $id=  'G'.$kd_galeri;
	      }
	      else {
	          $id=  'G0001';
	      }

		$data['mode'] = 'Tambah';
		$data['id'] = $id;
		$menu['galeri_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-camera"></i> Data Galeri';
		  
		$this->load->view('dashboard-header',$menu);
		$this->load->view('galeri/t_galeri',$data);
		$this->load->view('dashboard-footer');

	}

	public function simpan(){
		$mode = $this->input->post('mode');        

		$config['upload_path']  = './uploads/images/galeri/';
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size']     = 5000;
		$config['file_name'] 	= $this->input->post('kdgaleri');
		$this->load->library('upload', $config);
		
		$nama_file_gambar = '';

		if(!empty($_FILES['gambar']['name'])) {
			
			//Jika dalam mode update, maka hapus foto lama terlebih dahulu
			if ($mode == 'Edit') {
				$this->hapusGambar(md5($this->input->post('kdgaleri')));
			}

			if ( ! $this->upload->do_upload('gambar')) {
				$data['error'] = array('error' => $this->upload->display_errors());
				$data['mode'] = $mode;
				$data['last_data'] = $this->input->post();

				$this->load->view('dashboard-header',$menu);
				$this->load->view('galeri/t_galeri',$data);
				$this->load->view('dashboard-footer');

				return 0;
			
			} else {
				$nama_file_gambar = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar = '';
		}

		$data = array(
			'kd_galeri' => $this->input->post('kdgaleri'),
			'nm_galeri' => $this->input->post('nama'),
			'gambar' => $nama_file_gambar,
			);
			
		if($mode == 'Tambah'){
			if($this->M_galeri->simpan($data)) $this->session->set_flashdata('success', 'Data berhasil disimpan !!');
			else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
		} else {
			if($this->M_galeri->ubah_simpan($this->input->post('kdgaleri'), $data)) $this->session->set_flashdata('success', 'Data berhasil diubah !!');
			else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		}
		redirect('Galeri');

	}

	public function edit($data)
	{
		$edata['mode'] = 'Edit';
		$edata['dt_galeri'] = $this->M_galeri->ubah($data);
		$menu['galeri_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-camera"></i> Data Galeri';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('galeri/t_galeri',$edata);
		$this->load->view('dashboard-footer');
	}

	public function hapusGambar($id) {
		$gambarFilename = $this->db->select('gambar')->from('galeri')->where('md5(kd_galeri)',$id)->get()->row();
		$pathGambar = './uploads/images/galeri/';
		$uri = $pathGambar.$gambarFilename->gambar;
		if(file_exists($uri) && is_file($uri) && is_writable($uri)) unlink($uri);
		return true; 
	}
}
