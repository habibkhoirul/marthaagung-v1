<?php 

  $nama = "";
  $username = "";
  $password = "";
  $nik = "";
  $alamat ="";
  $telp = "";
  $rbLaki = "";
  $rbPerempuan = "";
  $opDefault = "Selected";
  $opAdmin = "";
  $opPetugas = "";

if($mode=="Edit"){
    foreach ($dt_petugas->result() as $dt) { 
      $kdpetugas = $dt->kd_petugas;
      $nik = $dt->nik;
      $nama = $dt->nm_petugas;
      $alamat = $dt->alamat;
      $username = $dt->username;
      $telp = $dt->no_telepon;
      $password = $dt->password;
      $level = $dt->level;
      $gender = $dt->gender;
      $opDefault = '';

      if($level=='Administrator') $opAdmin='Selected';
      else $opPetugas='Selected';
     
      if($gender=='Laki-Laki') $rbLaki='Checked';
      else $rbPerempuan='Checked';
     
    }
} else {
      $kdpetugas = $id;
}

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-users"></i> <?php echo $mode?> Data Petugas
    </center>
  </h3>
</div>

<div class="col-md-10 offset-md-1">

<form clas="row" action="<?php echo base_url() ?>Petugas/simpan" method="POST" name="simpanform" enctype="multipart/form-data" onsubmit="if (simpanform.password.value != simpanform.password2.value ){ alert('Password Tidak Sama'); simpanform.password2.focus(); return false;}">

    <div class="form-group row">
      <label for="kdpetugas" class="col-md-2 col-sm-2 col-form-label">ID Petugas</label>
      <div class="col-md-2 col-sm-10">
        <input type="text" class="form-control" id="kdpetugas" name="kdpetugas" value="<?php echo $kdpetugas ?>" readonly>
        <input type="hidden" name="mode" value="<?php echo $mode ?>">
      </div>
    </div>

  <div class="form-group row">
    <label for="nik" class="col-md-2 col-sm-2 col-form-label">NIK</label>
    <div class="col-md-4 col-sm-10">
      <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Keluarga" value="<?php echo $nik ?>" maxlength="16" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="nama" class="col-md-2 col-sm-2 col-form-label">Nama</label>
    <div class="col-md-6 col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" maxlength="50" required>
    </div>
  </div>

  <div class="form-group row">    
    <label for="gender" class="col-sm-2 control-label">Gender</label>
    <div class="col-md-6 col-sm-10">
      <div class="radio">
        <label>
          <input name="gender" type="radio" id="rbLaki" value="Laki-Laki" <?php echo $rbLaki?> /><label for="rbLaki">&nbsp;Laki - Laki</label>
        </label>&emsp;&emsp;&emsp;
        <label>
          <input name="gender" type="radio" id="rbPerempuan" value="Perempuan" <?php echo $rbPerempuan?>/><label for="rbPerempuan">&nbsp;Perempuan</label>
        </label>
      </div>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
    <div class="col-md-6 col-sm-10">
      <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="4"><?php echo $alamat ?></textarea>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="telp" class="col-md-2 col-sm-2 col-form-label">No Telepon</label>
    <div class="col-md-4 col-sm-10">
      <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telepon" value="<?php echo $telp ?>" maxlength="16" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="username" class="col-md-2 col-sm-2 col-form-label">Username</label>
    <div class="col-md-5 col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username ?>" maxlength="20" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="password" class="col-md-2 col-sm-2 col-form-label">Password</label>
    <div class="col-md-4 col-sm-10">
      <!-- Jika ingin password, type="password" -->
      <input type="text" class="form-control" id="password" name="password" placeholder="Password"  maxlength="100" value="<?php echo $password ?>" required>
    </div>
    <div class="col-md-4 col-sm-10">
      <!-- Jika ingin password, type="password" -->
      <input type="text" class="form-control" id="password2" name="password2" placeholder="Ulangi Password"  maxlength="100" value="<?php echo $password ?>" required>
    </div>
    <?php if($mode == 'Edit') { 
      echo '<input type="hidden" name="password_lama" value="'.$password.'">';
    } ?>
  </div>

  <div class="form-group row">
    <label for="gender" class="col-md-2 col-sm-2 col-form-label">Level</label>
    <div class="col-md-4 col-sm-10">
      <select class="form-control" id="selectLevel" name="level">
        <option value="" <?php echo $opDefault ?> >-- Pilih Level --</option>
        <option value="Administrator" <?php echo $opAdmin ?> >Administrator</option>
        <option value="Petugas" <?php echo $opPetugas ?> >Petugas</option>
      </select>
    </div>
  </div>  

  <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

    <div class="btni" style="float: right;">
      <button type="submit" class="btn btn-outline-primary" >
        <i class="fa fa-check"></i> Simpan
      </button>
      
      <a role="button" class="btn btn-danger btn-batal" href="<?php echo base_url()?>Petugas" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
        Batal
      </a>
    </div>
  </div>
</form>

</div>
