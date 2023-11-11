<?php


namespace App\Models;
use CodeIgniter\Model;

class MaterialpriceModel extends Model {
    
	protected $table = 'materialprice';
	protected $primaryKey = 'idmaterialprice';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['materialtype', 'materialprice', 'material_is_active'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function MaterialpriceModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM materialprice where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function MaterialpriceModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM materialprice');
        return $query->getResult();
	}

	
	
}