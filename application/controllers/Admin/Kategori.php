<?php
class Kategori extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('User_model');
		$this->load->model('Kategori_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Kategori';
		$data['kategori'] = $this->Kategori_model->tampil();
		$this->template->load('admin/template','admin/kategori',$data);
	}
	public function add(){
		$this->db->from('kategori')->where('nama_kategori',$this->input->post('nama_kategori'));
		$cek = $this->db->get()->result_array();
		if($cek != null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
               nama kategori sudah digunakan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = $this->Kategori_model->struktur();
			$this->db->insert('kategori',$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil ditambahkan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function update(){
		$this->db->from('kategori')->where_not_in('id_kategori',$this->input->post('id_kategori'));
		$temp = $this->db->get()->row();
		if($temp && $temp->id_kategori != $this->input->post('id_kategori')){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
			nama kategori sudah ada
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
		redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = $this->Kategori_model->struktur();
			$where = array('id_kategori'=> $this->input->post('id_kategori'));
			$this->db->update('kategori',$data,$where);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
					data berhasil diupdate
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>');
				redirect($_SERVER['HTTP_REFERER']);
		}
		
	}

	public function delete($id_user){
		$data = array('id_kategori' => $id_user);
		$this->db->delete('kategori',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil dihapus
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}
}
?>
