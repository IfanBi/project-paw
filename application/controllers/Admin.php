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
		$this->load->view('admin/daftartransaksi');
	}


}