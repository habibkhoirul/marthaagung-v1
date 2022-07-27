<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_detail_penjualan extends CI_Model {

	public function getdetail_penjualan($limit = null, $start = null, $no_jual = null)
	{
		$this->db->select('produk.nm_produk, detail_penjualan.*');
		$this->db->from('detail_penjualan');
		$this->db->join('produk', 'detail_penjualan.kd_produk = produk.kd_produk');
		if(!is_null($no_jual)) $this->db->where('md5(no_penjualan)', $no_jual);
		return $this->db->get();
	}

	function simpan($data){
		if(is_array($data)) return $this->db->insert_batch('detail_penjualan', $data);
		$this->db->insert('detail_penjualan',$data); 
	}

	function hapus($id){
		$this->db->where('md5(produk)',$id);
		$this->db->delete('detail_penjualan');
	}

	function ubah($id){
		$this->db->where('md5(no_penjualan)',$id);
		return $this->db->get('detail_penjualan');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_penjualan',$id);
		return $this->db->update('detail_penjualan',$data);
	}

	function batal($id){
		$this->db->where('md5(no_penjualan)',$id);
		$this->db->delete('detail_penjualan');
	}

}
