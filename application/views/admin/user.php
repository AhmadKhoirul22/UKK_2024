<div class="col-12">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#basicModal">
				Tambah User
			</button>
			<!-- modal -->
			<div class="modal fade" id="basicModal" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah User</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="<?= base_url('admin/user/add') ?>"  class="needs-validation" novalidate method="post">
						<div class="modal-body">
								<div class="mb-3">
									<label for="" class="form-label">Nama</label>
									<input type="text" required id="yourUsername" name="nama" class="form-control">
									<div class="invalid-feedback">tuliskan nama</div>

								</div>
								<div class="mb-3">
									<label for="" class="form-label">Username</label>
									<input type="text" required id="yourUsername" name="username" class="form-control">
									<div class="invalid-feedback">tuliskan username</div>

								</div>
								<div class="mb-3">
									<label for="" class="form-label">Email</label>
									<input type="email" id="yourUsername" required name="email" class="form-control">
									<div class="invalid-feedback">tuliskan email</div>

								</div>
								<div class="mb-3">
									<label for="" class="form-label">Password</label>
									<input type="password" id="yourUsername" required name="password" class="form-control">
									<div class="invalid-feedback">tuliskan password</div>

								</div>
								<div class="mb-3">
									<label for="" class="form-label">Alamat</label>
									<textarea name="alamat" id="yourUsername" class="form-control"></textarea>
									<div class="invalid-feedback">alamat</div>

								</div>
								<div class="mb-3">
									<label for="" class="form-label">Level</label>
									<select name="level" id="" class="form-control">
										<option value="ADMIN">ADMIN</option>
										<option value="PETUGAS">PETUGAS</option>
										<option value="PEMINJAM">PEMINJAM</option>
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
			<table class="table datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Email</th>
						<th>Alamat</th>
						<th>Level</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($user as $uu){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $uu['nama'] ?></td>
						<td><?= $uu['username'] ?></td>
						<td><?= $uu['email'] ?></td>
						<td><?= $uu['alamat'] ?></td>
						<td><?= $uu['level'] ?></td>
						<td>
							<?php if($uu['id_user'] != $this->session->userdata('id_user')){ ?>
							<button type="button" class="btn btn-info" data-bs-toggle="modal"
								data-bs-target="#basicModal<?= $uu['id_user'] ?>">
								<i class="bi bi-pencil"></i>
							</button>
							<a href="<?= base_url('admin/user/delete/'.$uu['id_user']) ?>" onclick="return confirm('yakin hapus?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							<!-- modal -->
							<div class="modal fade" id="basicModal<?= $uu['id_user'] ?>" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Update User</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<form action="<?= base_url('admin/user/update') ?>" method="post">
										<div class="modal-body">
												<input type="hidden" value="<?= $uu['id_user'] ?>" name="id_user" >
												<div class="mb-3">
													<label for="" class="form-label">Nama</label>
													<input type="text" required name="nama" value="<?= $uu['nama'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Username</label>
													<input type="text" required name="username" value="<?= $uu['username'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Email</label>
													<input type="email" required name="email" value="<?= $uu['email'] ?>" class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Password</label>
													<input type="password" required name="password" value="<?= $uu['password'] ?>"
														class="form-control">
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Alamat</label>
													<textarea name="alamat" id="yourUsername" class="form-control"><?= $uu['alamat'] ?></textarea>

												</div>
												<div class="mb-3">
													<label for="" class="form-label">Level</label>
													<select name="level" id="" class="form-control">
														<option value="ADMIN"<?php if($uu['level'] == 'ADMIN'){echo 'selected'; } ?> >ADMIN</option>
														<option value="PETUGAS"<?php if($uu['level'] == 'PETUGAS'){echo 'selected'; } ?> >PETUGAS</option>
														<option value="PEMINJAM"<?php if($uu['level'] == 'PEMINJAM'){echo 'selected'; } ?> >PEMINJAM</option>
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
							 <?php } ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
