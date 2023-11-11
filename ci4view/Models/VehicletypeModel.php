<?php


namespace App\Models;
use CodeIgniter\Model;

class VehicletypeModel extends Model {
    
	protected $table = 'vehicle_type';
	protected $primaryKey = 'idvehicle_type';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['vehicle_capacity', 'vehicle_type', 'vehicle_type_is_active'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function VehicletypeModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM vehicle_type where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function VehicletypeModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM vehicle_type');
        return $query->getResult();
	}

	
	
}