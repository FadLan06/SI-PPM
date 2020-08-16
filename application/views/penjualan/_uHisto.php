<form class="mb-4" action="<?=base_url('Penjualan/Aksi')?>" method="POST">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Tanggal SPK</label>
      <input type="hidden" class="form-control" id="inputEmail4" name="id_historis" value="<?=$data['id_historis']?>">
      <input type="date" class="form-control" id="inputEmail4" name="tgl_penjualan" value="<?=$data['tgl_penjualan']?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="inputCity">Nama Customer</label>
      <input type="text" class="form-control" id="inputCity" name="nama_customer" value="<?=$data['nama_customer']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">No. Telpon</label>
      <input type="text" class="form-control" id="inputZip" name="no_telp" value="<?=$data['no_telp']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Tipe RN</label>
    <input type="text" class="form-control" id="inputAddress2" name="type" value="<?=$data['type']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">NO. Rangka</label>
      <input type="text" class="form-control" id="inputCity" name="no_rangka" value="<?=$data['no_rangka']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Sales</label>
      <input type="text" class="form-control" id="inputZip" name="sales" value="<?=$data['sales']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Hasil Penjualan</label>
    <input type="text" class="form-control" id="inputAddress" name="hasil_penjualan" value="<?=$data['hasil_penjualan']?>">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Jenis Kendaraan</label>
    <select class="form-control" name="singkat">
      <option value="XPANDER" <?= $data['singkat'] == 'XPANDER' ? 'selected' : '' ?>>XPANDER</option>
      <option value="OUTLANDER" <?= $data['singkat'] == 'OUTLANDER' ? 'selected' : '' ?>>OUTLANDER</option>
      <option value="PAJERO" <?= $data['singkat'] == 'PAJERO' ? 'selected' : '' ?>>PAJERO</option>
      <option value="MIRAGE" <?= $data['singkat'] == 'MIRAGE' ? 'selected' : '' ?>>MIRAGE</option>
      <option value="STRADA" <?= $data['singkat'] == 'STRADA' ? 'selected' : '' ?>>STRADA</option>
      <option value="TRITON" <?= $data['singkat'] == 'TRITON' ? 'selected' : '' ?>>TRITON</option>
    </select>
  </div>
  <hr>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah</button>
</form>