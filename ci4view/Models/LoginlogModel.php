<?php


namespace App\Models;
use CodeIgniter\Model;

class LoginlogModel extends Model {
    
	protected $table = 'loginlog';
	protected $primaryKey = 'idloginlog';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['logindate', 'Users_idUsers', 'otpcode', 'iscorrect'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function LoginlogModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM loginlog where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function LoginlogModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM loginlog');
        return $query->getResult();
	}

	public function loginlogModelgetbyfk(){
$query = $this->db->query('select * from `loginlog`, `users`  where  `loginlog`.`Users_idUsers` = `users`.`idUsers`;');
return $query->getResult();
}

	
}