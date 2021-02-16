<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-to-b from-purple-700 to-gray-800 sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center bg-purple-700 justify-content-center" href="<?php echo base_url() ?>Admin">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-coffee"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Point Of Sales</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Admin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu Utama
  </div>

  <!-- Nav Item - Transaction -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Admin/transaksi">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Transaksi</span></a>
  </li>

  <!-- Nav Item - Retur -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Admin/retur">
      <i class="fas fa-fw fa-reply"></i>
      <span>Retur</span></a>
  </li>

  <!-- Nav Item - Kasir -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Kasir" target="_blank">
      <i class="fas fa-fw fa-desktop"></i>
      <span>Kasir</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Master Data
  </div>

  <!-- Nav Barang - Pages Collapse Menu -->
  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterBarang" aria-expanded="true" aria-controls="collapseMasterBarang">
      <i class="fas fa-fw fa-database"></i>
      <span>Barang</span>
    </a>
    <div id="collapseMasterBarang" class="collapse" aria-labelledby="headingMasterBarang" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Data Barang:</h6>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/barang"><i class="fas fa-fw fa-home"></i> Toko</a>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/warehouse"><i class="fas fa-fw fa-building"></i> Gudang</a>
      </div>
    </div>
  </li>

  <!-- Nav Satuan - Pages Collapse Menu -->
  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfigSatuan" aria-expanded="true" aria-controls="collapseMasterBarang">
      <i class="fas fa-fw fa-object-group"></i>
      <span>Satuan</span>
    </a>
    <div id="collapseConfigSatuan" class="collapse" aria-labelledby="headingConfigSatuan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Konfigurasi Satuan:</h6>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/satuan"><i class="fas fa-fw fa-cube"></i> Satuan</a>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/tipesatuan"><i class="fas fa-fw fa-cubes"></i> Tipe Satuan</a>
      </div>
    </div>
  </li>

  <!-- Nav User - Pages Collapse Menu -->
  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseMasterBarang">
      <i class="fas fa-fw fa-users"></i>
      <span>Pengguna</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Data Pengguna:</h6>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/user"><i class="fas fa-fw fa-user-shield"></i> Staff</a>
        <!-- <a class="collapse-item" href="<?php echo base_url() ?>Admin/paket"><i class="fas fa-fw fa-user"></i> Member</a> -->
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Konfigurasi
  </div>

  <!-- Nav Item - Aplikasi -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Admin/aplikasi">
      <i class="fas fa-fw fa-globe"></i>
      <span>Aplikasi</span></a>
  </li>

  <!-- Nav Item - Printer -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>Admin/printer">
      <i class="fas fa-fw fa-print"></i>
      <span>Printer</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Laporan
  </div>

  <!-- Nav Laporan - Pages Collapse Menu -->
  <li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseMasterBarang">
      <i class="fas fa-fw fa-chart-line"></i>
      <span>Data Laporan</span>
    </a>
    <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Data Laporan:</h6>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/laptransaksi"><i class="fas fa-fw fa-shopping-cart"></i> Laporan Transaksi</a>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/lapbarang"><i class="fas fa-fw fa-home"></i> Laporan Toko</a>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/lapwarehouse"><i class="fas fa-fw fa-building"></i> Laporan Gudang</a>
        <a class="collapse-item" href="<?php echo base_url() ?>Admin/lapretur"><i class="fas fa-fw fa-reply"></i> Laporan Retur</a>
        <!-- <a class="collapse-item" href="<?php echo base_url() ?>Admin/paket"><i class="fas fa-fw fa-user"></i> Laporan Member</a> -->
      </div>
    </div>
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
<div id="content-wrapper" class="d-flex flex-column bg-gray-300">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand bg-gradient-to-r from-purple-700 via-red-500 to-yellow-500 topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline small"><strong><?php echo $this->session->userdata('nama') ?></strong></span>
            <img class="img-profile rounded-circle" src="<?php echo base_url(); ?>assets/dist/img/avatar.png">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a id="requestfullscreen" class="dropdown-item" href="#">
              <i class="fas fa-expand fa-sm fa-fw mr-2 text-gray-400"></i>
              Mode Layar Penuh
            </a>
            <a id="exitfullscreen" class="dropdown-item" href="#" style="display: none;">
              <i class="fas fa-compress fa-sm fa-fw mr-2 text-gray-400"></i>
              Mode Normal
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Keluar
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->