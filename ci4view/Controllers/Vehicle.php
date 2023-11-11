<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\VehicleModel;
use App\Models\Vehicle_typeModel;
use App\Models\LocationModel;


class Vehicle extends BaseController
{
	
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
	
	public function index()
	{
		$data = [
			'controller'    	=> 'vehicle',
			'title'     		=> 'vehicle'				
		];

		//$data["selectdata_vehicle_type"] = $this->vehicle_typeModel->Vehicle_typeModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_vehicle_type"] = $this->vehicle_typeModel->Vehicle_typeModelgetlist($column, $colid);
//$data["selectdata_location"] = $this->locationModel->LocationModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_location"] = $this->locationModel->LocationModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/vehicle_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'vehicle',
			'title'     		=> 'vehicle'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicleModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicleModel->update($fields['idvehicle'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehicleModel->where('idvehicle', $id)->delete()) {
								
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

		$result = $this->vehicleModel->vehicleModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idvehicle .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idvehicle,
$value->vehicle_number,
$value->vehicle_chasis_number,
$value->vehicle_yom,
$value->vehicle_no_of_passengers,
$value->vehicle_weight,
$value->vehicle_is_available,
$value->vehicle_is_active,
$value->vehicle_type_idvehicle_type,
$value->Location_idLocation,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idvehicle');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->vehicleModel->where('idvehicle' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicleModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicleModel->update($fields['idvehicle'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehicleModel->where('idvehicle', $id)->delete()) {
								
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
