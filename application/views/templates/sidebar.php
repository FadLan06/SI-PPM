
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SI PPM <sup>1</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <?php $user = $this->db->get_where('user',['role_id' => $this->session->userdata('role_id')])->row_array(); ?>

      <?php if($user['role_id'] == 1): ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="<?=base_url('Admin')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data Master:</h6>
              <a class="collapse-item" href="<?=base_url('Permintaan')?>">Permintaan Kendaraan</a>
              <a class="collapse-item" href="<?=base_url('Pemesanan')?>">Pemesanan</a>
              <a class="collapse-item" href="<?=base_url('Stok')?>">Stok Unit</a>
              <a class="collapse-item" href="<?=base_url('Penjualan')?>">Historis Penjualan Unit</a>
              <a class="collapse-item" href="<?=base_url('Nota')?>">Nota Pemesanan</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Peramalan')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Peramalan Penjualan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Eoq')?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Persediaan EOQ</span></a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Laporan:</h6>
              <a class="collapse-item" href="<?=base_url('Laporan/Permintaan')?>">Permintaan Kendaraan</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Pemesanan')?>">Pemesanan Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Stok')?>">Stok Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Penjualan')?>">Penjualan Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Peramalan')?>">Peramalan Penjualan</a>
              <a class="collapse-item" href="<?=base_url('Laporan/EOQ')?>">Persediaan EOQ</a>
            </div>
          </div>
        </li>
      <?php elseif($user['role_id'] == 2): ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="<?=base_url('Admin')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Pemesanan')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pemesanan</span></a>
        </li>


        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Nota')?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Nota Pemesanan</span></a>
        </li>
      <?php elseif(($user['role_id'] == 3) || ($user['role_id'] == 4)): ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="<?=base_url('Admin')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Laporan:</h6>
              <a class="collapse-item" href="<?=base_url('Laporan/Permintaan')?>">Permintaan Kendaraan</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Pemesanan')?>">Pemesanan Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Stok')?>">Stok Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Penjualan')?>">Penjualan Unit</a>
              <a class="collapse-item" href="<?=base_url('Laporan/Peramalan')?>">Peramalan Penjualan</a>
              <a class="collapse-item" href="<?=base_url('Laporan/EOQ')?>">Persediaan EOQ</a>
            </div>
          </div>
        </li>
      <?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->