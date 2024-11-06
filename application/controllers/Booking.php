<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->model('Buku_model');
    }
    public function booking($id)
    {
        $data_user = $this->session->get_userdata();
        if (!isset($data_user['role_id'])) {
            $this->session->set_flashdata('message', 'silahkan Login Terlebih Dahulu');
            redirect('user/detailBuku/' . $id);
        } else {
            //check buku exist
            $check_buku = $this->Booking_model->check_buku($id, $data_user['id_user']);
            //check Buku sudah di pinjam atau belum
            if ($check_buku > 0) {
                $this->session->set_flashdata('message', 'Buku Ini Sudah anda pinjam');
                $sudah_pinjam = true;
            }
            $check_maksimal = $this->Booking_model->check_maksimal($data_user['id_user']);
            //2 = maksimal jumlah buku yang bisa di pinjam
            if ($check_maksimal >= 2) {
                $this->session->set_flashdata('message', 'Anda hanya boleh meminjam 2 buku');
            } else {
                //input ke db 
                //get data buku
                $now = date("Y-m-d H:i:s");
                $buku = $this->Buku_model->bukuDetail(['id_buku' => $id])->row_array();
                $array_insert = array(
                    'tgl_booking' => $now,
                    'id_user' => $data_user['id_user'],
                    'email_user' => $data_user['email'],
                    'id_buku' => $id,
                    'judul_buku' => $buku['judul_buku'],
                    'image' => $buku['image'],
                    'pengarang' => $buku['pengarang'],
                    'penerbit' => $buku['penerbit'],
                    'tahun_terbit' => $buku['tahun_terbit'],
                );
                if(!isset($sudah_pinjam)){
                    $this->Booking_model->input_booking($array_insert);
                }
            }
            
            $data['booking'] = $this->Booking_model->getbooking($data_user['id_user'])->result();
            $data['title'] = "Perpustakaan Booking";
            $data_user = $this->session->get_userdata();
            if (isset($data_user['role_id'])) {
                $data['user'] = $data_user;
            }
            $this->load->view('user/header_user', $data);
            $this->load->view('user/data_booking');
            $this->load->view('user/modal');
            $this->load->view('user/footer_user');
            // $this->db->get_where();
        }
    }
}
