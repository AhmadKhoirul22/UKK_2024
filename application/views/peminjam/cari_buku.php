<div class="row">
	<div class="col-6">
	<div class="search-bar">
      <form class="search-form d-flex align-items-center" method="GET" action="<?= base_url('peminjam/dashboard/cari_buku') ?>">
        <input type="search" name="keyword" class="form-control" placeholder="Search" title="Enter search keyword">
        <!-- <button type="submit" title="Search"><i class="bi bi-search"></i></button> -->
      </form>
    </div>
	</div>
	<div class="col-6">
		<div class="float-end">
		<a href="<?= base_url('peminjam/dashboard/temp/'.$this->session->userdata('id_user')) ?>" class="btn btn-info mb-3">Riwayat Request</a>
		</div>
	</div>
</div>

<div class="col-12">
	<div class="row">
		<?php if($buku == null){ ?>
		<h3 class="text-center" >Judul buku tidak ditemukan</h3>
		<?php } else {?>
		<?php foreach($buku as $bb){ ?>
		<div class="col-4">
			<div class="card">
				<div class="card-body">
					<a href="<?= base_url('peminjam/dashboard/detail_buku/'.$bb->id_buku) ?>">
						<h5>Judul : <?= $bb->judul ?></h5>
						<p>Penulis : <?= $bb->penulis ?></p>
						<p>Penerbit : <?= $bb->penerbit ?></p>
						<p>Tahun Terbit : <?= $bb->tahun_terbit ?></p>
						<p>Kategori : 
						<?php foreach($kategori as $kk){ ?>
							<?php if($kk['id_kategori'] == $bb->id_kategori){echo $kk['nama_kategori'];} ?>
						<?php } ?>	
						</p>
						<p>Rating : ⭐<?= number_format($this->Buku_model->rating($bb->id_buku),1) ?></p>
					</a>
					<div class="row">
						<div class="col-4">
							<?php if($this->Buku_model->cek_ulasan($bb->id_buku) != null){ ?>
							<?php 
								$this->db->from('ulasan')->where('id_buku',$bb->id_buku)->where('id_user',$this->session->userdata('id_user'));
								$ulasan = $this->db->get()->row();
								?>
							<button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
								data-bs-target="#default<?= $ulasan->id_ulasan ?>">
								<i class="bi bi-chat"></i>
							</button>
							<!-- modal -->
							<div class="modal fade text-left" id="default<?= $ulasan->id_ulasan?>" tabindex="-1"
								role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="myModalLabel1">Ulasan Buku</h5>
											<button type="button" class="close rounded-pill" data-bs-dismiss="modal"
												aria-label="Close">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-x">
													<line x1="18" y1="6" x2="6" y2="18"></line>
													<line x1="6" y1="6" x2="18" y2="18"></line>
												</svg>
											</button>
										</div>
										<form action="<?= base_url('peminjam/dashboard/update_ulasan') ?>" method="post">
											<input type="hidden" name="id_buku" value="<?= $ulasan->id_buku ?>">
											<input type="hidden" name="id_ulasan" value="<?= $ulasan->id_ulasan ?>">
											<input type="hidden" name="id_user"
												value="<?= $this->session->userdata('id_user') ?>">
											<div class="modal-body">
												<div class="mb-3">
													<label for="" class="form-label">Ulasan</label>
													<textarea name="ulasan" required id="" class="form-control"><?= $ulasan->ulasan ?></textarea>
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Rating</label>
													<select name="rating" id="" class="form-control">
														<option value="1"<?php if($ulasan->rating == 1){echo 'selected';} ?> >⭐</option>
														<option value="2"<?php if($ulasan->rating == 2){echo 'selected';} ?>>⭐⭐</option>
														<option value="3"<?php if($ulasan->rating == 3){echo 'selected';} ?>>⭐⭐⭐</option>
														<option value="4"<?php if($ulasan->rating == 4){echo 'selected';} ?>>⭐⭐⭐⭐</option>
														<option value="5"<?php if($ulasan->rating == 5){echo 'selected';} ?>>⭐⭐⭐⭐⭐</option>
													</select>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn" data-bs-dismiss="modal">
														<i class="bx bx-x d-block d-sm-none"></i>
														<span class="d-none d-sm-block">Close</span>
													</button>
													<button type="submit" class="btn btn-primary ml-1">
														<i class="bx bx-check d-block d-sm-none"></i>
														<span class="d-none d-sm-block">Submit</span>
													</button>
												</div>
										</form>
									</div>
								</div>
							</div>
							</div>
						<!-- end modal -->
						<?php }else if($this->Buku_model->pinjam_buku($bb->id_buku) != null){ ?>
							<button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
								data-bs-target="#default<?= $bb->id_buku ?>">
								<i class="bi bi-chat"></i>
							</button>
							<!-- modal -->
							<div class="modal fade text-left" id="default<?= $bb->id_buku ?>" tabindex="-1"
								role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="myModalLabel1">Ulasan Buku</h5>
											<button type="button" class="close rounded-pill" data-bs-dismiss="modal"
												aria-label="Close">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-x">
													<line x1="18" y1="6" x2="6" y2="18"></line>
													<line x1="6" y1="6" x2="18" y2="18"></line>
												</svg>
											</button>
										</div>
										<form action="<?= base_url('peminjam/dashboard/add_ulasan') ?>" method="post">
											<input type="hidden" name="id_buku" value="<?= $bb->id_buku ?>">
											<input type="hidden" name="id_user"
												value="<?= $this->session->userdata('id_user') ?>">
											<div class="modal-body">
												<div class="mb-3">
													<label for="" class="form-label">Ulasan</label>
													<textarea name="ulasan" required id="" class="form-control"></textarea>
												</div>
												<div class="mb-3">
													<label for="" class="form-label">Rating</label>
													<select name="rating" id="" class="form-control">
														<option value="1">⭐</option>
														<option value="2">⭐⭐</option>
														<option value="3">⭐⭐⭐</option>
														<option value="4">⭐⭐⭐⭐</option>
														<option value="5">⭐⭐⭐⭐⭐</option>
													</select>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn" data-bs-dismiss="modal">
														<i class="bx bx-x d-block d-sm-none"></i>
														<span class="d-none d-sm-block">Close</span>
													</button>
													<button type="submit" class="btn btn-primary ml-1">
														<i class="bx bx-check d-block d-sm-none"></i>
														<span class="d-none d-sm-block">Submit</span>
													</button>
												</div>
										</form>
									</div>
								</div>
							</div>
							</div>
						<!-- end modal -->
						<?php } else {}?>
					</div>
					<div class="col-4">
						<?php if($this->Buku_model->request_buku($bb->id_buku) == null){ ?>
						<a href="<?= base_url('peminjam/peminjaman/add_temp/'.$bb->id_buku) ?>"
							class="btn btn-primary">Pinjam</a>
						<?php } ?>
					</div>
					<div class="col-4">
						<div class="float-end">
							<?php if($this->Buku_model->koleksi($bb->id_buku) == null){ ?>
							<a href="<?= base_url('peminjam/koleksi/add_koleksi/'.$bb->id_buku) ?>"
								class="btn btn-info"><i class="bi bi-bookmark"></i></a>
							<?php } else{  
								$this->db->from('koleksi')->where('id_buku',$bb->id_buku);
								$this->db->where('id_user',$this->session->userdata('id_user'));
								$koleksi = $this->db->get()->row();
								?>
							<a href="<?= base_url('peminjam/koleksi/delete_koleksi/'.$koleksi->id_koleksi) ?>"
								class="btn btn-danger"><i class="bi bi-bookmark-fill"></i></a>

							<?php } ?>
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
