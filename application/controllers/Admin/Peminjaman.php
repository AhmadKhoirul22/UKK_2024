<?php 
class Peminjaman extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Buku_model');
		$this->load->model('User_model');
		$this->load->model('Peminjaman_model');
		if($this->session->userdata('level') == 'PEMINJAM'){
			redirect('auth');
		} else if($this->session->userdata('id_user') == null){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'Peminjaman';
		$data['peminjaman'] = $this->Peminjaman_model->data_pinjam();
		$data['user'] = $this->User_model->member();
		$this->template->load('admin/template','admin/peminjaman',$data);
	}

	public function temp($id_user){
		$data['temp'] = $this->Buku_model->temp($id_user);
		$data['buku'] = $this->Buku_model->tampil();
		$data['title'] = 'Request Buku';
		$data['user'] = $this->User_model->user_berdasarkan_id($id_user);
		$this->template->load('admin/template','admin/temp',$data);
	}

	public function pinjam_buku(){
		$id_user = $this->input->post('id_user');
		$kode = rand(100,10000) + 1;

		$temp = $this->Buku_model->temp($id_user);

		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$lama_minjam = 3;
		$tanggal_pengembalian = date('y-m-d',strtotime('+'.$lama_minjam.'days',strtotime($tanggal)));

		foreach ($temp as $item) {
			$this->db->from('peminjaman p')->where('p.id_user',$id_user)->where('p.status','DIPINJAM');
			$this->db->join('detail_peminjaman d','d.kode_peminjaman = p.kode_peminjaman','left');
			$this->db->where('d.id_buku',$item['id_buku']);
			$cek = $this->db->get()->result_array();

			if($cek != null){
				$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                buku yang lama belum dikembalikan, jadi tidak bisa meminjam lagi
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else if($item['jumlah'] < 1){
				$this->session->set_flashdata('alert','<div class="alert alert-warning bg-warning text-light border-0 alert-dismissible fade show" role="alert">
                jumlah buku tidak memadai
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$data = array(
					'kode_peminjaman' => $kode,
					'id_buku' => $item['id_buku']
				);
				$this->db->insert('detail_peminjaman',$data);
				// delete temp
				$data = array('id_temp' => $item['id_temp']);
				$this->db->delete('temp',$data);
				// update buku
				$data = array(
					'jumlah' => $item['jumlah'] - 1,
				);
				$this->db->where('id_buku',$item['id_buku']);
				$this->db->update('buku',$data);
			}
		}
		$data = array(
			'kode_peminjaman' => $kode,
			'tanggal_peminjaman' => $tanggal,
			'tanggal_pengembalian' => $tanggal_pengembalian,
			'tanggal_kembali' => '',
			'status' => 'DIPINJAM',
			'id_user' => $id_user
		);
		$this->db->insert('peminjaman',$data);

		$this->session->set_flashdata('alert','<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                buku berhasil dipinjam
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
        redirect('admin/peminjaman');
	}
}
?>
