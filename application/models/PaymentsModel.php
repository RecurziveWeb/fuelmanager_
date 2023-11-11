<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentsModel extends CI_Model {

    public function get_payments()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('payments');
        return $query->result();
    }

    public function insert_payments($data) 
    {
        $this->db->insert('payments', $data);
        return $this->db->insert_id();
    }

    public function getwhere_payments($idpayments)
    {
        $query = $this->db->get_where('payments', array('idpayments' => $idpayments));
        return $query->row();
    }

    public function update_payments($idpayments, $data) {
        $this->db->where('idpayments', $idpayments);
        return $this->db->update('payments', $data);
    }

    public function delete_payments($idpayments) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idpayments', $idpayments);
        return $this->db->update('payments', $data);
    }

}