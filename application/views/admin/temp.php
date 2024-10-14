<div class="col-12">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<?php if($temp == null){ ?>
						<h5 class="text-center" ><?= $user->nama ?> belum request buku</h5>
					<?php }else{ ?>
					<table id="table1" class="table databale" >
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Penerbit</th>
								<th>jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($temp as $pp){ ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $pp['judul'] ?></td>
							<td><?= $pp['penulis'] ?></td>
							<td><?= $pp['penerbit'] ?></td>
							<td>
								<a href="<?= base_url('peminjam/peminjaman/delete_temp/'.$pp['id_temp']) ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
					<form action="<?= base_url('admin/peminjaman/pinjam_buku') ?>" method="post" >
						<input type="hidden" name="id_user" value="<?= $user->id_user ?>" >
						<div class="mb-2">
							<button type="submit" onclick="return confirm('lama meminjam buku 3 hari, jika lebih dikenakan denda')" class="btn btn-success" >Confirm</button>
						</div>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
