<div class="col-md-12">

  <div class="row">
    <div class="col-md-12">
          <a class="btn btn-outline-primary" role="button" href="Pembelian/tambah">
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
  			<th>No Pembelian</th>
        <th>Tgl Pembelian</th>
        <th>Total</th>
        <th>Bayar</th>
        <th>ID Petugas</th>
  			<th>Opsi</th>
  		</thead>
  		<tbody>
  		<?php 
  		foreach ($dt_pembelian->result() as $data){
            echo '
            <tr>
            <td>'.$data->no_pembelian.'</td>
            <td>'.$data->tgl_pembelian.'</td>
            <td>Rp. '.$data->total.'</td>
            <td>Rp. '.$data->uang_bayar.'</td>
            <td>'.$data->kd_petugas.'</td>
                <td>
                    <a class="btn btn-outline-primary btn-sm" href="Pembelian/detPembelian/'.md5($data->no_pembelian).'" role="button" data-toggle="tooltip" data-placement="top" title="Detail Transaksi">
                        <i class="fa fa-search"></i>
                    </a>
                    <a class="btn btn-outline-dark btn-sm" href="Pembelian/delete/'.md5($data->no_pembelian).'" role="button" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini ??\')" 
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