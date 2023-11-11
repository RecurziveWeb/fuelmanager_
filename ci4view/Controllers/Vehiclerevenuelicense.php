<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\VehiclerevenuelicenseModel;
use App\Models\VehicleModel;


class Vehiclerevenuelicense extends BaseController
{
	
    protected $vehiclerevenuelicenseModel;
	protected $vehicleModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->vehiclerevenuelicenseModel = new VehiclerevenuelicenseModel();
		$this->vehicleModel = new VehicleModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'vehiclerevenuelicense',
			'title'     		=> 'vehicle_revenue_license'				
		];

		//$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/vehiclerevenuelicense_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'vehiclerevenuelicense',
			'title'     		=> 'vehicle_revenue_license'				
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

		$fields['idvehicle_revenue_license'] = $this->request->getPost('idvehicle_revenue_license');
$fields['vehicle_revenue_license_name'] = $this->request->getPost('vehicle_revenue_license_name');
$fields['vehicle_revenue_license_issue_date'] = $this->request->getPost('vehicle_revenue_license_issue_date');
$fields['vehicle_revenue_license_expiry_date'] = $this->request->getPost('vehicle_revenue_license_expiry_date');
$fields['vehicle_revenue_license_is_active'] = $this->request->getPost('vehicle_revenue_license_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_revenue_license_name' => ['label' => 'Vehicle revenue license name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_revenue_license_issue_date' => ['label' => 'Vehicle revenue license issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_expiry_date' => ['label' => 'Vehicle revenue license expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_is_active' => ['label' => 'Vehicle revenue license is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehiclerevenuelicenseModel->insert($fields)) {
												
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
		
		$fields['idvehicle_revenue_license'] = $this->request->getPost('idvehicle_revenue_license');
$fields['vehicle_revenue_license_name'] = $this->request->getPost('vehicle_revenue_license_name');
$fields['vehicle_revenue_license_issue_date'] = $this->request->getPost('vehicle_revenue_license_issue_date');
$fields['vehicle_revenue_license_expiry_date'] = $this->request->getPost('vehicle_revenue_license_expiry_date');
$fields['vehicle_revenue_license_is_active'] = $this->request->getPost('vehicle_revenue_license_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_revenue_license_name' => ['label' => 'Vehicle revenue license name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_revenue_license_issue_date' => ['label' => 'Vehicle revenue license issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_expiry_date' => ['label' => 'Vehicle revenue license expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_is_active' => ['label' => 'Vehicle revenue license is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehiclerevenuelicenseModel->update($fields['idvehicle_revenue_license'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_revenue_license');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehiclerevenuelicenseModel->where('idvehicle_revenue_license', $id)->delete()) {
								
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

		$result = $this->vehiclerevenuelicenseModel->vehiclerevenuelicenseModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idvehicle_revenue_license .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idvehicle_revenue_license,
$value->vehicle_revenue_license_name,
$value->vehicle_revenue_license_issue_date,
$value->vehicle_revenue_license_expiry_date,
$value->vehicle_revenue_license_is_active,
$value->vehicle_idvehicle,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idvehicle_revenue_license');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->vehiclerevenuelicenseModel->where('idvehicle_revenue_license' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['idvehicle_revenue_license'] = $this->request->getPost('idvehicle_revenue_license');
$fields['vehicle_revenue_license_name'] = $this->request->getPost('vehicle_revenue_license_name');
$fields['vehicle_revenue_license_issue_date'] = $this->request->getPost('vehicle_revenue_license_issue_date');
$fields['vehicle_revenue_license_expiry_date'] = $this->request->getPost('vehicle_revenue_license_expiry_date');
$fields['vehicle_revenue_license_is_active'] = $this->request->getPost('vehicle_revenue_license_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_revenue_license_name' => ['label' => 'Vehicle revenue license name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_revenue_license_issue_date' => ['label' => 'Vehicle revenue license issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_expiry_date' => ['label' => 'Vehicle revenue license expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_is_active' => ['label' => 'Vehicle revenue license is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehiclerevenuelicenseModel->insert($fields)) {
												
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
		
		$fields['idvehicle_revenue_license'] = $this->request->getPost('idvehicle_revenue_license');
$fields['vehicle_revenue_license_name'] = $this->request->getPost('vehicle_revenue_license_name');
$fields['vehicle_revenue_license_issue_date'] = $this->request->getPost('vehicle_revenue_license_issue_date');
$fields['vehicle_revenue_license_expiry_date'] = $this->request->getPost('vehicle_revenue_license_expiry_date');
$fields['vehicle_revenue_license_is_active'] = $this->request->getPost('vehicle_revenue_license_is_active');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');


        $this->validation->setRules([
			            'vehicle_revenue_license_name' => ['label' => 'Vehicle revenue license name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_revenue_license_issue_date' => ['label' => 'Vehicle revenue license issue date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_expiry_date' => ['label' => 'Vehicle revenue license expiry date', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'vehicle_revenue_license_is_active' => ['label' => 'Vehicle revenue license is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehiclerevenuelicenseModel->update($fields['idvehicle_revenue_license'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_revenue_license');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehiclerevenuelicenseModel->where('idvehicle_revenue_license', $id)->delete()) {
								
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
