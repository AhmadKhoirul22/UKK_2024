<div class="col-12">
	<div class="card">
		<div class="card-body">
			<form action="<?= base_url('admin/dashboard/update_myprofile') ?>" class="row g-3 needs-validation" novalidate method="post">
				<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
				<div class="mb-3">
					<label for="" class="form-label">Nama</label>
					<input type="text" required id="yourUsername" name="nama" value="<?= $user->nama ?>" class="form-control">
					<div class="invalid-feedback">tulis nama kamu</div>

				</div>
				<div class="mb-3">
					<label for="" class="form-label">Username</label>
					<input type="text" required id="yourUsername" name="username" value="<?= $user->username ?>" class="form-control">
					<div class="invalid-feedback">tulis username kamu</div>

				</div>
				<div class="mb-3">
					<label for="" class="form-label">Email</label>
					<input type="email" id="yourUsername" required name="email" value="<?= $user->email ?>" class="form-control">
					<div class="invalid-feedback">tulis email kamu</div>
				</div>
				<div class="mb-3">
					<label for="" class="form-label">Alamat</label>
					<textarea name="alamat" id="" id="yourUsername" class="form-control"><?= $user->alamat ?></textarea>
					<div class="invalid-feedback">tulis alamat kamu</div>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
