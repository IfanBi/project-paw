<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}else{
			if ($this->session->userdata('level')==2) {
				redirect('penyewa');
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
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
		$this->load->view('admin/index', $data);
	}
	
	public function daftarakun()
	{
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
		$data['daftarakun'] = $this->db->query(
			'SELECT a.nama_penyewa, b.username, b.password
			FROM tbl_penyewa a, tbl_akun b 
			WHERE a.username=b.username'
		);
		$data['akunadmin'] = $this->db->query(
			'SELECT a.nama_admin, b.username, b.password
			FROM tbl_admin a, tbl_akun b 
			WHERE a.username=b.username'
		);
		$this->load->view('admin/daftarakun', $data);
	}

	public function resetpass($username)
	{
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
		$data['akun'] = $this->db->get_where('tbl_akun', ['username'=>$username])->row_array();

		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',['matches' => 'Password tidak sama', 'min_length' => 'Password terlalu pendek']);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
			if ($this->form_validation->run() == false) 
			{
				$this->load->view('admin/resetpass', $data);
			}else{
				$up = array(
					'username' => $username,
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')
				);
				$this->db->where('username', $username);
				$this->db->update('tbl_akun', $up);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil diubah!</div>');
				redirect('admin/daftarakun');
			}
		}else{
			$this->load->view('admin/resetpass', $data);
		}
	}

	public function daftarkamar(){
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
		$data['kamartersedia'] = $this->db->query(
			'SELECT *
			FROM tbl_kamar
			WHERE status_kamar=1'
		);
		$data['kamartaktersedia'] = $this->db->query(
			'SELECT *
			FROM tbl_kamar
			WHERE status_kamar=0'
		);
		$this->load->view('admin/daftarkamar', $data);
	}

	public function daftartransaksi(){
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
		$query = "SELECT a.id_sewa, a.id_kamar, b.nama_penyewa, a.tgl_sewa, a.lama_sewa, c.harga_kamar, a.status_pembayaran, a.status_sewa
		FROM tbl_sewa a, tbl_penyewa b, tbl_kamar c
		WHERE a.status_pembayaran=0 AND a.status_sewa=1 AND a.id_penyewa=b.id_penyewa AND a.id_kamar=c.id_kamar";
		$data['tbt'] = $this->db->query($query);

		$query = "SELECT a.id_sewa, a.id_kamar, b.nama_penyewa, a.tgl_sewa, a.lama_sewa, c.harga_kamar, a.status_pembayaran, a.status_sewa
		FROM tbl_sewa a, tbl_penyewa b, tbl_kamar c
		WHERE a.status_pembayaran=1 AND a.status_sewa=1 AND a.id_penyewa=b.id_penyewa AND a.id_kamar=c.id_kamar";
		$data['tt'] = $this->db->query($query);

		$query = "SELECT a.id_sewa, a.id_kamar, b.nama_penyewa, a.tgl_sewa, a.lama_sewa, c.harga_kamar, a.status_pembayaran, a.status_sewa
		FROM tbl_sewa a, tbl_penyewa b, tbl_kamar c
		WHERE a.status_pembayaran=1 AND a.status_sewa=0 AND a.id_penyewa=b.id_penyewa AND a.id_kamar=c.id_kamar";
		$data['tts'] = $this->db->query($query);

		$query = "SELECT a.id_sewa, a.id_kamar, b.nama_penyewa, a.tgl_sewa, a.lama_sewa, c.harga_kamar, a.status_pembayaran, a.status_sewa
		FROM tbl_sewa a, tbl_penyewa b, tbl_kamar c
		WHERE a.status_pembayaran=0 AND a.status_sewa=0 AND a.id_penyewa=b.id_penyewa AND a.id_kamar=c.id_kamar";
		$data['tbts'] = $this->db->query($query);
		$this->load->view('admin/daftartransaksi', $data);
	}
	public function editprof($username)
	{
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();

		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
			$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim|numeric|min_length[11]');

			if ($this->form_validation->run() == false) 
			{
				$this->load->view('admin/editprof', $data);
			}else{
				$up = array(
					'nama_admin' => $this->input->post('nama'),
					'alamat_admin' => $this->input->post('alamat'),
					'telp_admin' => $this->input->post('telp')
				);
				$this->db->where('username', $username);
				$this->db->update('tbl_admin', $up);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Berhasil diubah!</div>');
				redirect('admin/');
			}
		}else{
			$this->load->view('admin/editprof', $data);
		}
		
	}
	public function addroom()
	{
		$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('harga_kamar', 'Harga Kamar', 'required|trim|numeric');

			if ($this->form_validation->run() == false) 
			{
				$this->load->view('admin/addroom');
			}else{
				$kamar = [
					'harga_kamar' => $this->input->post('harga_kamar'),
					'status_kamar' => 1
				];
				$this->db->insert('tbl_kamar', $kamar);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamar ditambahkan!</div>');
				redirect('admin/daftarkamar');
			}



		} else {
			$this->load->view('admin/addroom',$data);
		}
	}

}