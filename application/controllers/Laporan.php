<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
        // $this->load->model('Booking_model');
        cek_login();
    }
    public function laporan_buku()
    {
        $data['judul'] = "Dashboard";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $data['kategori'] = $this->Buku_model->getKategori()->result_array();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('laporan/laporan_buku', $data);
        $this->load->view('layout/footer');
    }
    public function cetak_laporan_buku()
    {
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $data['kategori'] = $this->Buku_model->getKategori()->result_array();
        $this->load->view('laporan/laporan_print_buku', $data);
    }

    public function laporan_buku_pdf()
    {
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        // $this->load->library('dompdf_gen'); 
        include APPPATH . "third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('laporan/laporan_pdf_buku', $data);
        $paper_size  = 'A4'; // ukuran kertas 
        $orientation = 'landscape'; //tipe format kertas potrait atau 
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF 
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("laporan_data_buku.pdf", array('Attachment' =>0));
        // nama file pdf yang di hasilkan 
    }
    public function export_excel_buku()
    {
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $data['kategori'] = $this->Buku_model->getKategori()->result_array();
        $this->load->view('laporan/export_excel_buku', $data);
    }
}
