<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			if ($this->session->userdata('level')==1) {
				redirect('admin');
			}elseif ($this->session->userdata('level')==2){
				redirect('penyewa');
			}
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tbl_akun', ['username'=>$username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' => $user['username'],
					'level' => $user['level']
				];
				$this->session->set_userdata($data);

				if ($user['level']==1) {
					redirect('admin/');
				}
				elseif ($user['level']==2){
					redirect('penyewa/');
				}
				
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
				$this->load->view('auth/login');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ada</div>');
			$this->load->view('auth/login');
		}
	}
	public function register()
	{
		if ($this->session->userdata('username')) {
			if ($this->session->userdata('level')==1) {
				redirect('admin');
			}elseif ($this->session->userdata('level')==2){
				redirect('penyewa');
			}
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|trim|numeric|min_length[11]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_akun.username]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',['matches' => 'Password tidak sama', 'min_length' => 'Password terlalu pendek']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) 
		{
			$this->load->view('auth/register');
		}else{
			$data_akun = [
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'level' => 2
			];
			$this->db->insert('tbl_akun', $data_akun);

			$data_penyewa = [
				'nama_penyewa' => $this->input->post('nama'),
				'alamat_penyewa' => $this->input->post('alamat'),
				'telp_penyewa' => $this->input->post('telp'),
				'username' => $this->input->post('username'),
			];
			$this->db->insert('tbl_penyewa', $data_penyewa);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil dibuat!</div>');
			redirect('auth/');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
		redirect('auth/');
	}
}