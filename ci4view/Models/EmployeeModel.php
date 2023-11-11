<?php


namespace App\Models;
use CodeIgniter\Model;

class EmployeeModel extends Model {
    
	protected $table = 'employee';
	protected $primaryKey = 'idemployee';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['fristname', 'lastname', 'epf', 'dateofbirth', 'isactive', 'isavailable', 'employeetype_idemployeetype'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function EmployeeModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM employee where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function EmployeeModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM employee');
        return $query->getResult();
	}

	public function employeeModelgetbyfk(){
$query = $this->db->query('select * from `employee`, `employeetype`  where  `employee`.`employeetype_idemployeetype` = `employeetype`.`idemployeetype`;');
return $query->getResult();
}

	
}