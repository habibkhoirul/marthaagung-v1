<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_detail_pembelian extends CI_Model {

	public function getdetail_pembelian($limit = null,$start = null, $no_beli = null)
	{
		$this->db->select('produk.nm_produk, produk.harga_modal, supplier.nm_supplier, detail_pembelian.*');
		$this->db->from('detail_pembelian');
		$this->db->join('produk', 'detail_pembelian.kd_produk = produk.kd_produk');
		$this->db->join('supplier', 'detail_pembelian.kd_supplier = supplier.kd_supplier');
		if(!is_null($no_beli)) $this->db->where('md5(no_pembelian)', $no_beli);
		return $this->db->get();
	}

	function simpan($data){
		$this->db->insert('detail_pembelian',$data); 
	}

	function hapus($id){
		$this->db->where('md5(kd_produk)',$id);
		$this->db->delete('detail_pembelian');
	}

	function ubah($id){
		$this->db->where('md5(no_pembelian)',$id);
		return $this->db->get('detail_pembelian');
	}

	function ubah_simpan($id,$data){
		$this->db->where('no_pembelian',$id);
		return $this->db->update('detail_pembelian',$data);
	}

	function batal($id){
		$this->db->where('md5(no_pembelian)',$id);
		$this->db->delete('detail_pembelian');
	}

}
