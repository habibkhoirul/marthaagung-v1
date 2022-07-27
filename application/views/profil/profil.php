<?php 

  foreach ($dt_petugas->result() as $dt) { 
    $username = $dt->username;
    $password = $dt->password;
  }

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-users"></i> Change Profile
    </center>
  </h3>
</div>

<div class="col-md-10 offset-1">

<form clas="row" action="<?php echo base_url() ?>Profil/simpan" method="POST" name="simpanform" enctype="multipart/form-data" onsubmit="if (simpanform.password.value != simpanform.password2.value ){ alert('Password Tidak Sama'); simpanform.password2.focus(); return false;}">

  <div class="form-group row">
    <label for="username" class="col-md-2 col-sm-2 col-form-label">Username</label>
    <div class="col-md-5 col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username ?>" maxlength="20" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="password" class="col-md-2 col-sm-2 col-form-label">Password</label>
    <div class="col-md-4 col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password"  maxlength="20" value="<?php echo $password ?>" required>
    </div>
    <div class="col-md-4 col-sm-10">
      <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password"  maxlength="20" value="<?php echo $password ?>" required>
    </div>
      <input type="hidden" name="password_lama" value="<?php echo $password ?>">
  </div>

  <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

    <div class="btni" style="float: right;">
      <button type="submit" class="btn btn-outline-primary">
        <i class="fa fa-check"></i> Simpan
      </button>
      
      <a role="button" class="btn btn-danger btn-batal" href="<?php echo base_url()?>Home" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
        Batal
      </a>
    </div>
  </div>
</form>

</div>
