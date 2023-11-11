<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\VehiclecalibrationcertificateModel;
use App\Models\VehicleModel;


class ApiVehiclecalibrationcertificate extends BaseController
{
    use ResponseTrait;

    protected $vehiclecalibrationcertificateModel;
    protected $vehicleModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->vehiclecalibrationcertificateModel = new VehiclecalibrationcertificateModel();
        $this->vehicleModel = new VehicleModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $vehicle_calibration_certificate = new vehiclecalibrationcertificateModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $vehicle_calibration_certificateData = $vehicle_calibration_certificate->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $vehicle_calibration_certificate->pager;

        return $this->respond([
            'vehicle_calibration_certificate' => $vehicle_calibration_certificateData,
            'pager' => $pager->makeLinks($page, $perPage, $vehicle_calibration_certificateData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $vehicle_calibration_certificate = new vehiclecalibrationcertificateModel();

        $mainData = $this->$vehicle_calibration_certificate->find($id);
     
        $relatedDatavehicle = $this->vehicleModel->find($mainData["vehicle_idvehicle"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idvehicle_calibration_certificate' => $mainData['idvehicle_calibration_certificate'],
'vehicle_calibration_certificate_name' => $mainData['vehicle_calibration_certificate_name'],
'vehicle_calibration_certificate_issue_date' => $mainData['vehicle_calibration_certificate_issue_date'],
'vehicle_calibration_certificate_expiry_date' => $mainData['vehicle_calibration_certificate_expiry_date'],
'vehicle_calibration_certificate_is_active' => $mainData['vehicle_calibration_certificate_is_active'],
'vehicle_idvehicle' => $mainData['vehicle_idvehicle'],
'vehicle' => [ 
 'idvehicle' => $relatedDatavehicle['idvehicle'],
 'vehicle_number' => $relatedDatavehicle['vehicle_number'],
 'vehicle_chasis_number' => $relatedDatavehicle['vehicle_chasis_number'],
 'vehicle_yom' => $relatedDatavehicle['vehicle_yom'],
 'vehicle_no_of_passengers' => $relatedDatavehicle['vehicle_no_of_passengers'],
 'vehicle_weight' => $relatedDatavehicle['vehicle_weight'],
 'vehicle_is_available' => $relatedDatavehicle['vehicle_is_available'],
 'vehicle_is_active' => $relatedDatavehicle['vehicle_is_active'],
 'vehicle_type_idvehicle_type' => $relatedDatavehicle['vehicle_type_idvehicle_type'],
 'Location_idLocation' => $relatedDatavehicle['Location_idLocation'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idvehicle_calibration_certificate'] = $this->request->getPost('idvehicle_calibration_certificate');
$fields['vehicle_calibration_certificate_name'] = $this->request->getPost('vehicle_calibration_certificate_name');
$fields['vehicle_calibration_certificate_issue_date'] = $this->request->getPost('vehicle_calibration_certificate_issue_date');
$fields['vehicle_calibration_certificate_expiry_date'] = $this->request->getPost('vehicle_calibration_certificate_expiry_date');
$fields['vehicle_calibration_certificate_is_active'] = $this->request->getPost('vehicle_calibration_certificate_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_calibration_certificate_name' => ['label' => 'Vehicle calibration certificate name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_calibration_certificate_issue_date' => ['label' => 'Vehicle calibration certificate issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_calibration_certificate_expiry_date' => ['label' => 'Vehicle calibration certificate expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_calibration_certificate_is_active' => ['label' => 'Vehicle calibration certificate is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehiclecalibrationcertificateModel->insert($fields)) {
												
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
		
		$fields['idvehicle_calibration_certificate'] = $this->request->getPost('idvehicle_calibration_certificate');
$fields['vehicle_calibration_certificate_name'] = $this->request->getPost('vehicle_calibration_certificate_name');
$fields['vehicle_calibration_certificate_issue_date'] = $this->request->getPost('vehicle_calibration_certificate_issue_date');
$fields['vehicle_calibration_certificate_expiry_date'] = $this->request->getPost('vehicle_calibration_certificate_expiry_date');
$fields['vehicle_calibration_certificate_is_active'] = $this->request->getPost('vehicle_calibration_certificate_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_calibration_certificate_name' => ['label' => 'Vehicle calibration certificate name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_calibration_certificate_issue_date' => ['label' => 'Vehicle calibration certificate issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_calibration_certificate_expiry_date' => ['label' => 'Vehicle calibration certificate expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_calibration_certificate_is_active' => ['label' => 'Vehicle calibration certificate is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehiclecalibrationcertificateModel->update($fields['idvehicle_calibration_certificate'], $fields)) {
				
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
		
			if ($this->vehiclecalibrationcertificateModel->where('idvehicle_calibration_certificate', $id)->delete()) {
								
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
