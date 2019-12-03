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

		$query = "SELECT * FROM tbl_sewa";
		$datasewa = $this->db->query($query);
		foreach ($datasewa->result_array() as $data) {
			$tgl_now = date('Y-m-d');
			$bataspembayaran = date('Y-m-d', strtotime('+2 days', strtotime($data['tgl_sewa'])));

			$batassewa = date('Y-m-d', strtotime('+'.$data['lama_sewa'].' month', strtotime($data['tgl_sewa'])));
			if ($data['status_pembayaran']==0 && $data['status_sewa']==1) {
				if ($tgl_now >= $bataspembayaran) {
					$upsewa = array(
						'status_sewa' => 0
					);
					$this->db->where('id_sewa', $data['id_sewa']);
					$this->db->update('tbl_sewa', $upsewa);

					$upkamar = array(
						'status_kamar' => 1
					);
					$this->db->where('id_kamar', $data['id_kamar']);
					$this->db->update('tbl_kamar', $upkamar);
				}
			}elseif ($data['status_pembayaran']==1 && $data['status_sewa']==1) {
				if ($tgl_now >= $batassewa) {
					$upsewa = array(
						'status_sewa' => 0
					);
					$this->db->where('id_sewa', $data['id_sewa']);
					$this->db->update('tbl_sewa', $upsewa);
					
					$upkamar = array(
						'status_kamar' => 1
					);
					$this->db->where('id_kamar', $data['id_kamar']);
					$this->db->update('tbl_kamar', $upkamar);
				}
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
		$query = "SELECT * FROM tbl_sewa WHERE id_penyewa=".$data['useractive']['id_penyewa']." AND status_sewa=1";
		$data['sewa'] = $this->db->query($query)->row_array();
		if ($data['sewa']) {
			$data['useractive']['punyakamar']=1;
			$data['kamar'] = $this->db->get_where('tbl_kamar', ['id_kamar'=>$data['sewa']['id_kamar']])->row_array();
		}else {
			$data['useractive']['punyakamar']=0;
		}
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
		$query = "SELECT * FROM tbl_sewa WHERE id_penyewa=".$data['useractive']['id_penyewa']." AND status_sewa=1";
		$data['sewa'] = $this->db->query($query)->row_array();
		if ($data['sewa']) {
			$data['useractive']['punyakamar']=1;
		}else {
			$data['useractive']['punyakamar']=0;
		}
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
					'status_pembayaran' => 0,
					'status_sewa' => 1
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
	public function batalsewa($id_sewa)
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$query = "SELECT * FROM tbl_sewa WHERE id_penyewa=".$data['useractive']['id_penyewa']." AND status_sewa=1";
		$datasewa = $this->db->query($query)->row_array();
		$upsewa = array(
			'id_sewa' => $datasewa['id_sewa'],
			'id_kamar' => $datasewa['id_kamar'],
			'id_penyewa' => $datasewa['id_penyewa'],
			'id_admin' => $datasewa['id_admin'],
			'tgl_sewa' => $datasewa['tgl_sewa'],
			'lama_sewa' => $datasewa['lama_sewa'],
			'status_pembayaran' => $datasewa['status_pembayaran'],
			'status_sewa' => 0
		);
		$this->db->where('id_sewa', $id_sewa);
		$this->db->update('tbl_sewa', $upsewa);

		$datakamar = $this->db->get_where('tbl_kamar', ['id_kamar'=>$datasewa['id_kamar']])->row_array();
		$upkamar = array(
			'id_kamar' => $datasewa['id_kamar'],
			'harga_kamar' => $datakamar['harga_kamar'],
			'status_kamar' => 1
		);
		$this->db->where('id_kamar', $datasewa['id_kamar']);
		$this->db->update('tbl_kamar', $upkamar);
		redirect('penyewa/kamarsaya');
	}
	public function resetpass($username)
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
		$data['akun'] = $this->db->get_where('tbl_akun', ['username'=>$username])->row_array();

		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',['matches' => 'Password tidak sama', 'min_length' => 'Password terlalu pendek']);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('penyewa/resetpass', $data);
			}else{
				$up = array(
					'username' => $username,
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')
				);
				$this->db->where('username', $username);
				$this->db->update('tbl_akun', $up);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil diubah!</div>');
				redirect('penyewa/');
			}
		}else{
			$this->load->view('penyewa/resetpass', $data);
		}
	}

	public function editprof($username)
	{
		$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();

		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
			$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim|numeric|min_length[11]');

			if ($this->form_validation->run() == false) 
			{
				$this->load->view('penyewa/editprof', $data);
			}else{
				$up = array(
					'nama_penyewa' => $this->input->post('nama'),
					'alamat_penyewa' => $this->input->post('alamat'),
					'telp_penyewa' => $this->input->post('telp')
				);
				$this->db->where('username', $username);
				$this->db->update('tbl_penyewa', $up);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Berhasil diubah!</div>');
				redirect('penyewa/');
			}
		}else{
			$this->load->view('penyewa/editprof', $data);
		}
		
	}
}