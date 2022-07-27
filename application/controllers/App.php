<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('App_model');
	}

	public function index(){
		$this->load->view('login');
		
	}

	public function val_login(){
		if(isset($_POST['login'])){
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$cek = $this->App_model->proseslogin($username,$password);
			
			if (count($cek) == 1){
				$data = $this->db->get_where('petugas',array('username' => $username, 'password' => $password))->row();
				$this->session->set_userdata('status','loggedin');
				$this->session->set_userdata('username',$data->username);
				$this->session->set_userdata('level',$data->level);
				$this->session->set_userdata('kd_petugas',$data->kd_petugas);

			  	if($data->level == 'Dokter') redirect ('Pasien');
			  	else if($data->level == 'Apoteker') redirect ('Penjualan');
			  	else redirect ('Home');
			  	
			} else {
				$this->session->set_userdata('msg','Username Atau Password Salah');
				redirect('App/index');
			}

		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('kd_petugas');
		$this->session->sess_destroy();
		redirect('Web');
	}

}