<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->load->view('home/index');
	}
	public function kontakadmin()
	{
		$data['kontakadmin'] = $this->db->query(
			'SELECT nama_admin, alamat_admin, telp_admin
			FROM tbl_admin'
		);
		$this->load->view('home/kontakadmin', $data);
	}
}