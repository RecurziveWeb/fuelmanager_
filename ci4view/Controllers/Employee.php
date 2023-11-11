<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\EmployeeModel;
use App\Models\EmployeetypeModel;


class Employee extends BaseController
{
	
    protected $employeeModel;
	protected $employeetypeModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->employeeModel = new EmployeeModel();
		$this->employeetypeModel = new EmployeetypeModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'employee',
			'title'     		=> 'employee'				
		];

		//$data["selectdata_employeetype"] = $this->employeetypeModel->EmployeetypeModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_employeetype"] = $this->employeetypeModel->EmployeetypeModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/employee_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'employee',
			'title'     		=> 'employee'				
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

		$fields['idemployee'] = $this->request->getPost('idemployee');
$fields['fristname'] = $this->request->getPost('fristname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['epf'] = $this->request->getPost('epf');
$fields['dateofbirth'] = $this->request->getPost('dateofbirth');
$fields['isactive'] = $this->request->getPost('isactive');
$fields['isavailable'] = $this->request->getPost('isavailable');
$fields['employeetype_idemployeetype'] = $this->request->getPost('employeetype_idemployeetype');


        $this->validation->setRules([
			            'fristname' => ['label' => 'Fristname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'epf' => ['label' => 'Epf', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'dateofbirth' => ['label' => 'Dateofbirth', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isactive' => ['label' => 'Isactive', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isavailable' => ['label' => 'Isavailable', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'employeetype_idemployeetype' => ['label' => 'Employeetype idemployeetype', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->employeeModel->insert($fields)) {
												
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
		
		$fields['idemployee'] = $this->request->getPost('idemployee');
$fields['fristname'] = $this->request->getPost('fristname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['epf'] = $this->request->getPost('epf');
$fields['dateofbirth'] = $this->request->getPost('dateofbirth');
$fields['isactive'] = $this->request->getPost('isactive');
$fields['isavailable'] = $this->request->getPost('isavailable');
$fields['employeetype_idemployeetype'] = $this->request->getPost('employeetype_idemployeetype');


        $this->validation->setRules([
			            'fristname' => ['label' => 'Fristname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'epf' => ['label' => 'Epf', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'dateofbirth' => ['label' => 'Dateofbirth', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isactive' => ['label' => 'Isactive', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isavailable' => ['label' => 'Isavailable', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'employeetype_idemployeetype' => ['label' => 'Employeetype idemployeetype', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->employeeModel->update($fields['idemployee'], $fields)) {
				
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
		
		$id = $this->request->getPost('idemployee');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->employeeModel->where('idemployee', $id)->delete()) {
								
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

		$result = $this->employeeModel->employeeModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idemployee .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idemployee,
$value->fristname,
$value->lastname,
$value->epf,
$value->dateofbirth,
$value->isactive,
$value->isavailable,
$value->employeetype_idemployeetype,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idemployee');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->employeeModel->where('idemployee' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['idemployee'] = $this->request->getPost('idemployee');
$fields['fristname'] = $this->request->getPost('fristname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['epf'] = $this->request->getPost('epf');
$fields['dateofbirth'] = $this->request->getPost('dateofbirth');
$fields['isactive'] = $this->request->getPost('isactive');
$fields['isavailable'] = $this->request->getPost('isavailable');
$fields['employeetype_idemployeetype'] = $this->request->getPost('employeetype_idemployeetype');


        $this->validation->setRules([
			            'fristname' => ['label' => 'Fristname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'epf' => ['label' => 'Epf', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'dateofbirth' => ['label' => 'Dateofbirth', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isactive' => ['label' => 'Isactive', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isavailable' => ['label' => 'Isavailable', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'employeetype_idemployeetype' => ['label' => 'Employeetype idemployeetype', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->employeeModel->insert($fields)) {
												
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
		
		$fields['idemployee'] = $this->request->getPost('idemployee');
$fields['fristname'] = $this->request->getPost('fristname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['epf'] = $this->request->getPost('epf');
$fields['dateofbirth'] = $this->request->getPost('dateofbirth');
$fields['isactive'] = $this->request->getPost('isactive');
$fields['isavailable'] = $this->request->getPost('isavailable');
$fields['employeetype_idemployeetype'] = $this->request->getPost('employeetype_idemployeetype');


        $this->validation->setRules([
			            'fristname' => ['label' => 'Fristname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'epf' => ['label' => 'Epf', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'dateofbirth' => ['label' => 'Dateofbirth', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isactive' => ['label' => 'Isactive', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isavailable' => ['label' => 'Isavailable', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'employeetype_idemployeetype' => ['label' => 'Employeetype idemployeetype', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->employeeModel->update($fields['idemployee'], $fields)) {
				
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
		
		$id = $this->request->getPost('idemployee');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->employeeModel->where('idemployee', $id)->delete()) {
								
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
