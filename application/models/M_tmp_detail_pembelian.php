<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tmp_detail_pembelian extends CI_Model {

	public function gettmp_detail_pembelian($limit = null,$start = null,$no_beli=null)
	{
		$this->db->select('produk.nm_produk, produk.harga_modal, supplier.nm_supplier, tmp_detail_pembelian.*');
		$this->db->from('tmp_detail_pembelian');
		$this->db->join('produk', 'tmp_detail_pembelian.kd_produk = produk.kd_produk');
		$this->db->join('supplier', 'tmp_detail_pembelian.kd_supplier = supplier.kd_supplier');
		if(!is_null($no_beli)) $this->db->where('no_pembelian', $no_beli);
		return $this->db->get(); 
	}

	function simpan($data){
		$this->db->insert('tmp_detail_pembelian',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_produk)',$id);
		$this->db->delete('tmp_detail_pembelian');
	}

	function ubah($id){
		$this->db->where('md5(no_pembelian)',$id);
		return $this->db->get('tmp_detail_pembelian');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_pembelian',$id);
		return $this->db->update('tmp_detail_pembelian',$data);
	}

	function batal($id){
		$this->db->where('md5(no_pembelian)',$id);
		$this->db->delete('tmp_detail_pembelian');
	}

}
