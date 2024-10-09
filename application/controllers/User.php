<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        echo "user nich";
    }
    public function dashboard()
    {
        echo "user nich";
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
