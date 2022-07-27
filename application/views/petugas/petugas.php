<?php 
  $level = $this->session->userdata('level');
  ($level == 'Petugas') ? $dtManip = false : $dtManip = true;
?>

<div class="col-md-12">
  <?php if($dtManip){ ?>
  <div class="row mb-3">
    <div class="col-md-12">
          <a class="btn btn-outline-primary" role="button" href="Petugas/tambah">
            <i class="fa fa-plus"></i> Tambah
          </a>
    </div>
  </div>
  <?php } ?>  

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
  			<th>ID Petugas</th>
  			<th>NIK</th>
  			<th>Nama</th>
  			<th>Gender</th>
  			<th>Alamat</th>
  			<th>No Telepon</th>
        <?php if($dtManip) echo '<th>Opsi</th>' ?>
  		</thead>
  		<tbody>
  		<?php
  		foreach ($dt_petugas->result() as $data){
            echo '
            <tr>
                <td>'.$data->kd_petugas.'</td>
                <td>'.$data->nik.'</td>
                <td>'.$data->nm_petugas.'</td>
                <td>'.$data->gender.'</td>
                <td>'.$data->alamat.'</td>
                <td>'.$data->no_telepon.'</td>';

          if($dtManip){    
            echo '<td>
                    <a class="btn btn-outline-primary btn-sm" href="Petugas/edit/'.md5($data->kd_petugas).'" role="button" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a class="btn btn-outline-dark btn-sm" href="Petugas/delete/'.md5($data->kd_petugas).'" role="button" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini ??\')" 
                        data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>';
          }
            echo '</tr>';
        } ?>
  		</tbody>
  	</table>

  </div>
</div>