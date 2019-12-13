<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Halaman Admin</title>

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
      <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kos Bintang Telang</div>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftarkamar'); ?>">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Daftar Kamar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftarakun'); ?>">
          <i class="fas fa-fw fa-address-book"></i>
          <span>Daftar Akun</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin/daftartransaksi'); ?>">
          <i class="fas fa-fw fa-file-invoice-dollar"></i>
          <span>Daftar Transaksi</span>
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $useractive['nama_admin']; ?></span>
                <i class="fas fa-fw fa-user-circle"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('admin/'); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?= base_url('admin/resetpass/'.$useractive['username']); ?>">
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
          <div class="mb-4">
            <?= $this->session->flashdata('message'); ?>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Transaksi Belum Terverifikasi (Belum Lunas & aktif)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID Kamar</th>
                        <th>Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tbt->result_array() as $row): ?>
                        <tr>
                          <td><?=$row['id_kamar']?></td>
                          <td><?=$row['nama_penyewa']?></td>
                          <td><?=date("d F Y", strtotime($row['tgl_sewa']));?></td>
                          <td><?=$row['lama_sewa']?> Bulan</td>
                          <td>
                            Rp. <?=number_format($row['lama_sewa']*$row['harga_kamar'], 0, ",", ".");?>
                          </td>
                          <td>
                            <?php if ($row['status_pembayaran']==1): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php endif ?>
                            <?php if ($row['status_pembayaran']==0): ?>
                              <span class="badge badge-danger">Belum Lunas</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#VerifikasiModal<?=$row['id_sewa']?>">Verifikasi</a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Transaksi Terverifikasi (Lunas & Aktif)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID Kamar</th>
                        <th>Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Sewa</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tt->result_array() as $row): ?>
                        <tr>
                          <td><?=$row['id_kamar']?></td>
                          <td><?=$row['nama_penyewa']?></td>
                          <td><?=date("d F Y", strtotime($row['tgl_sewa']));?></td>
                          <td><?=$row['lama_sewa']?> Bulan</td>
                          <td>
                            Rp. <?=number_format($row['lama_sewa']*$row['harga_kamar'], 0, ",", ".");?>
                          </td>
                          <td>
                            <?php if ($row['status_pembayaran']==1): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php endif ?>
                            <?php if ($row['status_pembayaran']==0): ?>
                              <span class="badge badge-danger">Belum Lunas</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($row['status_sewa']==1): ?>
                              <span class="badge badge-success">Aktif</span>
                            <?php endif ?>
                            <?php if ($row['status_sewa']==0): ?>
                              <span class="badge badge-danger">Selesai</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/tambahsewa/'.$row['id_sewa']); ?>">Perpanjang Sewa</a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Transaksi Terverifikasi dan Selesai (Lunas & Tidak Aktif)</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID Kamar</th>
                        <th>Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Sewa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tts->result_array() as $row): ?>
                        <tr>
                          <td><?=$row['id_kamar']?></td>
                          <td><?=$row['nama_penyewa']?></td>
                          <td><?=date("d F Y", strtotime($row['tgl_sewa']));?></td>
                          <td><?=$row['lama_sewa']?> Bulan</td>
                          <td>
                            Rp. <?=number_format($row['lama_sewa']*$row['harga_kamar'], 0, ",", ".");?>
                          </td>
                          <td>
                            <?php if ($row['status_pembayaran']==1): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php endif ?>
                            <?php if ($row['status_pembayaran']==0): ?>
                              <span class="badge badge-danger">Belum Lunas</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($row['status_sewa']==1): ?>
                              <span class="badge badge-success">Aktif</span>
                            <?php endif ?>
                            <?php if ($row['status_sewa']==0): ?>
                              <span class="badge badge-danger">Selesai</span>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Transaksi Belum Terverifikasi dan Selesai (Tidak Lunas & Tidak Aktif) / Hangus</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID Kamar</th>
                        <th>Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Sewa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tbts->result_array() as $row): ?>
                        <tr>
                          <td><?=$row['id_kamar']?></td>
                          <td><?=$row['nama_penyewa']?></td>
                          <td><?=date("d F Y", strtotime($row['tgl_sewa']));?></td>
                          <td><?=$row['lama_sewa']?> Bulan</td>
                          <td>
                            Rp. <?=number_format($row['lama_sewa']*$row['harga_kamar'], 0, ",", ".");?>
                          </td>
                          <td>
                            <?php if ($row['status_pembayaran']==1): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php endif ?>
                            <?php if ($row['status_pembayaran']==0): ?>
                              <span class="badge badge-danger">Belum Lunas</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($row['status_sewa']==1): ?>
                              <span class="badge badge-success">Aktif</span>
                            <?php endif ?>
                            <?php if ($row['status_sewa']==0): ?>
                              <span class="badge badge-danger">Hangus</span>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>                  
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
        <div class="modal-body">Yakin untuk Logout ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php foreach ($tbt->result_array() as $row): ?>
  <!-- verivikasi Modal-->
  <div class="modal fade" id="VerifikasiModal<?=$row['id_sewa']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Verifikasi Transaksi</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-hover table-borderless">
            <tr>
              <td>Nama Penyewa</td>
              <td><?=$row['nama_penyewa'];?></td>
            </tr>
            <tr>
              <td>Nomor Kamar</td>
              <td><?=$row['id_kamar'];?></td>
            </tr>
            <tr>
              <td>Harga Kamar</td>
              <td>Rp. <?=number_format($row['harga_kamar'], 0, ",", ".");?></td>
            </tr>
            <tr>
              <td>Tanggal Sewa</td>
              <td><?=date("d F Y", strtotime($row['tgl_sewa']));?></td>
            </tr>
            <tr>
              <td>Lama Sewa</td>
              <td><?=$row['lama_sewa'];?> Bulan</td>
            </tr>
            <tr>
              <td>Sewa Berakhir Pada</td>
              <td><?=date('d F Y', strtotime('+'.$row['lama_sewa'].' month', strtotime($row['tgl_sewa'])))?></td>
            </tr>
            <tr>
              <td>Total Harga</td>
              <td>Rp. <?=number_format($row['lama_sewa']*$row['harga_kamar'], 0, ",", ".");?></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('admin/verifikasipembayaran/'.$row['id_sewa']); ?>">Verifikasi</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

</body>

</html>
