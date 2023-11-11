<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentsModel extends CI_Model {

    public function get_documents()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('documents');
        return $query->result();
    }

    public function insert_documents($data) 
    {
        $this->db->insert('documents', $data);
        return $this->db->insert_id();
    }

    public function getwhere_documents($iddocuments)
    {
        $query = $this->db->get_where('documents', array('iddocuments' => $iddocuments));
        return $query->row();
    }

    public function update_documents($iddocuments, $data) {
        $this->db->where('iddocuments', $iddocuments);
        return $this->db->update('documents', $data);
    }

    public function delete_documents($iddocuments) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('iddocuments', $iddocuments);
        return $this->db->update('documents', $data);
    }

}