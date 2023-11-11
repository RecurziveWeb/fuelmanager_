<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\VehiclecalibrationcertificateModel;
use App\Models\VehicleModel;


class Vehiclecalibrationcertificate extends BaseController
{
	
    protected $vehiclecalibrationcertificateModel;
	protected $vehicleModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->vehiclecalibrationcertificateModel = new VehiclecalibrationcertificateModel();
		$this->vehicleModel = new VehicleModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'vehiclecalibrationcertificate',
			'title'     		=> 'vehicle_calibration_certificate'				
		];

		//$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/vehiclecalibrationcertificate_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'vehiclecalibrationcertificate',
			'title'     		=> 'vehicle_calibration_certificate'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehiclecalibrationcertificateModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehiclecalibrationcertificateModel->update($fields['idvehicle_calibration_certificate'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_calibration_certificate');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehiclecalibrationcertificateModel->where('idvehicle_calibration_certificate', $id)->delete()) {
								
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

		$result = $this->vehiclecalibrationcertificateModel->vehiclecalibrationcertificateModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idvehicle_calibration_certificate .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idvehicle_calibration_certificate,
$value->vehicle_calibration_certificate_name,
$value->vehicle_calibration_certificate_issue_date,
$value->vehicle_calibration_certificate_expiry_date,
$value->vehicle_calibration_certificate_is_active,
$value->vehicle_idvehicle,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idvehicle_calibration_certificate');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->vehiclecalibrationcertificateModel->where('idvehicle_calibration_certificate' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehiclecalibrationcertificateModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehiclecalibrationcertificateModel->update($fields['idvehicle_calibration_certificate'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_calibration_certificate');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehiclecalibrationcertificateModel->where('idvehicle_calibration_certificate', $id)->delete()) {
								
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
