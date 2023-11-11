<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\LoginlogModel;
use App\Models\UsersModel;


class Loginlog extends BaseController
{
	
    protected $loginlogModel;
	protected $usersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->loginlogModel = new LoginlogModel();
		$this->usersModel = new UsersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'loginlog',
			'title'     		=> 'loginlog'				
		];

		//$data["selectdata_users"] = $this->usersModel->UsersModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_users"] = $this->usersModel->UsersModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/loginlog_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'loginlog',
			'title'     		=> 'loginlog'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->loginlogModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->loginlogModel->update($fields['idloginlog'], $fields)) {
				
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
		
		$id = $this->request->getPost('idloginlog');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->loginlogModel->where('idloginlog', $id)->delete()) {
								
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

		$result = $this->loginlogModel->loginlogModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idloginlog .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idloginlog,
$value->logindate,
$value->Users_idUsers,
$value->otpcode,
$value->iscorrect,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idloginlog');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->loginlogModel->where('idloginlog' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->loginlogModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->loginlogModel->update($fields['idloginlog'], $fields)) {
				
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
		
		$id = $this->request->getPost('idloginlog');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->loginlogModel->where('idloginlog', $id)->delete()) {
								
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
