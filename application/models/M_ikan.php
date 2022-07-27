<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ikan extends CI_Model {

	public function getikan($limit = null,$start = null)
	{
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('ikan');
	}

	function simpan($data){
		return $this->db->insert('ikan',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_ikan)',$id);
		return $this->db->delete('ikan');
	}

	function ubah($id){
		$this->db->where('md5(kd_ikan)',$id);
		return $this->db->get('ikan');
	}

	function ubah_simpan($id,$data){
		$this->db->where('kd_ikan',$id);
		return $this->db->update('ikan',$data);
	}

	function getikanbyname($keyword, $limit = null, $start = null) {
		$this->db->like('nm_ikan', $keyword, $side = 'both');
		if(!is_null($limit) && !is_null($start)) $this->db->limit($limit, $start);
		return $this->db->get('ikan');
	}
}
