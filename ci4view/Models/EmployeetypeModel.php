<?php


namespace App\Models;
use CodeIgniter\Model;

class EmployeetypeModel extends Model {
    
	protected $table = 'employeetype';
	protected $primaryKey = 'idemployeetype';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['employeetype'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function EmployeetypeModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM employeetype where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function EmployeetypeModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM employeetype');
        return $query->getResult();
	}

	
	
}