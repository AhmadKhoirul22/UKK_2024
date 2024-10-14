<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-4 col-md-12 mt-4">
					<h5>Judul : <?= $buku->judul ?></h5>
					<p>Penulis : <?= $buku->penulis ?></p>
					<p>Penerbit : <?= $buku->penerbit ?></p>
					<p>Tahun Terbit : <?= $buku->tahun_terbit ?></p>
					<p>Kategori : <?= $buku->nama_kategori ?></p>
					<p>Rating : ⭐<?= number_format($this->Buku_model->rating($buku->id_buku),1) ?></p>
				</div>
				<div class="col-lg-8 col-md-12 mt-4">
					<?php foreach($ulasan as $uu){ ?>
					<div class="col-12">
						<h5><i class="bi bi-person-circle"></i> <?= $uu['nama'] ?></h5>
					</div>
					<div class="col-12">
						<p><?= str_repeat('⭐',$uu['rating']) ?></p>
						<p><?= $uu['ulasan'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

</div>
