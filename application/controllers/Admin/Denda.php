<?php  
class Denda extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('User_model');
		$this->load->model('Kategori_model');
		$this->load->model('Buku_model');
		$this->load->model('Denda_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Denda';
		$data['denda'] = $this->Denda_model->tampil();
		$this->template->load('admin/template','admin/denda',$data);
	}

	public function add(){
		$data = $this->Denda_model->struktur();
		$this->db->insert('denda',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil ditambahkan
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function update(){
		$data = $this->Denda_model->struktur();
		$where = array('id_denda' => $this->input->post('id_denda'));
		$this->db->update('denda',$data,$where);
		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil diupdate
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id){
		$where = array('id_denda' => $id);
		$this->db->delete('denda',$where);
		$this->session->set_flashdata('alert','<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                data berhasil dihapus
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function cetak_denda(){
		$data = array(
			'tanggal_awal' => $this->input->post('tanggal_awal'),
			'tanggal_akhir' => $this->input->post('tanggal_akhir'),
		);

		$this->load->view('cetak_denda',$data);
	}
}
?>
