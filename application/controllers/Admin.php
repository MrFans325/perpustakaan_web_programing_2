<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
        cek_login();
    }
    public function index()
    {
        $data['judul'] = "Dashboard";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/footer');
    }
    public function data_anggota()
    {
        $data['user'] = $this->User_model->getUserWhere()->result_array();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/data_anggota', $data);
        $this->load->view('layout/footer');
    }
    public function hapus_anggota($id)
    {
        $delete = $this->User_model->hapus_anggota($id);
        redirect('admin/data_anggota');
    }
    //kategori
    public function data_kategori()
    {
        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Data Kategori";
            $data['kategori'] = $this->Buku_model->getKategori()->result_array();
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar');
            $this->load->view('admin/data_kategori', $data);
            $this->load->view('layout/footer');
        } else {
            $this->editKategori();
        }
    }
    public function hapusKategori($id)
    {

        $where = ['id_kategori' => $id];
        $this->Buku_model->hapusKategori($where);
        $this->session->set_flashdata('success', 'Data Kategori Berhasil Di hapus');
        redirect('admin/data_kategori');
    }
    public function editKategori()
    {
        $data = [
            'jenis_kategori' => $this->input->post('kategori', true)
        ];
        if ($this->input->post('id')) {
            $this->Buku_model->updateKategori(['id_kategori' => $this->input->post('id')], $data);
            $this->session->set_flashdata('success', 'Data Kategori Berhasil Di Update');
        } else {
            $this->Buku_model->simpanKategori($data);
            $this->session->set_flashdata('success', 'Data Kategori Berhasil Di Simpan');
        }

        redirect('admin/data_kategori');
    }
    //buku
    public function data_buku()
    {
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi',
            'min_length' => 'Judul buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama pengarang harus diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama pengarang harus diisi',
            'min_length' => 'Nama pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama penerbit harus diisi',
            'min_length' => 'Nama penerbit terlalu pendek'
        ]);
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun terbit harus diisi',
            'min_length' => 'Tahun terbit terlalu pendek',
            'max_length' => 'Tahun terbit terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Data Kategori";
            $data['buku'] = $this->Buku_model->getBuku()->result_array();
            $data['kategori'] = $this->Buku_model->getKategori()->result_array();
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar');
            $this->load->view('admin/data_buku', $data);
            $this->load->view('layout/footer');
        } else {
            $this->editBuku();
        }
    }
    public function hapusBuku($id)
    {

        $where = ['id_buku' => $id];
        $this->Buku_model->hapusBuku($where);
        $this->session->set_flashdata('success', 'Data Buku Berhasil Di hapus');
        redirect('admin/data_buku');
    }
    public function editBuku()
    {
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $image = $this->upload->data();
            $gambar = $image['file_name'];
        } else {
            $gambar = '';
        }
        /*$filename = $_FILES["image"]["name"]; //mendapatkan nama file
        $ext_list = array("jpg", "png", "jpeg"); //membatasi jenis image yang bisa diupload
        $pisah = explode(".", $filename); //memisahkan nama file dengan extention
        $namaimage = 'img' . time() . in_array($pisah[1], $ext_list); //menghasilkan nama image baru
        move_uploaded_file($_FILES["image"]["tmp_name"], base_url('assets/img/upload/') . $namaimage);*/

        $data = [
            'judul_buku' => $this->input->post('judul_buku', true),
            'id_kategori' => $this->input->post('id_kategori', true),
            'pengarang' => $this->input->post('pengarang', true),
            'penerbit' => $this->input->post('penerbit', true),
            'tahun_terbit' => $this->input->post('tahun_terbit', true),
            'isbn' => $this->input->post('isbn', true),
            'stok' => $this->input->post('stok', true),
            'dipinjam' => 0,
            'dibooking' => 0,
            'image' => $gambar
        ];

        if ($this->input->post('id')) {
            $this->Buku_model->updateBuku($data, ['id_buku' => $this->input->post('id')]);
            $this->session->set_flashdata('success', 'Data Buku Berhasil Di Update');
        } else {
            $this->Buku_model->simpanBuku($data);
            $this->session->set_flashdata('success', 'Data Buku Berhasil Di Simpan');
        }
        redirect('admin/data_buku');
    }
}
