<?php


namespace App\Models;
use CodeIgniter\Model;

class LocationModel extends Model {
    
	protected $table = 'location';
	protected $primaryKey = 'idLocation';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['locationname', 'location_is_active'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function LocationModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM location where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function LocationModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM location');
        return $query->getResult();
	}

	public function locationModelgetbyfk(){
$query = $this->db->query('select * from `location`, `location`  where  `location`.`location_is_active` = `location`.`idLocation`;');
return $query->getResult();
}

	
}