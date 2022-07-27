<?php 
  $imgpath = '/uploads/images/galeri/';
?>

<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
          <a class="btn btn-outline-primary" role="button" href="Galeri/tambah">
            <i class="fa fa-plus"></i> Tambah
          </a>
    </div>
  </div>    

  <!-- Start of Alert Section -->
  <?php if( ($this->session->flashdata('error') != null) || ($this->session->flashdata('success') != null) ) { 
    if( $this->session->flashdata('error') != null) {
      $messages = $this->session->flashdata('error');
      $alertType = 'danger';
    
    } else {
      $messages = $this->session->flashdata('success');
      $alertType = 'success';
    } 
  ?>
  <div class="alert alert-<?php echo $alertType ?> alert-dismissible fade show mt-3" role="alert">
    <strong><?php echo $messages ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>
  <!-- End of Alert Section -->

  <div class="table-responsive" style="border-top: 2px solid #6c757d; margin-top: 10px; padding-top: 10px;">

  	<table class="table table-striped table-hover" id="tabel">
  		<thead>
  			<th>Kode Galeri</th>
  			<th>Nama</th>
        <th>Gambar</th>
        <th>Opsi</th>
  		</thead>
  		<tbody>
  		<?php 
  		foreach ($dt_galeri->result() as $data){
            echo '
            <tr>
            <td>'.$data->kd_galeri.'</td>
            <td>'.$data->nm_galeri.'</td>
            <td> <img src="'.base_url($imgpath.$data->gambar).'" alt="Gambar" class="img-rounded" height="200px"></td>
            <td>
              <a class="btn btn-outline-primary btn-sm" href="Galeri/edit/'.md5($data->kd_galeri).'" role="button" data-toggle="tooltip" data-placement="top" title="Hapus">
                  <i class="fa fa-edit"></i>
              </a>

              <a class="btn btn-outline-dark btn-sm" href="Galeri/delete/'.md5($data->kd_galeri).'" role="button" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini ??\')" 
                  data-toggle="tooltip" data-placement="top" title="Hapus">
                  <i class="fa fa-trash"></i>
              </a>
            </td>
            </tr>';
        } ?>
  		</tbody>
  	</table>

  </div>
</div>