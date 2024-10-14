<?php 
class Pengembalian extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Buku_model');
		$this->load->model('User_model');
		$this->load->model('Peminjaman_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
		
	}
	public function index(){
		$data['title'] = 'Pengembalian';
		$data['peminjaman'] = $this->Peminjaman_model->data_pengembalian();
		$data['user'] = $this->User_model->member();
		$this->template->load('admin/template','admin/pengembalian',$data);
	}

	public function detail_peminjaman($kode_peminjaman){
		$data['title'] = 'Detail Peminjaman';
		$data['peminjaman'] = $this->Peminjaman_model->peminjam_dan_user($kode_peminjaman);
		$data['dp'] = $this->Peminjaman_model->detail_peminjaman($kode_peminjaman);
		$this->template->load('admin/template','admin/detail_peminjaman',$data);
	}

	public function kembali_buku($kode_peminjaman){
		$this->db->from('detail_peminjaman')->where('kode_peminjaman',$kode_peminjaman);
		$cek = $this->db->get()->result_array();

		$this->db->from('peminjaman')->where('kode_peminjaman',$kode_peminjaman);
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
		// $tanggal = ('20241002');
		$selisih_hari = (strtotime($tanggal) - strtotime($p3)) / (60 * 60 * 24);

		if($selisih_hari > 0){
			$data = array(
				'kode_peminjaman' => $kode_peminjaman,
				'denda' => $jumlah * $selisih_hari
			);
			$this->db->insert('denda_peminjaman',$data);
		} else {
			$data = array(
				'kode_peminjaman' => $kode_peminjaman,
				'denda' => 0
			);
			$this->db->insert('denda_peminjaman',$data);
		}

		foreach ($cek as $item) {
			$id_buku = $item['id_buku'];

			$this->db->from('buku')->where('id_buku',$id_buku);
			$b = $this->db->get();
			$b2 = $b->row();
			if($b2){
				$penjumlahan = $b2->jumlah + 1;
				$data = array(
					'jumlah' => $penjumlahan
				);
				$this->db->where('id_buku',$id_buku);
				$this->db->update('buku',$data);
			}
		}
		$data = array(
			'tanggal_kembali' => $tanggal,
			'status' => 'DIKEMBALIKAN'
		);
		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$this->db->update('peminjaman',$data);
	    $this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                buku berhasil dikembalikan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
	    redirect($_SERVER['HTTP_REFERER']);
	}

	public function cetak_laporan(){
		$data = array(
			'tanggal_awal' => $this->input->post('tanggal_awal'),
			'tanggal_akhir' => $this->input->post('tanggal_akhir'),
			'status' => $this->input->post('status'),
		);
		$this->load->view('cetak_laporan',$data);
	}
}
?>
