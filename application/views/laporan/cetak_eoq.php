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
				      PT. MITSUBISHI GORONTALO
	          </h3>
	        </td>
	      </tr>
	    </table>

	    <table cellpadding="0" cellspacing="0" width="100%">
	    	<tr>
	    		<td align="center"><h2><?=$title?></h2></td>
	    	</tr>
	    </table>

		    <div class="card card-body border-primary mb-4">
          <table cellpadding="3" cellspacing="0" width="100%">
            <tr>
              <td width="15%">Tipe Kendaraan</td>
              <td width="2%">:</td>
              <td>MITSUBISHI <?=$_POST['filter']?></td>
            </tr>
            <tr>
              <td width="15%">Jumlah Permintaan</td>
              <td width="2%">:</td>
              <td><?=$fore['forecast']?> Unit</td>
            </tr>
          </table>
        </div>
        <div class="card border-primary">
          <div class="card-body">
            <div class="table-responsive-sm">
              <table cellpadding="3" border="1" cellspacing="0" width="100%" style="margin-top: 20px">
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
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>