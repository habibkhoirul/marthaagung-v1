<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tmp_detail_penjualan extends CI_Model {

	public function gettmp_detail_penjualan($limit = null, $start = null, $no_jual = null)
	{
		$this->db->select('produk.nm_produk, tmp_detail_penjualan.*');
		$this->db->from('tmp_detail_penjualan');
		$this->db->join('produk', 'tmp_detail_penjualan.kd_produk = produk.kd_produk');
		if(!is_null($no_jual)) $this->db->where('no_penjualan', $no_jual);
		return $this->db->get();
	}

	function simpan($data){
		$this->db->insert('tmp_detail_penjualan',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_produk)',$id);
		$this->db->delete('tmp_detail_penjualan');
	}

	function ubah($id){
		$this->db->where('md5(no_penjualan)',$id);
		return $this->db->get('tmp_detail_penjualan');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_penjualan',$id);
		return $this->db->update('tmp_detail_penjualan',$data);
	}

	function batal($id){
		$this->db->where('md5(no_penjualan)',$id);
		$this->db->delete('tmp_detail_penjualan');
	}

}
