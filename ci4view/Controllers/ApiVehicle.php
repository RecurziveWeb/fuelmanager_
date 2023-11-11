<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\VehicleModel;
use App\Models\Vehicle_typeModel;
use App\Models\LocationModel;


class ApiVehicle extends BaseController
{
    use ResponseTrait;

    protected $vehicleModel;
    protected $vehicle_typeModel;
protected $locationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->vehicleModel = new VehicleModel();
        $this->vehicle_typeModel = new Vehicle_typeModel();
$this->locationModel = new LocationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $vehicle = new vehicleModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $vehicleData = $vehicle->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $vehicle->pager;

        return $this->respond([
            'vehicle' => $vehicleData,
            'pager' => $pager->makeLinks($page, $perPage, $vehicleData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $vehicle = new vehicleModel();

        $mainData = $this->$vehicle->find($id);
     
        $relatedDatavehicle_type = $this->vehicle_typeModel->find($mainData["vehicle_type_idvehicle_type"]);
$relatedDatalocation = $this->locationModel->find($mainData["Location_idLocation"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idvehicle' => $mainData['idvehicle'],
'vehicle_number' => $mainData['vehicle_number'],
'vehicle_chasis_number' => $mainData['vehicle_chasis_number'],
'vehicle_yom' => $mainData['vehicle_yom'],
'vehicle_no_of_passengers' => $mainData['vehicle_no_of_passengers'],
'vehicle_weight' => $mainData['vehicle_weight'],
'vehicle_is_available' => $mainData['vehicle_is_available'],
'vehicle_is_active' => $mainData['vehicle_is_active'],
'vehicle_type_idvehicle_type' => $mainData['vehicle_type_idvehicle_type'],
'Location_idLocation' => $mainData['Location_idLocation'],
'vehicle_type' => [ 
 'idvehicle_type' => $relatedDatavehicle_type['idvehicle_type'],
 'vehicle_capacity' => $relatedDatavehicle_type['vehicle_capacity'],
 'vehicle_type' => $relatedDatavehicle_type['vehicle_type'],
 'vehicle_type_is_active' => $relatedDatavehicle_type['vehicle_type_is_active'],
],
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

        $fields['idvehicle'] = $this->request->getPost('idvehicle');
$fields['vehicle_number'] = $this->request->getPost('vehicle_number');
$fields['vehicle_chasis_number'] = $this->request->getPost('vehicle_chasis_number');
$fields['vehicle_yom'] = $this->request->getPost('vehicle_yom');
$fields['vehicle_no_of_passengers'] = $this->request->getPost('vehicle_no_of_passengers');
$fields['vehicle_weight'] = $this->request->getPost('vehicle_weight');
$fields['vehicle_is_available'] = $this->request->getPost('vehicle_is_available');
$fields['vehicle_is_active'] = $this->request->getPost('vehicle_is_active');
$fields['vehicle_type_idvehicle_type'] = $this->request->getPost('vehicle_type_idvehicle_type');
$fields['Location_idLocation'] = $this->request->getPost('Location_idLocation');


        $this->validation->setRules([
			            'vehicle_number' => ['label' => 'Vehicle number', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_chasis_number' => ['label' => 'Vehicle chasis number', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_yom' => ['label' => 'Vehicle yom', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_no_of_passengers' => ['label' => 'Vehicle no of passengers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_weight' => ['label' => 'Vehicle weight', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_is_available' => ['label' => 'Vehicle is available', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_is_active' => ['label' => 'Vehicle is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_type_idvehicle_type' => ['label' => 'Vehicle type idvehicle type', 'rules' => 'required|min_length[0]|max_length[11]'],
            'Location_idLocation' => ['label' => 'Location idLocation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicleModel->insert($fields)) {
												
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
		
		$fields['idvehicle'] = $this->request->getPost('idvehicle');
$fields['vehicle_number'] = $this->request->getPost('vehicle_number');
$fields['vehicle_chasis_number'] = $this->request->getPost('vehicle_chasis_number');
$fields['vehicle_yom'] = $this->request->getPost('vehicle_yom');
$fields['vehicle_no_of_passengers'] = $this->request->getPost('vehicle_no_of_passengers');
$fields['vehicle_weight'] = $this->request->getPost('vehicle_weight');
$fields['vehicle_is_available'] = $this->request->getPost('vehicle_is_available');
$fields['vehicle_is_active'] = $this->request->getPost('vehicle_is_active');
$fields['vehicle_type_idvehicle_type'] = $this->request->getPost('vehicle_type_idvehicle_type');
$fields['Location_idLocation'] = $this->request->getPost('Location_idLocation');


        $this->validation->setRules([
			            'vehicle_number' => ['label' => 'Vehicle number', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_chasis_number' => ['label' => 'Vehicle chasis number', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_yom' => ['label' => 'Vehicle yom', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_no_of_passengers' => ['label' => 'Vehicle no of passengers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_weight' => ['label' => 'Vehicle weight', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'vehicle_is_available' => ['label' => 'Vehicle is available', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_is_active' => ['label' => 'Vehicle is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_type_idvehicle_type' => ['label' => 'Vehicle type idvehicle type', 'rules' => 'required|min_length[0]|max_length[11]'],
            'Location_idLocation' => ['label' => 'Location idLocation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicleModel->update($fields['idvehicle'], $fields)) {
				
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
		
			if ($this->vehicleModel->where('idvehicle', $id)->delete()) {
								
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
