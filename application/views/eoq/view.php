<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?=$title?> <?=$this->uri->segment(3)?></h1>
  <p class="mb-4"></p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-right text-primary">Data <?=$title?> <?=$this->uri->segment(3)?></h6>
    </div>
    <div class="card-body">
      <div class="card card-body border-primary mb-4">
        <h5><b>Detail Kendaraan</b><a href="<?=base_url('Eoq') ?>" class="float-right btn btn-primary ml-1 btn-sm kembali">Kembali</a></h5>
        <table class="table table-sm">
          <tr>
            <td width="20%">Tipe Kendaraan</td>
            <td width="2%">:</td>
            <td>MITSUBISHI <?=$this->uri->segment(3)?></td>
          </tr>
          <tr>
            <td width="20%">Forecast</td>
            <td width="2%">:</td>
            <td><?=$fore['forecast']?> Unit</td>
          </tr>
        </table>
      </div>
      <?php if($this->uri->segment(3) == 'XPANDER'){ $harga = '220000000'; }elseif($this->uri->segment(3) == 'OUTLANDER'){ $harga = '333000000'; }elseif($this->uri->segment(3) == 'PAJERO'){ $harga = '595000000'; }elseif($this->uri->segment(3) == 'MIRAGE'){ $harga = '163000000'; }elseif($this->uri->segment(3) == 'STRADA'){ $harga = '279000000'; }elseif($this->uri->segment(3) == 'TRITON'){ $harga = '290000000'; } ?>
      <div class="row">
        <div class="col-md-5">
          <div class="card card-body border-primary">
            <table width="100%" class="table-sm" cellpadding="9">
              <tr align="right">
                <td width="50%">Jumlah Permintaan</td>
                <td><input type="number" class="form-control" id="jpermintaan" value="<?=$fore['forecast']?>"></td>
              </tr>
              <tr align="right">
                <td width="50%">Harga Beli <br> (Harga Satuan)</td>
                <td><input type="number" class="form-control" id="hbeli" value="<?=$harga?>"></td>
              </tr>
              <tr align="right">
                <td width="50%">Biaya Pemesanan <br> (1x Pesan)</td>
                <td><input type="number" class="form-control" id="bpesan" value="15000000"></td>
              </tr>
              <tr align="right">
                <td width="50%">Biaya Simpan <br> (Per Unit %)</td>
                <td><input type="number" class="form-control" id="bsimpan" value="17"></td>
              </tr>
              <tr align="right">
                <td width="50%">Hari Kerja Efektif Per Tahun (EDY)</td>
                <td><input type="number" class="form-control" id="hkerja" value="300"></td>
              </tr> 
              <tr align="right">
                <td width="50%">Rata-Rata Keterlambatan Setiap Pemesanan</td>
                <td><input type="number" class="form-control" id="terlambat" value="7"></td>
              </tr>
              <tr align="right">
                <td width="50%">
                  <input type="submit" class="btn btn-danger btn-sm hitung" onClick="hitung()" value="Hitung">
                </td>
                <td align="left">
                  <form action="<?=base_url('Eoq/aksi')?>" method="post">
                    <input type="hidden" name="permintaan" value="<?=$fore['forecast']?>">
                    <input type="hidden" name="hbeli" value="<?=$harga?>">
                    <input type="hidden" name="eoq1" id="eoq1" readonly="">
                    <input type="hidden" name="q1" id="q1" readonly="">
                    <input type="hidden" name="frekuensi1" id="frekuensi1" readonly="">
                    <input type="hidden" name="interval1" id="interval1" readonly="">
                    <input type="hidden" name="safety1" id="safety1" readonly="">
                    <input type="hidden" name="reorder1" id="reorder1" readonly="">
                    <input type="hidden" name="tic1" id="tic1" readonly="">
                    <input type="hidden" name="toc1" id="toc1" readonly="">
                    <input type="hidden" name="tcc1" id="tcc1" readonly="">
                    <input type="hidden" name="tipe" id="tipe" value="<?=$this->uri->segment(3)?>" readonly="">
                    <button type="submit" name="simpan" class="btn btn-success ml-1 btn-sm" id="simpan" disabled>Simpan</button>
                    <button type="button" onclick="myFunction()" class="btn btn-warning ml-1 btn-sm">Reset</button>
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card card-body border-primary">
            <form id="myForm">
              <table width="100%" class="table-sm" cellpadding="9">
                <tr>
                  <td align="right" width="40%" valign="top">Pemesanan Optimal Setiap Tahun</td>
                  <td>
                    <input type="number" class="form-control" id="eoq" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      EOQ = akar ((2 * jumlahPermintaan * biayaPesan) / (hargaSatuan * biayaSimpan))
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Pemesanan Optimal Setiap Bulan</td>
                  <td>
                    <input type="number" class="form-control" id="q" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Q* = EOQ / 12 bulan
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Frekuensi Pemesanan</td>
                  <td>
                    <input type="number" class="form-control" id="frekuensi" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Frekuensi = jumlahPermintaan / EOQ
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Interval Waktu Pemesanan</td>
                  <td>
                    <input type="number" class="form-control" id="interval" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Interval = (EOQ / jumlahPermintaan) * EDY
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Persediaan Pengaman (Safety Stock)</td>
                  <td>
                    <input type="number" class="form-control" id="safety" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Safety Stock =  rata-rata keterlambatan bahan baku perhari  ×  kebutuhan bahan paku perhari
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Titik Pemesanan Kembali (Reorder Point)</td>
                  <td>
                    <input type="number" class="form-control" id="reorder" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      ROP = (jumlahPermintaan * waktuTunggu) + Safety Stock
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Total Biaya Persediaan Tahunan</td>
                  <td>
                    <input type="number" class="form-control" id="tic" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      TIC = ((jumlahPermintaan / jumlahBarang) * biayaPemesanan) + ((jumlahBarang / 2) * biayaPenyimpanan)
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Total Biaya Pemesanan Tahunan</td>
                  <td>
                    <input type="number" class="form-control" id="toc" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      TOC = ((jumlahPermintaan / jumlahBarang) * biayaPemesanan)
                    </small>
                  </td>
                </tr>
                <tr>
                  <td align="right" width="40%" valign="top">Total Biaya Penyimpanan Tahunan (%)</td>
                  <td>
                    <input type="number" class="form-control" id="tcc" readonly="">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      TCC = ((jumlahBarang / 2) * biayaPemesanan)
                    </small>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
  function hitung(){

  $("#simpan").prop("disabled", false); 
    
    var jpermintaan = $('#jpermintaan').val();
    var hbeli = $('#hbeli').val();
    var bpesan = $('#bpesan').val();
    var bsimpan = $('#bsimpan').val();
    var hkerja = $('#hkerja').val();
    var terlambat = $('#terlambat').val();

    //EOQ
    var r = jpermintaan;
    var s = bpesan * r;
    var p = hbeli;
    var i = bsimpan;

    var eoq = Math.sqrt((2*r*s)/(p*i/100));
    eoqq = eoq.toFixed(0);

    $('#eoq').val(eoqq);
    $('#eoq1').val(eoqq);

    //Q*
    var q = eoq / 12;
    qq = q.toFixed(0);
    
    $('#q').val(qq);
    $('#q1').val(qq);

    //FREKUENSI
    var d = jpermintaan;
    var f = d / q;
    ff = f.toFixed(0);

    $('#frekuensi').val(ff);
    $('#frekuensi1').val(ff);

    //INTERVAL
    var edy = hkerja;
    var t = (q / d) * edy;
    tt = t.toFixed(0);

    $('#interval').val(tt);
    $('#interval1').val(tt);

    //Safety Stock
    var keb = d / edy;

    var safety = terlambat * keb;
    safetyy = safety.toFixed(0);

    $('#safety').val(safetyy);
    $('#safety1').val(safetyy);

    //Reorder Point
    var l = terlambat / edy;
    ll = l.toFixed(3);

    var rop = (d * ll) + safety;
    ropp = rop.toFixed(0);

    $('#reorder').val(ropp);
    $('#reorder1').val(ropp);

    //Total Biaya Persediaan Tahunan
    var ss = bpesan * qq;
    var tic = (d / qq * ss) + ((qq / 2) * i/100);
    hasil = tic.toFixed(3);

    $('#tic').val(tic);
    $('#tic1').val(tic);

    //TOC
    var toc = (d / qq * ss);
    $('#toc').val(toc);
    $('#toc1').val(toc);

    //TCC
    var tcc = (qq / 2) * i;
    tcc1 = tcc.toFixed(1);
    
    $('#tcc').val(tcc);
    $('#tcc1').val(tcc1);
  };

  function myFunction() {
    $("#simpan").prop("disabled", true); 
    document.getElementById("myForm").reset();
  }
</script>
