<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\DailydipModel;
use App\Models\FillingstationModel;


class ApiDailydip extends BaseController
{
    use ResponseTrait;

    protected $dailydipModel;
    protected $fillingstationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->dailydipModel = new DailydipModel();
        $this->fillingstationModel = new FillingstationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $dailydip = new dailydipModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $dailydipData = $dailydip->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $dailydip->pager;

        return $this->respond([
            'dailydip' => $dailydipData,
            'pager' => $pager->makeLinks($page, $perPage, $dailydipData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $dailydip = new dailydipModel();

        $mainData = $this->$dailydip->find($id);
     
        $relatedDatafillingstation = $this->fillingstationModel->find($mainData["fillingstation_idfillingstation"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['iddailydip' => $mainData['iddailydip'],
'checkdate' => $mainData['checkdate'],
'petrol' => $mainData['petrol'],
'diesel' => $mainData['diesel'],
'superdiesel' => $mainData['superdiesel'],
'superpetrol' => $mainData['superpetrol'],
'fillingstation_idfillingstation' => $mainData['fillingstation_idfillingstation'],
'fillingstation' => [ 
 'idfillingstation' => $relatedDatafillingstation['idfillingstation'],
 'fillingstation_name' => $relatedDatafillingstation['fillingstation_name'],
 'fillingstation_address' => $relatedDatafillingstation['fillingstation_address'],
 'numberoffueldespencers' => $relatedDatafillingstation['numberoffueldespencers'],
 'capacityofpetroltank' => $relatedDatafillingstation['capacityofpetroltank'],
 'capacityofdieseltank' => $relatedDatafillingstation['capacityofdieseltank'],
 'capacityofsuperpetrol' => $relatedDatafillingstation['capacityofsuperpetrol'],
 'capacityofsuperdiesel' => $relatedDatafillingstation['capacityofsuperdiesel'],
 'district' => $relatedDatafillingstation['district'],
 'Users_idUsers' => $relatedDatafillingstation['Users_idUsers'],
 'isapproved' => $relatedDatafillingstation['isapproved'],
 'approvedby' => $relatedDatafillingstation['approvedby'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->dailydipModel->insert($fields)) {
												
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

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->dailydipModel->update($fields['iddailydip'], $fields)) {
				
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
		
			if ($this->dailydipModel->where('iddailydip', $id)->delete()) {
								
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
