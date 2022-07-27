<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembelian extends CI_Model {

	public function getpembelian($limit = null,$start = null)
	{
		return $this->db->get('pembelian');
	}

	function simpan($data){
		return $this->db->insert('pembelian',$data); 
	}

	function hapus($id){
		$this->db->where('md5(no_pembelian)',$id);
		return $this->db->delete('pembelian');
	}

	function ubah($id){
		$this->db->where('md5(no_pembelian)',$id);
		return $this->db->get('pembelian');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_pembelian',$id);
		return $this->db->update('pembelian',$data);
	}

}
