<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersModel extends CI_Model {

    public function get_orders()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('orders');
        return $query->result();
    }

    public function insert_orders($data) 
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function getwhere_orders($idorders)
    {
        $query = $this->db->get_where('orders', array('idorders' => $idorders));
        return $query->row();
    }

    public function update_orders($idorders, $data) {
        $this->db->where('idorders', $idorders);
        return $this->db->update('orders', $data);
    }

    public function delete_orders($idorders) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idorders', $idorders);
        return $this->db->update('orders', $data);
    }

}