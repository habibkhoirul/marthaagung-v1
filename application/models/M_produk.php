<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

	public function getproduk($limit = null,$start = null)
	{
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('produk');
	}

	function simpan($data){
		return $this->db->insert('produk',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_produk)',$id);
		return $this->db->delete('produk');
	}

	function ubah($id){
		$this->db->where('md5(kd_produk)',$id);
		return $this->db->get('produk');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_produk',$id);
		return $this->db->update('produk',$data);
	}

	function getprodukbyname($keyword, $limit = null, $start = null) {
		$this->db->like('nm_produk', $keyword, $side = 'both');
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('produk');
	}

	public function getGroupBy($field = 'kd_produk', $limit = null,$start = null)
	{
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		$produks = $this->db->get('produk')->result();
		$result = [];
		foreach ($produks as $key => $value) {
			$result[$value->{$field}] = $value;
		}
		return $result;
	}
}
