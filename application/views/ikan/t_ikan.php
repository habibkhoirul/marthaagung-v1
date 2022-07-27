<?php 

  $nama = "";
  $harga_modal = "";
  $harga_jual = "";
  $stok = "";
  $keterangan = "";
  $imgpath = '/uploads/images/';

if(isset($error)) {
  $kdikan = $last_data['kdikan'];
  $nama = $last_data['nama'];
  $harga_modal = $last_data['harga_modal'];
  $harga_jual = $last_data['harga_jual'];
  $stok = $last_data['stok'];
  $keterangan = $last_data['keterangan'];

} else {
  if($mode=="Edit"){
    foreach ($dt_ikan->result() as $dt) { 
      $kdikan = $dt->kd_ikan;
      $nama = $dt->nm_ikan;
      $gambar = $dt->gambar;
      $harga_modal = $dt->harga_modal;
      $harga_jual = $dt->harga_jual;
      $stok = $dt->stok;
      $keterangan = $dt->keterangan;
    }
  } else {
    $kdikan = $id;
  }
}

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-gift"></i> <?php echo $mode?> Data Ikan
    </center>
  </h3>
</div>

<div class="col-md-10 offset-md-1">

<?php if(isset($error)) { ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Gagal Mengupload Gambar !!</strong> <?php echo $error['error'] ?> Silahkan pilih gambar lain.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<form clas="row" action="<?php echo base_url() ?>Ikan/simpan" method="POST" name="simpanform" enctype="multipart/form-data"">

    <div class="form-group row">
      <label for="kdikan" class="col-md-2 col-sm-2 col-form-label">ID Ikan</label>
      <div class="col-md-2 col-sm-10">
        <input type="text" class="form-control" id="kdikan" name="kdikan" value="<?php echo $kdikan ?>" readonly>
        <input type="hidden" name="mode" value="<?php echo $mode ?>">
      </div>
    </div>

  <div class="form-group row">
    <label for="nama" class="col-md-2 col-sm-2 col-form-label">Nama Ikan</label>
    <div class="col-md-6 col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" maxlength="50" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="harga_modal" class="col-md-2 col-sm-2 col-form-label">Hrg Modal (Rp.)</label>
    <div class="col-md-3 col-sm-10">
      <input type="number" class="form-control" id="harga_modal" name="harga_modal" placeholder="Harga Modal" value="<?php echo $harga_modal ?>" min="0" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="harga_jual" class="col-md-2 col-sm-2 col-form-label">Hrg Jual (Rp.)</label>
    <div class="col-md-3 col-sm-10">
      <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual ?>" min="0" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="stok" class="col-md-2 col-sm-2 col-form-label">Stok</label>
    <div class="col-md-2 col-sm-10">
      <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="<?php echo $stok ?>" min="0" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="keterangan" class="col-md-2 col-sm-2 col-form-label">Keterangan</label>
    <div class="col-md-6 col-sm-10">
      <textarea rows="4" cols="120" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required><?php echo $keterangan ?></textarea>
    </div>
  </div>

  <div class="alert alert-info">
    <strong>Info!</strong>
    <ul>
      <?php if($mode=='Edit') { ?>
      <li>Jika ingin mengganti gambar, pilih gambar baru</li>
      <li>Jika tidak ingin mengganti gambar, kosongi gambar ikan!!</li>
      <?php } else { ?>
      <li>Jika Gambar tidak diisi maka akan berisi gambar default</li>
      <?php } ?>
      <li>Format File yang didukung PNG/JPG/JPEG/GIF</li>
      <li>Ukuran Maksimum File adalah 5MB</li>
    </ul>
  </div>
  <div class="form-group row">
    <label for="gambar" class="col-md-2 col-sm-2 col-form-label">Gambar Ikan</label>
    <div class="col-md-6 col-sm-10">
      <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" placeholder="Gambar">
    </div>
  </div>  

  <?php if($mode=='Edit') { ?>
  <div class="form-group row">
    <label for="gambar" class="col-md-2 col-sm-2 col-form-label">Gambar Sebelumnya</label>
    <div class="col-md-6 col-sm-10">
      <?php if($gambar!='') { ?>
      <img src="<?php echo base_url($imgpath.$gambar)?>" alt="Gambar Sebelumnya" class="img-rounded" height="200px">
      <?php } ?>
    </div>
  </div>  
  <?php } ?>

  <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

    <div class="btni" style="float: right;">
      <button type="submit" class="btn btn-outline-primary" >
        <i class="fa fa-check"></i> Simpan
      </button>
      
      <a role="button" class="btn btn-danger btn-batal" href="<?php echo base_url()?>Ikan" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
        Batal
      </a>
    </div>
  </div>
</form>

</div>
