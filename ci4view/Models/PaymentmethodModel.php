<?php


namespace App\Models;
use CodeIgniter\Model;

class PaymentmethodModel extends Model {
    
	protected $table = 'paymentmethod';
	protected $primaryKey = 'idpaymentmethod';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['method_name'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function PaymentmethodModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM paymentmethod where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function PaymentmethodModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM paymentmethod');
        return $query->getResult();
	}

	
	
}