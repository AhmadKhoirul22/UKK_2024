<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Loginn';
		$this->load->view('login',$data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function daftar(){
		$data['title'] = 'registrasi';
		$this->load->view('register',$data);
	}

	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->db->from('user')->where('username',$username);
		$cek  = $this->db->get()->row();

		if($cek == null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                username tidak ditemukan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else if($cek->password == $password){
			$data = array(
				'nama' => $cek->nama,
				'username' => $cek->username,
				// 'password' => $cek->password,
				// 'email' => $cek->email,
				// 'alamat' => $cek->alamat,
				'level' => $cek->level,
				'id_user' => $cek->id_user,
			);
			$this->session->set_userdata($data);
			if($data['level'] == 'ADMIN' OR $data['level'] == 'PETUGAS'){
				redirect('admin/dashboard');
			} else if($data['level'] == 'PEMINJAM'){
				redirect('peminjam/dashboard');
			}
		} else {
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                password salah
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function register(){

		$this->db->from('user')->where('username',$this->input->post('username'));
		$cek = $this->db->get()->result_array();

		if($cek != null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                username sudah digunakan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'level' => 'PEMINJAM',
				'alamat' => '',
			);
			$this->db->insert('user',$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                registrasi berhasil
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			// redirect($_SERVER['HTTP_REFERER']);
			redirect('auth');
		}
	}
}
