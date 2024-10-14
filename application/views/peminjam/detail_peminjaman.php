<div class="col-12">
	<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="card-body">
					<form action="">
						<div class="mb-2">
							<label for="" class="form-label">Nama</label>
							<input type="text" value="<?= $peminjaman->nama ?>" readonly class="form-control">
						</div>
						<div class="mb-2">
							<label for="" class="form-label">Kode Peminjaman</label>
							<input type="text" value="<?= $peminjaman->kode_peminjaman ?>" readonly
								class="form-control">
						</div>
						<div class="mb-2">
							<label for="" class="form-label">Tanggal Peminjmana</label>
							<input type="text" value="<?= $peminjaman->tanggal_peminjaman ?>" readonly
								class="form-control">
						</div>
						<div class="mb-2">
							<label for="" class="form-label">Tanggal Pengembalian</label>
							<input type="text" value="<?= $peminjaman->tanggal_pengembalian ?>" readonly
								class="form-control">
						</div>
						<?php if($peminjaman->status == 'DIKEMBALIKAN'){ ?>
						<div class="mb-2">
							<label for="" class="form-label">Tanggal Kembali</label>
							<input readonly type="text" value="<?= $peminjaman->tanggal_kembali ?>"
								class="form-control">
						</div>
						<?php } else{
							
						}?>
					</form>
				</div>
			</div>
		</div>
		<div class="col-8">
			<div class="card">
				<div class="card-body">
					<form action="">
						<div class="mb-2">
							<label for="" class="form-label">Status</label>
							<input type="text" value="<?= $peminjaman->status ?>" readonly class="form-control">
						</div>
						<div class="mb-2">
							<label for="" class="form-label">Denda</label>
							<?php  
							if($peminjaman->status == 'DIPINJAM'){
								$this->db->from('detail_peminjaman')->where('kode_peminjaman',$peminjaman->kode_peminjaman);
							$cek = $this->db->get()->result_array();
					
							$this->db->from('peminjaman')->where('kode_peminjaman',$peminjaman->kode_peminjaman);
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
							} else {
								$this->db->from('denda_peminjaman')->where('kode_peminjaman',$peminjaman->kode_peminjaman);
								$op = $this->db->get();
								$opo = $op->row();
								echo 'Rp '.number_format($opo->denda);
							}
							?>
						</div>
						<table class="table datatable">
							<thead>
								<tr>
									<th>No</th>
									<th>Judul</th>
									<th>Penulis</th>
									<th>Penerbit</th>
									<th>Tahun terbit</th>
									<th>kategori</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($dp as $dd){ ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $dd['judul'] ?></td>
									<td><?= $dd['penulis'] ?></td>
									<td><?= $dd['penerbit'] ?></td>
									<td><?= $dd['tahun_terbit'] ?></td>
									<td><?= $dd['nama_kategori'] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
