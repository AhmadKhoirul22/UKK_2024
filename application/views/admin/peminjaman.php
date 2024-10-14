<div class="col-12">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-outline-primary block mt-3 mb-3" data-bs-toggle="modal"
				data-bs-target="#default">
				Pilih User
			</button>
			<!-- modal -->
			<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Pilih User</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                       <table class="table datatable">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Alamat</th>
												<th>Email</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($user as $uu){ ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $uu['nama'] ?></td>
												<td><?= $uu['alamat'] ?></td>
												<td><?= $uu['email'] ?></td>
												<td>
													<a href="<?= base_url('admin/peminjaman/temp/'.$uu['id_user']) ?>" class="btn btn-info">pilih</a>
												</td>
											</tr>
											<?php }?>
										</tbody>
									   </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="button" class="btn btn-primary ml-1" >
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
			 <!--end modal  -->
			<table class="table datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Peminjaman</th>
						<th>Pengembalian</th>
						<th>Kembali</th>
						<th>Status</th>
						<th>Denda</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($peminjaman as $pp){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $pp['kode_peminjaman'] ?></td>
						<td><?= $pp['tanggal_peminjaman'] ?></td>
						<td><?= $pp['tanggal_pengembalian'] ?></td>
						<td>masih dipinjam</td>
						<td><?= $pp['status'] ?></td>
						<td>
							<?php
							$this->db->from('detail_peminjaman')->where('kode_peminjaman',$pp['kode_peminjaman']);
							$cek = $this->db->get()->result_array();
					
							$this->db->from('peminjaman')->where('kode_peminjaman',$pp['kode_peminjaman']);
							$p = $this->db->get();
							$p2 = $p->row();
							$p3 = $p2->tanggal_pengembalian;
					
							$this->db->from('denda')->where('status','BERLAKU');
							$d = $this->db->get();
							$d2 = $d->row();
							$d3 = $d2->harga_denda;
					
							$jumlah = count($cek) * $d3;
					
							date_default_timezone_set("Asia/Jakarta");
							$tanggal = date('Ymd');
							$selisih_hari = (strtotime($tanggal) - strtotime($p3)) / (60 * 60 * 24);
					
							if($selisih_hari > 0){
								echo 'Rp '.number_format($jumlah * $selisih_hari);
							} else {
								echo 'Rp 0';
							}
							?>
						</td>
						<td><?= $pp['nama'] ?></td>
						<td>
							<a href="<?= base_url('admin/pengembalian/detail_peminjaman/'.$pp['kode_peminjaman']) ?>" class="btn btn-primary mb-2">Detail</a>
							<a onclick="return confirm('yakin kembalikan buku?')" href="<?= base_url('admin/pengembalian/kembali_buku/'.$pp['kode_peminjaman']) ?>" class="btn btn-info">Kembalikan Buku</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
