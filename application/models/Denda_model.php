<?php
class Denda_model extends CI_Model{

	public function tampil(){
		$this->db->from('denda');
		$data = $this->db->get()->result_array();

		return $data;
	}

	public function struktur(){
		$data = array(
			'harga_denda' => $this->input->post('harga_denda'),
			'status' => $this->input->post('status')
		);
		if($data['status'] == 'BERLAKU'){
			$this->db->where('status','BERLAKU');
			$this->db->update('denda',array('status' => 'TIDAK BERLAKU'));
		}
		return $data;
	}

	public function denda_berlaku(){
		$this->db->from('denda')->where('status','BERLAKU');
		$data = $this->db->get()->row();
		$harga = $data->harga_denda;

		return $harga;
	}
}
?>
