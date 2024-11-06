<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Buku_model');
        $this->load->model('Booking_model');
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
    public function booking()
    {
        $data['booking'] = $this->Booking_model->get_booking_all()->result();
        $data['judul'] = "Data Booking";
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/data_booking', $data);
        $this->load->view('layout/footer');
    }
    public function detail_booking($id_booking)
    {
        $data['booking'] = $this->Booking_model->get_id_booking($id_booking)->row_array();
        $data['detail_booking'] = $this->Booking_model->get_detail_booking($id_booking)->result();
        $data['judul'] = "Data Booking";
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/detail_booking', $data);
        $this->load->view('layout/footer');
    }
    public function aksi_booking($id_booking)
    {
        $data_detail_booking = $this->Booking_model->get_detail_booking($id_booking)->result_array();
        $date = date('Y-m-d');
        $m = date('m');
        $d = date('d');
        $y = date('y');
        //get list booking hari ini
        $data_booking = $this->Booking_model->get_id_booking($id_booking)->row_array();
        $get_pinjam_all = $this->Booking_model->get_pinjam_all()->num_rows();
        //generate id
        $id_baru = $get_pinjam_all + 1;
        if ($get_pinjam_all < 10) {
            $id_baru = "0" . $id_baru;
        }
        $id_generated = $m . $d . $y . $id_baru;
        // insert id_booking
        $tanggal_ambil = date('Y-m-d', strtotime($date . " +3 days"));
        $insert_booking = array(
            'no_pinjam' => $id_generated,
            'tgl_pinjam' => $date,
            'id_booking' => $data_booking['id_booking'],
            'id_user' => $data_booking['id_user'],
            'tgl_kembali' => $tanggal_ambil,
        );
        $insert_detail_pinjam = array();
        foreach ($data_detail_booking as $vdb) {
            $insert_detail_pinjam[] = array(
                'no_pinjam' => $id_generated,
                'id_buku' => $vdb['id_buku']
            );
        }

        if (!empty($insert_detail_pinjam)) {
            $this->Booking_model->insert_pinjam($insert_booking, $insert_detail_pinjam);
            $this->Booking_model->hapus_booking($id_booking);
            $this->session->set_flashdata('message', 'Pinjam Berhasil');
        } else {
            $this->session->set_flashdata('error', 'Pinjam Gagal');
        }
        redirect('Admin/data_pinjaman');
    }
    public function data_pinjaman()
    {
        $data['pinjaman'] = $this->Booking_model->get_pinjam_all()->result();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/data_pinjaman', $data);
        $this->load->view('layout/footer');
    }
    public function ubah_status_pinjam($id_pinjam)
    {
        $data_pinjaman = $this->Booking_model->get_pinjam_id($id_pinjam)->row_array();

        $now = strtotime(date('Y-m-d'));
        // $now = strtotime($data_pinjaman['tgl_pengembalian']);
        // $date_pinjam = strtotime($vp->tgl_booking);
        $date_batas = strtotime($data_pinjaman['tgl_kembali']);
        // var_dump($now);
        // var_dump($date_batas);
        if ($now > $date_batas) {
            $beda_hari = $now - $date_batas;
            $beda_hari = round($beda_hari / (60 * 60 * 24));
            $denda = 5000 * $beda_hari;
        } else {
            $beda_hari = 0;
            $denda = 0;
        }
        $data_update = array(
            'status' =>'Kembali',
            'tgl_pengembalian' => date('Y-m-d'),
            'total_denda' =>$denda
        );
        $data_denda = array(
            'denda' => $denda
        );
        $aksi_pinjam = $this->Booking_model->update_pinjam($id_pinjam,$data_update,$data_denda);
        redirect('Admin/data_pinjaman');
    }
}
