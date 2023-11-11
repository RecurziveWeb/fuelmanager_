<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\LocationModel;
use App\Models\LocationModel;


class Location extends BaseController
{
	
    protected $locationModel;
	protected $locationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->locationModel = new LocationModel();
		$this->locationModel = new LocationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'location',
			'title'     		=> 'location'				
		];

		//$data["selectdata_location"] = $this->locationModel->LocationModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_location"] = $this->locationModel->LocationModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/location_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'location',
			'title'     		=> 'location'				
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

		$fields['idLocation'] = $this->request->getPost('idLocation');
$fields['locationname'] = $this->request->getPost('locationname');
$fields['location_is_active'] = $this->request->getPost('location_is_active');


        $this->validation->setRules([
			            'locationname' => ['label' => 'Locationname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'location_is_active' => ['label' => 'Location is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->locationModel->insert($fields)) {
												
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
		
		$fields['idLocation'] = $this->request->getPost('idLocation');
$fields['locationname'] = $this->request->getPost('locationname');
$fields['location_is_active'] = $this->request->getPost('location_is_active');


        $this->validation->setRules([
			            'locationname' => ['label' => 'Locationname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'location_is_active' => ['label' => 'Location is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->locationModel->update($fields['idLocation'], $fields)) {
				
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
		
		$id = $this->request->getPost('idLocation');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->locationModel->where('idLocation', $id)->delete()) {
								
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

		$result = $this->locationModel->locationModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idLocation .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idLocation,
$value->locationname,
$value->location_is_active,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idLocation');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->locationModel->where('idLocation' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->locationModel->insert($fields)) {
												
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
		
		$fields['idLocation'] = $this->request->getPost('idLocation');
$fields['locationname'] = $this->request->getPost('locationname');
$fields['location_is_active'] = $this->request->getPost('location_is_active');


        $this->validation->setRules([
			            'locationname' => ['label' => 'Locationname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'location_is_active' => ['label' => 'Location is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->locationModel->update($fields['idLocation'], $fields)) {
				
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
		
		$id = $this->request->getPost('idLocation');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->locationModel->where('idLocation', $id)->delete()) {
								
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
