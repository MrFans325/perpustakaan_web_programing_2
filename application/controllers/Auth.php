<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'email Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->get_user_by_email($email);
        if ($user) {
            // Cek apakah akun sudah aktif (verifikasi email)
            if ($user['is_active'] == 1) {
                // Verifikasi password yang di-hash
                if (password_verify($password, $user['password'])) {
                    // Jika password cocok, buat session login
                    $data = [
                        'id_user' => $user['id_user'],
                        'email' => $user['email'],
                        'nama' => $user['nama'],
                        'role_id' => $user['role_id'], // Simpan role di session
                        'logged_in' => TRUE
                    ];
                    $this->session->set_userdata($data);

                    // Redirect berdasarkan role pengguna
                    if ($user['role_id'] == "user") {
                        // Jika role = 1 (siswa), redirect ke dashboard siswa
                        redirect('user/dashboard');
                    } elseif ($user['role_id'] == "admin") {
                        // Jika role = 2 (admin), redirect ke dashboard admin
                        redirect('admin');
                    } else {
                        // Jika role tidak dikenal, logout dan tampilkan pesan error
                        $this->session->set_flashdata('message', 'Role tidak dikenali!');
                        redirect('auth/logout');
                    }
                } else {
                    // Jika password salah
                    $this->session->set_flashdata('message', 'Password salah!');
                    redirect('auth');
                }
            } else {
                // Jika email belum diverifikasi
                $this->session->set_flashdata('message', 'Akun belum diverifikasi, silakan cek email Anda.');
                redirect('auth');
            }
        } else {
            // Jika user tidak ditemukan
            $this->session->set_flashdata('message', 'Email tidak terdaftar!');
            redirect('auth');
        }
    }
    public function registrasi()
    {
        // Validasi input
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('repassword', 'Konfirmasi Password', 'required|trim|matches[password]');
        $role_id = $this->input->post('role');
        if ($this->form_validation->run() == FALSE) {
            if ($role_id != '' && $role_id == 'user') {
                // redirect('user/dashboard');
                $data['buku'] = $this->Buku_model->getBuku()->result_array();
                $data['title'] = "Perpustakaan Booking";
                $this->load->view('user/header_user', $data);
                $this->load->view('user/dashboard');
                $this->load->view('user/modal');
                $this->load->view('user/footer_user');
            } else {
                $this->load->view('layout/header');
                $this->load->view('auth/registrasi');
                $this->load->view('layout/footer');
            }
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'alamat' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 0, // Akun belum aktif, perlu verifikasi email
                'role_id' => $role_id,
                'created' => date("Y-m-d H:i:s")
            ];
            // Simpan data ke database
            $this->User_model->insert_entry($data);
            // Kirim email verifikasi
            // $this->_send_email_verification($email, $data['token']);
            //  Tampilkan pesan berhasil registrasi
            $this->session->set_flashdata('message', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi');
            if ($role_id == 'user') {
                redirect('user/dashboard');
            } else {
                redirect('Auth');
            }
        }
    }
    public function logout()
    {
        $data_user = $this->session->get_userdata();
        if (isset($data_user['role_id']) && $data_user['role_id'] == 'user') {
            $current_user = "user";
        } else {
            $current_user = "admin";
        }
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('message', 'Anda berhasil Log out!');
        if ($current_user == "user") {
            redirect('user/dashboard');
        } else {
            redirect('auth');
        }
    }
}
