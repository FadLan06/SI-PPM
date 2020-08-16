<table class="table table- table-sm" width="100%">
	<tr>
		<td width="30%">Tanggal</td>
		<td width="2%">:</td>
		<td><?=date('d F Y', strtotime($data['tgl']))?></td>
	</tr>
	<tr>
		<td width="30%">No. Rangka</td>
		<td width="2%">:</td>
		<td><?=$data['no_rangka']?></td>
	</tr>
	<tr>
		<td width="30%">Nama Mobil</td>
		<td width="2%">:</td>
		<td><?=$data['nama_unit']?></td>
	</tr>
	<tr>
		<td width="30%">Tipe RN</td>
		<td width="2%">:</td>
		<td><?=$data['tipe']?></td>
	</tr>
	<tr>
		<td width="30%">Warna</td>
		<td width="2%">:</td>
		<td><?=$data['warna']?></td>
	</tr>
	<tr>
		<td width="30%">Sisa</td>
		<td width="2%">:</td>
		<td><?=$data['sisa']?></td>
	</tr>
	<tr>
		<td width="30%">Satuan</td>
		<td width="2%">:</td>
		<td><?=$data['satuan']?></td>
	</tr>
	<tr>
		<td width="30%">Stok Masuk</td>
		<td width="2%">:</td>
		<td><?=$data['stok_masuk'].' '.$data['satuan']?></td>
	</tr>
	<tr>
		<td width="30%">Stok Keluar</td>
		<td width="2%">:</td>
		<td><?=$data['stok_keluar'].' '.$data['satuan']?></td>
	</tr>
	<tr>
		<td width="30%">Sisa Stok</td>
		<td width="2%">:</td>
		<td><?=$data['sisa_stok'].' '.$data['satuan']?></td>
	</tr>
</table>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>