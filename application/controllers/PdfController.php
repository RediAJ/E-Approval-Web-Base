<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library dan model yang diperlukan
        $this->load->library('form_validation');
        $this->load->model('your_model'); // Gantilah 'your_model' dengan nama model Anda
    }

    public function generate_pdf($id) {
        // Ambil data dari model berdasarkan ID atau parameter yang sesuai
        $data['result'] = $this->your_model->get_data_by_id($id); // Gantilah 'your_model' dengan nama model Anda

        // Load view yang berisi konten PDF
        $html = $this->load->view('pdf_template', $data, true);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas (Opsional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (Opsional: Simpan atau tampilkan)
        $dompdf->render();
        $dompdf->stream('output.pdf', array('Attachment' => 0));
    }
}
?>
