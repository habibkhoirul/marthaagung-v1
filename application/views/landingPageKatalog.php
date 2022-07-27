<?php
  $pesanWhatsapp = urlencode('Hai MARTHA AGUNG');
  
  foreach ($dt_toko->result() as $dt) { 
    $alamat = $dt->alamat;
    $whatsappNumber = '62'.substr($dt->no_whatsapp,1);
    $telp = $dt->no_telepon;
    $email = $dt->email;
    $facebook = $dt->facebook;
  }

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MARTHA AGUNG</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url() ?>assets/images/system/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url() ?>assets/landing_page/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/landing_page/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/landing_page/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/landing_page/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/landing_page/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>assets/landing_page/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header-transparent">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="<?php echo base_url() ?>#header" class="scrollto">MARTHA AGUNG</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="<?php echo base_url() ?>assets/landing_page/img/logo.png" alt=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?php echo base_url() ?>#header">Home</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#features">Layanan</a></li>
          <li  class="menu-active"><a href="#call-to-action">Produk</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Kontak</a></li>
          <li><a href="<?php echo base_url('App') ?>">Log In</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action">
      <div class="container pt-1">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left pt-4">
            <h3 class="cta-title">Katalog Produk</h3>
            <p class="cta-text">
              Temukan produk yang anda inginkan, jelajahi katalog produk kami.
            </p>
            <p class="cta-text">
              SILAHKAN LOGIN UNTUK MEMESAN 
            </p>
          </div>
        </div>
      </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="section-bg">
      <div class="container">
        <!-- Page Navigation -->
        <div class="row">
          <div class="col-lg-8 col-sm-6">
            <form class="form-inline" method="POST" action="<?php echo base_url('web/katalogProduk') ?>">
              <div class="input-group mb-3 col-12">
                <input type="text" name="kata_kunci" class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                    Cari &nbsp;
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4 col-sm-6 float-right">
              <?php echo $pagination ?>
          </div>
        </div>
    <!-- End of Page Navigation -->
        <div class="row">
          <?php
            foreach ($dt_produk->result() as $dt) {
              if($dt->gambar=='') $gambarProduk = 'product-default.png';
              else $gambarProduk = $dt->gambar; 
          ?> 
          <div class="col-lg-4 col-md-6">
            <div class="box wow fadeInRight">
              <h5><?php echo $dt->nm_produk ?></h5>
              <img 
                src="<?php echo base_url('uploads/images/'.$gambarProduk)?>" 
                class="d-block w-100 card-img-top" 
                alt="Gambar untuk <?php echo $dt->nm_produk?>"
                height="300" />
              <br />
              <h4><sup>Rp.</sup><?php echo $dt->harga_jual ?><span></span></h4>
              <!-- <a href="#" class="get-started-btn">
                <?php //echo (($dt->stok > 0) ? 'Stok Ready' : 'Stok Habis') ?>
              </a> -->
            </div>
          </div>
          <?php } ?>

        </div>
      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="bg-dark">
      <div class="container">
        <div class="row wow fadeInUp">

          <div class="col-lg-3 col-md-4">
            <div class="contact-about">
              <h3>MARTHA AGUNG</h3>
              <p class="text-white">
                Supermarket dan swalayan yang modern dan terpadu. Tunggu apa lagi ayo segera belanja di MARTHA AGUNG.
              </p>
              <div class="social-links">
                <a href="<?php echo $facebook ?>" class="facebook bg-dark"><i class="fa fa-facebook"></i></a>
                <a href="#" class="instagram bg-dark"><i class="fa fa-instagram"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <a href="#">
                  <i class="ion-ios-location-outline"></i>
                  <p class="text-white"><?php echo $alamat ?></p>
                </a>
              </div>

              <div>
                <a href="mailto:<?php echo $email ?>">
                  <i class="ion-ios-email-outline"></i>
                  <p class="text-white">info@example.com</p>
                </a>
              </div>

              <div>
                <a href="<?php echo "https://api.whatsapp.com/send?phone=$whatsappNumber&text=$pesanWhatsapp" ?>">
                  <i class="ion-social-whatsapp-outline"></i>
                  <p class="text-white"><?php echo '+'.$whatsappNumber ?></p>
                </a>
              </div>

            </div>
          </div>

          <div class="col-lg-6 col-md-8">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d415.3616446225919!2d111.47867853355172!3d-7.935925280404758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790ad252b46a93%3A0x2a77f577a2671976!2sReog%20Simo%20Ndaru%20Seto!5e0!3m2!1sid!2sid!4v1618644389337!5m2!1sid!2sid" 
                width="100%" 
                height="250px" 
                style="border:0;" 
                allowfullscreen="" loading="lazy">
            </iframe>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/wow/wow.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url() ?>assets/landing_page/vendor/hoverIntent/hoverIntent.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url() ?>assets/landing_page/js/main.js"></script>

</body>

</html>