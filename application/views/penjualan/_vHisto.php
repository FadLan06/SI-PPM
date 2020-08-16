<table class="table table- table-sm" width="100%">
	<tr>
		<td width="30%">Tanggal Penjualan</td>
		<td width="2%">:</td>
		<td><?=date('d F Y', strtotime($data['tgl_penjualan']))?></td>
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
		<td width="30%">Tipe Kendaraan</td>
		<td width="2%">:</td>
		<td><?=$data['type']?></td>
	</tr>
	<tr>
		<td width="30%">No. Rangka</td>
		<td width="2%">:</td>
		<td><?=$data['no_rangka']?></td>
	</tr>
	<tr>
		<td width="30%">Sales</td>
		<td width="2%">:</td>
		<td><?=$data['sales']?></td>
	</tr>
	<tr>
		<td width="30%">Hasil Penjualan</td>
		<td width="2%">:</td>
		<td><?=$data['hasil_penjualan']?></td>
	</tr>
</table>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>