<?php
  $pesanWhatsapp = urlencode('Martha');
  
  foreach ($dt_toko->result() as $dt) { 
    $alamat = $dt->alamat;
    $whatsappNumber = '62'.substr($dt->no_whatsapp,1);
    $telp = $dt->no_telepon;
    $email = $dt->email;
    $facebook = $dt->facebook;
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
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Martha Agung</title>
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
        <h1><a href="#header" class="scrollto">MARTHA AGUNG</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#header"><img src="<?php echo base_url() ?>assets/landing_page/img/logo.png" alt=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#header">Home</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#features">Layanan</a></li>
          <li><a href="#call-to-action">Produk</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Kontak</a></li>
          <li><a href="<?php echo base_url('App') ?>">Log In</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Intro Section ======= -->
  <section id="intro">

    <div class="intro-text">
      <h2>Welcome to Martha Agung</h2>
      <p>Dapatkan produk berkualitas dengan harga terjangkau</p>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>

    <div class="product-screens">

      <div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">
        <img src="<?php echo base_url() ?>assets/landing_page/img/product-screen-1.png" alt="">
      </div>

      <div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">
        <img src="<?php echo base_url() ?>assets/landing_page/img/product-screen-2.png" alt="">
      </div>

      <div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">
        <img src="<?php echo base_url() ?>assets/landing_page/img/product-screen-3.png" alt="">
      </div>

    </div>

  </section><!-- End Intro Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="section-bg">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Tentang Kami</h3>
          <span class="section-divider"></span>
        </div>

        <div class="row">
          <div class="col-lg-6 about-img wow fadeInLeft">
            <img src="<?php echo base_url() ?>gambar/galeri/4.jpg" alt="">
          </div>

          <div class="col-lg-6 content wow fadeInRight">
            <p class="text-justify">
              Sebagai supermarket yang telah berdiri sejak 1999, kami telah berpengalaman dalam
              dunia perniagaan. . kami bertujuan untuk memberikan masyarakat pengalaman berbelanja 
              modern yang mudah diakses masyarakat.      
            </p>
            <p class="text-justify">
              Martha Agung menyediakan berbagai produk makanan &amp; minuman, kosmetik, 
              bahan-bahan memasak serta produk lainnya. Kami menjamin ketersediaan stok dan transparansi harga.
              Anda tidak akan menjumpai perbedaan harga di kasir dengan di rak produk.        
            </p>
            <p class="text-justify">
              Komitmen kami sebagai supermarket grosir yang memberikan produk dengan harga ramah di kantong, 
              telah mendorong kami ke level yang lebih baik. Pelanggan kami telah membuktikan, bahwa produk-produk 
              yang kami jual berkualitas dengan harga yang terjangkau.     
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Featuress Section ======= -->
    <section id="features">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 offset-lg-4">
            <div class="section-header wow fadeIn" data-wow-duration="1s">
              <h3 class="section-title">Layanan Kami</h3>
              <span class="section-divider"></span>
            </div>
          </div>

          <div class="col-lg-4 col-md-5 features-img">
            <img src="<?php echo base_url() ?>assets/landing_page/img/product-features.png" alt="" class="wow fadeInLeft">
          </div>

          <div class="col-lg-8 col-md-7 ">

            <div class="row">

              <div class="col-lg-6 col-md-6 box wow fadeInRight">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                <h4 class="title"><a href="">24/7</a></h4>
                <p class="description">
                  Bingung mencari camilan di tengah malam?, 
                  Disini kami siap melayani anda 24 jam penuh dalam satu minggu.
                </p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.1s">
                <div class="icon"><i class="ion-social-buffer-outline"></i></div>
                <h4 class="title"><a href="">Swalayan Modern</a></h4>
                <p class="description">
                  Tidak membawa uang tunai, 
                  tenang Martha Agung menerima pembayaran melalui uang digital dan kartu debit.
                </p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.2s">
                <div class="icon"><i class="ion-ios-location-outline"></i></div>
                <h4 class="title"><a href="">Lokasi Strategis</a></h4>
                <p class="description">
                  Martha Agung dilalui jalan propinsi sehingga untuk menuju Martha Agung, 
                  anda dapat dengan mudah memilih transportasi umum atau kendaraan pribadi.
                </p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.3s">
                <div class="icon"><i class="ion-ios-camera-outline"></i></div>
                <h4 class="title"><a href="">Keamanan Tinggi</a></h4>
                <p class="description">
                  Martha Agung diawasi dengan CCTV sehingga anda bisa 
                  dengan tenang berbelanja tanpa kuatir barang anda hilang. 
                </p>
              </div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- End Featuress Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Katalog Produk</h3>
            <p class="cta-text">
              Temukan produk yang anda inginkan, jelajahi katalog produk kami.
            </p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="<?php echo base_url('web/katalogProduk') ?>">Lihat Katalog Produk Kami</a>
          </div>
        </div>

      </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="section-bg">
      <div class="container">

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
              <a href="#" class="get-started-btn">
                <?php echo (($dt->stok > 0) ? 'Stok Ready' : 'Stok Habis') ?>
              </a>
            </div>

          </div>
          <?php } ?>

        </div>
                  <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="<?php echo base_url('web/katalogProduk') ?>">Lihat Katalog Produk Kami</a>
          </div>
      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Gallery</h3>
          <span class="section-divider"></span>
        </div>

        <div class="row no-gutters">

          <?php
          for($i=1; $i <= 6; $i++) { ?>
          <div class="col-lg-4 col-md-6">
            <div class="gallery-item wow fadeInUp">
              <a href="<?php echo base_url('uploads/images/galeri/'.${'foto'.($i)}) ?>" data-gall="portfolioGallery" class="venobox">
                <img src="<?php echo base_url('uploads/images/galeri/'.${'foto'.($i)})?>" alt="">
              </a>
            </div>
          </div>
          <?php 
            } 
          ?>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="bg-dark">
      <div class="container">
        <div class="row wow fadeInUp">

          <div class="col-lg-3 col-md-4">
            <div class="contact-about">
              <h3>Martha Agung</h3>
              <p class="text-white">
                Supermarket dan swalayan yang modern dan terpadu. Tunggu apa lagi ayo segera belanja di Toko Kami.
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
                  <p class="text-white"><?php echo $email ?></p>
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