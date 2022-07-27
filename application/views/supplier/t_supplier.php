<?php 

  $nama = "";
  $telp = "";
  $almt = "";

if($mode=="Edit"){
  foreach ($dt_supplier->result() as $dt) { 
    $kdsupplier = $dt->kd_supplier;
    $nama = $dt->nm_supplier;
    $telp = $dt->no_telepon;
    $almt = $dt->alamat;
  }
} else {
  $kdsupplier = $id;
}

?>

<div class="col-md-12" style="margin-bottom: 30px;">
  <h3>
    <center>
    <i class="fas fa-truck"></i> <?php echo $mode?> Data Supplier
    </center>
  </h3>
</div>

<div class="col-md-10 offset-md-1">

<form clas="row" action="<?php echo base_url() ?>Supplier/simpan" method="POST" name="simpanform" enctype="multipart/form-data" onsubmit="if (simpanform.password.value != simpanform.password2.value ){ alert('Password Tidak Sama'); simpanform.password2.focus(); return false;}">

    <div class="form-group row">
      <label for="kdsupplier" class="col-md-2 col-sm-2 col-form-label">ID Supplier</label>
      <div class="col-md-2 col-sm-10">
        <input type="text" class="form-control" id="kdsupplier" name="kdsupplier" value="<?php echo $kdsupplier ?>" readonly>
        <input type="hidden" name="mode" value="<?php echo $mode ?>">
      </div>
    </div>

  <div class="form-group row">
    <label for="nama" class="col-md-2 col-sm-2 col-form-label">Nama</label>
    <div class="col-md-6 col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama ?>" maxlength="50" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="telp" class="col-md-2 col-sm-2 col-form-label">No Telepon</label>
    <div class="col-md-4 col-sm-10">
      <input type="text" class="form-control" id="telp" maxlength="16" name="telp" placeholder="No Telepon" value="<?php echo $telp ?>" maxlength="16" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="alamat" class="col-md-2 col-sm-2 col-form-label">Alamat</label>
    <div class="col-md-5 col-sm-10">
      <textarea class="form-control" name="alamat" id="alamat" rows="5"><?php echo $almt ?></textarea>
    </div>
  </div>

  <div class="form-group" style="width: 100%;border-top: 1px solid #6c757d; padding: 5px;">

    <div class="btni" style="float: right;">
      <button type="submit" class="btn btn-outline-primary" >
        <i class="fa fa-check"></i> Simpan
      </button>
      
      <a role="button" class="btn btn-danger btn-batal" href="<?php echo base_url()?>Supplier" onclick="return confirm('Apakah Anda Yakin Akan Membatalkan?\nData Yang Diinputkan Tidak Akan Diproses!!');">
        Batal
      </a>
    </div>
  </div>

</form>

</div>
