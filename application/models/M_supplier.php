<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

	public function getsupplier($limit = null,$start = null)
	{
		return $this->db->get('supplier');
	}

	function simpan($data){
		return $this->db->insert('supplier',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_supplier)',$id);
		return $this->db->delete('supplier');
	}

	function ubah($id){
		$this->db->where('md5(kd_supplier)',$id);
		return $this->db->get('supplier');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_supplier',$id);
		return $this->db->update('supplier',$data);
	}

}
