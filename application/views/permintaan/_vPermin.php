<table class="table table- table-sm" width="100%">
	<tr>
		<td width="30%">Tanggal SPK</td>
		<td width="2%">:</td>
		<td><?=date('d F Y', strtotime($data['tgl_spk']))?></td>
	</tr>
	<tr>
		<td width="30%">No. SPK Dealer</td>
		<td width="2%">:</td>
		<td><?=$data['no_spk']?></td>
	</tr>
	<tr>
		<td width="30%">Customer</td>
		<td width="2%">:</td>
		<td><?=$data['nama_customer']?></td>
	</tr>
	<tr>
		<td width="30%">No. Telpon</td>
		<td width="2%">:</td>
		<td><?=$data['no_telp']?></td>
	</tr>
	<tr>
		<td width="30%">Nama Mobil</td>
		<td width="2%">:</td>
		<td><?=$data['nama_unit']?></td>
	</tr>
	<tr>
		<td width="30%">Tipe RN</td>
		<td width="2%">:</td>
		<td><?=$data['type_unit']?></td>
	</tr>
	<tr>
		<td width="30%">Warna</td>
		<td width="2%">:</td>
		<td><?=$data['warna']?></td>
	</tr>
	<tr>
		<td width="30%">Jumlah</td>
		<td width="2%">:</td>
		<td><?=$data['jumlah_permintaan']?></td>
	</tr>
	<tr>
		<td width="30%">Status SPK</td>
		<td width="2%">:</td>
		<td><?=$data['status_spk']?></td>
	</tr>
	<tr>
		<td width="30%">Cara Pembayaran</td>
		<td width="2%">:</td>
		<td><?=$data['bayar']?></td>
	</tr>
	<tr>
		<td width="30%">Nama Leasing</td>
		<td width="2%">:</td>
		<td><?=$data['leasing']?></td>
	</tr>
	<tr>
		<td width="30%">Tenor</td>
		<td width="2%">:</td>
		<td><?=$data['tenor']?></td>
	</tr>
</table>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>