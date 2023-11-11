<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehiclerevenuelicenseModel extends CI_Model {

    public function get_vehicle_revenue_license()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('vehicle_revenue_license');
        return $query->result();
    }

    public function insert_vehicle_revenue_license($data) 
    {
        $this->db->insert('vehicle_revenue_license', $data);
        return $this->db->insert_id();
    }

    public function getwhere_vehicle_revenue_license($idvehicle_revenue_license)
    {
        $query = $this->db->get_where('vehicle_revenue_license', array('idvehicle_revenue_license' => $idvehicle_revenue_license));
        return $query->row();
    }

    public function update_vehicle_revenue_license($idvehicle_revenue_license, $data) {
        $this->db->where('idvehicle_revenue_license', $idvehicle_revenue_license);
        return $this->db->update('vehicle_revenue_license', $data);
    }

    public function delete_vehicle_revenue_license($idvehicle_revenue_license) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idvehicle_revenue_license', $idvehicle_revenue_license);
        return $this->db->update('vehicle_revenue_license', $data);
    }

}