<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    //manajemen buku
    public function getBuku()
    {
        return $this->db->get('buku');
    }

    public function getLimitBuku()
    {
        $this->db->limit(5);
        return $this->db->get('buku');
    }

    public function bukuWhere($where)
    {
        return $this->db->get_where('buku', $where);
    }
    public function bukuDetail($where){
        $this->db->select("buku.*,kategori.jenis_kategori as kategori");
        $this->db->join('kategori','buku.id_kategori=kategori.id_kategori');
        return $this->db->get_where('buku', $where);
    }
    public function simpanBuku($data = null)
    {
        $this->db->insert('buku', $data);
    }

    public function updateBuku($data = null, $where = null)
    {
        $this->db->update('buku', $data, $where);
    }

    public function hapusBuku($where = null)
    {
        $this->db->delete('buku', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    public function bukuTotalRecord()
    {
        $this->db->from('buku');
        return $this->db->count_all_results();
    }

    public function bukuLimit($batas, $awal = 0)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($batas, $awal);

        return $this->db->get('buku');
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriBuku($where)
    {
        //$this->db->select('buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }

    public function search_order_buku($keyword){
        $this->db->like('judul_buku',$keyword);
        $this->db->order_by("judul_buku ASC");
        return $this->db->get('buku');
    }
}
