<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?=$title?></h1>
  <p class="mb-4"></p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-right text-primary">Data <?=$title?></h6>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="form-row align-items-center">
          <div class="col-auto">
            <!-- <label class="mr-2">Cari Berdasarkan</label> -->
            <select name="filter" id="filter" class="form-control" required>
              <option value="" disabled selected><-- Cari Berdasarkan --></option>
              <option value="semua">Semua Data </option>
              <option value="2">Bulan dan Tahun</option>
              <option value="3">Tahun</option>
            </select>
          </div>
          <div class="col-auto" id="f-bulan">
            <label class="sr-only" for="inlineFormInputGroup">Username</label>
            <select class="form-control" id="bulan" name="bulan" autocomplate="off">
                <option selected><-- Pilih Bulan --></option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
          </div>
          <div class="col-auto" id="f-tahun">
            <label class="sr-only" for="inlineFormInputGroup">Username</label>
            <select class="custom-select mr-sm-2" name="tahun" id="inlineFormCustomSelect">
              <option selected><-- Pilih Tahun --></option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-warning btn-sm" name="cari"><i class="fas fa-search"></i> Cari</button>
            <?php if(isset($_POST['cari'])): ?>
              <a href="<?=base_url('Laporan/Permintaan')?>" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php if(isset($_POST['cari'])): ?>
    <div class="card shadow mb-4">
        <?php if($this->session->userdata('role_id') == 1): ?>
      <div class="card-header">
        <form action="<?=base_url('Laporan/Permintaan_')?>" method="post"  target="_blank">
            <input type="hidden" name="filter" id="filter" class="form-control" value="<?=$_POST['filter']?>">
            <input type="hidden" name="bulan" id="bulan" class="form-control" value="<?=$_POST['bulan']?>">
            <input type="hidden" name="tahun" id="tahun" class="form-control" value="<?=$_POST['tahun']?>">
            <button class="btn btn-info btn-sm float-right ml-2" type="submit" onclick="return valid();" name="cetak"><i class="fas fa-print"></i> Cetak</button>
        </form>
        <form action="<?=base_url('Laporan/Export_Permintaan')?>" method="post">
            <input type="hidden" name="filter" id="filter" class="form-control" value="<?=$_POST['filter']?>">
            <input type="hidden" name="bulan" id="bulan" class="form-control" value="<?=$_POST['bulan']?>">
            <input type="hidden" name="tahun" id="tahun" class="form-control" value="<?=$_POST['tahun']?>">
            <button class="btn btn-success btn-sm float-right" type="submit" name="excel"><i class="fas fa-download"></i> Export Excel</button>
        </form>  
      </div>
        <?php endif; ?> 
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr align="center">
                <th width="5%">#</th>
                <th width="20%">Tanggal SPK</th>
                <th width="15%">Customer</th>
                <th>Nama Mobil</th>
                <th>Tipe RN</th>
                <th>Warna</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php if($permintaan->num_rows() != 0) : $no=1; foreach($permintaan->result_array() as $data): ?>
                <tr>
                  <td align="center"><?=$no++?></td>
                  <td><?=date('d F Y', strtotime($data['tgl_spk']))?></td>
                  <td><?=$data['nama_customer']?></td>
                  <td><?=$data['nama_unit']?></td>
                  <td><?=$data['type_unit']?></td>
                  <td align="center"><?=$data['warna']?></td>
                  <td align="center"><?=$data['jumlah_permintaan']?></td>
                </tr>
              <?php endforeach;?>
              <?php else : ?>
                <tr>
                  <td colspan="7">
                    <i>
                      <center>
                        -----------
                        Tidak Ada Data
                        -----------
                      </center>
                    </i>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
