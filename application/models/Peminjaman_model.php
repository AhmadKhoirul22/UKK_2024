<?php 
class Peminjaman_model extends CI_Model{
	
	public function data_pinjam(){
		$this->db->from('peminjaman p');
		$this->db->join('user u','u.id_user = p.id_user','left');
		$this->db->where('p.status','DIPINJAM');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function data_pengembalian(){
		$this->db->from('peminjaman p');
		$this->db->join('user u','u.id_user = p.id_user','left');
		$this->db->join('denda_peminjaman d','d.kode_peminjaman = p.kode_peminjaman','left');
		$this->db->where('p.status','DIKEMBALIKAN');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function peminjam_dan_user($kode_peminjaman){
		$this->db->from('peminjaman p')->where('p.kode_peminjaman',$kode_peminjaman);
		$this->db->join('user u','u.id_user = p.id_user','left');
		$data = $this->db->get()->row();

		return $data;
	}

	public function detail_peminjaman($kode_peminjaman){
		$this->db->from('detail_peminjaman d')->where('d.kode_peminjaman',$kode_peminjaman);
		$this->db->join('buku b','b.id_buku = d.id_buku','left');
		$this->db->join('kategori k','k.id_kategori = b.id_kategori','left');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function history_peminjaman(){
		$this->db->from('peminjaman p');
		$this->db->join('user u','u.id_user = p.id_user','left');
		$this->db->order_by('p.tanggal_peminjaman','DESC');
		$this->db->limit(5);
		$data = $this->db->get()->result_array();

		return $data;
	}
}
?>
