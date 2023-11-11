<?php


namespace App\Models;
use CodeIgniter\Model;

class DailydipModel extends Model {
    
	protected $table = 'dailydip';
	protected $primaryKey = 'iddailydip';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['checkdate', 'petrol', 'diesel', 'superdiesel', 'superpetrol', 'fillingstation_idfillingstation'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function DailydipModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM dailydip where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function DailydipModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM dailydip');
        return $query->getResult();
	}

	public function dailydipModelgetbyfk(){
$query = $this->db->query('select * from `dailydip`, `fillingstation`  where  `dailydip`.`fillingstation_idfillingstation` = `fillingstation`.`idfillingstation`;');
return $query->getResult();
}

	
}