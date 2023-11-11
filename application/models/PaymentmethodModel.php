<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentmethodModel extends CI_Model {

    public function get_paymentmethod()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('paymentmethod');
        return $query->result();
    }

    public function insert_paymentmethod($data) 
    {
        $this->db->insert('paymentmethod', $data);
        return $this->db->insert_id();
    }

    public function getwhere_paymentmethod($idpaymentmethod)
    {
        $query = $this->db->get_where('paymentmethod', array('idpaymentmethod' => $idpaymentmethod));
        return $query->row();
    }

    public function update_paymentmethod($idpaymentmethod, $data) {
        $this->db->where('idpaymentmethod', $idpaymentmethod);
        return $this->db->update('paymentmethod', $data);
    }

    public function delete_paymentmethod($idpaymentmethod) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idpaymentmethod', $idpaymentmethod);
        return $this->db->update('paymentmethod', $data);
    }

}