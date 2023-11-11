<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaterialpriceModel extends CI_Model {

    public function get_materialprice()
    {
        $this->db->where('isdelete', false);
        $query = $this->db->get('materialprice');
        return $query->result();
    }

    public function insert_materialprice($data,$mattype) 
    {
        $this->db->where('materialtype', $mattype);
        $this->db->set('material_is_active', 0);
        $this->db->update('materialprice');

        $this->db->insert('materialprice', $data);
        return $this->db->insert_id();
    }

    public function getwhere_materialprice($idmaterialprice)
    {
        $query = $this->db->get_where('materialprice', array('idmaterialprice' => $idmaterialprice));
        return $query->row();
    }

    public function update_materialprice($idmaterialprice, $data) {
        $this->db->where('idmaterialprice', $idmaterialprice);
        return $this->db->update('materialprice', $data);
    }

    public function delete_materialprice($idmaterialprice) {
        $data = array(
            'isdelete' => 1,
        );
        $this->db->where('idmaterialprice', $idmaterialprice);
        return $this->db->update('materialprice', $data);
    }

    public function get_materialpricetoday()
    {
        $this->db->where('isdelete', false);
        $this->db->where('material_is_active', 1);
        $query = $this->db->get('materialprice');
        return $query->result();
    }

}