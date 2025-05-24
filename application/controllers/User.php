<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
        $this->load->model('Booking_model');
    }
    public function index()
    {
        redirect('user/dashboard');
    }
    public function dashboard()
    {
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $data['title'] = "Perpustakaan Booking";
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id'])) {
            $data['user'] = $data_user;
        }
        $this->load->view('user/header_user', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/modal');
        $this->load->view('user/footer_user');
    }
    public function detailBuku($id = 1)
    {
        $data['buku'] = $this->Buku_model->bukuDetail(['id_buku' => $id])->row_array();
        $data['related_books'] = $this->Buku_model->bukuWhere(['id_kategori' => $data['buku']['id_kategori']])->result();
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id'])) {
            $data['user'] = $data_user;
        }
        $data['title'] = "Detail buku";
        $this->load->view('user/header_user', $data);
        $this->load->view('user/detail_buku');
        $this->load->view('user/modal');
        $this->load->view('user/footer_user');
    }
    public function finish_booking()
    {
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id'])) {
            $date = date('Y-m-d');
            $m = date('m');
            $d = date('d');
            $y = date('y');
            $data['user'] = $data_user;
            $id_user = $data_user['id_user'];
            //ambil data pinjaman buku
            $tanggal_ambil = date('Y-m-d', strtotime($date . " +3 days"));

            $data_temp = $this->User_model->get_temp($id_user)->result_array();
            // var_dump($tanggal_ambil);
            // var_dump($date);
            //generate id booking 
            //get list booking hari ini
            $today_booking = $this->User_model->get_list_booking()->num_rows();
            //generate id
            $id_baru = $today_booking + 1;
            if ($today_booking < 10) {
                $id_baru = "0" . $id_baru;
            }
            $id_generated = $m . $d . $y . $id_baru;
            // insert id_booking
            $insert_booking = array(
                'id_booking' => $id_generated,
                'tgl_booking' => $date,
                'batas_ambil' => $tanggal_ambil,
                'id_user' => $id_user,
            );
            $insert_detail_booking = array();
            foreach ($data_temp as $vdt) {
                $insert_detail_booking[] = array(
                    'id_booking' => $id_generated,
                    'id_buku' => $vdt['id_buku']
                );
            }

            if (!empty($insert_detail_booking)) {
                $this->Booking_model->insert_booking($insert_booking, $insert_detail_booking);
                $this->Booking_model->hapus_temp($id_user);
                $this->session->set_flashdata('message', 'Booking Berhasil');
            } else {
                $this->session->set_flashdata('error', 'Booking Gagal');
            }
            redirect('user/list_booking');
        }else{
            $this->session->set_flashdata('error', 'Booking Gagal');
            redirect('user/dashboard');
        }
    }
    public function list_booking()
    {
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id'])) {
            $id_user = $data_user['id_user'];
            $data['booking'] = $this->Booking_model->get_user_booking($id_user)->result();
            $data['title'] = "Detail Booking";
            $data['user'] = $data_user;
            $this->load->view('user/header_user', $data);
            $this->load->view('user/list_booking');
            $this->load->view('user/modal');
            $this->load->view('user/footer_user');
        } else {
            $this->session->set_flashdata('error', 'Booking Gagal');
            redirect('user/dashboard');
        }
    }
    public function hapus_booking($id){
        $this->db->where('id',$id);
        $this->db->delete('temp');
        $this->session->set_flashdata('success', 'Hapus data booking berhasil');
        redirect('user/dashboard');
    }
    public function search_buku(){
        $keyword = $this->input->get('keyword');
        $data['buku'] = $this->Buku_model->search_order_buku($keyword)->result_array();
        $data['title'] = "Perpustakaan Booking";
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id'])) {
            $data['user'] = $data_user;
        }
        $this->load->view('user/header_user', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/modal');
        $this->load->view('user/footer_user');
    }
}
