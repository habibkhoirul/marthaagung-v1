<?php
foreach ($dt_toko->result() as $dt) { 
  $alamat = $dt->alamat;
  $whatsapp = $dt->no_whatsapp;
  $telp = $dt->no_telepon;
  $email = $dt->email;
  $facebook = $dt->facebook;
  $tampil_perhitungan = $dt->tampil_perhitungan;
  $indeks_musim = $dt->indeks_musim;
}

foreach ($dt_galeri->result() as $dt) {
  $foto1 = $dt->foto1;
  $foto2 = $dt->foto2;
  $foto3 = $dt->foto3;
  $foto4 = $dt->foto4;
  $foto5 = $dt->foto5;
  $foto6 = $dt->foto6;
}
?>

<div class="col-md-10 offset-md-1">

<?php if( ($this->session->flashdata('error') != null) || ($this->session->flashdata('success') != null) ) { 
  if( $this->session->flashdata('error') != null) {
    $messages = $this->session->flashdata('error');
    $alertType = 'danger';
  
  } else {
    $messages = $this->session->flashdata('success');
    $alertType = 'success';
  } 

?>
<div class="alert alert-<?php echo $alertType ?> alert-dismissible fade show" role="alert">
  <strong><?php echo $messages ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<!-- Panel Section -->

  <!-- Panel Database -->
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <i class="fas fa-database"></i>&emsp;Database
    </div>
    <div class="card-body">
      <form clas="row" action="<?php echo base_url() ?>Manajemen/restoreDatabase" method="POST" name="simpanform" enctype="multipart/form-data">

      <div class="form-group row">
        <label for="restore_file" class="col-md-3 col-sm-2 col-form-label">Restore Database</label>
        <div class="col-md-4 col-sm-5">
          <input type="file" name="restore_file" id="restore_file" class="form-control-file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
        </div>
        <div class="col-md-4 col-sm-4">
          <button type="submit" class="btn btn-outline-primary" >
            <i class="fa fa-upload"></i> Restore Data
          </button>
        </div>
      </div>

      <div class="form-group row">
        <label for="restore_file" class="col-md-3 col-sm-2 col-form-label">Backup Database</label>
        <div class="col-md-4 col-sm-10">
          <a href="<?php echo base_url().'Manajemen/backupDatabase'?>" class="btn btn-primary btn-tambah" role="button">
            <i class="fa fa-download"></i> Backup Database
          </a>
        </div>
      </div>

      </form>
    </div>
  </div>
  <!-- End of Panel Database -->

  <!-- Panel Data Toko -->
  <div class="card mt-4 shadow-sm">
    <div class="card-header bg-dark text-white">
      <i class="fas fa-file"></i>&emsp;Data Toko
    </div>
    <div class="card-body">
    <form clas="row" action="<?php echo base_url() ?>Manajemen/simpanDataToko" method="POST" name="simpanform" enctype="multipart/form-data">

      <div class="form-group row">
        <label for="alamat" class="col-md-2 col-sm-2 col-form-label">Alamat</label>
        <div class="col-md-10 col-sm-10">
          <textarea class="form-control" name="alamat" id="alamat" rows="5"><?php echo $alamat ?></textarea>
        </div>
      </div>
  
      <div class="form-group row">
      <label for="whatsapp" class="col-md-2 col-sm-2 col-form-label">No. Whatsapp</label>
      <div class="col-md-10 col-sm-10">
        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="No. Whatsapp" value="<?php echo $whatsapp ?>" maxlength="16" required>
      </div>
      </div>

      <div class="form-group row">
      <label for="telp" class="col-md-2 col-sm-2 col-form-label">No Telepon</label>
      <div class="col-md-10 col-sm-10">
        <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telepon" value="<?php echo $telp ?>" maxlength="16" required>
      </div>
      </div>

      <div class="form-group row">
      <label for="email" class="col-md-2 col-sm-2 col-form-label">Email</label>
      <div class="col-md-10 col-sm-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email ?>" maxlength="30">
      </div>
      </div>

      <div class="form-group row">
      <label for="facebook" class="col-md-2 col-sm-2 col-form-label">Facebook</label>
      <div class="col-md-10 col-sm-10">
        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook"  maxlength="20" value="<?php echo $facebook ?>">
      </div>
      </div>

      <div class="form-group row">
      <label for="tampil_perhitungan" class="col-md-2 col-sm-2 col-form-label">Peramalan</label>
      <div class="col-md-10 col-sm-10">
        <select class="form-control" id="tampil_perhitungan" name="tampil_perhitungan">
          <option value="0" <?= ($tampil_perhitungan == '0') ? 'selected' : '' ?>>Sembunyikan Perhitungan</option>
          <option value="1" <?= ($tampil_perhitungan == '1') ? 'selected' : '' ?>>Tampilkan Perhitungan</option>
        </select>
      </div>
      </div>

      <div class="form-group row">
      <label for="indeks_musim" class="col-md-2 col-sm-2 col-form-label">Indeks Musim</label>
      <div class="col-md-10 col-sm-10">
        <select class="form-control" id="indeks_musim" name="indeks_musim">
          <option value="0" <?= ($indeks_musim == '0') ? 'selected' : '' ?>>Abaikan Indeks Musim</option>
          <option value="1" <?= ($indeks_musim == '1') ? 'selected' : '' ?>>Gunakan Indeks Musim</option>
        </select>
      </div>
      </div>

      <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">
        <div class="btni" style="float: right;">
          <button type="submit" class="btn btn-outline-primary" >
            <i class="fa fa-check"></i> Simpan
          </button>
        </div>
      </div>

      </form>
    </div>
  </div>
  <!-- End of Panel Data Toko -->

  <!-- Panel Galeri Foto -->
  <div class="card mt-4 shadow-sm">
    <div class="card-header bg-dark text-white">
      <i class="fas fa-camera"></i>&emsp;Gallery Foto
    </div>
    <div class="card-body">
    <form clas="row" action="<?php echo base_url() ?>Manajemen/simpanDataGaleri" method="POST" name="simpanform" enctype="multipart/form-data">
      <div class="alert alert-info mt-2">
        <strong>Info!</strong>
        <ul>
          <li>Jika ingin mengganti foto, pilih foto baru</li>
          <li>Jika tidak ingin mengganti foto, kosongi foto galeri!!</li>
          <li>Format File yang didukung PNG/JPG/JPEG/GIF</li>
          <li>Ukuran Maksimum File adalah 5MB</li>
        </ul>
      </div>
      <?php
        for($i=0; $i<6; $i++) {
      ?>
      <hr />
      <div class="form-group row">
        <div class="col-md-5 col-sm-10">
          <p class="text-dark">Foto <?php echo $i+1 ?></p>
          <input type="file" class="form-control-file" id="foto<?php echo $i+1 ?>" name="foto<?php echo $i+1 ?>" accept="image/*" placeholder="Foto 1">
        </div>
        <div class="col-md-7 col-sm-12">
          <p class="text-dark">Gambar Sebelumnya: <?php echo ${'foto'.($i+1)} ?></p>
          <input type="hidden" name="foto_lama_<?php echo $i+1 ?>" value="<?php echo ${'foto'.($i+1)} ?>">
          <img 
            class="img-responsive"
            src="http://localhost/HabibMart.com/uploads/images/galeri/<?php echo ${'foto'.($i+1)} ?>" 
            alt="foto1"
            width="100%">
        </div>
      </div>
      <?php 
        }
      ?>
      
      <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">
        <div class="btni" style="float: right;">
          <button type="submit" class="btn btn-outline-primary" >
            <i class="fa fa-check"></i> Simpan
          </button>
        </div>
      </div>

      </form>
    </div>
  </div>
  <!-- End of Panel Galeri Foto -->

<!-- End of Panel Section -->
</div>

<script>
  function gettgl(){
    var d, nowdate, year, month;
    d = new Date();
    nowdate = d.getDate();
    month = d.getMonth()+1; 
    year = d.getFullYear();

    document.getElementById("tgl_start").value =  year + '-' + month + '-' + nowdate;
  };
</script>
