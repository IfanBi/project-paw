<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Homepage - Kos Bintang Telang</title>

  <!-- Font Awesome Icons -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="assets/css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">KOST TELANG</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Room</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <?php if (!$this->session->userdata('username')): ?>
            <li class="nav-item"><a href="<?= base_url('auth')?>" class="nav-link">Log in</a></li>
          <?php endif ?>


          <?php if ($this->session->userdata('username')): ?>


            <li class="nav-item">
              <a 
              <?php if ($this->session->userdata('level')==1): ?>
                href="<?= base_url('admin/')?>"
              <?php endif ?>

              <?php if ($this->session->userdata('level')==2): ?>
                href="<?= base_url('penyewa/')?>"
                <?php endif ?> class="nav-link">

                <?php if ($this->session->userdata('level')==1): ?>
                  <?= $useractive['nama_admin']; ?>
                <?php endif ?>

                <?php if ($this->session->userdata('level')==2): ?>
                  <?= $useractive['nama_penyewa']; ?>
                <?php endif ?>

              </a></li>
              <li class="nav-item">
                <a class="nav-link " href="#" data-toggle="modal" data-target="#logoutModal"> Log out</a>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
          <div class="col-lg-10 align-self-end">
            <h1 class="text-uppercase text-white font-weight-bold">Selamat Datang di KOS Telang</h1>
            <hr class="divider my-4">
          </div>
          <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 font-weight-light mb-5">Ingin mencari kos yang aman, nyaman dan murah?
            Disini tempatnya</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
          </div>
        </div>
      </div>
    </header>

    <!-- About Section -->
    <section class="page-section bg-primary" id="about">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="text-white mt-0">Kost Telang</h2>
            <hr class="divider light my-4">
            <p class="text-white-50 mb-4">Kost Telang adalah sebuah hunian yang terletak di Jl. Raya Trunojoyo, 500 m sebelah barat Universitas Trunojoyo Madura. Terletak di lokasi strategis dilengkapi dengan fasilitas yang lengkap seperti Tempat parkir yang luas, kamar mandi dalam, dapur bersama, dan ruang TV akan membuat anda </p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="page-section" id="services">
      <div class="container">
        <h2 class="text-center mt-0">Fasilitas</h2>
        <hr class="divider my-4">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="mt-5">
              <i class="fas fa-4x fa-car text-primary mb-4"></i>
              <h3 class="h4 mb-2">Tempat parkir</h3>
              <p class="text-muted mb-0">Tersedia tempat parkir yang luas, teduh dan aman</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="mt-5">
              <i class="fas fa-4x fa-utensil-spoon text-primary mb-4"></i>
              <h3 class="h4 mb-2">Dapur</h3>
              <p class="text-muted mb-0">Tersedia dapur bersama yang bersih dan nyaman</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="mt-5">
              <i class="fas fa-4x fa-bolt text-primary mb-4"></i>
              <h3 class="h4 mb-2">Free Listrik</h3>
              <p class="text-muted mb-0">Tidak dipungut biaya listrik tambahan</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="mt-5">
              <i class="fas fa-4x fa-tint text-primary mb-4"></i>
              <h3 class="h4 mb-2">Free Air</h3>
              <p class="text-muted mb-0">Tidak dipungut biaya air tambahan</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio">
      <div class="container-fluid p-0">
        <div class="row no-gutters">
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/1.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/2.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/2.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/3.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/3.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/4.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/4.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/5.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/5.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="././././assets/img/portfolio/fullsize/6.jpg">
              <img class="img-fluid" src="././././assets/img/portfolio/thumbnails/6.jpg" alt="">
              <div class="portfolio-box-caption p-3">
                <div class="project-category text-white-50">
                  Kost
                </div>
                <div class="project-name">
                  Telang Bintang
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact Section -->
    <section class="page-section" id="contact">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="mt-0">Ayo Segera miliki kos impian anda!</h2>
            <a class="btn btn-light btn-xl js-scroll-trigger"  href="<?= base_url('auth')?>">Booking Sekarang</a>
            <hr class="divider my-4">
            <p class="text-muted mb-5">Dapat kan kenyamanan hunian kos terbaik hanya di Kost Telang
            stok terbatas</p>
          </div>
        </div>

<div class="text-center">
  <hr>
  <h2>Contact Admins</h2><br><br>
</div>

          <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
              <i class="fas fa-user fa-3x mb-3 text-muted"></i>

              <?php foreach ($kontakadmin->result_array() as $row): ?>
                
                <div><?=$row['nama_admin']?></div>
                <hr>

              <?php endforeach ?>
              
            </div>
            <div class="col-lg-4 mr-auto text-center">
              <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
              <!-- Make sure to change the email address in anchor text AND the link below! -->
              <?php foreach ($kontakadmin->result_array() as $row): ?>
                
                <div><a href="https://wa.me/<?=$row['telp_admin']?>"> <?=$row['telp_admin']?></a></div>
                <hr>

              <?php endforeach ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer class="bg-light py-5">
        <div class="container">
          <div class="small text-center text-muted">Copyright &copy; 2019 - Kos Telang Bangkalan</div>
        </div>
      </footer>


      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Yakin untuk Logout ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript -->
      <script src="assets/vendor/jquery/jquery.min.js"></script>
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Plugin JavaScript -->
      <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

      <!-- Custom scripts for this template -->
      <script src="assets/js/creative.min.js"></script>

    </body>

    </html>
