<?php
class Dashboard extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('User_model');
		$this->load->model('Kategori_model');
		$this->load->model('Buku_model');
		$this->load->model('Denda_model');
		$this->load->model('Peminjaman_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Dashboard';
		$data['buku'] = $this->Buku_model->tampil();
		$data['denda'] = $this->Denda_model->denda_berlaku();
		$data['user'] = $this->User_model->member();
		$data['kategori'] = $this->Kategori_model->tampil();
		$data['peminjaman'] = $this->Peminjaman_model->history_peminjaman();
		$this->template->load('admin/template','admin/dashboard',$data);
	}

	public function myprofile(){
		$data['user'] = $this->User_model->user_berdasarkan_login();
		$data['title'] = 'My Profile';
		$this->template->load('admin/template','admin/my_profile',$data);
	}

	public function update_myprofile(){
		$data = $this->User_model->update_profile();
		$where = array(
			'id_user' => $this->input->post('id_user')
		);
		$this->db->update('user',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil diupdate
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function mypassword(){
		$data['user'] = $this->User_model->user_berdasarkan_login();
		$data['title'] = 'Change Password';
		$this->template->load('admin/template','admin/my_password',$data);
	}

	public function update_mypassword(){
		$password = $this->input->post('password');
		$password_lama = md5($this->input->post('password_lama'));
		$password_baru = md5($this->input->post('password_baru'));

		if($password != $password_lama){
			$this->session->set_flashdata('alert',$this->Alert_model->password_salah());
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'password' => $password_baru
			);
			$where = array(
				'id_user' => $this->input->post('id_user')
			);
			$this->db->update('user',$data,$where);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil diupdate
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

}
?>
