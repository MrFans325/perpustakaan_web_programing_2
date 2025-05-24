<?php
class User_model extends CI_Model
{
        public function get_data($table)
        {
                $query = $this->db->get($table);
                return $query->result();
        }

        public function cekData($where){
                return $this->db->get_where('user',$where);
        }
        public function getUserWhere($where = null){
                return $this->db->get_where('user',$where);
        }
        public function get_user_by_email($data){
                $this->db->where('email',$data);
                return $this->db->get('user')->row_array();
        }
        public function insert_entry($data)
        {

                $this->db->insert('user', $data);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }
        public function hapus_anggota($id){
                $this->db->where(['id_user'=>$id]);
                $this->db->delete('user');
        }       

        public function get_temp($id){
                return $this->db->get_where('temp',['id_user'=>$id]);
        }
        public function get_list_booking(){
                return $this->db->get_where('booking',['tgl_booking'=>date('Y-m-d')]);
        }
        public function konfirmasi_user($id){
                $this->db->where('id_user',$id);
                $this->db->update('user',['is_active'=>1]);
        }
}
