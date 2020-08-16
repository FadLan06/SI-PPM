<form class="mb-4" action="<?=base_url('Permintaan/Aksi')?>" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Tanggal SPK</label>
      <input type="hidden" class="form-control" id="inputEmail4" name="id_permintaan" value="<?=$data['id_permintaan']?>">
      <input type="date" class="form-control" id="inputEmail4" name="tgl_spk" value="<?=$data['tgl_spk']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">No. SPK Dealer</label>
      <input type="text" class="form-control" id="inputPassword4" name="no_spk" value="<?=$data['no_spk']?>">
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
    <label for="inputAddress">Nama Mobil</label>
    <input type="text" class="form-control" id="inputAddress" name="nama_unit" value="<?=$data['nama_unit']?>">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Tipe RN</label>
    <input type="text" class="form-control" id="inputAddress2" name="tipe_unit" value="<?=$data['type_unit']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Warna</label>
      <input type="text" class="form-control" id="inputCity" name="warna" value="<?=$data['warna']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Jumlah</label>
      <input type="text" class="form-control" id="inputZip" name="jumlah_permintaan" value="<?=$data['jumlah_permintaan']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Status SPK</label>
      <select class="form-control" name="status_spk" id="">
        <option value="Tunggu Unit" <?= 'Tunggu Unit' == $data['status_spk'] ? 'selected' : '' ?>>Tunggu Unit</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Cara Pembayaran</label>
      <select class="form-control" name="bayar" id="">
        <option value="Debit" <?= 'Debit' == $data['bayar'] ? 'selected' : '' ?>>Debit</option>
        <option value="Kredit" <?= 'Kredit' == $data['bayar'] ? 'selected' : '' ?>>Kredit</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Nama Leasing</label>
      <select class="form-control" name="leasing" id="">
        <option value="MTF" <?= 'MTF' == $data['leasing'] ? 'selected' : '' ?>>MTF</option>
        <option value="BCA" <?= 'BCA' == $data['leasing'] ? 'selected' : '' ?>>BCA</option>
        <option value="MY BANK" <?= 'MY BANK' == $data['leasing'] ? 'selected' : '' ?>>MY BANK</option>
        <option value="ADIRA" <?= 'ADIRA' == $data['leasing'] ? 'selected' : '' ?>>ADIRA</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Tenor</label>
      <input type="text" class="form-control" name="tenor" id="inputZip" value="<?=$data['tenor']?>">
    </div>
  </div>
  <hr>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah</button>
</form>