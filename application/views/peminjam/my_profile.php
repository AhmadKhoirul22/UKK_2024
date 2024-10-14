<div class="col-12">
	<div class="card">
		<div class="card-body">
			<form action="<?= base_url('peminjam/user/update_myprofile') ?>" method="post">
				<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
				<div class="mb-3">
					<label for="" class="form-label">Nama</label>
					<input type="text" required name="nama" value="<?= $user->nama ?>" class="form-control">
				</div>
				<div class="mb-3">
					<label for="" class="form-label">Username</label>
					<input type="text" required name="username" value="<?= $user->username ?>" class="form-control">
				</div>
				<div class="mb-3">
					<label for="" class="form-label">Email</label>
					<input type="email" required name="email" value="<?= $user->email ?>" class="form-control">
				</div>
				<div class="mb-3">
					<label for="" class="form-label">Alamat</label>
					<textarea name="alamat" id="" class="form-control"><?= $user->alamat ?></textarea>
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
