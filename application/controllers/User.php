<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
    }
    public function index()
    {
        echo "user nich";
    }
    public function dashboard()
    {
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $data['title'] = "Perpustakaan Booking";
        $this->load->view('user/header_user',$data);
        $this->load->view('user/dashboard');
        $this->load->view('user/footer_user');
    }
    public function detailBuku($id = 1){
        $data['buku'] = $this->Buku_model->bukuWhere(['id_buku'=>$id])->result_array();
        $data['title'] = "Detail buku";
        $this->load->view('user/header_user',$data);
        $this->load->view('user/detail_buku');
        $this->load->view('user/footer_user');
    }
    public function test_model()
    {
        echo "
        test model
        <pre>";
        var_dump($this->User_model->get_data('kategori'));
        echo "</pre>";
        echo "user nich";
    }
}
