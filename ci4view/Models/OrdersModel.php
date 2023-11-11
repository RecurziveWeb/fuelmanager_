<?php


namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model {
    
	protected $table = 'orders';
	protected $primaryKey = 'idorders';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['orderdate', 'amount', 'discount', 'tax', 'isapproved', 'fillingstation_idfillingstation', 'approvedby', 'vehicle_idvehicle', 'employee_idemployee'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function OrdersModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM orders where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function OrdersModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM orders');
        return $query->getResult();
	}

	public function ordersModelgetbyfk(){
$query = $this->db->query('select * from `orders`, `fillingstation` , `vehicle` , `employee`  where  `orders`.`fillingstation_idfillingstation` = `fillingstation`.`idfillingstation` AND  `orders`.`vehicle_idvehicle` = `vehicle`.`idvehicle` AND  `orders`.`employee_idemployee` = `employee`.`idemployee`;');
return $query->getResult();
}

	
}