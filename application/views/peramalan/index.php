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
      <?= $this->session->flashdata('message') ?>
      <form method="post">
        <div class="form-row align-items-center">
          <div class="col-md-3 my-1">
            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
            <select class="custom-select mr-sm-2" name="tipe" id="inlineFormCustomSelect" required>
              <option disabled="disabled" selected>Pilih Tipe Kendaraan</option>
              <option value="XPANDER">XPANDER</option>
              <option value="OUTLANDER">OUTLANDER</option>
              <option value="PAJERO">PAJERO</option>
              <option value="MIRAGE">MIRAGE</option>
              <option value="STRADA">STRADA</option>
              <option value="TRITON">TRITON</option>
            </select>
          </div>
          <div class="col-md-2 my-1">
            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
            <input type="text" name="alpha" class="form-control" autocomplete="off" placeholder="Input Nilai ALPHA" required>
          </div>
          <div class="col-md-2 my-1">
            <button type="submit" class="btn btn-primary" name="cari">Cek</button>
            <?php if(isset($_POST['cari'])) : ?>
              <a href="<?=base_url('Peramalan')?>" class="btn btn-danger"><i class="fas fa-sync-alt"></i> Refresh</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  <?php if(isset($_POST['cari'])): ?>
    <div class="card-footer">
      <h6 class="m-0 font-weight-bold text-primary" align="center">Hasil Pencarian Tipe Kedaraan Unit <?=$_POST['tipe']?>, ALPHA <?=$_POST['alpha']?> di PT. Mitsubishi Gorontalo 20</h6>
    </div>
  <?php endif; ?>
  </div>
  <?php if(isset($_POST['cari'])): ?>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Forecast dan Forecast Error <?=$_POST['tipe']?> </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" width="100%" cellspacing="0">
            <thead>
              <tr align="center">
                <th width="12%">Periode</th>
                <th width="8%">Jumlah</th>
                <th width="8%">S't</th>
                <th width="8%">S''t</th>
                <th width="8%">at</th>
                <th width="10%">bt</th>
                <th width="8%">Forecast</th>
                <th width="8%">Error</th>
                <th width="8%">MAD</th>
                <th width="8%">MSE</th>
                <th width="8%">MAPE%</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no=0;
                $ak=0;
                $total_jum=0;
                foreach($pen->result() as $data):
                  $bulan = date("m",strtotime($data->tgl_penjualan)); 
                  $tahun = date("Y",strtotime($data->tgl_penjualan)); 
                  $jum = $this->db->query("SELECT COUNT(singkat) as singkat FROM `historis` WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun' AND singkat='$_POST[tipe]'")->row();
                  if($jum->singkat == 0){
                    $ak = $ak + 1;
                  }
                  $jumlah=2;
                  $no++;
              ?>
                <tr align="center">
                  <input type="hidden" name="" id="alpha" value="<?=$_POST['alpha']?>">
                  <?php
                    for($x=1;$x<=1;$x++){
                      echo '<td>'.date('F Y', strtotime($data->tgl_penjualan)).'</td>';
                      echo '<td><input type="text" id="singkat'.$no.'" value="'.$jum->singkat.'" style="width: 60%"></td>';
                      $noo=0;
                      for($i=1;$i<=2;$i++){
                        $noo+=1;
                        echo '<td><input type="hidden" id="s'.$no.'t'.$noo.'" style="width: 60%"> <input type="text" id="ss'.$no.'tt'.$noo.'" style="width: 60%"></td>';
                      }
                        echo '<td><input type="text" id="at'.$no.'" style="width: 60%"></td>';
                        echo '<td><input type="text" id="bt'.$no.'" style="width: 60%"></td>';
                      
                        echo '<td><input type="text" id="for'.$no.'" style="width: 60%" class="kol1"> <input type="hidden" id="forr'.$no.'" style="width: 60%" class="koll1"></td>';
                        echo '<td><input type="text" id="er'.$no.'" style="width: 60%" class="kol2"> <input type="hidden" id="eer'.$no.'" style="width: 60%" class="koll2"></td>';
                        echo '<td><input type="text" id="mad'.$no.'" style="width: 60%" class="kol3"> <input type="hidden" id="madd'.$no.'" style="width: 60%" class="koll3"></td>';
                        echo '<td><input type="text" id="mse'.$no.'" style="width: 60%" class="kol4"> <input type="hidden" id="msse'.$no.'" style="width: 60%" class="koll4"></td>';
                        echo '<td><input type="text" id="mape'.$no.'" style="width: 60%" class="kol5"> <input type="hidden" id="mappe'.$no.'" style="width: 60%" class="koll5"></td>';

                        $total_jum += $jum->singkat;
                    }
                  ?>
                </tr>
              <?php endforeach; ?>
                <tr align="center">
                  <td><b>TOTAL</b></td>
                  <td><input type="text" style="width: 60%" value="<?=$total_jum?>"></td>
                  <td colspan="4"></td>
                  <?php
                    for($i=1;$i<=5;$i++){
                      echo '<td><input type="text" style="width: 60%" id="ttl'.$i.'"> <input type="hidden" style="width: 60%" id="ttll'.$i.'"></td>';
                    }
                  ?>
                </tr>
                <tr align="center">
                  <td colspan="8" align="right"><b>RATA - RATA</b></td>
                  <?php
                    for($i=3;$i<=5;$i++){
                      echo '<td><input type="text" style="width: 60%" id="rrt'.$i.'"></td>';
                    }
                  ?>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card card-body shadow mb-4">
      <div class="table-responsive">
        <table class="table table-hover table-sm" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>KETERANGAN</th>
              <th>NILAI</th>
            </tr>
          </thead>
          <tbody>
            <form action="<?=base_url('Peramalan/aksi')?>" method="post">
            <tr>
              <th>ALPHA</th>
              <td><input type="text" class="form-control" name="alpha" id="dt" value="<?=$_POST['alpha']?>" readonly=""/></td>
            </tr>
            <tr>
              <th>FORECAST</th>
              <td><input type="text" class="form-control" name="forecast" id="dt1" value="0" readonly=""/></td>
            </tr>
            <tr>
              <th>ERROR</th>
              <td><input type="text" class="form-control" name="error" id="dt2" value="0" readonly=""/></td>
            </tr>
            <tr>
              <th>MAD</th>
              <td><input type="text" class="form-control" name="mad" id="dt3" value="0" readonly=""/></td>
            </tr>
            <tr>
              <th>MSE</th>
              <td><input type="text" class="form-control" name="mse" id="dt4" value="0" readonly=""/></td>
            </tr>
            <tr>
              <th>MAPE</th>
              <td><input type="text" class="form-control" name="mape" id="dt5" value="0" readonly=""/></td>
            </tr>
            <input type="hidden" class="form-control" name="tipe" value="<?=$_POST['tipe']?>">
            <button type="submit" class="btn btn-success float-right mb-2" name="simpan">Simpan</button>
            </form>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Forecast, MAD, MSE dan MAPE Unit <?=$_POST['tipe']?> PT. Mitsubishi Gorontalo 20</h6>
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
  $(function(){

    for(i=1;i<=<?=$no?>;i++){
    var sing = $('#singkat'+i).val();
    var sing1 = $('#singkat'+1).val();
    var alpha = $('#alpha').val();
    var jumlah=2;
      for(s=1;s<=jumlah;s++){
        var st = "#s"+i+"t"+s;
        if(sing == 0){
          var w = i - 1;
          var u = $("#s"+w+"t"+s).val();
          var st = "#s"+i+"t"+s;
          if(st == "#s"+i+"t1"){
            var s1 = $('#s1t1').val();
            if(s1 == ''){
              if(sing1 == 0){
                var jum = parseFloat(0);
              }
            }else{
              var jum = parseFloat(u);
            }
            hasill = jum.toFixed(1);
            $("#s"+i+"t1").val(jum);
            $("#ss"+i+"tt1").val(hasill);
          }else if(st == "#s"+i+"t2"){
            var s2 = $('#s2t1').val();
            if(s2 == ''){
              if(sing1 == 0){
                var jumm = parseFloat(0);
              }
            }else{
              var jumm = parseFloat(u);
            }
            hasill = jumm.toFixed(1);
            $("#s"+i+"t2").val(jumm);
            $("#ss"+i+"tt2").val(hasill);
          }
        }else{
          if((st == '#s1t1') || (st == '#s1t2')){
            var lt = sing-0;
            hass = lt.toFixed(1);
            $("#s"+i+"t"+s).val(lt);
            $("#ss"+i+"tt"+s).val(hass);
          }else{
            var ww = i - 1;
            var uu = $("#s"+ww+"t"+s).val();
            var sst = "#s"+i+"t"+s;
            if(sst == "#s"+i+"t1"){
              if(uu == 0){
                var jum = sing-0;;
                hasill = jum.toFixed(1);
                $("#s"+i+"t1").val(jum);
                $("#ss"+i+"tt1").val(hasill);
              }else{
                var jum = (alpha*sing)+(1-alpha)*uu;
                hasill = jum.toFixed(1);
                $("#s"+i+"t1").val(jum);
                $("#ss"+i+"tt1").val(hasill);
              }
            }else if(sst == "#s"+i+"t2"){
              if(uu == 0){
                var stt = $("#s"+i+"t1").val();
                var jumm = stt-0;
                hasill = jumm.toFixed(1);
                $("#s"+i+"t2").val(jumm);
                $("#ss"+i+"tt2").val(hasill);
              }else{
                var stt = $("#s"+i+"t1").val();
                var jumm = (alpha*stt)+(1-alpha)*uu;
                hasill = jumm.toFixed(1);
                $("#s"+i+"t2").val(jumm);
                $("#ss"+i+"tt2").val(hasill);
              }
            }
          }
        }
        var si = "#singkat"+i;
        if(si == '#singkat1'){
          var aat = (2 * sing) - sing;
          aatt = aat.toFixed(1);
          var btt = alpha/(1-alpha)*(sing-sing);
          bbtt = btt.toFixed(1);
          var fo = aat + btt;
          foo = fo.toFixed(1);
          var er = Math.abs(sing - fo);
          err = er.toFixed(1);
          var mse = err * err;
          msee = mse.toFixed(1);
          if(sing == 0){
            var mape = 0;
          }else{
            var mape = er*100/sing; 
          }
          mapee = mape.toFixed(1);
          $('#at'+i).val(aatt);
          $('#bt'+i).val(bbtt);
          $('#for'+i).val(foo);
          $('#forr'+i).val(fo);
          $('#er'+i).val(err);
          $('#eer'+i).val(er);
          $('#mad'+i).val(err);
          $('#madd'+i).val(er);
          $('#mse'+i).val(msee);
          $('#msse'+i).val(mse);
          $('#mape'+i).val(mapee);
          $('#mappe'+i).val(mape);
        }else if(sing == 0){
          var aat = 0;
          aatt = aat.toFixed(1);
          var btt = 0;
          bbtt = btt.toFixed(1);
          var fo = 0;
          foo = fo.toFixed(1);
          var er = 0;
          err = er.toFixed(1);
          var mse = 0;
          msee = mse.toFixed(1);
          var mape = 0; 
          mapee = mape.toFixed(1);
          $('#at'+i).val(aatt);
          $('#bt'+i).val(bbtt);
          $('#for'+i).val(foo);
          $('#forr'+i).val(fo);
          $('#er'+i).val(err);
          $('#eer'+i).val(er);
          $('#mad'+i).val(err);
          $('#madd'+i).val(er);
          $('#mse'+i).val(msee);
          $('#msse'+i).val(mse);
          $('#mape'+i).val(mapee);
          $('#mappe'+i).val(mape);
        }else{
          var aat = (2 * jum) - jumm;
          aatt = aat.toFixed(1);
          var btt = alpha/(1-alpha)*(jum-jumm);
          bbtt = btt.toFixed(1);
          var fo = aat + btt;
          foo = fo.toFixed(1);
          var er = Math.abs(sing - fo);
          err = er.toFixed(1);
          var mse = er * er;
          msee = mse.toFixed(1);
          var mape = er*100/sing; 
          mapee = mape.toFixed(1);
          $('#at'+i).val(aatt);
          $('#bt'+i).val(bbtt);
          $('#for'+i).val(foo);
          $('#forr'+i).val(fo);
          $('#er'+i).val(err);
          $('#eer'+i).val(er);
          $('#mad'+i).val(err);
          $('#madd'+i).val(er);
          $('#mse'+i).val(msee);
          $('#msse'+i).val(mse);
          $('#mape'+i).val(mapee);
          $('#mappe'+i).val(mape);
        }
        for(k=1;k<=2;k++){
          var suum=0;
          $(".koll"+k).each(function(){
            suum+=parseFloat($(this).val());
          });
          
          var xx = suum;
          hasi = xx.toFixed(0);
          $('#dt'+k).val(hasi);
        }
      }
        total();
        rata();

      for(f=3;f<=5;f++){
        var tt = $("#rrt"+f).val();
        $("#dt"+f).val(tt);
      }
    }

  });

  function total()
  {
    for(r=1;r<=5;r++){
      var sum=0;
      $(".koll"+r).each(function(){
        sum+=parseFloat($(this).val());
      });
      var fx=sum;
      tot = fx.toFixed(0);
      $("#ttl"+r).val(tot);
      $("#ttll"+r).val(fx);
    }
  }

  function rata()
  {
    for(r=3;r<=5;r++){
      var tot = $("#ttll"+r).val();
      var rat = tot / <?=$no - $ak?>;
      rataa = rat.toFixed(1);
      $("#rrt"+r).val(rataa);
    }
  }
  
</script>

<script type="text/javascript">
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Bar Chart Example
  $(function(){
    var suum=0;
    $(".kol"+1).each(function(){
      suum+=parseFloat($(this).val());
    });
    
    var xx = suum;
    hasi = xx.toFixed(0);

    var tt1 = $("#rrt"+3).val();
    var tt2 = $("#rrt"+4).val();
    var tt3 = $("#rrt"+5).val();

    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["FORECAST", "MAD", "MSE", "MAPE"],
        datasets: [{
          label: "Nilai",
          backgroundColor: "#4e73df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#4e73df",
          data: [hasi, tt1, tt2, tt3],
        }],
      },
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