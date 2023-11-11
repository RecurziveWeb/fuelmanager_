<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\EmployeetypeModel;


class ApiEmployeetype extends BaseController
{
    use ResponseTrait;

    protected $employeetypeModel;
    
    protected $validation;
	
	public function __construct()
	{
	    $this->employeetypeModel = new EmployeetypeModel();
        
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $employeetype = new employeetypeModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $employeetypeData = $employeetype->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $employeetype->pager;

        return $this->respond([
            'employeetype' => $employeetypeData,
            'pager' => $pager->makeLinks($page, $perPage, $employeetypeData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $employeetype = new employeetypeModel();

        $mainData = $this->$employeetype->find($id);
     
        

         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idemployeetype' => $mainData['idemployeetype'],
'employeetype' => $mainData['employeetype'],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idemployeetype'] = $this->request->getPost('idemployeetype');
$fields['employeetype'] = $this->request->getPost('employeetype');


        $this->validation->setRules([
			            'employeetype' => ['label' => 'Employeetype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->employeetypeModel->insert($fields)) {
												
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
		
		$fields['idemployeetype'] = $this->request->getPost('idemployeetype');
$fields['employeetype'] = $this->request->getPost('employeetype');


        $this->validation->setRules([
			            'employeetype' => ['label' => 'Employeetype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->employeetypeModel->update($fields['idemployeetype'], $fields)) {
				
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
		
			if ($this->employeetypeModel->where('idemployeetype', $id)->delete()) {
								
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
