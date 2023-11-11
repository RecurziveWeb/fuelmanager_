<?php


namespace App\Models;
use CodeIgniter\Model;

class VehicleModel extends Model {
    
	protected $table = 'vehicle';
	protected $primaryKey = 'idvehicle';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['vehicle_number', 'vehicle_chasis_number', 'vehicle_yom', 'vehicle_no_of_passengers', 'vehicle_weight', 'vehicle_is_available', 'vehicle_is_active', 'vehicle_type_idvehicle_type', 'Location_idLocation'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function VehicleModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM vehicle where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function VehicleModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM vehicle');
        return $query->getResult();
	}

	public function vehicleModelgetbyfk(){
$query = $this->db->query('select * from `vehicle`, `vehicle_type` , `location`  where  `vehicle`.`vehicle_type_idvehicle_type` = `vehicle_type`.`idvehicle_type` AND  `vehicle`.`Location_idLocation` = `location`.`idLocation`;');
return $query->getResult();
}

	
}