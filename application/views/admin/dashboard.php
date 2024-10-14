<div class="col-lg-12">
	<div class="row">
		<div class="col-3">
			<div class="card">
				<a href="<?= base_url('admin/user') ?>">
					<div class="card-body">
						<h5 class="mt-2"><i class="bi bi-person-circle"></i> User Peminjam</h5>
						<h5><?= count($user) ?> Orang</h5>
					</div>
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="card">
				<a href="<?= base_url('admin/buku') ?>">
					<div class="card-body">
						<h5 class="mt-2"><i class="bi bi-book"></i> Jumlah Buku</h5>
						<h5><?= count($buku) ?> Buku</h5>
					</div>
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="card">
				<a href="<?= base_url('admin/denda') ?>">

					<div class="card-body">
						<h5 class="mt-2"><i class="bi bi-cash-coin"></i> Denda Perbuku</h5>
						<h5>Rp <?= number_format($denda) ?></h5>
					</div>
				</a>

			</div>
		</div>
		<div class="col-3">
			<div class="card">
				<a href="<?= base_url('admin/kategori') ?>">

					<div class="card-body">
						<h5 class="mt-2"><i class="bi bi-journal-text"></i> Kategori Buku</h5>
						<h5><?= count($kategori) ?> Kategori</h5>
					</div>
				</a>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Peminjaman</th>
								<th>Kembali</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($peminjaman as $pp){ ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $pp['nama'] ?></td>
								<td><?= $pp['tanggal_peminjaman'] ?></td>
								<td>
								<?php if($pp['status'] == 'DIKEMBALIKAN'){
									echo $pp['tanggal_kembali'];
								} else {
									echo 'masih dipinjam';
								}?>
								</td>
								<td><a href="<?= base_url('admin/pengembalian/detail_peminjaman/'.$pp['kode_peminjaman']) ?>"
										class="btn btn-info"><i class="bi bi-book"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
