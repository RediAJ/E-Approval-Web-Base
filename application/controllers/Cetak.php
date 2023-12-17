<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_approval');
    }
    public function surat_approval_pdf($id_approval){

        $data['approval'] = $this->m_approval->get_all_approval_by_id_approval($id_approval)->result_array();

       
    
        $this->load->library('pdf');
    
        $this->pdf->setPaper('Letter', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "surat-approval.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    
    
    }
    
}