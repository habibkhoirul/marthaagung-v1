<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_supplier');
	}

	public function index(){
		$menu['supplier_menu'] = 'active';
		$data['dt_supplier'] = $this->M_supplier->getsupplier();
		$plugin['tabel_plugin'] = 1;
		$menu['title'] = '<i class="fas fa-truck"></i> Data Supplier';

		$this->load->view('dashboard-header',$menu,$plugin);
		$this->load->view('supplier/supplier',$data);
		$this->load->view('dashboard-footer',$plugin);
	}

	public function delete($id){
		if($this->M_supplier->hapus($id)) $this->session->set_flashdata('success', 'Data berhasil dihapus !!');
		else $this->session->set_flashdata('error', 'Gagal menghapus data !!');
		redirect('Supplier');
	}

	public function tambah(){

		$qry =  $this->db->query("select * from supplier order by kd_supplier desc");
	      if($qry->num_rows() > 0){
	          $row    =  $qry->row_array();
	          $kd_supplier   = substr($row['kd_supplier'], -3);
	          $kd_supplier=$kd_supplier+1;
	          if(strlen($kd_supplier)==1) $kd_supplier='00'.$kd_supplier;
	          else if(strlen($kd_supplier)==2) $kd_supplier='0'.$kd_supplier;
	          else $kd_supplier=$kd_supplier;
	          $id=  'SP'.$kd_supplier;
	      }
	      else {
	          $id=  'SP001';
	      }


		$data['mode'] = 'Tambah';
		$data['id'] = $id;
		$menu['supplier_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-truck"></i> Data Supplier';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('supplier/t_supplier',$data);
		$this->load->view('dashboard-footer');

	}

	public function simpan(){
		$mode = $this->input->post('mode');        
        $data = array(
			'kd_supplier' => $this->input->post('kdsupplier'),
			'nm_supplier' => $this->input->post('nama'),
			'no_telepon' => $this->input->post('telp'),
			'alamat' => $this->input->post('alamat')
			);
			
		if($mode == 'Tambah'){
			if($this->M_supplier->simpan($data)) $this->session->set_flashdata('success', 'Data berhasil disimpan !!');
			else $this->session->set_flashdata('error', 'Gagal menyimpan data !!');
		} else {
			if($this->M_supplier->ubah_simpan($this->input->post('kdsupplier'),$data)) $this->session->set_flashdata('success', 'Data berhasil diubah !!');
			else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		}
		redirect('Supplier');

	}

	public function edit($data){
		$edata['mode'] = 'Edit';
		$edata['dt_supplier'] = $this->M_supplier->ubah($data);
		$menu['supplier_menu'] = 'active';
  		$menu['title'] = '<i class="fas fa-truck"></i> Data Supplier';
  		
		$this->load->view('dashboard-header',$menu);
		$this->load->view('supplier/t_supplier',$edata);
		$this->load->view('dashboard-footer');
	}

}
