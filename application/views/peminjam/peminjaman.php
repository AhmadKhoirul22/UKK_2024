<div class="col-12">
	<div class="card">
		<div class="card-body">
			<!-- <a href="<?= base_url('peminjam/peminjaman/temp/'.$this->session->userdata('id_user')) ?>" class="btn btn-info mt-2 mb-2">Riwayat Pinjam</a> -->
			<table class="table" id="table1" >
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Peminjaman</th>
						<th>Pengembalian</th>
						<th>Kembali</th>
						<th>Status</th>
						<th>Denda</th>
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
						<td>
							<a href="<?= base_url('peminjam/pengembalian/detail_peminjaman/'.$pp['kode_peminjaman']) ?>" class="btn btn-primary mb-2">Detail</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
