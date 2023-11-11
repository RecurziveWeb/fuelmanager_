<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\EmployeeModel;
use App\Models\EmployeetypeModel;


class ApiEmployee extends BaseController
{
    use ResponseTrait;

    protected $employeeModel;
    protected $employeetypeModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->employeeModel = new EmployeeModel();
        $this->employeetypeModel = new EmployeetypeModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $employee = new employeeModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $employeeData = $employee->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $employee->pager;

        return $this->respond([
            'employee' => $employeeData,
            'pager' => $pager->makeLinks($page, $perPage, $employeeData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $employee = new employeeModel();

        $mainData = $this->$employee->find($id);
     
        $relatedDataemployeetype = $this->employeetypeModel->find($mainData["employeetype_idemployeetype"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idemployee' => $mainData['idemployee'],
'fristname' => $mainData['fristname'],
'lastname' => $mainData['lastname'],
'epf' => $mainData['epf'],
'dateofbirth' => $mainData['dateofbirth'],
'isactive' => $mainData['isactive'],
'isavailable' => $mainData['isavailable'],
'employeetype_idemployeetype' => $mainData['employeetype_idemployeetype'],
'employeetype' => [ 
 'idemployeetype' => $relatedDataemployeetype['idemployeetype'],
 'employeetype' => $relatedDataemployeetype['employeetype'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->employeeModel->insert($fields)) {
												
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->employeeModel->update($fields['idemployee'], $fields)) {
				
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
		
			if ($this->employeeModel->where('idemployee', $id)->delete()) {
								
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
