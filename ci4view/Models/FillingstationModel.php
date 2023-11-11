<?php


namespace App\Models;
use CodeIgniter\Model;

class FillingstationModel extends Model {
    
	protected $table = 'fillingstation';
	protected $primaryKey = 'idfillingstation';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['fillingstation_name', 'fillingstation_address', 'numberoffueldespencers', 'capacityofpetroltank', 'capacityofdieseltank', 'capacityofsuperpetrol', 'capacityofsuperdiesel', 'district', 'Users_idUsers', 'isapproved', 'approvedby'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function FillingstationModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM fillingstation where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function FillingstationModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM fillingstation');
        return $query->getResult();
	}

	public function fillingstationModelgetbyfk(){
$query = $this->db->query('select * from `fillingstation`, `users`  where  `fillingstation`.`Users_idUsers` = `users`.`idUsers`;');
return $query->getResult();
}

	
}