<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DailydipModel;
use App\Models\FillingstationModel;


class Dailydip extends BaseController
{
	
    protected $dailydipModel;
	protected $fillingstationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->dailydipModel = new DailydipModel();
		$this->fillingstationModel = new FillingstationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'dailydip',
			'title'     		=> 'dailydip'				
		];

		//$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/dailydip_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'dailydip',
			'title'     		=> 'dailydip'				
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

		$fields['iddailydip'] = $this->request->getPost('iddailydip');
$fields['checkdate'] = $this->request->getPost('checkdate');
$fields['petrol'] = $this->request->getPost('petrol');
$fields['diesel'] = $this->request->getPost('diesel');
$fields['superdiesel'] = $this->request->getPost('superdiesel');
$fields['superpetrol'] = $this->request->getPost('superpetrol');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');


        $this->validation->setRules([
			            'checkdate' => ['label' => 'Checkdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'petrol' => ['label' => 'Petrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'diesel' => ['label' => 'Diesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superdiesel' => ['label' => 'Superdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superpetrol' => ['label' => 'Superpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->dailydipModel->insert($fields)) {
												
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
		
		$fields['iddailydip'] = $this->request->getPost('iddailydip');
$fields['checkdate'] = $this->request->getPost('checkdate');
$fields['petrol'] = $this->request->getPost('petrol');
$fields['diesel'] = $this->request->getPost('diesel');
$fields['superdiesel'] = $this->request->getPost('superdiesel');
$fields['superpetrol'] = $this->request->getPost('superpetrol');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');


        $this->validation->setRules([
			            'checkdate' => ['label' => 'Checkdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'petrol' => ['label' => 'Petrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'diesel' => ['label' => 'Diesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superdiesel' => ['label' => 'Superdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superpetrol' => ['label' => 'Superpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->dailydipModel->update($fields['iddailydip'], $fields)) {
				
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
		
		$id = $this->request->getPost('iddailydip');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->dailydipModel->where('iddailydip', $id)->delete()) {
								
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

		$result = $this->dailydipModel->dailydipModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->iddailydip .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->iddailydip,
$value->checkdate,
$value->petrol,
$value->diesel,
$value->superdiesel,
$value->superpetrol,
$value->fillingstation_idfillingstation,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('iddailydip');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->dailydipModel->where('iddailydip' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['iddailydip'] = $this->request->getPost('iddailydip');
$fields['checkdate'] = $this->request->getPost('checkdate');
$fields['petrol'] = $this->request->getPost('petrol');
$fields['diesel'] = $this->request->getPost('diesel');
$fields['superdiesel'] = $this->request->getPost('superdiesel');
$fields['superpetrol'] = $this->request->getPost('superpetrol');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');


        $this->validation->setRules([
			            'checkdate' => ['label' => 'Checkdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'petrol' => ['label' => 'Petrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'diesel' => ['label' => 'Diesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superdiesel' => ['label' => 'Superdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superpetrol' => ['label' => 'Superpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->dailydipModel->insert($fields)) {
												
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
		
		$fields['iddailydip'] = $this->request->getPost('iddailydip');
$fields['checkdate'] = $this->request->getPost('checkdate');
$fields['petrol'] = $this->request->getPost('petrol');
$fields['diesel'] = $this->request->getPost('diesel');
$fields['superdiesel'] = $this->request->getPost('superdiesel');
$fields['superpetrol'] = $this->request->getPost('superpetrol');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');


        $this->validation->setRules([
			            'checkdate' => ['label' => 'Checkdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'petrol' => ['label' => 'Petrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'diesel' => ['label' => 'Diesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superdiesel' => ['label' => 'Superdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'superpetrol' => ['label' => 'Superpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->dailydipModel->update($fields['iddailydip'], $fields)) {
				
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
		
		$id = $this->request->getPost('iddailydip');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->dailydipModel->where('iddailydip', $id)->delete()) {
								
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
