<div class="col-12">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#basicModal">
				Tambah Buku
			</button>
			<!-- modal -->
			<div class="modal fade" id="basicModal" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Buku</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="<?= base_url('admin/buku/add') ?>" class="needs-validation" novalidate method="post">
							<div class="modal-body">
								<div class="mb-3">
									<label for="" class="form-label">Judul</label>
									<input type="text" required name="judul" id="yourUsername" class="form-control">
									<div class="invalid-feedback">tulis judul buku</div>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Penulis</label>
									<input type="text" required name="penulis" id="yourUsername" class="form-control">
									<div class="invalid-feedback">tulis penulis buku</div>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Penerbit</label>
									<input type="text" required name="penerbit" id="yourUsername" class="form-control">
									<div class="invalid-feedback">tulis penerbit buku</div>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Tahun Terbit</label>
									<input type="number" required name="tahun_terbit" id="yourUsername" min="2000" class="form-control">
									<div class="invalid-feedback">tulis tahun terbit buku buku</div>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Kategori</label>
									<select name="id_kategori" id="" class="form-control">
										<?php foreach ($kategori as $kk) { ?>
										<option value="<?= $kk['id_kategori'] ?>"><?= $kk['nama_kategori'] ?></option>
										<?php  } ?>
									</select>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">jumlah </label>
									<input type="number" required name="jumlah" min="1" id="yourUsername" class="form-control">
									<div class="invalid-feedback">tulis jumlah buku</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- end modal -->
			<table class="table datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Penulis</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
						<th>Kategori</th>
						<th>Jumlah</th>
						<th>Rating</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($buku as $uu){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $uu['judul'] ?></td>
						<td><?= $uu['penulis'] ?></td>
						<td><?= $uu['penerbit'] ?></td>
						<td><?= $uu['tahun_terbit'] ?></td>
						<td><?= $uu['nama_kategori'] ?></td>
						<td><?= $uu['jumlah'] ?></td>
						<td>⭐<?= number_format( $this->Buku_model->rating($uu['id_buku']),1) ?></td>
						<td>
							<button type="button" class="btn btn-info" data-bs-toggle="modal"
								data-bs-target="#basicModal<?= $uu['id_buku'] ?>">
								<i class="bi bi-pencil"></i>
							</button>
							<a href="<?= base_url('admin/buku/delete/'.$uu['id_buku']) ?>"
								onclick="return confirm('yakin hapus?')" class="btn btn-danger"><i
									class="bi bi-trash"></i></a>
							<a href="<?= base_url('admin/buku/detail_buku/'.$uu['id_buku']) ?>"
								 class="btn btn-warning mt-2"><i
									class="bi bi-book-half"></i></a>
							<!-- modal -->
							<div class="modal fade" id="basicModal<?= $uu['id_buku'] ?>" tabindex="-1">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Kategori</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<form action="<?= base_url('admin/buku/update') ?>" method="post">
											<div class="modal-body">
												<input type="hidden" value="<?= $uu['id_buku'] ?>" name="id_buku">
												<div class="mb-3">
													<label for="" class="form-label">Judul</label>
													<input type="text" required name="judul" value="<?= $uu['judul'] ?>"
														class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Penulis</label>
													<input type="text" required name="penulis"
														value="<?= $uu['penulis'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Penerbit</label>
													<input type="text" required name="penerbit"
														value="<?= $uu['penerbit'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Tahun Terbit</label>
													<input type="number" required name="tahun_terbit"
														value="<?= $uu['tahun_terbit'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Kategori</label>
													<select name="id_kategori" id="" class="form-control">
														<?php foreach ($kategori as $kk) { ?>
														<option
															<?php if($uu['id_kategori'] == $kk['id_kategori']){echo 'selected'; } ?>
															value="<?= $kk['id_kategori'] ?>">
															<?= $kk['nama_kategori'] ?></option>
														<?php  } ?>
													</select>
												</div>
												<div class="mb-3">
													<label for="" class="form-label">jumlah </label>
													<input type="number" required name="jumlah"
														value="<?= $uu['jumlah'] ?>" class="form-control">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary"
													data-bs-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end modal -->
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
