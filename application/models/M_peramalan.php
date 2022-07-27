<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peramalan extends CI_Model {

	public function getperamalan($tabel)
	{
		return $this->db->get($tabel);
	}

	public function getperamalan_transaksi($tabel,$tgl_start,$tgl_end){
		$this->db->select("$tabel.*, petugas.nm_petugas, detail_$tabel.*");
		$this->db->from($tabel);
		$this->db->join("detail_$tabel", "detail_$tabel.no_$tabel = $tabel.no_$tabel");
		$this->db->join("petugas", "$tabel.kd_petugas = petugas.kd_petugas");
		if($tgl_start!="") $this->db->where("tgl_$tabel BETWEEN '".date('Y-m-d', strtotime($tgl_start))."' AND '".date('Y-m-d', strtotime($tgl_end))."'");
		return $this->db->get();
	}
}
