<?php


namespace App\Models;
use CodeIgniter\Model;

class DocumentsModel extends Model {
    
	protected $table = 'documents';
	protected $primaryKey = 'iddocuments';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['type', 'filename', 'uploaddate', 'isapproved', 'fillingstation_idfillingstation', 'approvedby'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function DocumentsModelgetbyid($column, $colid, $value, $valueid)
	{
		$query = $this->db->query('SELECT '.$value.' as keyvalue, '.$valueid.' as keyid FROM documents where '.$column.' = '.$colid);
        return $query->getResult();
	}
	
	public function DocumentsModelgetlist($column, $colid)
	{
		$query = $this->db->query('SELECT '.$column.' as keyvalue, '.$colid.' as keyid FROM documents');
        return $query->getResult();
	}

	public function documentsModelgetbyfk(){
$query = $this->db->query('select * from `documents`, `fillingstation`  where  `documents`.`fillingstation_idfillingstation` = `fillingstation`.`idfillingstation`;');
return $query->getResult();
}

	
}