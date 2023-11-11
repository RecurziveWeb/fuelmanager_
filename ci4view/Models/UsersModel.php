<?php


namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model {
    
	protected $table = 'users';
	protected $primaryKey = 'idUsers';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'isadmin', 'isdealer', 'isdriver', 'phonenumber'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function UsersModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM users where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function UsersModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM users');
        return $query->getResult();
	}

	
	
}