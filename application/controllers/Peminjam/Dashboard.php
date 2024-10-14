<?php
class Dashboard extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Buku_model');
		if($this->session->userdata('level') != 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Dashboard';
		$data['buku'] = $this->Buku_model->tampil();
		$this->template->load('peminjam/template','peminjam/dashboard',$data);
	}

	public function temp($id_user){
		$data['temp'] = $this->Buku_model->temp($id_user);
		$data['buku'] = $this->Buku_model->tampil();
		$data['title'] = 'Temp Buku';
		$this->template->load('peminjam/template','peminjam/temp',$data);
	}

	public function add_ulasan(){
		$id_buku = $this->input->post('id_buku');
		$id_user = $this->input->post('id_user');
		$this->db->from('ulasan')->where('id_buku',$id_buku)->where('id_user',$id_user);
		$cek = $this->db->get()->row();

		$this->db->from('peminjaman p')->where('p.id_user',$id_user);
			$this->db->join('detail_peminjaman d','d.kode_peminjaman = p.kode_peminjaman','left');
			$this->db->where('d.id_buku',$id_buku);
			$cek1 = $this->db->get()->result_array();

	if($cek != null){
		$this->session->set_flashdata('notif','<div class="alert alert-warning alert-dismissible show fade">
                            hanya dapat memberikan ulasan 1 kali
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
	} else if($cek1 == null){
		$this->session->set_flashdata('notif','<div class="alert alert-warning alert-dismissible show fade">
                            tidak dapat memberikan ulasan, karna belum meminjam buku tersebut
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
	} else {
		$data = array(
			'id_buku' => $id_buku,
			'id_user' => $id_user,
			'ulasan' => $this->input->post('ulasan'),
			'rating' => $this->input->post('rating'),
		);
		$this->db->insert('ulasan',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                        berhasil memberikan ulasan
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function update_ulasan(){
		$data = array(
			'id_buku' => $this->input->post('id_buku'),
			'id_user' => $this->input->post('id_user'),
			'ulasan' => $this->input->post('ulasan'),
			'rating' => $this->input->post('rating'),
		);
		$where = array('id_ulasan' => $this->input->post('id_ulasan'));
		$this->db->update('ulasan',$data,$where);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                        berhasil mengupdate ulasan
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_ulasan($id_ulasan){
		$data = array('id_ulasan' => $id_ulasan);
		$this->db->delete('ulasan',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-danger alert-dismissible show fade">
						ulasan dihapus
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function detail_buku($id_buku){
		$data['buku'] = $this->Buku_model->buku_id($id_buku);
		$data['ulasan'] = $this->Buku_model->ulasan_user($id_buku);
		$data['title'] = 'Detail Buku';
		$this->template->load('peminjam/template','peminjam/detail_buku',$data);
	}

	public function cari_buku(){
		$keyword = $this->input->get('keyword');
		if($keyword){
			$data['buku'] = $this->Buku_model->search($keyword);
		}
		$data['kategori'] = $this->Buku_model->tampil();
		$data['title'] = 'Pencarian Buku';

		$this->template->load('peminjam/template','peminjam/cari_buku',$data);

	}
}
?>
