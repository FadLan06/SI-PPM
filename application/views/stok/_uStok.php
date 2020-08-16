<form class="mb-4" action="<?=base_url('Stok/Aksi')?>" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Tanggal</label>
      <input type="hidden" class="form-control" id="inputEmail4" name="id_stok" value="<?=$data['id_stok']?>">
      <input type="date" class="form-control" id="inputEmail4" name="tgl" value="<?=$data['tgl']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">No. Rangka</label>
      <input type="text" class="form-control" id="inputPassword4" name="no_rangka" value="<?=$data['no_rangka']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Nama Mobil</label>
    <input type="text" class="form-control" id="inputAddress" name="nama_unit" value="<?=$data['nama_unit']?>">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Tipe</label>
    <input type="text" class="form-control" id="inputAddress2" name="tipe" value="<?=$data['tipe']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Warna</label>
      <input type="text" class="form-control" id="inputCity" name="warna" value="<?=$data['warna']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Sisa</label>
      <input type="text" class="form-control" id="inputZip" name="sisa" value="<?=$data['sisa']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Satuan</label>
      <input type="text" class="form-control" id="inputZip" name="satuan" value="<?=$data['satuan']?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Stok Masuk</label>
      <input type="number" class="form-control" onchange="hitung();" id="stok_masuk" name="stok_masuk" value="<?=$data['stok_masuk']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Stok Keluar</label>
      <input type="number" class="form-control" onchange="hitung();" id="stok_keluar" name="stok_keluar" value="<?=$data['stok_keluar']?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Sisa Stok</label>
      <input type="text" class="form-control" id="sisa_stok" name="sisa_stok" value="<?=$data['sisa_stok']?>" readonly>
    </div>
  </div>
  <hr>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah</button>
</form>