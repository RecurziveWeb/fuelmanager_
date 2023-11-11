<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsersModel;


class Users extends BaseController
{
	
    protected $usersModel;
	
    protected $validation;
	
	public function __construct()
	{
	    $this->usersModel = new UsersModel();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'users',
			'title'     		=> 'users'				
		];

		


		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/users_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'users',
			'title'     		=> 'users'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->usersModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->usersModel->update($fields['idUsers'], $fields)) {
				
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
		
		$id = $this->request->getPost('idUsers');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->usersModel->where('idUsers', $id)->delete()) {
								
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

		$result = $this->usersModel->select()->findAll();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idUsers .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idUsers,
$value->firstname,
$value->lastname,
$value->email,
$value->password,
$value->isadmin,
$value->isdealer,
$value->isdriver,
$value->phonenumber,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idUsers');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->usersModel->where('idUsers' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->usersModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->usersModel->update($fields['idUsers'], $fields)) {
				
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
		
		$id = $this->request->getPost('idUsers');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->usersModel->where('idUsers', $id)->delete()) {
								
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
