<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DocumentsModel;
use App\Models\FillingstationModel;


class Documents extends BaseController
{
	
    protected $documentsModel;
	protected $fillingstationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->documentsModel = new DocumentsModel();
		$this->fillingstationModel = new FillingstationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'documents',
			'title'     		=> 'documents'				
		];

		//$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/documents_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'documents',
			'title'     		=> 'documents'				
		];

		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/",$data);
		echo view("admin/layouts/footer",$data);
	}

	
	public function insert()
	{
        $response = array();

		$fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->documentsModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success") ;	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function update()
	{
        $response = array();
		
		$fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->documentsModel->update($fields['iddocuments'], $fields)) {
				
                $response['success'] = true;
                $response['messages'] = lang("App.update-success");	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.update-error");
				
            }
        }
		
        return $this->response->setJSON($response);	
	}
	
	public function delete()
	{
		$response = array();
		
		$id = $this->request->getPost('iddocuments');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->documentsModel->where('iddocuments', $id)->delete()) {
								
				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");	
				
			} else {
				
				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->documentsModel->documentsModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->iddocuments .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->iddocuments,
$value->type,
$value->filename,
$value->uploaddate,
$value->isapproved,
$value->fillingstation_idfillingstation,
$value->approvedby,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('iddocuments');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->documentsModel->where('iddocuments' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->documentsModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success") ;	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function edit()
	{
        $response = array();
		
		$fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->documentsModel->update($fields['iddocuments'], $fields)) {
				
                $response['success'] = true;
                $response['messages'] = lang("App.update-success");	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.update-error");
				
            }
        }
		
        return $this->response->setJSON($response);	
	}
	
	public function remove()
	{
		$response = array();
		
		$id = $this->request->getPost('iddocuments');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->documentsModel->where('iddocuments', $id)->delete()) {
								
				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");	
				
			} else {
				
				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	
