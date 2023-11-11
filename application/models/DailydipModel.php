<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailydipModel extends CI_Model {

    public function get_dailydip()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('dailydip');
        return $query->result();
    }

    public function insert_dailydip($data) 
    {
        $this->db->insert('dailydip', $data);
        return $this->db->insert_id();
    }

    public function getwhere_dailydip($iddailydip)
    {
        $query = $this->db->get_where('dailydip', array('iddailydip' => $iddailydip));
        return $query->row();
    }

    public function update_dailydip($iddailydip, $data) {
        $this->db->where('iddailydip', $iddailydip);
        return $this->db->update('dailydip', $data);
    }

    public function delete_dailydip($iddailydip) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('iddailydip', $iddailydip);
        return $this->db->update('dailydip', $data);
    }
    
}