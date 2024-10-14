<div class="col-12">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#basicModal">
				Tambah Kategori
			</button>
			<!-- modal -->
			<div class="modal fade" id="basicModal" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Kategori</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="<?= base_url('admin/kategori/add') ?>" class="needs-validation" novalidate method="post">

						<div class="modal-body">
								<div class="mb-3">
									<label for="" class="form-label">Nama Kategori</label>
									<input type="text" name="nama_kategori"  id="yourUsername" required class="form-control">
									<div class="invalid-feedback">tulis nama kategori</div>
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
						<th>Nama Kategori</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($kategori as $uu){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $uu['nama_kategori'] ?></td>
						<td>
							<button type="button" class="btn btn-info" data-bs-toggle="modal"
								data-bs-target="#basicModal<?= $uu['id_kategori'] ?>">
								<i class="bi bi-pencil"></i>
							</button>
							<a href="<?= base_url('admin/kategori/delete/'.$uu['id_kategori']) ?>" onclick="return confirm('yakin hapus?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							<!-- modal -->
							<div class="modal fade" id="basicModal<?= $uu['id_kategori'] ?>" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Kategori</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<form action="<?= base_url('admin/kategori/update') ?>" method="post">

										<div class="modal-body">
												<input type="hidden" value="<?= $uu['id_kategori'] ?>" name="id_kategori" >
												<div class="mb-3">
													<label for="" class="form-label">Nama Kategori</label>
													<input type="text" required name="nama_kategori" value="<?= $uu['nama_kategori'] ?>" class="form-control">
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
