<?php
    if ($this->session->userdata('msg')!=""){ ?>
      <script>
      alert("Username atau Password salah !");
      document.getElementById("username").focus();
      </script><?php
      $this->session->set_userdata('msg','');
      $this->session->unset_userdata('msg');
    } else {
      $this->session->set_userdata('msg','');
      $this->session->unset_userdata('msg');
    }
    $this->session->sess_destroy(); 
?>
<html>

<head>
  <title>MARTHA AGUNG</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/all.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/dashboard.css" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/system/favicon.png">

</head>

<body class="login">

  <div class="form-signin bg-dark">
    <div class="tab-content">
        <div>
            <form action="<?php echo base_url() ?>App/val_login" method="POST" name="formlogin">
            <h4><p class="text-white text-center" id="pandu"  style="margin-bottom: 5px;">
                    Login Martha Agung
                </p></h4>
                <br />
                <input 
                  type="text" 
                  placeholder="Username" 
                  class="form-control top bg-dark" 
                  id="username" 
                  name="username"
                  autocomplete="off" 
                  required />
                <input type="password" placeholder="Password" class="form-control bottom bg-dark" id="password" name="password" required>
                <button type="submit" class="btn btn-lg btn-primary btn-block" name="login" id="login" onclick="return validasi_input()">Login</button>
                <a href="<?php echo base_url()?>" class="btn btn-lg btn-outline-danger btn-block">Batal</a>
            </form>
        </div>
    </div>
    <hr style="margin-bottom: 5px;">
    <div class="text-white text-center mt-5" style="">
        &copy;<?php echo date('Y') ?> Martha Agung
    </div>
  </div>

  
  <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url() ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  
</body> 

</html>