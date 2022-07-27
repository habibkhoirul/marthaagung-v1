<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

	public function proseslogin($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get('petugas')->result_array();
	}

	function mp($data){
		$this->db->where('username',$data);
		return $this->db->get('petugas');
	}

	function ubah_simpan($unama,$data){
		$this->db->where('username',$unama);
		return $this->db->update('petugas',$data);
	}

}
