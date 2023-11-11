<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\FillingstationModel;
use App\Models\UsersModel;


class ApiFillingstation extends BaseController
{
    use ResponseTrait;

    protected $fillingstationModel;
    protected $usersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->fillingstationModel = new FillingstationModel();
        $this->usersModel = new UsersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $fillingstation = new fillingstationModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $fillingstationData = $fillingstation->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $fillingstation->pager;

        return $this->respond([
            'fillingstation' => $fillingstationData,
            'pager' => $pager->makeLinks($page, $perPage, $fillingstationData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $fillingstation = new fillingstationModel();

        $mainData = $this->$fillingstation->find($id);
     
        $relatedDatausers = $this->usersModel->find($mainData["Users_idUsers"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idfillingstation' => $mainData['idfillingstation'],
'fillingstation_name' => $mainData['fillingstation_name'],
'fillingstation_address' => $mainData['fillingstation_address'],
'numberoffueldespencers' => $mainData['numberoffueldespencers'],
'capacityofpetroltank' => $mainData['capacityofpetroltank'],
'capacityofdieseltank' => $mainData['capacityofdieseltank'],
'capacityofsuperpetrol' => $mainData['capacityofsuperpetrol'],
'capacityofsuperdiesel' => $mainData['capacityofsuperdiesel'],
'district' => $mainData['district'],
'Users_idUsers' => $mainData['Users_idUsers'],
'isapproved' => $mainData['isapproved'],
'approvedby' => $mainData['approvedby'],
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->fillingstationModel->insert($fields)) {
												
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->fillingstationModel->update($fields['idfillingstation'], $fields)) {
				
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
		
			if ($this->fillingstationModel->where('idfillingstation', $id)->delete()) {
								
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
