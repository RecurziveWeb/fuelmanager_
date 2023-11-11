<?php


namespace App\Models;
use CodeIgniter\Model;

class OrderitemsModel extends Model {
    
	protected $table = 'orderitems';
	protected $primaryKey = 'idorderitems';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['itemname', 'qty', 'itemamount', 'orders_idorders'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function OrderitemsModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM orderitems where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function OrderitemsModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM orderitems');
        return $query->getResult();
	}

	public function orderitemsModelgetbyfk(){
$query = $this->db->query('select * from `orderitems`, `orders`  where  `orderitems`.`orders_idorders` = `orders`.`idorders`;');
return $query->getResult();
}

	
}