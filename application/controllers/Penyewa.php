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
}