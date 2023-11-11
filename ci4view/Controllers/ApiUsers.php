<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UsersModel;


class ApiUsers extends BaseController
{
    use ResponseTrait;

    protected $usersModel;
    
    protected $validation;
	
	public function __construct()
	{
	    $this->usersModel = new UsersModel();
        
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $users = new usersModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $usersData = $users->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $users->pager;

        return $this->respond([
            'users' => $usersData,
            'pager' => $pager->makeLinks($page, $perPage, $usersData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $users = new usersModel();

        $mainData = $this->$users->find($id);
     
        

         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idUsers' => $mainData['idUsers'],
'firstname' => $mainData['firstname'],
'lastname' => $mainData['lastname'],
'email' => $mainData['email'],
'password' => $mainData['password'],
'isadmin' => $mainData['isadmin'],
'isdealer' => $mainData['isdealer'],
'isdriver' => $mainData['isdriver'],
'phonenumber' => $mainData['phonenumber'],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idUsers'] = $this->request->getPost('idUsers');
$fields['firstname'] = $this->request->getPost('firstname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['email'] = $this->request->getPost('email');
$fields['password'] = $this->request->getPost('password');
$fields['isadmin'] = $this->request->getPost('isadmin');
$fields['isdealer'] = $this->request->getPost('isdealer');
$fields['isdriver'] = $this->request->getPost('isdriver');
$fields['phonenumber'] = $this->request->getPost('phonenumber');


        $this->validation->setRules([
			            'firstname' => ['label' => 'Firstname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|valid_email|min_length[0]|max_length[256]'],
            'password' => ['label' => 'Password', 'rules' => 'permit_empty|min_length[0]|max_length[300]'],
            'isadmin' => ['label' => 'Isadmin', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isdealer' => ['label' => 'Isdealer', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isdriver' => ['label' => 'Isdriver', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'phonenumber' => ['label' => 'Phonenumber', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->usersModel->insert($fields)) {
												
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
		
		$fields['idUsers'] = $this->request->getPost('idUsers');
$fields['firstname'] = $this->request->getPost('firstname');
$fields['lastname'] = $this->request->getPost('lastname');
$fields['email'] = $this->request->getPost('email');
$fields['password'] = $this->request->getPost('password');
$fields['isadmin'] = $this->request->getPost('isadmin');
$fields['isdealer'] = $this->request->getPost('isdealer');
$fields['isdriver'] = $this->request->getPost('isdriver');
$fields['phonenumber'] = $this->request->getPost('phonenumber');


        $this->validation->setRules([
			            'firstname' => ['label' => 'Firstname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'lastname' => ['label' => 'Lastname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|valid_email|min_length[0]|max_length[256]'],
            'password' => ['label' => 'Password', 'rules' => 'permit_empty|min_length[0]|max_length[300]'],
            'isadmin' => ['label' => 'Isadmin', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isdealer' => ['label' => 'Isdealer', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'isdriver' => ['label' => 'Isdriver', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'phonenumber' => ['label' => 'Phonenumber', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->usersModel->update($fields['idUsers'], $fields)) {
				
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
		
			if ($this->usersModel->where('idUsers', $id)->delete()) {
								
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
