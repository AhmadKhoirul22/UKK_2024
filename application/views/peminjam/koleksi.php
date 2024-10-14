<div class="col-12">
	<div class="row">
		<?php if($koleksi == null){ ?>
		<h5 class="text-center" >Belum menambahkan buku kekoleksi</h5>
		<?php } else { ?>
		<?php foreach($koleksi as $bb){ ?>
		<div class="col-4">
			<div class="card">
				<div class="card-body">
					<a href="<?= base_url('peminjam/koleksi/detail_buku/'.$bb['id_buku']) ?>">
					<h5>Judul : <?= $bb['judul'] ?></h5>
					<p>Penulis : <?= $bb['penulis'] ?></p>
					<p>Penerbit : <?= $bb['penerbit'] ?></p>
					<p>Tahun Terbit : <?= $bb['tahun_terbit'] ?></p>
					<p>Kategori : <?= $bb['nama_kategori'] ?></p>
					<p>Rating : ⭐<?= number_format($this->Buku_model->rating($bb['id_buku']),1) ?></p>
					</a>
					<div class="row">
						<div class="col-6">
						</div>
						<div class="col-6">
							<div class="float-end">
							<a href="<?= base_url('peminjam/koleksi/delete_koleksi/'.$bb['id_koleksi']) ?>" onclick="return confirm('yakin menghapus buku dari koleksi ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php } ?>
	</div>
</div>
