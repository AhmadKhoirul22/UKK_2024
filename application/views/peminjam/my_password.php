<div class="col-12">
	<div class="card">
		<div class="card-body">
			<form action="<?= base_url('peminjam/user/update_mypassword') ?>" method="post">
				<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
				<input type="hidden" name="password" value="<?= $user->password ?>" >
				<div class="mb-3">
					<label for="" class="form-label">Password Lama</label>
					<input type="password" required name="password_lama" class="form-control">
				</div>
				<div class="mb-3">
					<label for="" class="form-label">Password Baru</label>
					<input type="password" required name="password_baru" class="form-control">
				</div>
				<div class="mb-3">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
