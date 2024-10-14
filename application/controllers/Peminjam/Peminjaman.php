<?php
class Peminjaman extends CI_Controller{
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
		$data['title'] = 'peminjaman';
		$this->db->from('peminjaman')->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('status','DIPINJAM');
		$data['peminjaman'] = $this->db->get()->result_array();
		$this->template->load('peminjam/template','peminjam/peminjaman',$data);
	}

	public function add_temp($id_buku){
		$id_user = $this->session->userdata('id_user');
		// $id_buku = $this->input->post('id_buku');
		$this->db->from('temp t')->where('t.id_buku',$id_buku);
		$this->db->where('t.id_user',$id_user);
		$cek = $this->db->get()->result_array();
		if($cek != null){
			$this->session->set_flashdata('notif','<div class="alert alert-warning alert-dismissible show fade">
                            buku sudah dipilh
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'id_user' => $id_user,
				'id_buku' => $id_buku
			);
			$this->db->insert('temp',$data);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                            berhasil request buku
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete_temp($id_temp){
		$data = array('id_temp' => $id_temp);
		$this->db->delete('temp',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-danger alert-dismissible show fade">
                            berhasil diberhasil dicancel
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}
}
?>
