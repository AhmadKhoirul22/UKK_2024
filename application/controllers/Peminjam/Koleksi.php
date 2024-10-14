<?php  
class Koleksi extends CI_Controller{
	
	public function __construct(){
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
		$data['koleksi'] = $this->Buku_model->koleksi_berdasarkan_login();
		$data['title'] = 'Koleksi';
		$this->template->load('peminjam/template','peminjam/koleksi',$data);
	}

	public function add_koleksi($id_buku){
		$id_user = $this->session->userdata('id_user');
		$data = array(
			'id_buku' => $id_buku,
			'id_user' => $id_user,
		);
		$this->db->insert('koleksi',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                        berhasil menambahkan ke koleksi
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_koleksi($id_koleksi){
		$data = array('id_koleksi' => $id_koleksi);
		$this->db->delete('koleksi',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-danger alert-dismissible show fade">
                        buku dihapus dari koleksi
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
}
?>
