<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index($lastNo=0){
		$menu['home_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-home"></i> Home';
		$plugin['tabel_plugin'] = 1;
		$data['dt_produk_stok_tipis'] = $this->db->query('Select * from produk where stok < 5');

		$this->load->view('dashboard-header',$menu);
		$this->load->view('dashboard',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

}
