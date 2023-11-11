<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleModel extends CI_Model {

    public function get_vehicle()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('vehicle');
        return $query->result();
    }

    public function insert_vehicle($data) 
    {
        $this->db->insert('vehicle', $data);
        return $this->db->insert_id();
    }

    public function getwhere_vehicle($idvehicle)
    {
        $query = $this->db->get_where('vehicle', array('idvehicle' => $idvehicle));
        return $query->row();
    }

    public function update_vehicle($idvehicle, $data) {
        $this->db->where('idvehicle', $idvehicle);
        return $this->db->update('vehicle', $data);
    }

    public function delete_vehicle($idvehicle) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idvehicle', $idvehicle);
        return $this->db->update('vehicle', $data);
    }

}