<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_petugas');
	}

	public function index(){
		$data['dt_petugas'] = $this->M_petugas->ubah(md5($this->session->userdata('kd_petugas')));
		$menu['petugas_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-users"></i> Change Profile';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('profil/profil',$data);
		$this->load->view('dashboard-footer');
	}

	public function simpan(){

    	$password = $this->input->post('password');
    	$password_lama = $this->input->post('password_lama');

    	if($password != $password_lama) $password = md5($password);
    	else $password = $password;
        

        $data = array(
			'username' => $this->input->post('username'),
			'password' => $password
            );

		$this->M_petugas->ubah_simpan($this->session->userdata('kd_petugas'),$data);
		redirect('Home');

	}

}