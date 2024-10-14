<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<h5>Judul : <?= $buku->judul ?></h5>
					<p>Penulis : <?= $buku->penulis ?></p>
					<p>Penerbit : <?= $buku->penerbit ?></p>
					<p>Tahun Terbit : <?= $buku->tahun_terbit ?></p>
					<p>Kategori : <?= $buku->nama_kategori ?></p>
					<p>Rating : ⭐<?= number_format($this->Buku_model->rating($buku->id_buku),1) ?></p>
				</div>
				<div class="col-lg-8 col-md-12">
					<?php foreach($ulasan as $uu){ ?>
					<div class="col-12">
						<h5><i class="bi bi-person-circle"></i> <?= $uu['nama'] ?></h5>
					</div>
					<div class="col-12">
						<p><?= str_repeat('⭐',$uu['rating']) ?></p>
						<p><?= $uu['ulasan'] ?></p>
						<?php if($uu['id_user'] == $this->session->userdata('id_user')){ ?>
						<a onclick="return confirm('yakin hapus ulasan?')" href="<?= base_url('peminjam/dashboard/delete_ulasan/'.$uu['id_ulasan']) ?>" class="btn btn-sm"><i class="bi bi-trash"></i></a>
						<button type="button" class="btn btn-sm" data-bs-toggle="modal"
							data-bs-target="#default<?= $uu['id_ulasan'] ?>">
							<i class="bi bi-pencil"></i>
						</button>
						<!-- modal -->
						<div class="modal fade text-left" id="default<?= $uu['id_ulasan'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Update Ulasan</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
									<form action="<?= base_url('peminjam/dashboard/update_ulasan') ?>" method="post" >
										<input type="hidden" name="id_buku" value="<?= $uu['id_buku'] ?>" >
										<input type="hidden" name="id_ulasan" value="<?= $uu['id_ulasan'] ?>" >
										<input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>" >
                                    <div class="modal-body">
									<div class="mb-3">
												<label for="" class="form-label">Ulasan</label>
												<textarea name="ulasan" id="" required class="form-control"><?= $uu['ulasan'] ?></textarea>
											</div>
											<div class="mb-3">
												<label for="" class="form-label">Rating</label>
												<select name="rating" id="" class="form-control">
													<option value="1"<?php if($uu['rating'] == 1){echo 'selected';} ?>>⭐</option>
													<option value="2"<?php if($uu['rating'] == 2){echo 'selected';} ?>>⭐⭐</option>
													<option value="3"<?php if($uu['rating'] == 3){echo 'selected';} ?>>⭐⭐⭐</option>
													<option value="4"<?php if($uu['rating'] == 4){echo 'selected';} ?>>⭐⭐⭐⭐</option>
													<option value="5"<?php if($uu['rating'] == 5){echo 'selected';} ?>>⭐⭐⭐⭐⭐</option>
												</select>
											</div>
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
						 <!-- end modal -->
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

</div>
