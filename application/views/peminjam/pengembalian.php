<div class="col-12">
	<div class="card">
		<div class="card-body">
			<table class="table" id="table1" >
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Peminjaman</th>
						<th>Pengembalian</th>
						<th>Kembali</th>
						<th>Status</th>
						<th>Denda</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($peminjaman as $pp){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $pp['kode_peminjaman'] ?></td>
						<td><?= $pp['tanggal_peminjaman'] ?></td>
						<td><?= $pp['tanggal_pengembalian'] ?></td>
						<td><?= $pp['tanggal_kembali'] ?></td>
						<td><?= $pp['status'] ?></td>
						<td>Rp <?= number_format($pp['denda']) ?>
						</td>
						<td>
							<a href="<?= base_url('peminjam/pengembalian/detail_peminjaman/'.$pp['kode_peminjaman']) ?>" class="btn btn-primary mb-2">Detail</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
