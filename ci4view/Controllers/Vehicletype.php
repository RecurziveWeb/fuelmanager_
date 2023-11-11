<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\VehicletypeModel;


class Vehicletype extends BaseController
{
	
    protected $vehicletypeModel;
	
    protected $validation;
	
	public function __construct()
	{
	    $this->vehicletypeModel = new VehicletypeModel();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'vehicletype',
			'title'     		=> 'vehicle_type'				
		];

		


		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/vehicletype_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'vehicletype',
			'title'     		=> 'vehicle_type'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicletypeModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicletypeModel->update($fields['idvehicle_type'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_type');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehicletypeModel->where('idvehicle_type', $id)->delete()) {
								
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

		$result = $this->vehicletypeModel->select()->findAll();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idvehicle_type .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idvehicle_type,
$value->vehicle_capacity,
$value->vehicle_type,
$value->vehicle_type_is_active,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idvehicle_type');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->vehicletypeModel->where('idvehicle_type' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->vehicletypeModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->vehicletypeModel->update($fields['idvehicle_type'], $fields)) {
				
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
		
		$id = $this->request->getPost('idvehicle_type');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->vehicletypeModel->where('idvehicle_type', $id)->delete()) {
								
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
