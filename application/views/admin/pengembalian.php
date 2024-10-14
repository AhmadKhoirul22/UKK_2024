<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-6"></div>
				<div class="col-6">
				<div class="float-end">
			<button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class="bi bi-printer"></i> Cetak Laporan
              </button>
			  <!-- modal -->
			  <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Cetak Laporan Peminjaman Buku</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
					<form action="<?= base_url('admin/pengembalian/cetak_laporan') ?>" method="post" target="_blank" >
                    <div class="modal-body">
							<div class="mb-3">
								<label for="" class="form-label">Tanggal Awal</label>
								<input type="date" name="tanggal_awal" required class="form-control">
							</div>
							<div class="mb-3">
								<label for="" class="form-label">Tanggal Akhir</label>
								<input type="date" name="tanggal_akhir" required class="form-control">
							</div>
							<div class="mb-3">
								<label for="" class="form-label">Status</label>
								<select name="status" id="" class="form-control">
									<option value="1">DIPINJAM</option>
									<option value="2">DIKEMBALIKAN</option>
									<option value="0">SEMUA</option>
								</select>
							</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
					</form>
                  </div>
                </div>
              </div>
			<!-- end modal -->
			</div>
				</div>
			</div>
			<table class="table datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Peminjaman</th>
						<th>Pengembalian</th>
						<th>Kembali</th>
						<th>Status</th>
						<th>Denda</th>
						<th>Nama</th>
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
						<td><?= $pp['nama'] ?></td>
						<td>
							<a href="<?= base_url('admin/pengembalian/detail_peminjaman/'.$pp['kode_peminjaman']) ?>" class="btn btn-primary mb-2">Detail</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
