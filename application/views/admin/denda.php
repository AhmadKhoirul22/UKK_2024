<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-6">
					<button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal"
						data-bs-target="#basicModal">
						Tambah Denda
					</button>
							<!-- modal -->
					<div class="modal fade" id="basicModal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Tambah Denda</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="<?= base_url('admin/denda/add') ?>" class="needs-validation" novalidate method="post">
								<div class="modal-body">
										<div class="mb-3">
											<label for="" class="form-label">Harga Denda</label>
											<input type="number" id="yourUsername" required name="harga_denda" min="500" class="form-control">
											<div class="invalid-feedback">tulis harga denda</div>

										</div>
										<div class="mb-3">
											<label for="" class="form-label">Status</label>
											<select name="status" id="" class="form-control">
												<option value="BERLAKU">BERLAKU</option>
												<option value="TIDAK BERLAKU">TIDAK BERLAKU</option>
											</select>
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
				</div>
				<div class="col-6">
					<div class="float-end">
					<button type="button" class="btn btn-danger mt-2 mb-2" data-bs-toggle="modal"
						data-bs-target="#denda">
						<i class="bi bi-printer"></i> Cetak Denda
					</button>
					<div class="modal fade" id="denda" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Cetak Data Denda</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="<?= base_url('admin/denda/cetak_denda') ?>" method="post" target="_blank" >
								<div class="modal-body">
										<div class="mb-3">
											<label for="" class="form-label">Tanggal Awal</label>
											<input type="date" required name="tanggal_awal" required class="form-control">
										</div>
										<div class="mb-3">
											<label for="" class="form-label">Tanggal Akhir</label>
											<input type="date" required name="tanggal_akhir" required class="form-control">
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
					</div>
				</div>
			</div>
			<table class="table datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Harga Denda</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($denda as $uu){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td>Rp <?= number_format($uu['harga_denda'])  ?></td>
						<td><?= $uu['status'] ?></td>
						<td>
							<button type="button" class="btn btn-info" data-bs-toggle="modal"
								data-bs-target="#basicModal<?= $uu['id_denda'] ?>">
								<i class="bi bi-pencil"></i>
							</button>
							<a href="<?= base_url('admin/denda/delete/'.$uu['id_denda']) ?>"
								onclick="return confirm('yakin hapus?')" class="btn btn-danger"><i
									class="bi bi-trash"></i></a>
							<!-- modal -->
							<div class="modal fade" id="basicModal<?= $uu['id_denda'] ?>" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update Denda</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<form action="<?= base_url('admin/denda/update') ?>" method="post">
											<div class="modal-body">
												<input type="hidden" value="<?= $uu['id_denda'] ?>" name="id_denda">
												<div class="mb-3">
													<label for="" class="form-label">Harga Denda</label>
													<input type="number" required name="harga_denda" min="500"
														value="<?= $uu['harga_denda'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Status</label>
													<select name="status" id="" class="form-control">
														<option value="BERLAKU"
															<?php if($uu['status'] == 'BERLAKU'){echo 'selected'; } ?>>
															BERLAKU</option>
														<option value="TIDAK BERLAKU"
															<?php if($uu['status'] == 'TIDAK BERLAKU'){echo 'selected'; } ?>>
															TIDAK BERLAKU</option>
													</select>
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
