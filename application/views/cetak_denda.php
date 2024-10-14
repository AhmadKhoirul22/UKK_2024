<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Data Denda</title>
</head>
<body>
	<?php
	$this->db->from('peminjaman p');
	$this->db->join('denda_peminjaman d','d.kode_peminjaman = p.kode_peminjaman','left');
	$this->db->join('user u','u.id_user = p.id_user','left');
	$this->db->where('p.tanggal_peminjaman >=',$tanggal_awal);
	$this->db->where('p.tanggal_peminjaman <=',$tanggal_akhir);
	$this->db->where('d.denda >',0);
	$denda = $this->db->get()->result_array();
	?>
	<center>
	<h4>Data Laporan Denda Peminjaman Buku</h4>	
	<h4>Dari <?= $tanggal_awal ?> sampai <?= $tanggal_akhir ?> </h4>
	<table border="1px" >
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kode</th>
				<th>Peminjaman</th>
				<th>Pengembalian</th>
				<th>Kembali</th>
				<th>Denda</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $total_denda=0; $no=1; foreach($denda as $dd){ ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $dd['nama'] ?></td>
				<td><?= $dd['kode_peminjaman'] ?></td>
				<td><?= $dd['tanggal_peminjaman'] ?></td>
				<td><?= $dd['tanggal_pengembalian'] ?></td>
				<td><?= $dd['tanggal_kembali'] ?></td>
				<td>Rp <?= number_format($dd['denda']) ?></td>
				<td><?= $dd['status'] ?></td>
			</tr>
			<?php $total_denda += $dd['denda']; ?>
			<?php } ?>
			<tr>
				<td >Jumlah Denda</td>
				<!-- <td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td> -->
				<td colspan="7" >Rp <?= number_format($total_denda) ?></td>
			</tr>
		</tbody>
	</table>
	</center>
</body>
<script>
	window.print();
</script>
</html>
