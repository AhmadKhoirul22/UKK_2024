<?php 
class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Buku_model');
		$this->load->model('User_model');
		if($this->session->userdata('level') != 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function myprofile(){
		$data['user'] = $this->User_model->user_berdasarkan_login();
		$data['title'] = 'My Profile';
		$this->template->load('peminjam/template','peminjam/my_profile',$data);
	}

	public function update_myprofile(){
		$data = $this->User_model->update_profile();
		$where = array(
			'id_user' => $this->input->post('id_user')
		);
		$this->db->update('user',$data,$where);
		$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                        data profile berhasil diupdate
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function mypassword(){
		$data['user'] = $this->User_model->user_berdasarkan_login();
		$data['title'] = 'Change Password';
		$this->template->load('peminjam/template','peminjam/my_password',$data);
	}

	public function update_mypassword(){
		$password = $this->input->post('password');
		$password_lama = md5($this->input->post('password_lama'));
		$password_baru = md5($this->input->post('password_baru'));

		if($password != $password_lama){
			$this->session->set_flashdata('notif','<div class="alert alert-warning alert-dismissible show fade">
                        password salah
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'password' => $password_baru
			);
			$where = array(
				'id_user' => $this->input->post('id_user')
			);
			$this->db->update('user',$data,$where);
			$this->session->set_flashdata('notif','<div class="alert alert-success alert-dismissible show fade">
                        password berhasil diupdate
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>
