<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MaterialpriceModel;


class Materialprice extends BaseController
{
	
    protected $materialpriceModel;
	
    protected $validation;
	
	public function __construct()
	{
	    $this->materialpriceModel = new MaterialpriceModel();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'materialprice',
			'title'     		=> 'materialprice'				
		];

		


		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/materialprice_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'materialprice',
			'title'     		=> 'materialprice'				
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

		$fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->materialpriceModel->insert($fields)) {
												
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
		
		$fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->materialpriceModel->update($fields['idmaterialprice'], $fields)) {
				
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
		
		$id = $this->request->getPost('idmaterialprice');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->materialpriceModel->where('idmaterialprice', $id)->delete()) {
								
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

		$result = $this->materialpriceModel->select()->findAll();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idmaterialprice .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idmaterialprice,
$value->materialtype,
$value->materialprice,
$value->material_is_active,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idmaterialprice');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->materialpriceModel->where('idmaterialprice' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->materialpriceModel->insert($fields)) {
												
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
		
		$fields['idmaterialprice'] = $this->request->getPost('idmaterialprice');
$fields['materialtype'] = $this->request->getPost('materialtype');
$fields['materialprice'] = $this->request->getPost('materialprice');
$fields['material_is_active'] = $this->request->getPost('material_is_active');


        $this->validation->setRules([
			            'materialtype' => ['label' => 'Materialtype', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'materialprice' => ['label' => 'Materialprice', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'material_is_active' => ['label' => 'Material is active', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->materialpriceModel->update($fields['idmaterialprice'], $fields)) {
				
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
		
		$id = $this->request->getPost('idmaterialprice');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->materialpriceModel->where('idmaterialprice', $id)->delete()) {
								
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
