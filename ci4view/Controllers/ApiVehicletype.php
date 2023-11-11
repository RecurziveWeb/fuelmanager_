<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\VehicletypeModel;


class ApiVehicletype extends BaseController
{
    use ResponseTrait;

    protected $vehicletypeModel;
    
    protected $validation;
	
	public function __construct()
	{
	    $this->vehicletypeModel = new VehicletypeModel();
        
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $vehicle_type = new vehicletypeModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $vehicle_typeData = $vehicle_type->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $vehicle_type->pager;

        return $this->respond([
            'vehicle_type' => $vehicle_typeData,
            'pager' => $pager->makeLinks($page, $perPage, $vehicle_typeData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $vehicle_type = new vehicletypeModel();

        $mainData = $this->$vehicle_type->find($id);
     
        

         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idvehicle_type' => $mainData['idvehicle_type'],
'vehicle_capacity' => $mainData['vehicle_capacity'],
'vehicle_type' => $mainData['vehicle_type'],
'vehicle_type_is_active' => $mainData['vehicle_type_is_active'],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idvehicle_type'] = $this->request->getPost('idvehicle_type');
$fields['vehicle_capacity'] = $this->request->getPost('vehicle_capacity');
$fields['vehicle_type'] = $this->request->getPost('vehicle_type');
$fields['vehicle_type_is_active'] = $this->request->getPost('vehicle_type_is_active');


        $this->validation->setRules([
			            'vehicle_capacity' => ['label' => 'Vehicle capacity', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_type' => ['label' => 'Vehicle type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_type_is_active' => ['label' => 'Vehicle type is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicletypeModel->insert($fields)) {
												
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
		
		$fields['idvehicle_type'] = $this->request->getPost('idvehicle_type');
$fields['vehicle_capacity'] = $this->request->getPost('vehicle_capacity');
$fields['vehicle_type'] = $this->request->getPost('vehicle_type');
$fields['vehicle_type_is_active'] = $this->request->getPost('vehicle_type_is_active');


        $this->validation->setRules([
			            'vehicle_capacity' => ['label' => 'Vehicle capacity', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_type' => ['label' => 'Vehicle type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_type_is_active' => ['label' => 'Vehicle type is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicletypeModel->update($fields['idvehicle_type'], $fields)) {
				
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
		
			if ($this->vehicletypeModel->where('idvehicle_type', $id)->delete()) {
								
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
