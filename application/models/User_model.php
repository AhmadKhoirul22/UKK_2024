<?php  
class User_model extends CI_Model{

	public function tampil(){
		$this->db->from('user');
		$data = $this->db->get()->result_array();
		
		return $data;
	}

	public function struktur(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'alamat' => $this->input->post('alamat'),
			'level' => $this->input->post('level'),
		);
		return $data;
	}

	public function member(){
		$this->db->from('user')->where('level','PEMINJAM');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function user_berdasarkan_id($id_user){
		$this->db->from('user')->where('id_user',$id_user);
		$data = $this->db->get()->row();

		return $data;
	}

	public function user_berdasarkan_login(){
		$this->db->from('user')->where('id_user',$this->session->userdata('id_user'));
		$data = $this->db->get()->row();

		return $data;
	}

	public function update_profile(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
		);

		return $data;
	}
}
?>
