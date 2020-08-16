<form class="mb-4" action="<?=base_url('Nota/Aksi')?>" method="POST">
  <div class="form-group">
    <label for="inputAddress">Nama Unit</label>
    <input type="hidden" class="form-control" id="inputEmail4" name="id_nota" value="<?=$data['id_nota']?>">
    <input type="text" class="form-control" id="inputAddress" name="nama_unit" value="<?=$data['nama_unit']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Jumlah Pesanan</label>
      <input type="text" class="form-control" id="inputCity" name="sebanyak" value="<?=$data['sebanyak']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Harga</label>
      <input type="text" class="form-control" id="inputZip" name="harga" value="<?=$data['harga']?>">
    </div>
  </div>
  <hr>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary float-right" name="ubah">Ubah</button>
</form>