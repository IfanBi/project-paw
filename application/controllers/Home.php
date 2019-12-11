<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['kontakadmin'] = $this->db->query(
			'SELECT nama_admin, alamat_admin, telp_admin
			FROM tbl_admin'
		);
		if (!$this->session->userdata('username')) {

			$this->load->view('home/index',$data);
		} else{
			if ($this->session->userdata('level')==2) {
				$data['useractive'] = $this->db->get_where('tbl_penyewa', ['username'=>$this->session->userdata('username')])->row_array();
			}elseif ($this->session->userdata('level')==1) {
				$data['useractive'] = $this->db->get_where('tbl_admin', ['username'=>$this->session->userdata('username')])->row_array();
			}

			$this->load->view('home/index',$data);
		}
	}
	public function kontakadmin()
	{
		$data['kontakadmin'] = $this->db->query(
			'SELECT nama_admin, alamat_admin, telp_admin
			FROM tbl_admin'
		);
		$this->load->view('home/idex', $data);
	}
}