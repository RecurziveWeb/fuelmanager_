<?php


namespace App\Models;
use CodeIgniter\Model;

class PaymentsModel extends Model {
    
	protected $table = 'payments';
	protected $primaryKey = 'idpayments';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['paymentdate', 'isreceived', 'paymentmethod_idpaymentmethod', 'amount', 'orders_idorders'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function PaymentsModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM payments where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function PaymentsModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM payments');
        return $query->getResult();
	}

	public function paymentsModelgetbyfk(){
$query = $this->db->query('select * from `payments`, `paymentmethod` , `orders`  where  `payments`.`paymentmethod_idpaymentmethod` = `paymentmethod`.`idpaymentmethod` AND  `payments`.`orders_idorders` = `orders`.`idorders`;');
return $query->getResult();
}

	
}