<?php 

  $uang_bayar = "";
  $kd_petugas = $this->session->userdata('kd_petugas');
  $no_beli = $id;

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-dolly"></i> Transaksi Pembelian
    </center>
  </h3>
</div>

<div class="row col-md-12">

<div class="col-md-6">
  <form clas="row" action="<?php echo base_url() ?>Pembelian/simpan" method="POST" name="simpanform" enctype="multipart/form-data"">

      <div class="form-group row">
        <label for="no_beli" class="col-md-4 col-sm-2 col-form-label">No Pembelian</label>
        <div class="col-md-8 col-sm-10">
          <input type="text" class="form-control" id="no_beli" name="no_beli" value="<?php echo $no_beli ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
          <label for="kd_petugas" class="col-md-4 col-sm-2 col-form-label">ID Petugas</label>
          <div class="col-md-8 col-sm-10">
            <input type="text" class="form-control" id="kd_petugas" name="kd_petugas" value="<?php echo $kd_petugas ?>" required readonly>
          </div>
      </div>
   
</div>

<div class="col-md-6">

  <div class="form-group row">
      <label for="tgl_beli" class="col-md-4 col-sm-2 col-form-label">Tanggal</label>
      <div class="col-md-8 col-sm-10">
        <input type="date" class="form-control" id="tgl_now" name="tgl_beli" required readonly>
      </div>
  </div>
  
</div>

  <div class="col-md-4">
    <br>
    <div class="form-group row">
      <label for="produk_tindakan" class="col-md-3 col-sm-2 col-form-label">Produk</label>
      <div class="col-md-9 col-sm-10">
        <input type="text" class="form-control" id="produk" name="produk" placeholder="Produk" required style="pointer-events: none">
      </div>
    </div>

    <div class="form-group row">
      <label for="jumlah" class="col-md-3 col-sm-2 col-form-label"></label>
      <div class="col-md-4 col-sm-3">
        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_produk">
          <i class="fas fa-search"></i> Produk
        </button>
      </div>
    </div>

    <div class="form-group row">
      <label for="jumlah" class="col-md-3 col-sm-2 col-form-label">Jumlah</label>
      <div class="col-md-9 col-sm-10">
        <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required value="1"></input>
        <input type="hidden" id="harga" name="harga"></input>
      </div>
    </div>

    <div class="form-group row">
      <label for="supplier" class="col-md-3 col-sm-2 col-form-label">Supplier</label>
      <div class="col-md-9 col-sm-10">
        <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Supplier" required style="pointer-events: none">
      </div>
    </div>

    <div class="form-group row">
      <label for="jumlah" class="col-md-3 col-sm-2 col-form-label"></label>
      <div class="col-md-4 col-sm-3">
        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal_supplier">
          <i class="fas fa-search"></i> Supplier
        </button>
      </div>
    </div>

    <!-- Hidden Input -->
    <input type="hidden" name="kdproduk" id="kdproduk">
    <input type="hidden" name="kdsupplier" id="kdsupplier" required>
    <!-- End of Hidden Input -->
    <button type="submit" class="btn btn-primary col-md-12" name="tambah_produk">
      <i class="fa fa-plus"></i> Tambah
    </button>
    
  </div>

  <div class="col-md-8" style="padding: 0 0 0 10px; font-size: 14px">
    
    <br>
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Produk</th>
        <th>Supplier</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Opsi</th>
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
            <td>'.$data->nm_supplier.'</td>
            <td>Rp. '.$data->harga_modal.'</td>
            <td>'.$data->jumlah.'</td>
            <td>Rp. '.$data->subtotal.'</td>
                <td>
                    <a class="btn btn-outline-dark btn-sm" href="delete_produk/'.md5($data->kd_produk).'" role="button" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>';
     } ?>
        <tr>
          <td colspan="4">Grand Total</td>
          <td><?php echo $gr_jml ?></td>
          <td>Rp. <?php echo $gr_total ?></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div class="form-group row">
      <label for="uang_bayar" class="col-md-4 col-sm-2 col-form-label">Uang Bayar</label>
      <div class="col-md-8 col-sm-10">
        <input type="hidden" id="hid_total" name="hid_total" value="<?php echo $gr_total ?>">
        <input type="number" class="form-control" id="uang_bayar" name="uang_bayar" placeholder="Uang Bayar" min="0" value="<?php echo $gr_total ?>" required></input>
      </div>
    </div>

    <div class="form-group row">
      <label for="kembalian" class="col-md-4 col-sm-2 col-form-label">Kembalian</label>
      <div class="col-md-8 col-sm-10">
        <input type="number" class="form-control" id="kembalian" name="kembalian" min="0"value="0" placeholder="Kembalian" readonly></input>
      </div>
    </div>  

  </div>

    
    <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

      <div class="btni" style="float: right;">
        <button type="submit" class="btn btn-outline-primary" name="simpan_transaksi">
          <i class="fa fa-check"></i> Simpan
        </button>
        
        <a role="button" class="btn btn-danger btn-batal" href="<?php echo 'batal/'.md5($id) ?>" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
          Batal
        </a>
      </div>
    </div>
  </form>

</div>