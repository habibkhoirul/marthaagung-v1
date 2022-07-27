<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_petugas');
	}

	public function index(){
		$menu['petugas_menu'] = 'active';
		$data['dt_petugas'] = $this->M_petugas->getpetugas();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-users"></i> Data Petugas';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('petugas/petugas',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		if($this->M_petugas->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Petugas');
	}

	public function tambah(){

		$qry =  $this->db->query("select * from petugas order by kd_petugas desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_petugas   = substr($row['kd_petugas'], -3);
	          $kd_petugas=$kd_petugas+1;
	          if(strlen($kd_petugas)==1) $kd_petugas='00'.$kd_petugas;
	          else if(strlen($kd_petugas)==2) $kd_petugas='0'.$kd_petugas;
	          else $kd_petugas=$kd_petugas;
	          $id=  'PT'.$kd_petugas;
	      }
	      else {
	          $id=  'PT001';
	      }


		$data['mode'] = 'Tambah';
		$data['id'] = $id;
		$menu['petugas_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-users"></i> Data Petugas';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('petugas/t_petugas',$data);
		$this->load->view('dashboard-footer');

	}

	public function simpan(){

		$mode = $this->input->post('mode');
        
        //Menentukan Apakah Password Diubah ato Tidak
        if($mode == 'Tambah'){
        	$password = md5($this->input->post('password'));
        } else {
        	$password = $this->input->post('password');
        	$password_lama = $this->input->post('password_lama');

        	if($password != $password_lama) $password = md5($password);
        	else $password = $password;
        }
        

        $data = array(
			'kd_petugas' => $this->input->post('kdpetugas'),
			'nik' => $this->input->post('nik'),
			'nm_petugas' => $this->input->post('nama'),
			'gender' => $this->input->post('gender'),
			'alamat' => $this->input->post('alamat'),
			'no_telepon' => $this->input->post('telp'),
			'username' => $this->input->post('username'),
			'password' => $password, 		
           	'level' => $this->input->post('level')
            );

        if($mode == 'Tambah'){
			if($this->M_petugas->simpan($data)) $this->session->set_flashdata('success', 'Data berhasil disimpan !!');
			else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
		} else {
			if($this->M_petugas->ubah_simpan($this->input->post('kdpetugas'),$data)) $this->session->set_flashdata('success', 'Data berhasil diubah !!');
			else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		}
		redirect('Petugas');

	}

	public function edit($data){
		$edata['mode'] = 'Edit';
		$edata['dt_petugas'] = $this->M_petugas->ubah($data);
		$menu['petugas_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-users"></i> Data Petugas';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('petugas/t_petugas',$edata);
		$this->load->view('dashboard-footer');
	}

}
