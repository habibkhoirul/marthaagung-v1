<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model {

	public function getpenjualan($limit = null,$offset = null)
	{
		if(!is_null($limit) && !is_null($offset)) $this->db->limit($limit, $offset);
		
		$this->db->order_by('CAST(no_penjualan as integer)');
		return $this->db->get('penjualan');
	}

	function simpan($data){
		if(!is_array($data)) return false;
		if(isset($data[0]) || $data[0] !== NULL || is_array($data[0])) return $this->db->insert_batch('penjualan', $data);
		return $this->db->insert('penjualan',$data); 
	}

	function hapus($id){
		$this->db->where('md5(no_penjualan)',$id);
		return $this->db->delete('penjualan');
	}

	function ubah($id){
		$this->db->where('md5(no_penjualan)',$id);
		return $this->db->get('penjualan');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_penjualan',$id);
		return $this->db->update('penjualan',$data);
	}

	public function get_count() {
		return $this->db->count_all('penjualan');
	}

	public function getFullData($filter = array(), $toArray = false) {
		$this->db->select('*');
		$this->db->from('detail_penjualan');
		$this->db->join('penjualan', 'detail_penjualan.no_penjualan = penjualan.no_penjualan');
		$this->db->join('produk', 'detail_penjualan.kd_produk = produk.kd_produk');
		if(!empty($filter)) {
			foreach ($filter as $key => $value) {
				$this->db->where($key.'"'.$value.'"');
			}
		}
		$result = $this->db->get();
		if($toArray) return $result->result_array();
		return $result->result();
	}

}
