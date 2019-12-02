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
}