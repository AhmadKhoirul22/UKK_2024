<?php 
class Pengembalian extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Buku_model');
		$this->load->model('User_model');
		$this->load->model('Peminjaman_model');
		if($this->session->userdata('level') != 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}
	public function index(){
		$data['title'] = 'Pengembalian';
		$this->db->from('peminjaman p')->where('p.id_user',$this->session->userdata('id_user'));
		$this->db->join('denda_peminjaman d','d.kode_peminjaman = p.kode_peminjaman','left');
		$this->db->where('p.status','DIKEMBALIKAN');

		$data['peminjaman'] = $this->db->get()->result_array();
		$data['user'] = $this->User_model->member();
		$this->template->load('peminjam/template','peminjam/pengembalian',$data);
	}

	public function detail_peminjaman($kode_peminjaman){
		$data['title'] = 'Detail Peminjaman';
		$data['peminjaman'] = $this->Peminjaman_model->peminjam_dan_user($kode_peminjaman);
		$data['dp'] = $this->Peminjaman_model->detail_peminjaman($kode_peminjaman);
		$this->template->load('peminjam/template','peminjam/detail_peminjaman',$data);
	}
}
?>
