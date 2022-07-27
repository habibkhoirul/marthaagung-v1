<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
          <a class="btn btn-outline-primary" role="button" href="Produk/tambah">
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
  			<th>Kode Produk</th>
  			<th>Nama</th>
  			<th>Hrg Modal</th>
  			<th>Hrg Jual</th>
  			<th>Stok</th>
        <th>Keterangan</th>
        <th>Opsi</th>
  		</thead>
  		<tbody>
  		<?php 
  		foreach ($dt_produk->result() as $data){
            echo '
            <tr>
            <td>'.$data->kd_produk.'</td>
            <td>'.$data->nm_produk.'</td>
            <td>Rp. '.$data->harga_modal.'</td>
            <td>Rp. '.$data->harga_jual.'</td>
            <td>'.$data->stok.'</td>
            <td>'.$data->keterangan.'</td>
            <td>
              <a class="btn btn-outline-primary btn-sm" href="Produk/edit/'.md5($data->kd_produk).'" role="button" data-toggle="tooltip" data-placement="top" title="Hapus">
                  <i class="fa fa-edit"></i>
              </a>

              <a class="btn btn-outline-dark btn-sm" href="Produk/delete/'.md5($data->kd_produk).'" role="button" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini ??\')" 
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