<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {

    public function get_location()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('location');
        return $query->result();
    }

    public function insert_location($data) 
    {
        $this->db->insert('location', $data);
        return $this->db->insert_id();
    }

    public function getwhere_location($idLocation)
    {
        $query = $this->db->get_where('location', array('idLocation' => $idLocation));
        return $query->row();
    }

    public function update_location($idLocation, $data) {
        $this->db->where('idLocation', $idLocation);
        return $this->db->update('location', $data);
    }

    public function delete_location($idLocation) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idLocation', $idLocation);
        return $this->db->update('location', $data);
    }

}