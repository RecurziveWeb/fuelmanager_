<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeetypeModel extends CI_Model {

    public function get_employeetype()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('employeetype');
        return $query->result();
    }

    public function insert_employeetype($data) 
    {
        $this->db->insert('employeetype', $data);
        return $this->db->insert_id();
    }

    public function getwhere_employeetype($idemployeetype)
    {
        $query = $this->db->get_where('employeetype', array('idemployeetype' => $idemployeetype));
        return $query->row();
    }

    public function update_employeetype($idemployeetype, $data) {
        $this->db->where('idemployeetype', $idemployeetype);
        return $this->db->update('employeetype', $data);
    }

    public function delete_employeetype($idemployeetype) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idemployeetype', $idemployeetype);
        return $this->db->update('employeetype', $data);
    }

}