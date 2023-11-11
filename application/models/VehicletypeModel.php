<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicletypeModel extends CI_Model {

    public function get_vehicle_type()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('vehicle_type');
        return $query->result();
    }

    public function insert_vehicle_type($data) 
    {
        $this->db->insert('vehicle_type', $data);
        return $this->db->insert_id();
    }

    public function getwhere_vehicle_type($idvehicle_type)
    {
        $query = $this->db->get_where('vehicle_type', array('idvehicle_type' => $idvehicle_type));
        return $query->row();
    }

    public function update_vehicle_type($idvehicle_type, $data) {
        $this->db->where('idvehicle_type', $idvehicle_type);
        return $this->db->update('vehicle_type', $data);
    }

    public function delete_vehicle_type($idvehicle_type) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idvehicle_type', $idvehicle_type);
        return $this->db->update('vehicle_type', $data);
    }

}