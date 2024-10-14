<div class="col-12">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<p><strong>*Meminjam buku maksimal 3 hari, jika lebih dari 3 hari maka akan dikenakan denda</strong></p>
					<table id="table1">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Penerbit</th>
								<th>Aksi</th>
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
								<a href="<?= base_url('peminjam/peminjaman/delete_temp/'.$pp['id_temp']) ?>" onclick="return confirm('yakin mengcancel buku ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
