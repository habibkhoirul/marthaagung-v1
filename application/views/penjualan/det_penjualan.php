<?php 
  foreach ($dt_penjualan->result() as $dt) { 
    $no_jual = $dt->no_penjualan;
    $kd_petugas = $dt->kd_petugas;
    $tanggal = $dt->tgl_penjualan;
    $total = $dt->total;
    $uang_bayar = $dt->uang_bayar;
    $kembalian = $uang_bayar - $total;
  }

?>

<div class="col-md-12 row" style="margin-bottom: 30px;">
  <div class="col-md-10">
    <h3>
      <center>
      <i class="fas fa-shopping-cart"></i> Detail Transaksi
      </center>
    </h3>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-dark" onclick="window.history.back()">
      Kembali
    </button>
  </div>
</div>

<div class="row col-md-12">

<div class="col-md-6">
  <form clas="row" action="<?php echo base_url() ?>Penjualan/simpan" method="POST" name="simpanform" enctype="multipart/form-data"">

      <div class="form-group row">
        <label for="no_jual" class="col-md-4 col-sm-2 col-form-label">No Penjualan</label>
        <div class="col-md-8 col-sm-10">
          <input type="text" class="form-control" id="no_jual" value="<?php echo $no_jual ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
          <label for="kd_petugas" class="col-md-4 col-sm-2 col-form-label">ID Petugas</label>
          <div class="col-md-8 col-sm-10">
            <input type="text" class="form-control" id="kd_petugas" value="<?php echo $kd_petugas ?>" readonly>
          </div>
      </div>
   
</div>

<div class="col-md-6">

  <div class="form-group row">
      <label for="tgl_now" class="col-md-4 col-sm-2 col-form-label">Tanggal</label>
      <div class="col-md-8 col-sm-10">
        <input type="date" class="form-control" id="tgl_now" value="<?php echo $tanggal ?>" readonly>
      </div>
  </div>
  
</div>

  <div class="col-md-12" style="padding: 0 0 0 10px;">
    
    <br>
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </thead>
      <tbody>
      <?php
      $no=0; $gr_jml=0; $gr_total=0; 
      foreach ($dt_detail->result() as $data){
            $no=$no+1; $gr_jml=$gr_jml+$data->jumlah; $gr_total=$gr_total+$data->subtotal;

            echo '
            <tr>
            <td>'.$no.'</td>
            <td>'.$data->nm_produk.'</td>
            <td>Rp. '.$data->harga.'</td>
            <td>'.$data->jumlah.'</td>
            <td>Rp. '.$data->subtotal.'</td>
            </tr>';
     } ?>
        <tr>
          <td colspan="3">Grand Total</td>
          <td><?php echo $gr_jml ?></td>
          <td>Rp. <?php echo $total ?></td>
        </tr>
      </tbody>
    </table>

    <div class="form-group row">
      <label for="uang_bayar" class="col-md-4 col-sm-2 col-form-label">Uang Bayar</label>
      <div class="col-md-8 col-sm-10">
        <input type="number" class="form-control" id="uang_bayar" value="<?php echo $uang_bayar ?>" readonly></input>
      </div>
    </div>

    <div class="form-group row">
      <label for="kembalian" class="col-md-4 col-sm-2 col-form-label">Kembalian</label>
      <div class="col-md-8 col-sm-10">
        <input type="number" class="form-control" id="kembalian" value="<?php echo $kembalian ?>" readonly></input>
      </div>
    </div>  

  </div>

  </form>

</div>