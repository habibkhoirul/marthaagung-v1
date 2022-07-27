<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_galeri extends CI_Model {

	public function getgaleri($limit = null,$start = null)
	{
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('galeri');
	}

	function simpan($data){
		return $this->db->insert('galeri',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_galeri)',$id);
		return $this->db->delete('galeri');
	}

	function ubah($id){
		$this->db->where('md5(kd_galeri)',$id);
		return $this->db->get('galeri');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_galeri',$id);
		return $this->db->update('galeri',$data);
	}

	function getgaleribyname($keyword, $limit = null, $start = null) {
		$this->db->like('nm_galeri', $keyword, $side = 'both');
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('galeri');
	}
}
