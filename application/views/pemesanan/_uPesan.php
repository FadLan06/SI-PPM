<form class="mb-4" action="<?=base_url('Pemesanan/Aksi')?>" method="POST">
  <div class="form-group">
    <label for="inputAddress">Nama Unit</label>
    <input type="hidden" class="form-control" id="inputEmail4" name="id_pemesanan" value="<?=$data['id_pemesanan']?>">
    <input type="text" class="form-control" id="inputAddress" name="nama_unit" value="<?=$data['nama_unit']?>">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Tipe Unit</label>
    <input type="text" class="form-control" id="inputAddress2" name="tipe" value="<?=$data['tipe']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Warna</label>
      <input type="text" class="form-control" id="inputCity" name="warna" value="<?=$data['warna']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Jumlah</label>
      <input type="text" class="form-control" id="inputZip" name="jumlah_pesan" value="<?=$data['jumlah_pesan']?>">
    </div>
  </div>
  <hr>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah</button>
</form>