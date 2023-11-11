<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FillingstationModel extends CI_Model {

    public function get_fillingstation()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('fillingstation');
        return $query->result();
    }

    public function insert_fillingstation($data) 
    {
        $this->db->insert('fillingstation', $data);
        return $this->db->insert_id();
    }

    public function getwhere_fillingstation($idfillingstation)
    {
        $query = $this->db->get_where('fillingstation', array('idfillingstation' => $idfillingstation));
        return $query->row();
    }

    public function update_fillingstation($idfillingstation, $data) {
        $this->db->where('idfillingstation', $idfillingstation);
        return $this->db->update('fillingstation', $data);
    }

    public function delete_fillingstation($idfillingstation) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idfillingstation', $idfillingstation);
        return $this->db->update('fillingstation', $data);
    }

    public function get_fillingstation_unapproved()
    {
        $this->db->where('isdelete', false);
        $this->db->where('isapproved', false);
        $query = $this->db->get('fillingstation');
        return $query->result();
    }

    public function get_fillingstation_unapprovedbyid($id)
    {
        $this->db->where('isdelete', false);
        $this->db->where('isapproved', false);
        $this->db->where('idfillingstation', $id);
        $query = $this->db->get('fillingstation');
        return $query->result();
    }

    public function get_fillingstation_byid($id)
    {
        $this->db->where('isdelete', false);
        $this->db->where('isapproved', true);
        $this->db->where('idfillingstation', $id);
        $query = $this->db->get('fillingstation');
        return $query->result();
    }

    public function get_fillingstation_byuserid($userid)
    {
        $this->db->where('isdelete', false);
        $this->db->where('isapproved', true);
        $this->db->where('Users_idUsers', $userid);
        $query = $this->db->get('fillingstation');
        return $query->result();
    }

}