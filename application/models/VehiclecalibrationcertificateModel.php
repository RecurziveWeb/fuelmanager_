<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehiclecalibrationcertificateModel extends CI_Model {

    public function get_vehicle_calibration_certificate()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('vehicle_calibration_certificate');
        return $query->result();
    }

    public function insert_vehicle_calibration_certificate($data) 
    {
        $this->db->insert('vehicle_calibration_certificate', $data);
        return $this->db->insert_id();
    }

    public function getwhere_vehicle_calibration_certificate($idvehicle_calibration_certificate)
    {
        $query = $this->db->get_where('vehicle_calibration_certificate', array('idvehicle_calibration_certificate' => $idvehicle_calibration_certificate));
        return $query->row();
    }

    public function update_vehicle_calibration_certificate($idvehicle_calibration_certificate, $data) {
        $this->db->where('idvehicle_calibration_certificate', $idvehicle_calibration_certificate);
        return $this->db->update('vehicle_calibration_certificate', $data);
    }

    public function delete_vehicle_calibration_certificate($idvehicle_calibration_certificate) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idvehicle_calibration_certificate', $idvehicle_calibration_certificate);
        return $this->db->update('vehicle_calibration_certificate', $data);
    }

}