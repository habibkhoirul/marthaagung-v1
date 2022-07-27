<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Manajemen extends CI_Controller {
	const kddatatoko = 'DT001';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_data_toko');
		$this->load->model('M_produk');
		$this->load->model('M_penjualan');
		$this->load->model('M_detail_penjualan');
	}

	public function index() {
		$menu['manajemen_menu'] = 'active';
		$menu['title'] = '<i class="fas fa-cog"></i> Manajemen Data';
		$data['dt_toko'] = $this->M_data_toko->getdatatoko(Manajemen::kddatatoko);
		$data['dt_galeri'] = $this->M_data_toko->getdatagaleri(Manajemen::kddatatoko);
		$this->load->view('dashboard-header',$menu);
		$this->load->view('manajemen/manajemen', $data);
		$this->load->view('dashboard-footer');
	}

	public function backupDatabase() {
		$this->load->dbutil();
		$prefs = array(
					'format' => 'zip',
					'filename' => 'Marthaagung_backup.sql'
				);
		$backup =& $this->dbutil->backup($prefs);
		$nm_file = 'backup-on-'.date('Y-m-d-H-i-s').'.zip';
		$saveFile = './backup/database/'.$nm_file;
		
		// $this->load->helper('file');
		// if(write_file($saveFile, $backup)) {
		// 	$this->session->set_flashdata('success', 'Database Berhasil DiBackup !!');
		// } else {
		// 	$this->session->set_flashdata('error', 'Gagal Mem-Backup Database !!');
		// }

		$this->load->helper('download');
		force_download($nm_file, $backup);

	}

	public function restoreDatabase() {
		$path 		= 'uploads/files/';
		$json 		= [];
		$this->upload_config($path);
		if (!$this->upload->do_upload('restore_file')) {
			$json = [
				'error_message' => $this->upload->display_errors(),
			];
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('Manajemen');
		} else {
			$produks = $this->M_produk->getGroupBy('nm_produk');
			
			$file_data 	= $this->upload->data();
			$file_name 	= $path.$file_data['file_name'];
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);
			if('csv' == $extension) {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet 	= $reader->load($file_name);
			$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
			$list 			= [];
			
			$penjualanToInsert = array();
			$detailToInsert = array();
			$idPenjualan = 1;
			foreach($sheet_data as $key => $val) {
				$val9 = trim($val[9]);
				if(empty($val9)) continue;

				$checkIfExist = array_key_exists($val9, $produks);
				
				if($checkIfExist) {
					$jumlah = abs((int) $val[10]);
					$total = intval($produks[$val9]->harga_jual) * $jumlah;
					array_push($detailToInsert, [
						'no_penjualan' => $idPenjualan,
						'kd_produk' => $produks[$val9]->kd_produk,
						'harga' => $produks[$val9]->harga_jual,
						'jumlah' => $jumlah,
						'subtotal' => $total
					]);
					array_push($penjualanToInsert, [
						'no_penjualan' => $idPenjualan,
						'tgl_penjualan' => date('Y-m-d', DateTime::createFromFormat('!d/m/Y', trim($val[2]))->getTimestamp()),
						'total' => $total,
						'uang_bayar' => $total,
						'kd_petugas' => 'PT001'
					]);
				} else {
					continue;
				}
				
				$idPenjualan++;
			}
			
			if(file_exists($file_name))
				unlink($file_name);

			if(count($detailToInsert) > 0 && (count($detailToInsert) == count($penjualanToInsert)) ) {
				$resultPenjualan 	= $this->M_penjualan->simpan($penjualanToInsert);
				$resultDetailPenjualan 	= $this->M_detail_penjualan->simpan($detailToInsert);

				$this->session->set_flashdata('success', 'Data Berhasil Di Import');
			} else {
				$this->session->set_flashdata('error', 'Terjadi Kesalahan, Data Gagal Di Import');
			}
		}

		redirect('Manajemen');

	}

	public function simpanDataToko() {
		$data = array(
			'alamat' => $this->input->post('alamat'),
			'no_whatsapp' => $this->input->post('whatsapp'),
			'no_telepon' => $this->input->post('telp'),
			'email' => $this->input->post('email'), 		
			'facebook' => $this->input->post('facebook'),
			'tampil_perhitungan' => $this->input->post('tampil_perhitungan'),
			'indeks_musim' => $this->input->post('indeks_musim')
            );

		if($this->M_data_toko->ubah_simpan(Manajemen::kddatatoko,$data)) $this->session->set_flashdata('success', 'Data berhasil diperbarui !!');
		else $this->session->set_flashdata('error', 'Gagal memperbarui data !!');

		redirect('Manajemen');
	}

	public function simpanDataGaleri(){       
		$config['upload_path']  = './uploads/images/galeri/';
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size']     = 5000;
		$this->load->library('upload', $config);
		
		$nama_file_gambar = '';

		if(!empty($_FILES['foto1']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_1'));

			if ( ! $this->upload->do_upload('foto1')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_1 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_1 = $this->input->post('foto_lama_1');
		}

		if(!empty($_FILES['foto2']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_2'));

			if ( ! $this->upload->do_upload('foto2')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_2 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_2 = $this->input->post('foto_lama_2');
		}

		if(!empty($_FILES['foto3']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_3'));

			if ( ! $this->upload->do_upload('foto3')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_3 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_3 = $this->input->post('foto_lama_3');
		}

		if(!empty($_FILES['foto4']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_4'));

			if ( ! $this->upload->do_upload('foto4')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_4 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_4 = $this->input->post('foto_lama_4');
		}

		if(!empty($_FILES['foto5']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_5'));

			if ( ! $this->upload->do_upload('foto5')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_5 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_5 = $this->input->post('foto_lama_5');
		}

		if(!empty($_FILES['foto6']['name'])) {
			$this->hapusGambar($this->input->post('foto_lama_6'));

			if ( ! $this->upload->do_upload('foto6')) {
				$data['error'] = array('error' => $this->upload->display_errors());

				$this->load->view('dashboard-header',$menu);
				$this->load->view('manajemen/manajemen',$data);
				$this->load->view('dashboard-footer');
				return 0;
			
			} else {
				$nama_file_gambar_6 = $this->upload->data('file_name');				
			}

		} else {
			$nama_file_gambar_6 = $this->input->post('foto_lama_6');
		}

		$data = array(
			'foto1' => $nama_file_gambar_1,
			'foto2' => $nama_file_gambar_2,
			'foto3' => $nama_file_gambar_3,
			'foto4' => $nama_file_gambar_4,
			'foto5' => $nama_file_gambar_5,
			'foto6' => $nama_file_gambar_6
			);
			
		if($this->M_data_toko->ubah_simpan_galeri(Manajemen::kddatatoko, $data)) $this->session->set_flashdata('success', 'Data Galeri berhasil diperbarui !!');
		else $this->session->set_flashdata('error', 'Gagal mengubah data !!');
		
		redirect('Manajemen');
	}

	public function hapusGambar($gambarFilename) {
		$pathGambar = './uploads/images/galeri/';
		$uri = $pathGambar.$gambarFilename;
		if(file_exists($uri) && is_file($uri) && is_writable($uri)) unlink($uri);
		return true; 
	}

	public function upload_config($path) {
		if (!is_dir($path)) 
			mkdir($path, 0777, TRUE);		
		$config['upload_path'] 		= './'.$path;		
		$config['allowed_types'] 	= 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 1409600; 
		$this->load->library('upload', $config);
	}
}
