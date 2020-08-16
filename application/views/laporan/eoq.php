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
            <select name="filter" id="filter" class="custom-select" required>
              <option value="" disabled selected>Pilih Tipe Kendaraan</option>
              <option value="XPANDER">XPANDER</option>
              <option value="OUTLANDER">OUTLANDER</option>
              <option value="PAJERO">PAJERO</option>
              <option value="MIRAGE">MIRAGE</option>
              <option value="STRADA">STRADA</option>
              <option value="TRITON">TRITON</option>
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
        <form action="<?=base_url('Laporan/EOQ_')?>" method="post"  target="_blank">
            <input type="hidden" name="filter" id="filter" class="form-control" value="<?=$_POST['filter']?>">
            <button class="btn btn-info btn-sm float-right ml-2" type="submit" name="cetak" onclick="return valid();"><i class="fas fa-print"></i> Cetak</button>
        </form>  
      </div>
      <?php endif; ?> 
      <div class="card-body">
        <div class="card card-body border-primary mb-4">
          <table class="table table-sm">
            <tr>
              <td width="20%">Tipe Kendaraan</td>
              <td width="2%">:</td>
              <td>MITSUBISHI <?=$_POST['filter']?></td>
            </tr>
            <tr>
              <td width="20%">Jumlah Permintaan</td>
              <td width="2%">:</td>
              <td><?=$fore['forecast']?> Unit</td>
            </tr>
          </table>
        </div>
        <div class="card border-primary">
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr align="center">
                    <th width="10%">TGL</th>
                    <th>EOQ</th>
                    <th>Q*</th>
                    <th>FREKUENSI</th>
                    <th>INTERVAL</th>
                    <th>SAFETY STOCK</th>
                    <th>SOP</th>
                    <th>TIC</th>
                    <th>TOC</th>
                    <th>TCC</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($eoq as $data): ?>
                    <tr align="center">
                      <td style="vertical-align: middle;"><?=date('Y-m-d', strtotime($data['waktu']))?></td>
                      <td style="vertical-align: middle;"><?=$data['eoq']?> Unit</td>
                      <td style="vertical-align: middle;"><?=$data['q']?> Unit</td>
                      <td style="vertical-align: middle;"><?=$data['frekuensi']?> Kali/Tahun</td>
                      <td style="vertical-align: middle;"><?=$data['interval']?> Hari</td>
                      <td style="vertical-align: middle;"><?=$data['safety']?> Unit</td>
                      <td style="vertical-align: middle;"><?=$data['reorder']?> Unit</td>
                      <td style="vertical-align: middle;"><?=$data['tic']?></td>
                      <td style="vertical-align: middle;"><?=$data['toc']?></td>
                      <td style="vertical-align: middle;"><?=$data['tcc']?>%</td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
