<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_approval');
	}

	public function dashboard_super_admin()
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$data['approval'] = $this->m_approval->count_all_approval()->row_array();
		$data['approval_acc'] = $this->m_approval->count_all_approval_acc()->row_array();
		$data['approval_confirm'] = $this->m_approval->count_all_approval_confirm()->row_array();
		$data['approval_reject'] = $this->m_approval->count_all_approval_reject()->row_array();
		$data['pegawai'] = $this->m_user->count_all_pegawai()->row_array();
		$data['admin'] = $this->m_user->count_all_admin()->row_array();
		$this->load->view('super_admin/dashboard', $data);

	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}
	}

	public function dashboard_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$data['approval'] = $this->m_approval->count_all_approval()->row_array();
			$data['approval_acc'] = $this->m_approval->count_all_approval_acc()->row_array();
			$data['approval_confirm'] = $this->m_approval->count_all_approval_confirm()->row_array();
			$data['approval_reject'] = $this->m_approval->count_all_approval_reject()->row_array();
			$data['pegawai'] = $this->m_user->count_all_pegawai()->row_array();
			$this->load->view('admin/dashboard', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	
	public function dashboard_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {

			$data['approval_pegawai'] = $this->m_approval->get_all_approval_first_by_id_user($this->session->userdata('id_user'))->result_array();
			$data['approval'] = $this->m_approval->count_all_approval_by_id($this->session->userdata('id_user'))->row_array();
			$data['approval_acc'] = $this->m_approval->count_all_approval_acc_by_id($this->session->userdata('id_user'))->row_array();
			$data['approval_confirm'] = $this->m_approval->count_all_approval_confirm_by_id($this->session->userdata('id_user'))->row_array();
			$data['approval_reject'] = $this->m_approval->count_all_approval_reject_by_id($this->session->userdata('id_user'))->row_array();
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			// echo var_dump($data);
			// die();
			$this->load->view('pegawai/dashboard', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}
    }
    
}