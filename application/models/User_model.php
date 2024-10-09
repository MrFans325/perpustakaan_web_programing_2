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
}
