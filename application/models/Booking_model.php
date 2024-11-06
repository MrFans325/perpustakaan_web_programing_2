<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    function check_buku($id_buku,$id_user){
        return $this->db->get_where('temp',['id_buku'=>$id_buku,'id_user'=>$id_user])->num_rows();
    }
    function check_maksimal($id_user){
        return $this->db->get_where('temp',['id_user'=>$id_user])->num_rows();
    }
    function input_booking($data){
        return $this->db->insert('temp',$data);
    }
    function getbooking($id_user){
        return $this->db->get_where('temp',['id_user'=>$id_user]);
    }
    function hapus_temp($id_user){
        return $this->db->where(['id_user'=>$id_user])->delete('temp');
    }
    function insert_booking($booking_array,$detail_array){
        $this->db->insert('booking',$booking_array);
        $this->db->insert_batch('booking_detail',$detail_array);
    }
    function hapus_booking($id_booking){
        $this->db->where(['id_booking'=>$id_booking])->delete('booking');
        return $this->db->where(['id_booking'=>$id_booking])->delete('booking_detail');
    }
    function insert_pinjam($pinjam,$detail_pinjam){
        $this->db->insert('pinjam',$pinjam);
        $this->db->insert_batch('detail_pinjam',$detail_pinjam);
    }
    function get_user_booking($id_user){
        $this->db->join('booking_detail','booking_detail.id_booking = booking.id_booking');
        $this->db->join('buku','booking_detail.id_buku = buku.id_buku');
        return $this->db->get_where('booking',['id_user'=>$id_user]);
    }
    function get_id_booking($id_booking){
        $this->db->join('user','user.id_user = booking.id_user');
        return $this->db->get_where('booking',['id_booking'=>$id_booking]);
    }
    function get_detail_booking($id_booking){
        $this->db->join('buku','booking_detail.id_buku = buku.id_buku');
        return $this->db->get_where('booking_detail',['id_booking'=>$id_booking]);
    }
    function get_booking_all(){
        return $this->db->get('booking');
    }
    function get_pinjam_all(){
        return $this->db->get('pinjam');
    }
    function get_pinjam_id($no_pinjam){
        return $this->db->get_where('pinjam',['no_pinjam'=>$no_pinjam]);
    }
    function update_pinjam($no_pinjam,$data_pinjam,$data_denda){
        $this->db->where(['no_pinjam'=>$no_pinjam]);
        $this->db->update('pinjam',$data_pinjam);
        $this->db->where(['no_pinjam'=>$no_pinjam]);
        $this->db->update('detail_pinjam',$data_denda);
    }
}