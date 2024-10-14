<?php  
class Buku_model extends CI_Model{

	public function tampil(){
		$this->db->from('buku b');
		$this->db->join('kategori k','k.id_kategori =b.id_kategori','left');
		$data = $this->db->get()->result_array();
		
		return $data;
	}

	public function struktur(){
		$data = array(
			'judul' => $this->input->post('judul'),
			'penulis' => $this->input->post('penulis'),
			'penerbit' => $this->input->post('penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'jumlah' => $this->input->post('jumlah'),
			'id_kategori' => $this->input->post('id_kategori'),
		);
		return $data;
	}

	public function rating($id_buku){
		$this->db->select('avg(rating) as rata_rata');
		$this->db->from('ulasan')->where('id_buku',$id_buku);
		$data = $this->db->get();

		if($data->num_rows() > 0){
			return $data->row()->rata_rata;
		} else {
			return 0;
		}
	}

	public function koleksi($id_buku){
		$this->db->from('koleksi')->where('id_buku',$id_buku);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$data = $this->db->get()->row();

		return $data;
	}

	public function koleksi_berdasarkan_login(){
		$this->db->from('koleksi k')->where('k.id_user',$this->session->userdata('id_user'));
		$this->db->join('buku b','b.id_buku = k.id_buku','left');
		$this->db->join('kategori a','a.id_kategori = b.id_kategori','left');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function pinjam_buku($id_buku){
		$this->db->from('detail_peminjaman d')->where('d.id_buku',$id_buku);
		$this->db->join('peminjaman p','p.kode_peminjaman = d.kode_peminjaman','left');
		$this->db->where('p.id_user',$this->session->userdata('id_user'));
		$data = $this->db->get()->result_array();

		return $data;
	}
	
	public function cek_ulasan($id_buku){
		$this->db->from('ulasan')->where('id_buku',$id_buku);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$ulasan = $this->db->get()->row();

		return $ulasan;
	}

	public function request_buku($id_buku){
		$this->db->from('temp')->where('id_buku',$id_buku);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function search($keyword){
		$this->db->like('judul',$keyword);
		$this->db->or_like('penulis',$keyword);
		$this->db->or_like('penerbit',$keyword);
		$this->db->or_like('tahun_terbit',$keyword);
		$data = $this->db->get('buku')->result();

		return $data;
	}

	public function temp($id_user){
		$this->db->from('temp t')->where('t.id_user',$id_user);
		$this->db->join('buku b','b.id_buku = t.id_buku','left');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function buku_id($id_buku){
		$this->db->from('buku b')->where('b.id_buku',$id_buku);
		$this->db->join('kategori k','k.id_kategori = b.id_kategori','left');
		$data = $this->db->get()->row();

		return $data;
	}

	public function ulasan_user($id_buku){
		$this->db->from('ulasan u');
		$this->db->join('buku b','b.id_buku = u.id_buku','left');
		$this->db->join('user a','a.id_user = u.id_user','left');
		$this->db->where('b.id_buku',$id_buku);
		$data = $this->db->get()->result_array();

		return $data;
	}
}
?>
