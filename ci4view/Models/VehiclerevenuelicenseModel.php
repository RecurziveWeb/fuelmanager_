<?php


namespace App\Models;
use CodeIgniter\Model;

class VehiclerevenuelicenseModel extends Model {
    
	protected $table = 'vehicle_revenue_license';
	protected $primaryKey = 'idvehicle_revenue_license';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['vehicle_revenue_license_name', 'vehicle_revenue_license_issue_date', 'vehicle_revenue_license_expiry_date', 'vehicle_revenue_license_is_active', 'vehicle_idvehicle'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function VehiclerevenuelicenseModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM vehicle_revenue_license where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function VehiclerevenuelicenseModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM vehicle_revenue_license');
        return $query->getResult();
	}

	public function vehiclerevenuelicenseModelgetbyfk(){
$query = $this->db->query('select * from `vehicle_revenue_license`, `vehicle`  where  `vehicle_revenue_license`.`vehicle_idvehicle` = `vehicle`.`idvehicle`;');
return $query->getResult();
}

	
}