<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        cek_login();
    }
    public function index()
    {
        $data['judul'] = "Dashboard";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('layout/footer');
    }
    public function data_anggota(){
        $data['user'] = $this->User_model->getUserWhere(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/data_anggota');
        $this->load->view('layout/footer');
    }
}
