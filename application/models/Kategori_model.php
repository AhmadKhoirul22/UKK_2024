<?php  
class Kategori_model extends CI_Model{

	public function tampil(){
		$this->db->from('kategori');
		$data = $this->db->get()->result_array();
		
		return $data;
	}

	public function struktur(){
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
		);
		return $data;
	}
}
?>
