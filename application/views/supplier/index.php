<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Kendaraan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$permintaan?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemesanan Unit</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pemesanan?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stok Unit</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$stok?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Historis Penjualan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$historis?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">MITSUBISHI XPANDER</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="col-md" align="center">
            <img src="<?=base_url('assets/img/XPANDER.jpeg')?>" width="150px">
            <p align="justify">Mitsubishi Xpander memiliki tipe Xpander 1.5L  Exceed (4x2) M/T, Xpander 1.5L Ultimate (4x2) A/T, Xpander 1.5L GLS (4x2) M/T. Interior mewah dilengkapi material interior terbaik yang digunakan di tiap sudut Mitsubishi xpander, membuatnya tampak berkelas dan nyaman untuk seluruh keluarga. Xpander memberikan standar baru pada mobil keluarga dengan 4 fitur unggulan yaitu mesin bertenaga, suspense stabil, kenyamanan interior, dan kabin yang lebih senyap di kelasnya</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">MITSUBISHI OUTLANDER</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="col-md" align="center">
            <img src="<?=base_url('assets/img/OUTLANDER.jpeg')?>" width="200px">
            <p align="justify">Mitsubishi outlander sport  terdiri dari tipe Outlander Sport PX 2.0 AT, Outlander Sport GLS 2.0 AT, dan Outlander Sport GLX 2.0 MT. Kombinasi ketangguhan SUV dan kenyamanan mobil sedan menghasilkan “Newly Reborn” sebagai inovasi yang sempurna. Model sport benar-benar responsive dan agresif dalam setiap kecepatan. INVECS memantau kondisi jalan dan mengantisipasi setiap gerakan secara otomatis.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">MITSUBISHI PAJERO</h6>
        </div>
        <div class="card-body">
          <div class="col-md" align="center">
            <img src="<?=base_url('assets/img/PAJERO.jpg')?>" width="180px">
            <p align="justify">Mitsubishi Pajero sport terdiri dari tipe Pajero Sport 2.4L Dakar-H 4x2 A/T, Pajero Sport Exceed Limited A/T 4x2, Pajero Sport GLS Limited M/T 4x2. Menggunakan desain yang staylish dan futuristic terlihat dari keseluruhan design baik eksterior maupun interior. Pajero sport Dakar 4x4 AT berkapasitas 7-penumpang dibekali juga dengan transmisi 8-speed Automatic. Sistem keamanannya dibekali Anti Theft Device dan Anti- Theft Alarm.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">

      <!-- Illustrations -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">MITSUBISHI MIRAGE</h6>
        </div>
        <div class="card-body">
          <div class="col-md" align="center">
            <img src="<?=base_url('assets/img/MIRAGE.jpeg')?>" width="240px">
            <p align="justify">Mitsubishi mirage  mempunyai tiga varian yaitu Exceed, GLS, dan GLX. Ketiga varian ini memiliki harga yang berbeda-beda. Tiepe Mitsubishi mirage exceed menjadi varian tertinggi, sedangkan GLX menjadi varian terendah. Menjadi tumpuan pabrik Mitsubishi di segmen city car. Dengan desain Mitsubishi Mirage yang kompak membuat gesekan dengan angin semakin berkurang, sehingga mobil lebih stabil dan kinerja mesin semakin efisiensi.</p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4 mx-auto">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">MITSUBISHI STRADA TRITON</h6>
        </div>
        <div class="card-body">
          <div class="col-md" align="center">
            <img src="<?=base_url('assets/img/TRITON.jpeg')?>" width="150px">
            <p align="justify">Mitsubishi all  Strada Triton All new Strada Triton terdiri dari tiga tipe, yakni Strada 2.5L SC GLX HR (4x2) M/T, Triton Single Cap GLX 2 WD, Triton Double Cap H-DX. HDX punya dua jeni bodi, yaitu kabin tunggal sebagai varian terbawah dan kabin ganda, GLS tersedian dengan bodi kabin ganda. Semua varian menggunakan transmisi manual. Sebagian besar dikabin, interior dikemas elegan. Kemudi bisa naik turun agar lebih menyesuaikan dengan kenyamanan pengemudi. Terdapat pengaturan spion lipat, auto power window, dan arm rest di jok baris kedua. </p>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</div>
<!-- /.container-fluid -->
