<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\LocationModel;
use App\Models\LocationModel;


class ApiLocation extends BaseController
{
    use ResponseTrait;

    protected $locationModel;
    protected $locationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->locationModel = new LocationModel();
        $this->locationModel = new LocationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $location = new locationModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $locationData = $location->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $location->pager;

        return $this->respond([
            'location' => $locationData,
            'pager' => $pager->makeLinks($page, $perPage, $locationData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $location = new locationModel();

        $mainData = $this->$location->find($id);
     
        $relatedDatalocation = $this->locationModel->find($mainData["location_is_active"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idLocation' => $mainData['idLocation'],
'locationname' => $mainData['locationname'],
'location_is_active' => $mainData['location_is_active'],
'location' => [ 
 'idLocation' => $relatedDatalocation['idLocation'],
 'locationname' => $relatedDatalocation['locationname'],
 'location_is_active' => $relatedDatalocation['location_is_active'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idLocation'] = $this->request->getPost('idLocation');
$fields['locationname'] = $this->request->getPost('locationname');
$fields['location_is_active'] = $this->request->getPost('location_is_active');


        $this->validation->setRules([
			            'locationname' => ['label' => 'Locationname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'location_is_active' => ['label' => 'Location is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->locationModel->insert($fields)) {
												
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
		
		$fields['idLocation'] = $this->request->getPost('idLocation');
$fields['locationname'] = $this->request->getPost('locationname');
$fields['location_is_active'] = $this->request->getPost('location_is_active');


        $this->validation->setRules([
			            'locationname' => ['label' => 'Locationname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'location_is_active' => ['label' => 'Location is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->locationModel->update($fields['idLocation'], $fields)) {
				
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
		
			if ($this->locationModel->where('idLocation', $id)->delete()) {
								
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
