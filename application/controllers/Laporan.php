<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_laporan');
	}

	public function index(){
		$menu['laporan_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-copy"></i> Laporan';
		$plugin['date_plugin'] = 1;

		$this->load->view('dashboard-header',$menu);
		$this->load->view('laporan/t_laporan');
		$this->load->view('dashboard-footer',$plugin);
	}

	public function generate(){
		$tb = $this->input->post('laporan_data');
		$tgl_start = $this->input->post('tanggal_start');
		$tgl_end = $this->input->post('tanggal_end');
		
		if($tb=='penjualan' || $tb=='pembelian') {
			$data['dt_'.$tb] = $this->M_laporan->getlaporan_transaksi($tb,$tgl_start,$tgl_end);
		} else {
			$data['dt_'.$tb] = $this->M_laporan->getlaporan($tb);	
		}
		
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-data-$tb.pdf";
		$this->pdf->load_view('laporan/laporan_'.$tb, $data);
	}

}
