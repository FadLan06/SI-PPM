<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?=$title?></h1>
  <p class="mb-4"></p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-right text-primary">Data <?=$title?> <br>  <?php if(isset($_POST['cari'])) : ?>
          <?php if($_POST['bulan'] == 1){
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
            } ?>
          Periode : <?=$bulan?> <?=$_POST['tahun']?>
        <?php endif; ?> 
      </h6>
      <form method="post">
        <div class="form-row align-items-center">
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Name</label>
            <select class="custom-select mr-sm-2" name="bulan" id="inlineFormCustomSelect" required>
              <option selected disabled><-- Pilih Bulan --></option>
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
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Username</label>
            <select class="custom-select mr-sm-2" name="tahun" id="inlineFormCustomSelect" required>
              <option selected disabled><-- Pilih Tahun --></option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-warning btn-sm" name="cari"><i class="fas fa-search"></i> Cari</button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-plus-circle"></i> Tambah</button>
            <?php if(isset($_POST['cari'])) : ?>
              <a href="<?=base_url('Permintaan')?>" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      <?= $this->session->flashdata('message') ?>
      <div class="table-responsive">
        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th width="5%">#</th>
              <th width="20%">Tanggal SPK</th>
              <th width="15%">Customer</th>
              <th>Nama Mobil</th>
              <th>Tipe RN</th>
              <th width="10%">Aksi</th>
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
                <td align="center">
                  <a href="" title="Lihat Data" data-target="#vPermin" data-toggle="modal" data-id="<?=$data['id_permintaan']?>"><i class="fas fa-search text-warning"></i></a>
                  <a href="" title="Ubah Data" data-target="#uPermin" data-toggle="modal" data-id="<?=$data['id_permintaan']?>"><i class="fas fa-edit text-success mr-1 ml-1"></i></a>
                  <a href="<?=base_url('Permintaan/hapus/').$data['id_permintaan']?>" title="Hapus Data" onclick="return confirm('Anda Yakin ?');"><i class="fas fa-trash text-danger"></i></a>
                </td>
              </tr>
            <?php endforeach;?>
            <?php else : ?>
              <tr>
                <td colspan="6">
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

</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Permintaan Kendaraan SPK</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="mb-4" action="<?=base_url('Permintaan/Aksi')?>" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Tanggal SPK</label>
              <input type="date" class="form-control" id="inputEmail4" name="tgl_spk" required autocomplete="off"> 
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">No. SPK Dealer</label>
              <input type="text" class="form-control" id="inputPassword4" name="no_spk" required autocomplete="off">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="inputCity">Nama Customer</label>
              <input type="text" class="form-control" id="inputCity" name="nama_customer" required autocomplete="off">
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">No. Telpon</label>
              <input type="text" class="form-control" id="inputZip" name="no_telp" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Nama Mobil</label>
            <input type="text" class="form-control" id="inputAddress" name="nama_unit" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Tipe RN</label>
            <input type="text" class="form-control" id="inputAddress2" name="tipe_unit" required autocomplete="off">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Warna</label>
              <input type="text" class="form-control" id="inputCity" name="warna" required autocomplete="off">
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">Jumlah</label>
              <input type="text" class="form-control" id="inputZip" name="jumlah_permintaan" required autocomplete="off">
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">Status SPK</label>
              <select class="form-control" name="status_spk" id="" required>
                <option>Tunggu Unit</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity">Cara Pembayaran</label>
              <select class="form-control" name="bayar" id="" required>
                <option>Debit</option>
                <option>Kredit</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">Nama Leasing</label>
              <select class="form-control" name="leasing" id="" required>
                <option>MTF</option>
                <option>BCA</option>
                <option>MY BANK</option>
                <option>ADIRA</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">Tenor</label>
              <input type="text" class="form-control" name="tenor" id="inputZip" required autocomplete="off">
            </div>
          </div>
          <hr>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="vPermin" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Permintaan Kendaraan SPK</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="_viewPermin"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uPermin" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="staticBackdropLabel">Ubah Permintaan Kendaraan SPK</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="_ubahPermin"></div>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#vPermin').on('show.bs.modal', function(e) {
          var kd = $(e.relatedTarget).data('id');
          //menggunakan fungsi ajax untuk pengambilan data
          $.ajax({
              type: 'post',
              url: '<?= base_url('Permintaan/dt_view') ?>',
              data: 'id_permintaan=' + kd,
              success: function(data) {
                  $('._viewPermin').html(data); //menampilkan data ke dalam modal
              }
          });
      });
  });

  $(document).ready(function() {
      $('#uPermin').on('show.bs.modal', function(e) {
          var kd = $(e.relatedTarget).data('id');
          //menggunakan fungsi ajax untuk pengambilan data
          $.ajax({
              type: 'post',
              url: '<?= base_url('Permintaan/dt_ubah') ?>',
              data: 'id_permintaan=' + kd,
              success: function(data) {
                  $('._ubahPermin').html(data); //menampilkan data ke dalam modal
              }
          });
      });
  });
</script>