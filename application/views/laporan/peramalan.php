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
              <option value="semua">Forecast, MAD, MSE, dan MAPE </option>
              <option value="mad">Forecast dan MAD</option>
              <option value="mse">Forecast dan MSE</option>
              <option value="mape">Forecast dan MAPE</option>
            </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-warning btn-sm" name="cari"><i class="fas fa-search"></i> Cari</button>
            <?php if(isset($_POST['cari'])): ?>
              <a href="<?=base_url('Laporan/Peramalan')?>" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
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
        <form action="<?=base_url('Laporan/Peramalan_')?>" method="post"  target="_blank">
            <input type="hidden" name="filter" id="filter" class="form-control" value="<?=$_POST['filter']?>">
            <button class="btn btn-info btn-sm float-right ml-2" type="submit" onclick="return valid();" name="cetak"><i class="fas fa-print"></i> Cetak</button>
        </form>
      </div>
        <?php endif; ?> 
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr align="center">
                <th width="3%">#</th>
                <th width="25%">Tipe Kendaraan</th>
                <th width="25%">Forecast Brown</th>
                <?php if($_POST['filter'] == 'semua'): ?>
                <th width="15%">MAD</th>
                <th width="15%">MSE</th>
                <th width="15%">MAPE</th>
                <?php elseif($_POST['filter'] == 'mad'): ?>
                <th width="25%">MAD</th>
                <?php elseif($_POST['filter'] == 'mse'): ?>
                <th width="25%">MSE</th>
                <?php elseif($_POST['filter'] == 'mape'): ?>
                <th width="25%">MAPE</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach($ramalan->result() as $data): ?>
                <?php $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data->tipe' ORDER BY waktu DESC")->row(); ?>
                <tr align="center">
                  <td> => </td>
                  <td><?=$data->tipe?></td>
                  <td><?=$for->forecast?></td>
                  <?php if($_POST['filter'] == 'semua'): ?>
                    <td><?=$for->mad?></td>
                    <td><?=$for->mse?></td>
                    <td><?=$for->mape?></td>
                  <?php elseif($_POST['filter'] == 'mad'): ?>
                    <td><?=$for->mad?></td>
                  <?php elseif($_POST['filter'] == 'mse'): ?>
                    <td><?=$for->mse?></td>
                  <?php elseif($_POST['filter'] == 'mape'): ?>
                    <td><?=$for->mape?></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Forecast, MAD, MSE dan MAPE PT. Mitsubishi Gorontalo 20</h6>
      </div>
      <div class="card-body">
        <div class="chart-bar">
          <canvas id="myBarChart"></canvas>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>


<script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>vendor/chart.js/Chart.min.js"></script>
<script type="text/javascript">

  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Bar Chart Example
  $(function(){

    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
      type: 'line',
      <?php if($_POST['filter'] == 'semua'): ?>
        data: {
          labels: [
            <?php foreach ($ramalan->result_array() as $data) { echo '"' . $data['tipe'] . '",'; }?>
          ],
          datasets: [{
            label: "Forecast Brown",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "blue",
            borderColor: "#4e73df",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['forecast'] . '",'; }?>
            ],
          },
          {
            label: "MAD",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "red",
            borderColor: "#ff6384",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mad'] . '",'; }?>
            ],
          },
          {
            label: "MSE",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "Green",
            borderColor: "#469536",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mse'] . '",'; }?>
            ],
          },
          {
            label: "MAPE",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "Yellow",
            borderColor: "#ffce56",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mape'] . '",'; }?>
            ],
          }],
        },
      <?php elseif($_POST['filter'] == 'mad'): ?>
        data: {
          labels: [
            <?php foreach ($ramalan->result_array() as $data) { echo '"' . $data['tipe'] . '",'; }?>
          ],
          datasets: [{
            label: "Forecast Brown",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "blue",
            borderColor: "#4e73df",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['forecast'] . '",'; }?>
            ],
          },
          {
            label: "MAD",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "red",
            borderColor: "#ff6384",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mad'] . '",'; }?>
            ],
          }],
        },
      <?php elseif($_POST['filter'] == 'mse'): ?>
        data: {
          labels: [
            <?php foreach ($ramalan->result_array() as $data) { echo '"' . $data['tipe'] . '",'; }?>
          ],
          datasets: [{
            label: "Forecast Brown",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "blue",
            borderColor: "#4e73df",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['forecast'] . '",'; }?>
            ],
          },
          {
            label: "MSE",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "Green",
            borderColor: "#469536",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mse'] . '",'; }?>
            ],
          }],
        },
      <?php elseif($_POST['filter'] == 'mape'): ?>
        data: {
          labels: [
            <?php foreach ($ramalan->result_array() as $data) { echo '"' . $data['tipe'] . '",'; }?>
          ],
          datasets: [{
            label: "Forecast Brown",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "blue",
            borderColor: "#4e73df",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['forecast'] . '",'; }?>
            ],
          },
          {
            label: "MAPE",
            lineTension: 0,
            fill: false,
            hoverBackgroundColor: "Yellow",
            borderColor: "#ffce56",
            data: [
              <?php foreach ($ramalan->result_array() as $data) { $for = $this->db->query("SELECT * FROM ramalan WHERE tipe='$data[tipe]' ORDER BY waktu DESC")->row_array(); echo '"' . $for['mape'] . '",'; }?>
            ],
          }],
        },
      <?php endif; ?>
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            maxBarThickness: 55,
          }],
        },
        legend: {
          display: false
        },
      }
    });

  });

</script>
