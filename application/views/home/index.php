<!doctype html>
<html lang="en">

<head>
  <title>Homepage - Kos Telang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/')?>fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?= base_url('assets/')?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>css/aos.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>css/style.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center position-relative">


          <div class="site-logo">
            <a href="index.html" class="text-black"><span class="text-primary">Kos Bintang Telang</a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li><a href="#home-section" class="nav-link">Home</a></li>
                  <li><a href="#services-section" class="nav-link">Services</a></li>


                  <li class="has-children">
                    <a href="#about-section" class="nav-link">About Us</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="#team-section" class="nav-link">Rooms</a></li>
                      <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                    </ul>
                  </li>

                  <li><a href="#why-us-section" class="nav-link">Why Us</a></li>

                  <li><a href="#contact-section" class="nav-link">Contact</a></li>
                  
                  <?php if (!$this->session->userdata('username')): ?>
                    <li><a href="<?= base_url('auth')?>" class="nav">Log in</a></li>
                  <?php endif ?>
                  <?php if ($this->session->userdata('username')): ?>


                    <li class="has-children">
                    <a href="#" class="nav-link ">
                      
                      <?php if ($this->session->userdata('level')==1): ?>
                            <?= $useractive['nama_admin']; ?>
                          <?php endif ?>

                          <?php if ($this->session->userdata('level')==2): ?>
                            <?= $useractive['nama_penyewa']; ?>
                          <?php endif ?>

                    </a>
                    <ul class="dropdown arrow-top">
                      <li><a 

                        <?php if ($this->session->userdata('level')==1): ?>
                            href="<?= base_url('admin/')?>"
                          <?php endif ?>

                          <?php if ($this->session->userdata('level')==2): ?>
                            href="<?= base_url('penyewa/')?>"
                          <?php endif ?>

                       class="nav-link">Dashboard</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#logoutModal" class="nav-link">Log out</a></li>
                    </ul>
                  </li>
                  <?php endif ?>
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>

      <div class="ftco-blocks-cover-1">
        <div class="ftco-cover-1 overlay" style="background-image: url('<?= base_url('assets/')?>images/kos_besar.jpg')">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <h1>Pilih Kos yang berkualitas dan aman</h1>
                <p class="mb-5">Kos telang bintang bisa menjadi solusinya.</p>
                
              </div>
            </div>
          </div>
        </div>
        <!-- END .ftco-cover-1 -->
        <div class="ftco-service-image-1 pb-5">
          <div class=" ">

          </div>
        </div>

      </div>

      <div class="site-section bg-light" id="services-section">
        <div class="container">
          <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
              <div class="block-heading-1">
                <h2>What We Offer</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
          <div class="owl-carousel owl-all">
            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-ferry"></span>
              </div>
              <h3 class="mb-3">Sea Freight</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-airplane"></span>
              </div>
              <h3 class="mb-3">Air Freight</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-box"></span>
              </div>
              <h3 class="mb-3">Package Forwarding</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-lorry"></span>
              </div>
              <h3 class="mb-3">Trucking</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-warehouse"></span>
              </div>
              <h3 class="mb-3">Warehouse</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

            <div class="block__35630">
              <div class="icon mb-0">
                <span class="flaticon-add"></span>
              </div>
              <h3 class="mb-3">Delivery</h3>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. </p>
            </div>

          </div>
        </div>
      </div>




      <div class="site-section" id="about-section">

        <div class="container">
          <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
              <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2>About Us</h2>
                <p>Kost pro eaaaaaaa</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="site-section" id="team-section">
        <div class="container">
          <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
            <h2>Rooms</h2>
            <br>
          </div>
          <div class="owl-carousel owl-all">
            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

          </div>

          <div class="owl-carousel owl-all">
            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

          </div>

          <div class="owl-carousel owl-all">
            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

            <div class="service text-center">
              <img src="<?= base_url('assets/')?>images/cargo_sea_small.jpg" alt="Image" class="img-fluid">
              <div class="px-md-3">
                <h3>Sea Freight</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              </div>
            </div>

          </div>
          <div>
            <a href="<?= base_url('auth/')?>"><button class="btn btn-primary text-white px-4" >Pesan Sekarang!</button></a> 
          </div>

        </div>
      </div>



      <div class="site-section" id="faq-section">
        <div class="container">
          <div class="row mb-5">
            <div class="block-heading-1 col-12 text-center">
              <h2>Frequently Ask Questions</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Can I accept both Paypal and Stripe?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>What available is refund period?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Can I accept both Paypal and Stripe?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>What available is refund period?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>
            </div>
            <div class="col-lg-6">

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Where are you from?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>What is your opening time?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>Can I accept both Paypal and Stripe?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>

              <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-black h4 mb-4"><span class="icon-question_answer text-primary mr-2"></span>What available is refund period?</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="block__73694 site-section border-top" id="why-us-section">
        <div class="container">
          <div class="row d-flex no-gutters align-items-stretch">

            <div class="col-12 col-lg-6 block__73422 order-lg-2" style="background-image: url('images/cargo_sea_small.jpg');" data-aos="fade-left" data-aos-delay="">
            </div>



            <div class="col-lg-5 mr-auto p-lg-5 mt-4 mt-lg-0 order-lg-1" data-aos="fade-right" data-aos-delay="">
              <h2 class="mb-4 text-black">Why Us</h2>
              <h4 class="text-primary">We work quickly and efficiently!</h4>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>

              <ul class="ul-check primary list-unstyled mt-5">
                <li>Cargo express</li>
                <li>Secure Services</li>
                <li>Secure Warehouseing</li>
                <li>Cost savings</li>
                <li>Proven by great companies</li>
              </ul>

            </div>

          </div>
        </div>
      </div>

      <div class="site-section bg-light" id="contact-section">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
              <div class="block-heading-1">
                <h2>Contact Us</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-5" data-aos="fade-up" data-aos-delay="100">
              <div class="bg-white p-3 p-md-5">
                <h3 class="text-black mb-4">Contact Info</h3>
                <ul class="list-unstyled footer-link">
                  <li class="d-block mb-3">
                    <span class="d-block text-black">Address:</span>
                    <span>34 Street Name, City Name Here, United States</span></li>
                    <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span>+1 242 4942 290</span></li>
                    <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>info@yourdomain.com</span></li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>


        <footer class="site-footer">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-7">
                    <h2 class="footer-heading mb-4">About Us</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                  </div>
                  <div class="col-md-4 ml-auto">
                    <h2 class="footer-heading mb-4">Features</h2>
                    <ul class="list-unstyled">
                      <li><a href="#">About Us</a></li>
                      <li><a href="#">Terms of Service</a></li>
                      <li><a href="#">Privacy</a></li>
                      <li><a href="#">Contact Us</a></li>
                    </ul>
                  </div>

                </div>
              </div>
              <div class="col-md-4 ml-auto">

                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </form>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p class="copyright">
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

    </div>

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

    <script src="<?= base_url('assets/')?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/')?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/')?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/')?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.sticky.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.animateNumber.min.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.fancybox.min.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('assets/')?>js/aos.js"></script>

    <script src="<?= base_url('assets/')?>js/main.js"></script>


  </body>

  </html>
