<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_toko extends CI_Model {

	public function getdatagaleri($id)
	{
		return $this->db->where('kd_data_toko', $id)->get('galeri', 1);
	}
	
	public function getdatatoko($id)
	{
		return $this->db->where('kd_data_toko', $id)->get('data_toko', 1);
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_data_toko',$id);
		return $this->db->update('data_toko',$data);
	}

	function ubah_simpan_galeri($id,$data){
		$this->db->where('kd_data_toko',$id);
		return $this->db->update('galeri',$data);
	}

}
