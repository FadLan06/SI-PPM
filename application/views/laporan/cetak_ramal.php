<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Cetak <?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div style="margin-top: 5px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px">
	    <table class="" cellpadding="0" cellspacing="0" width="100%">
	      <tr>
	        <td width="100" style="vertical-align: middle;">
	          <img src="<?=base_url('assets/img/logo.png')?>" width="80%">
	        </td>
	        <td style="text-align: left; vertical-align: middle;">
	          <h3>
	            Sistem Penjualan dan Persediaan Mobil<br>
				PT. MITSUBISHI GORONTALO <br>
				Periode : 
		        <?php
		          if($_POST['filter'] == '2'){

		            if($_POST['bulan'] == 1){
		              $bulan = 'Januari';
		            }elseif($_POST['bulan'] == 2){
		              $bulan = 'Februari';
		            }elseif($_POST['bulan'] == 3){
		              $bulan = 'Maret';
		            }elseif($_POST['bulan'] == 4){
		              $bulan = 'April';
		            }elseif($_POST['bulan'] == 5){
		              $bulan = 'Mei';
		            }elseif($_POST['bulan'] == 6){
		              $bulan = 'Juni';
		            }elseif($_POST['bulan'] == 7){
		              $bulan = 'Juli';
		            }elseif($_POST['bulan'] == 8){
		              $bulan = 'Agustus';
		            }elseif($_POST['bulan'] == 9){
		              $bulan = 'September';
		            }elseif($_POST['bulan'] == 10){
		              $bulan = 'Oktober';
		            }elseif($_POST['bulan'] == 11){
		              $bulan = 'November';
		            }elseif($_POST['bulan'] == 12){
		              $bulan = 'Desember';
		            }
		            echo $bulan.' '.$_POST['tahun'];
		          }elseif($_POST['filter'] == '3'){
		            echo $_POST['tahun'];
		          }else{
		            echo 'Semua Periode';
		          }
		        ?>
	          </h3>
	        </td>
	      </tr>
	    </table>

	    <table cellpadding="0" cellspacing="0" width="100%">
	    	<tr>
	    		<td align="center"><h2><?=$title?></h2></td>
	    	</tr>
	    </table>

	    <table cellpadding="3" border="1" cellspacing="0" width="100%">
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
		<table width="80%" align="center">
			<tr>
				<td style="height:250px"><canvas id="myBarChart"></canvas></td>
			</tr>
		</table>
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
</body>
</html>