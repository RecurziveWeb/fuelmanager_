<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\FillingstationModel;
use App\Models\UsersModel;


class Fillingstation extends BaseController
{
	
    protected $fillingstationModel;
	protected $usersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->fillingstationModel = new FillingstationModel();
		$this->usersModel = new UsersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'fillingstation',
			'title'     		=> 'fillingstation'				
		];

		//$data["selectdata_users"] = $this->usersModel->UsersModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_users"] = $this->usersModel->UsersModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/fillingstation_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'fillingstation',
			'title'     		=> 'fillingstation'				
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

		$fields['idfillingstation'] = $this->request->getPost('idfillingstation');
$fields['fillingstation_name'] = $this->request->getPost('fillingstation_name');
$fields['fillingstation_address'] = $this->request->getPost('fillingstation_address');
$fields['numberoffueldespencers'] = $this->request->getPost('numberoffueldespencers');
$fields['capacityofpetroltank'] = $this->request->getPost('capacityofpetroltank');
$fields['capacityofdieseltank'] = $this->request->getPost('capacityofdieseltank');
$fields['capacityofsuperpetrol'] = $this->request->getPost('capacityofsuperpetrol');
$fields['capacityofsuperdiesel'] = $this->request->getPost('capacityofsuperdiesel');
$fields['district'] = $this->request->getPost('district');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'fillingstation_name' => ['label' => 'Fillingstation name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'fillingstation_address' => ['label' => 'Fillingstation address', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'numberoffueldespencers' => ['label' => 'Numberoffueldespencers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofpetroltank' => ['label' => 'Capacityofpetroltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofdieseltank' => ['label' => 'Capacityofdieseltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperpetrol' => ['label' => 'Capacityofsuperpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperdiesel' => ['label' => 'Capacityofsuperdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'district' => ['label' => 'District', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->fillingstationModel->insert($fields)) {
												
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
		
		$fields['idfillingstation'] = $this->request->getPost('idfillingstation');
$fields['fillingstation_name'] = $this->request->getPost('fillingstation_name');
$fields['fillingstation_address'] = $this->request->getPost('fillingstation_address');
$fields['numberoffueldespencers'] = $this->request->getPost('numberoffueldespencers');
$fields['capacityofpetroltank'] = $this->request->getPost('capacityofpetroltank');
$fields['capacityofdieseltank'] = $this->request->getPost('capacityofdieseltank');
$fields['capacityofsuperpetrol'] = $this->request->getPost('capacityofsuperpetrol');
$fields['capacityofsuperdiesel'] = $this->request->getPost('capacityofsuperdiesel');
$fields['district'] = $this->request->getPost('district');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'fillingstation_name' => ['label' => 'Fillingstation name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'fillingstation_address' => ['label' => 'Fillingstation address', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'numberoffueldespencers' => ['label' => 'Numberoffueldespencers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofpetroltank' => ['label' => 'Capacityofpetroltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofdieseltank' => ['label' => 'Capacityofdieseltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperpetrol' => ['label' => 'Capacityofsuperpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperdiesel' => ['label' => 'Capacityofsuperdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'district' => ['label' => 'District', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->fillingstationModel->update($fields['idfillingstation'], $fields)) {
				
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
		
		$id = $this->request->getPost('idfillingstation');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->fillingstationModel->where('idfillingstation', $id)->delete()) {
								
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

		$result = $this->fillingstationModel->fillingstationModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idfillingstation .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idfillingstation,
$value->fillingstation_name,
$value->fillingstation_address,
$value->numberoffueldespencers,
$value->capacityofpetroltank,
$value->capacityofdieseltank,
$value->capacityofsuperpetrol,
$value->capacityofsuperdiesel,
$value->district,
$value->Users_idUsers,
$value->isapproved,
$value->approvedby,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idfillingstation');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->fillingstationModel->where('idfillingstation' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['idfillingstation'] = $this->request->getPost('idfillingstation');
$fields['fillingstation_name'] = $this->request->getPost('fillingstation_name');
$fields['fillingstation_address'] = $this->request->getPost('fillingstation_address');
$fields['numberoffueldespencers'] = $this->request->getPost('numberoffueldespencers');
$fields['capacityofpetroltank'] = $this->request->getPost('capacityofpetroltank');
$fields['capacityofdieseltank'] = $this->request->getPost('capacityofdieseltank');
$fields['capacityofsuperpetrol'] = $this->request->getPost('capacityofsuperpetrol');
$fields['capacityofsuperdiesel'] = $this->request->getPost('capacityofsuperdiesel');
$fields['district'] = $this->request->getPost('district');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'fillingstation_name' => ['label' => 'Fillingstation name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'fillingstation_address' => ['label' => 'Fillingstation address', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'numberoffueldespencers' => ['label' => 'Numberoffueldespencers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofpetroltank' => ['label' => 'Capacityofpetroltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofdieseltank' => ['label' => 'Capacityofdieseltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperpetrol' => ['label' => 'Capacityofsuperpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperdiesel' => ['label' => 'Capacityofsuperdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'district' => ['label' => 'District', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->fillingstationModel->insert($fields)) {
												
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
		
		$fields['idfillingstation'] = $this->request->getPost('idfillingstation');
$fields['fillingstation_name'] = $this->request->getPost('fillingstation_name');
$fields['fillingstation_address'] = $this->request->getPost('fillingstation_address');
$fields['numberoffueldespencers'] = $this->request->getPost('numberoffueldespencers');
$fields['capacityofpetroltank'] = $this->request->getPost('capacityofpetroltank');
$fields['capacityofdieseltank'] = $this->request->getPost('capacityofdieseltank');
$fields['capacityofsuperpetrol'] = $this->request->getPost('capacityofsuperpetrol');
$fields['capacityofsuperdiesel'] = $this->request->getPost('capacityofsuperdiesel');
$fields['district'] = $this->request->getPost('district');
$fields['Users_idUsers'] = $this->request->getPost('Users_idUsers');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'fillingstation_name' => ['label' => 'Fillingstation name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'fillingstation_address' => ['label' => 'Fillingstation address', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'numberoffueldespencers' => ['label' => 'Numberoffueldespencers', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofpetroltank' => ['label' => 'Capacityofpetroltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofdieseltank' => ['label' => 'Capacityofdieseltank', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperpetrol' => ['label' => 'Capacityofsuperpetrol', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'capacityofsuperdiesel' => ['label' => 'Capacityofsuperdiesel', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'district' => ['label' => 'District', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'Users_idUsers' => ['label' => 'Users idUsers', 'rules' => 'required|min_length[0]|max_length[11]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->fillingstationModel->update($fields['idfillingstation'], $fields)) {
				
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
		
		$id = $this->request->getPost('idfillingstation');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->fillingstationModel->where('idfillingstation', $id)->delete()) {
								
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
