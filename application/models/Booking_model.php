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
}