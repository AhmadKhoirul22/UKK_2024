<?php
class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('User_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		} else if($this->session->userdata('level') == 'PETUGAS'){
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function index(){
		$data['title'] = 'User';
		$data['user'] = $this->User_model->tampil();
		$this->template->load('admin/template','admin/user',$data);
	}
	public function add(){
		$this->db->from('user')->where('username',$this->input->post('username'));
		$cek = $this->db->get()->result_array();

		if($cek != null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                username sudah digunakan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = $this->User_model->struktur();
			$this->db->insert('user',$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil ditambahkan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function update(){
		$this->db->from('user')->where_not_in('id_user',$this->input->post('id_user'));
		$temp = $this->db->get()->row();
		if($temp && $temp->id_user != $this->input->post('id_user')){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
			username sudah ada
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
		redirect($_SERVER['HTTP_REFERER']);
		}
		$data = $this->User_model->struktur();
		$where = array('id_user'=> $this->input->post('id_user'));
		$this->db->update('user',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil diupdate
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id_user){
		$data = array('id_user' => $id_user);
		$this->db->delete('user',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil dihapus
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}
}
?>
