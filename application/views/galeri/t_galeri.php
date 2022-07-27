<?php 

  $nama = "";
  $imgpath = '/uploads/images/galeri/';

if(isset($error)) {
  $kdgaleri = $last_data['kdgaleri'];
  $nama = $last_data['nama'];
  $gambar = $last_data['gambar'];

} else {
  if($mode=="Edit"){
    foreach ($dt_galeri->result() as $dt) { 
      $kdgaleri = $dt->kd_galeri;
      $nama = $dt->nm_galeri;
      $gambar = $dt->gambar;
    }
  } else {
    $kdgaleri = $id;
  }
}

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-gift"></i> <?php echo $mode?> Data Galeri
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

<form clas="row" action="<?php echo base_url() ?>Galeri/simpan" method="POST" name="simpanform" enctype="multipart/form-data"">

    <div class="form-group row">
      <label for="kdgaleri" class="col-md-2 col-sm-2 col-form-label">ID Galeri</label>
      <div class="col-md-2 col-sm-10">
        <input type="text" class="form-control" id="kdgaleri" name="kdgaleri" value="<?php echo $kdgaleri ?>" readonly>
        <input type="hidden" name="mode" value="<?php echo $mode ?>">
      </div>
    </div>

  <div class="form-group row">
    <label for="nama" class="col-md-2 col-sm-2 col-form-label">Nama Galeri</label>
    <div class="col-md-6 col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" maxlength="50" required>
    </div>
  </div>
  
  <div class="alert alert-info">
    <strong>Info!</strong>
    <ul>
      <?php if($mode=='Edit') { ?>
      <li>Jika ingin mengganti gambar, pilih gambar baru</li>
      <li>Jika tidak ingin mengganti gambar, kosongi gambar galeri!!</li>
      <?php } else { ?>
      <li>Jika Gambar tidak diisi maka akan berisi gambar default</li>
      <?php } ?>
      <li>Format File yang didukung PNG/JPG/JPEG/GIF</li>
      <li>Ukuran Maksimum File adalah 5MB</li>
    </ul>
  </div>
  <div class="form-group row">
    <label for="gambar" class="col-md-2 col-sm-2 col-form-label">Gambar Galeri</label>
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
      
      <a role="button" class="btn btn-danger btn-batal" href="<?php echo base_url()?>Galeri" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
        Batal
      </a>
    </div>
  </div>
</form>

</div>
