<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\MaterialpriceModel;


class ApiMaterialprice extends BaseController
{
    use ResponseTrait;

    protected $materialpriceModel;
    
    protected $validation;
	
	public function __construct()
	{
	    $this->materialpriceModel = new MaterialpriceModel();
        
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $materialprice = new materialpriceModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $materialpriceData = $materialprice->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $materialprice->pager;

        return $this->respond([
            'materialprice' => $materialpriceData,
            'pager' => $pager->makeLinks($page, $perPage, $materialpriceData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $materialprice = new materialpriceModel();

        $mainData = $this->$materialprice->find($id);
     
        

         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idmaterialprice' => $mainData['idmaterialprice'],
'materialtype' => $mainData['materialtype'],
'materialprice' => $mainData['materialprice'],
'material_is_active' => $mainData['material_is_active'],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->materialpriceModel->insert($fields)) {
												
                $response['status'] = "success";
                $response['messages'] = lang("App.insert-success") ;	
				
            } else {
				
                $response['success'] = "fail";
                $response['messages'] = lang("App.insert-error") ;
				
            }
        }

		
        return $this->response->setJSON($response);

	}

	
	public function update()
	{
        $response = array();
		
		$fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->materialpriceModel->update($fields['idmaterialprice'], $fields)) {
				
                $response['status'] = "success";
                $response['messages'] = lang("App.update-success");	
				
            } else {
				
                $response['status'] = "fail";
                $response['messages'] = lang("App.update-error");
				
            }
        }
		
        return $this->response->setJSON($response);	
	}
	
	public function delete($id)
	{
		$response = array();
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->materialpriceModel->where('idmaterialprice', $id)->delete()) {
								
				$response['status'] = "success";
				$response['messages'] = lang("App.delete-success");	
				
			} else {
				
				$response['status'] = "fail";
				$response['messages'] = lang("App.delete-error");
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	

}	
