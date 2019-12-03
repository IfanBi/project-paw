<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Halaman Penyewa</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <div class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kos Bintang Telang</div>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link"  href="<?= base_url('penyewa/kamarsaya'); ?>">
          <i class="fas fa-fw fa-person-booth"></i>
          <span>Kamar Saya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="<?= base_url('penyewa/daftarkamar'); ?>">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Daftar Kamar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="<?= base_url('penyewa/kontakadmin'); ?>">
          <i class="fas fa-fw fa-phone-square-alt"></i>
          <span>Kontak Admin</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$useractive['nama_penyewa'];?></span>
                <i class="fas fa-fw fa-user-circle"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('penyewa/'); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?= base_url('penyewa/resetpass/'.$useractive['username']); ?>">
                  <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ganti Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="row">
            <!-- Area Chart -->
            <div class="col-lg-6 mb-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kamar Saya</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <?= $this->session->flashdata('message'); ?>
                  <?php if ($useractive['punyakamar']==0): ?>
                  <div class="alert alert-danger" role="alert">
                    Anda Belum Menyewa Kamar!
                  </div>
                  <?php endif ?>
                  <?php if ($useractive['punyakamar']==1): ?>
                  <table class="table table-hover table-borderless">
                    <tr>
                      <td>Nomor Kamar</td>
                      <td><?=$sewa['id_kamar'];?></td>
                    </tr>
                    <tr>
                      <td>Harga Kamar</td>
                      <td>Rp. <?=number_format($kamar['harga_kamar'], 0, ",", ".");?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Sewa</td>
                      <td><?=date("d F Y", strtotime($sewa['tgl_sewa']));?></td>
                    </tr>
                    <tr>
                      <td>Lama Sewa</td>
                      <td><?=$sewa['lama_sewa'];?> Bulan</td>
                    </tr>
                    <tr>
                      <td>Sewa Berakhir Pada</td>
                      <td><?=date('d F Y', strtotime('+'.$sewa['lama_sewa'].' month', strtotime($sewa['tgl_sewa'])))?></td>
                    </tr>
                    <tr>
                      <td>Total Harga</td>
                      <td>Rp. <?=number_format($sewa['lama_sewa']*$kamar['harga_kamar'], 0, ",", ".");?></td>
                    </tr>
                    <tr>
                      <td>Status Pembayaran</td>
                      <td>
                        <?php if ($sewa['status_pembayaran']==0): ?>
                        Belum Lunas
                        <?php endif ?>
                        <?php if ($sewa['status_pembayaran']==1): ?>
                        Lunas
                        <?php endif ?>
                      </td>
                    </tr>
                  </table>
                  <?php if ($sewa['status_pembayaran']==0): ?>
                  <div class="alert alert-danger" role="alert">
                    Segera Lakukan Pembayaran ke Admin Sebelum Tanggal<br>
                    <?=date("d F Y", strtotime('+2 days', strtotime($sewa['tgl_sewa'])))?> !
                  </div>
                  <?php endif ?>
                  <?php if ($sewa['status_pembayaran']==0): ?>
                  <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#ModalBatalSewa">Batal Sewa</a>
                  <?php endif ?>
                  <?php if ($sewa['status_pembayaran']==1): ?>
                  <a class="btn btn-primary" href="<?= base_url('penyewa/'); ?>">Tambah Waktu Sewa</a>
                  <a class="btn btn-danger" href="<?= base_url('penyewa/'); ?>">Berhenti Sewa</a>
                  <?php endif ?>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kos Bintang Telang 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda Akan Logout</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Batal Sewa Modal-->
  <div class="modal fade" id="ModalBatalSewa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Untuk Membatalkan Sewa?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-hover table-borderless">
            <tr>
              <td>Nomor Kamar</td>
              <td><?=$sewa['id_kamar'];?></td>
            </tr>
            <tr>
              <td>Harga Kamar</td>
              <td>Rp. <?=number_format($kamar['harga_kamar'], 0, ",", ".");?></td>
            </tr>
            <tr>
              <td>Tanggal Sewa</td>
              <td><?=date("d F Y", strtotime($sewa['tgl_sewa']));?></td>
            </tr>
            <tr>
              <td>Lama Sewa</td>
              <td><?=$sewa['lama_sewa'];?> Bulan</td>
            </tr>
            <tr>
              <td>Sewa Berakhir Pada</td>
              <td><?=date('d F Y', strtotime('+'.$sewa['lama_sewa'].' month', strtotime($sewa['tgl_sewa'])))?> Bulan</td>
            </tr>
            <tr>
              <td>Total Harga</td>
              <td>Rp. <?=number_format($sewa['lama_sewa']*$kamar['harga_kamar'], 0, ",", ".");?></td>
            </tr>
            <tr>
              <td>Status Pembayaran</td>
              <td>
                <?php if ($sewa['status_pembayaran']==0): ?>
                Belum Lunas
                <?php endif ?>
                <?php if ($sewa['status_pembayaran']==1): ?>
                Lunas
                <?php endif ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('penyewa/batalsewa/'.$sewa['id_sewa']); ?>">Yakin</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

</body>

</html>
