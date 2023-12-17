<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_approval extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_approval');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_form');
	}
	
	public function view_pegawai_hapus_data_user()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {

			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$this->load->view('pegawai/form_pengajuan_approval', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}

	}

	public function view_pegawai_payment_voucher()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {

			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$this->load->view('pegawai/form_payment_voucher', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}

	}
	
	public function proses_approval()
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {

		$id_user = $this->input->post("id_user");
		$alasan = $this->input->post("alasan");
		$perihal_approval = $this->input->post("perihal_approval");
		$mulai = $this->input->post("mulai");
		$berakhir = $this->input->post("berakhir");
		$id_approval = md5($id_user.$alasan.$mulai);
		
		$id_status_approval = 1;

		$hasil = $this->m_approval->insert_data_approval('approval-'.substr($id_approval, 0, 5),$id_user, $alasan, $mulai, $berakhir, $id_status_approval, $perihal_approval);

		if($hasil==false){
			$this->session->set_flashdata('eror_input','eror_input');
		
		}else{
			$this->session->set_flashdata('input','input');
		}
		redirect('Form_approval/view_pegawai');

	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}	

	}

	public function fetchData() {

        // Get the data based on the inputs
        $input_data1 = $this->input->post('input_data1');
        $input_data2 = $this->input->post('input_data2');

        // Fetch data from the database based on the inputs
        $result = $this->m_form->getAutofillData($input_data1, $input_data2);

        // Return the result as JSON
        echo json_encode($result);
    }

	public function generatePdf() {
        // Handle form submission and get data
        $data['input_data1'] = $this->input->post('input_data1');
        $data['input_data2'] = $this->input->post('input_data2');
		$data['autofill'] = $this->input->post('autofill');
		$data['alasan'] = $this->input->post('alasan');

        // Load the Dompdf library
        $this->load->library('dompdf');

        // Load the view file into a variable
        $html = $this->load->view('pdf_template', $data, true);

        // Load the Dompdf class
        $this->dompdf->loadHtml($html);

        // (Optional) Set the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF (inline view)
        $this->dompdf->stream("output.pdf", array("Attachment" => false));
    }

}
