<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

    public function get_users()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function insert_users($data) 
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function getwhere_users($idUsers)
    {
        $query = $this->db->get_where('users', array('idUsers' => $idUsers));
        return $query->row();
    }

    public function update_users($idUsers, $data) {
        $this->db->where('idUsers', $idUsers);
        return $this->db->update('users', $data);
    }

    public function delete_users($idUsers) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idUsers', $idUsers);
        return $this->db->update('users', $data);
    }

    public function checkcredential($email, $password_hash)
    {
        $this->db->where('isdelete', false);
        $this->db->where('email', $email);
        $this->db->where('password', $password_hash);
        $query = $this->db->get('users');
        return $query->result();
    }

}