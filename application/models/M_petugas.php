<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_Model {

	public function getpetugas($limit = null,$start = null)
	{
		return $this->db->get('petugas');
	}

	function simpan($data){
		return $this->db->insert('petugas',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_petugas)',$id);
		return $this->db->delete('petugas');
	}

	function ubah($id){
		$this->db->where('md5(kd_petugas)',$id);
		return $this->db->get('petugas');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_petugas',$id);
		return $this->db->update('petugas',$data);
	}

}
