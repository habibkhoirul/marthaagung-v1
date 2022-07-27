<!DOCTYPE html>

<?php
  if($this->session->userdata('status') == 'loggedin'){
  
    $user = $this->session->userdata('username');
    $level = $this->session->userdata('level');
    $kdpet = $this->session->userdata('kd_petugas');

    //---Levelling
    //lv 1 => Admin, lv 2 => Petugas / Not Admin
    $menuDisStart1 = '';
    $menuDisEnd1 = '';
    $menuDisStart2 = '';
    $menuDisEnd2 = '';

    if($level=='Administrator'){
        $menuDisStart1 = '';
        $menuDisEnd1 = '';
    } else{
        $menuDisStart2 = '<!--';
        $menuDisEnd2 = '-->';
    }


  } else {
    redirect('App/index');
  }
?>

<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="MarthaAgung">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/system/favicon.png">

    <title>PT. MARTHA AGUNG</title>
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/dashboard.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/select2/dist/css/select2.min.css" rel="stylesheet" />

  </head>

  <body>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="bg-primary text-white active">
        <div class="sidebar-header">
            <h3>MARTHA AGUNG</h3>
            <strong>M</strong>
        </div>
        <ul class="list-unstyled components">

            <li class="<?php if(isset($home_menu)) echo $home_menu?>">
                <a href="<?php echo base_url().'Home' ?>">
                    <i class="fas fa-home"></i>Beranda
                </a>
            </li>
            <hr>

            <?php echo $menuDisStart2 ?>
            
            <li class="<?php if(isset($pembelian_menu)) echo $pembelian_menu?>">
                <a href="<?php echo base_url() ?>Pembelian">
                    <i class="fas fa-dolly"></i>Pembelian
                </a>
            </li>
            <hr>

            <?php echo $menuDisEnd2 ?>
            <li class="<?php if(isset($penjualan_menu)) echo $penjualan_menu?>">
                <a href="<?php echo base_url() ?>Penjualan">
                    <i class="fas fa-shopping-cart"></i>Penjualan
                </a>
            </li>
            
            <hr>

            <?php echo $menuDisStart2 ?>
            <li class="<?php if(isset($petugas_menu)) echo $petugas_menu?>">
                <a href="<?php echo base_url() ?>Petugas">
                    <i class="fas fa-users"></i>Petugas
                </a>
            </li>
            <hr>

            <?php echo $menuDisEnd2 ?>
            <li class="<?php if(isset($produk_menu)) echo $produk_menu?>">
                <a href="<?php echo base_url() ?>Produk">
                    <i class="fas fa-gift"></i>Produk
                </a>
            </li>
            <hr>

            <li class="<?php if(isset($supplier_menu)) echo $supplier_menu?>">
                <a href="<?php echo base_url() ?>Supplier">
                    <i class="fas fa-truck"></i>Supplier
                </a>
            </li>

            <hr>
            <li class="<?php if(isset($laporan_menu)) echo $laporan_menu?>">
                <a href="<?php echo base_url() ?>Laporan">
                    <i class="fas fa-copy"></i>Laporan
                </a>
            </li>
            <hr>

            <li class="<?php if(isset($peramalan_menu)) echo $peramalan_menu?>">
                <a href="<?php echo base_url() ?>Peramalan">
                    <i class="fas fa-industry"></i>Peramalan
                </a>
            </li>
            <hr>
            
            <?php echo $menuDisStart2 ?>
            <li class="<?php if(isset($manajemen_menu)) echo $manajemen_menu?>">
                <a href="<?php echo base_url() ?>Manajemen">
                    <i class="fas fa-cog"></i>Manajemen Data
                </a>
            </li>
            <hr>
            <?php echo $menuDisEnd2 ?>

            
        </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content" style="padding: 0; margin-bottom: 30px;">
        <nav class="navbar navbar-expand-sm navbar-primary bg-white sticky-top">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" style="margin: auto;" id="sidebarToggler">
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-bars"></i>
                    </button>
                </li>

                <li class="navbar-brand" id="breadcumb">
                    <a class="nav-link text-dark" href="#">
                        <?php 
                            echo ucwords(($this->uri->total_segments() > 1 && strtolower($this->uri->segment(2)) != 'index') ? $this->uri->segment(1).' / '.$this->uri->segment(2, '') : $this->uri->segment(1)); 
                        ?> 
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto drop">
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-dark">
                        <img class="rounded-circle" src="<?php echo base_url() ?>assets/images/1.jpg">
                        |&emsp;
                        <?php echo strtoupper($this->session->userdata('username')) ?>&nbsp;
                    </a>
                    <div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="navbarDropdown">
                        <a href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-white">
                            <center>
                            <img width="100" class="rounded ml-1 image-responsive" src="<?php echo base_url() ?>assets/images/1.jpg"><br>
                            &nbsp;
                            <?php echo strtoupper($this->session->userdata('username')).'<br>'.$this->session->userdata('level') ?>
                            </center>
                        </a>
                        <hr>
                        <a class="dropdown-item text-white" href="<?php echo base_url().'Profil/index'?> ">
                            <i class="fas fa-edit"></i>&emsp;Change Profile
                        </a>
                        <a class="dropdown-item text-white" href="<?php echo base_url().'App/logout'?>">
                            <i class="fas fa-sign-out-alt"></i>&emsp;Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        
    

    
