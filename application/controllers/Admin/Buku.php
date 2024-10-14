<?php
class Buku extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('User_model');
		$this->load->model('Kategori_model');
		$this->load->model('Buku_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Buku';
		$data['buku'] = $this->Buku_model->tampil();
		$data['kategori'] = $this->Kategori_model->tampil();
		$this->template->load('admin/template','admin/buku',$data);
	}
	public function add(){
		$this->db->from('buku')->where('judul',$this->input->post('judul'));
		$cek = $this->db->get()->result_array();
		if($cek != null){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                judul buku sudah digunakan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = $this->Buku_model->struktur();
			$this->db->insert('buku',$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil ditambahkan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function update(){	
		$this->db->from('buku')->where_not_in('id_buku',$this->input->post('id_buku'));
		$temp = $this->db->get()->row();
		if($temp && $temp->id_buku != $this->input->post('id_buku')){
			$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
			judul buku sudah ada
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
		redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = $this->Buku_model->struktur();
		$where = array('id_buku'=> $this->input->post('id_buku'));
		$this->db->update('buku',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil diupdate
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}
		}
		

	public function delete($id_user){
		$data = array('id_buku' => $id_user);
		$this->db->delete('buku',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil dihapus
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function detail_buku($id_buku){
		$data['buku'] = $this->Buku_model->buku_id($id_buku);
		$data['ulasan'] = $this->Buku_model->ulasan_user($id_buku);
		$data['title'] = 'Detail Buku';
		$this->template->load('admin/template','admin/detail_buku',$data);
	}
}
?>
