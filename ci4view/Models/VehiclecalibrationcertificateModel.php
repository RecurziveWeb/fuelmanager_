<?php


namespace App\Models;
use CodeIgniter\Model;

class VehiclecalibrationcertificateModel extends Model {
    
	protected $table = 'vehicle_calibration_certificate';
	protected $primaryKey = 'idvehicle_calibration_certificate';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['vehicle_calibration_certificate_name', 'vehicle_calibration_certificate_issue_date', 'vehicle_calibration_certificate_expiry_date', 'vehicle_calibration_certificate_is_active', 'vehicle_idvehicle'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function VehiclecalibrationcertificateModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM vehicle_calibration_certificate where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function VehiclecalibrationcertificateModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM vehicle_calibration_certificate');
        return $query->getResult();
	}

	public function vehiclecalibrationcertificateModelgetbyfk(){
$query = $this->db->query('select * from `vehicle_calibration_certificate`, `vehicle`  where  `vehicle_calibration_certificate`.`vehicle_idvehicle` = `vehicle`.`idvehicle`;');
return $query->getResult();
}

	
}