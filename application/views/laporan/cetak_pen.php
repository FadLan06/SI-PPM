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
	        <td width="120" style="vertical-align: middle;">
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
	    			<th width="5%">#</th>
	    			<th width="12%">Tanggal</th>
	    			<th width="17%">Customer</th>
	    			<th width="12%">No. Telpon</th>
	    			<th>Tipe Kendaraan</th>
	    			<th>No. Rangka</th>
	    			<th>Sales</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		<?php if($historis->num_rows() != 0) : $no=1; foreach($historis->result_array() as $data): ?>
	    			<tr align="center">
	    				<td><?=$no++?></td>
	    				<td><?=date('d F Y', strtotime($data['tgl_penjualan']))?></td>
	    				<td><?=$data['nama_customer']?></td>
	    				<td><?=$data['no_telp']?></td>
	    				<td><?=$data['type']?></td>
	    				<td><?=$data['no_rangka']?></td>
	    				<td><?=$data['sales']?></td>
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
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>