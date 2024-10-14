<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Data Laporan Peminjaman Buku</title>
</head>
<body>
	<?php  
	$this->db->from('peminjaman p');
	$this->db->join('user u','u.id_user = p.id_user','left');
	$this->db->where('p.tanggal_peminjaman >=',$tanggal_awal);
	$this->db->where('p.tanggal_peminjaman <=',$tanggal_akhir);
	if($status == 1){
		$this->db->where('status','DIPINJAM');
	} else if($status == 2){
		$this->db->where('status','DIKEMBALIKAN');
	} else if($status == 0){

	}
	$peminjaman = $this->db->get()->result_array();
	?>
	<center>
	<h4>Data Laporan Peminjaman Buku</h4>	
	<h4>Dari <?= $tanggal_awal ?> sampai <?= $tanggal_akhir ?> </h4>
	<table border="1px" >
		
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kode</th>
				<th>Buku</th>
				<th>Peminjaman</th>
				<th>Pengembalian</th>
				<th>Kembali</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($peminjaman as $pp){?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $pp['nama'] ?></td>
				<?php
				$this->db->from('detail_peminjaman d')->where('d.kode_peminjaman',$pp['kode_peminjaman']);
				$this->db->join('buku b','b.id_buku = d.id_buku','left');
				$detail = $this->db->get()->result_array();

				$firstRow = true;
				?>
				<?php foreach($detail as $dd){ ?>
				<?php if(!$firstRow){?>
				<td></td>
				<td></td>
				<?php } else {?>
				<?php $firstRow = false; }	
				?>
				<td><?= $dd['kode_peminjaman'] ?></td>
				<td><?= $dd['judul'] ?></td>
				<td><?= $pp['tanggal_peminjaman'] ?></td>
				<td><?= $pp['tanggal_pengembalian'] ?></td>
				<?php if($pp['status'] == 'DIKEMBALIKAN'){ ?>
					<td><?= $pp['tanggal_kembali'] ?></td>
				<?php } else { ?>
				<td>masih dipinjam</td>

				<?php } ?>
				<td><?= $pp['status'] ?></td>
			</tr>
			<?php } ?>
			<?php } ?>
		</tbody>
	</table>
	</center>
</body>
<script>
	window.print();
</script>
</html>
