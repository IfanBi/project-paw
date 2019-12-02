<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyewa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}else{
			if ($this->session->userdata('level')==1) {
				redirect('admin');
			}
		}
	}
	public function index()
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$this->load->view('penyewa/index', $data);
	}
	public function kontakadmin()
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$data['kontakadmin'] = $this->db->query(
			'SELECT nama_admin, alamat_admin, telp_admin
			FROM tbl_admin'
		);
		$this->load->view('penyewa/kontakadmin', $data);
	}
	public function kamarsaya()
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$data['kontakadmin'] = $this->db->query(
			'SELECT nama_admin, alamat_admin, telp_admin
			FROM tbl_admin'
		);
		$data['sewa'] = $this->db->get_where('tbl_sewa', ['id_penyewa'=>$data['useractive']['id_penyewa']])->row_array();
		$this->load->view('penyewa/kamarsaya', $data);
	}
	public function daftarkamar()
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$data['kamartersedia'] = $this->db->query(
			'SELECT *
			FROM tbl_kamar
			WHERE status_kamar=1'
		);
		$this->load->view('penyewa/daftarkamar', $data);
	}
	public function sewakamar($id)
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$data['kamar'] = $this->db->get_where('tbl_kamar', ['id_kamar'=>$id])->row_array();
		$idkamar = $data['kamar']['id_kamar'];
		$penyewa = $data['useractive']['id_penyewa'];
		$tgl = date('Y-m-d');
		$lamasewa = $this->input->post('lamasewa');
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('lamasewa', 'Lamasewa', 'required');
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('penyewa/sewakamar', $data);
			}else{
				$data_sewa = [
					'id_kamar' => $idkamar,
					'id_penyewa' => $penyewa,
					'id_admin' => 1,
					'tgl_sewa' => $tgl,
					'lama_sewa' => $lamasewa,
					'status_pembayaran' => 0
				];
				$this->db->insert('tbl_sewa', $data_sewa);
				$up = [
					'id_kamar' => $idkamar,
					'harga_kamar' => $data['kamar']['harga_kamar'],
					'status_kamar' => 0
				];
				$this->db->where('id_kamar', $idkamar);
				$this->db->update('tbl_kamar', $up);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamar Berhasil di Sewa!</div>');
				redirect('penyewa/kamarsaya', $data);
			}
		}else{
			$this->load->view('penyewa/sewakamar', $data);
		}

	}
}