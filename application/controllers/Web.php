<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	const kddatatoko = 'DT001';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_data_toko');
		$this->load->model('M_produk');
	}

	public function index(){
		$data['dt_toko'] = $this->M_data_toko->getdatatoko(Web::kddatatoko);
		$data['dt_produk'] = $this->M_produk->getproduk(3,0);
		$data['dt_galeri'] = $this->db->get('galeri', 1);
		$this->load->view('landingPageIndex', $data);
		
	}

	public function katalogProduk() {
		if(($this->input->post('kata_kunci') != '')) {
			$config['total_rows'] = $this->M_produk->getprodukbyname($this->input->post('kata_kunci'))->num_rows();
		} else  {         
			$config['total_rows'] = $this->db->count_all('produk');
		}

		//pagination setting
		$config['base_url'] = base_url().'web/katalogProduk/';
		$config['per_page'] = "15";
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		//configurasi untuk bootstrap v.4.* pagination
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if(($this->input->post('kata_kunci') != '')) {
			$data['dt_produk'] = $this->M_produk->getprodukbyname($this->input->post('kata_kunci'),$config["per_page"], $data['page']);           
		} else  {
			$data['dt_produk'] = $this->M_produk->getproduk($config["per_page"], $data['page']);
		}

		$data['pagination'] = $this->pagination->create_links();
		$data['dt_toko'] = $this->M_data_toko->getdatatoko(Web::kddatatoko);

		$this->load->view('landingPageKatalog', $data);
		
	}
}