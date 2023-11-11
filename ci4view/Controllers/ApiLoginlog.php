<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\LoginlogModel;
use App\Models\UsersModel;


class ApiLoginlog extends BaseController
{
    use ResponseTrait;

    protected $loginlogModel;
    protected $usersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->loginlogModel = new LoginlogModel();
        $this->usersModel = new UsersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $loginlog = new loginlogModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $loginlogData = $loginlog->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $loginlog->pager;

        return $this->respond([
            'loginlog' => $loginlogData,
            'pager' => $pager->makeLinks($page, $perPage, $loginlogData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $loginlog = new loginlogModel();

        $mainData = $this->$loginlog->find($id);
     
        $relatedDatausers = $this->usersModel->find($mainData["Users_idUsers"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idloginlog' => $mainData['idloginlog'],
'logindate' => $mainData['logindate'],
'Users_idUsers' => $mainData['Users_idUsers'],
'otpcode' => $mainData['otpcode'],
'iscorrect' => $mainData['iscorrect'],
'users' => [ 
 'idUsers' => $relatedDatausers['idUsers'],
 'firstname' => $relatedDatausers['firstname'],
 'lastname' => $relatedDatausers['lastname'],
 'email' => $relatedDatausers['email'],
 'password' => $relatedDatausers['password'],
 'isadmin' => $relatedDatausers['isadmin'],
 'isdealer' => $relatedDatausers['isdealer'],
 'isdriver' => $relatedDatausers['isdriver'],
 'phonenumber' => $relatedDatausers['phonenumber'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idloginlog'] = $this->request->getPost('idloginlog');
$fields['logindate'] = $this->request->getPost('logindate');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['otpcode'] = $this->request->getPost('otpcode');
$fields['iscorrect'] = $this->request->getPost('iscorrect');


        $this->validation->setRules([
			            'logindate' => ['label' => 'Logindate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'otpcode' => ['label' => 'Otpcode', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'iscorrect' => ['label' => 'Iscorrect', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->loginlogModel->insert($fields)) {
												
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
		
		$fields['idloginlog'] = $this->request->getPost('idloginlog');
$fields['logindate'] = $this->request->getPost('logindate');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['otpcode'] = $this->request->getPost('otpcode');
$fields['iscorrect'] = $this->request->getPost('iscorrect');


        $this->validation->setRules([
			            'logindate' => ['label' => 'Logindate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'otpcode' => ['label' => 'Otpcode', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'iscorrect' => ['label' => 'Iscorrect', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->loginlogModel->update($fields['idloginlog'], $fields)) {
				
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
		
			if ($this->loginlogModel->where('idloginlog', $id)->delete()) {
								
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
