<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model {

    public function get_employee()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('employee');
        return $query->result();
    }

    public function insert_employee($data) 
    {
        $this->db->insert('employee', $data);
        return $this->db->insert_id();
    }

    public function getwhere_employee($idemployee)
    {
        $query = $this->db->get_where('employee', array('idemployee' => $idemployee));
        return $query->row();
    }

    public function update_employee($idemployee, $data) {
        $this->db->where('idemployee', $idemployee);
        return $this->db->update('employee', $data);
    }

    public function delete_employee($idemployee) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idemployee', $idemployee);
        return $this->db->update('employee', $data);
    }

}