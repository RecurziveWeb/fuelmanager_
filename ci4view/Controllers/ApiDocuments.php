<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\DocumentsModel;
use App\Models\FillingstationModel;


class ApiDocuments extends BaseController
{
    use ResponseTrait;

    protected $documentsModel;
    protected $fillingstationModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->documentsModel = new DocumentsModel();
        $this->fillingstationModel = new FillingstationModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $documents = new documentsModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $documentsData = $documents->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $documents->pager;

        return $this->respond([
            'documents' => $documentsData,
            'pager' => $pager->makeLinks($page, $perPage, $documentsData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $documents = new documentsModel();

        $mainData = $this->$documents->find($id);
     
        $relatedDatafillingstation = $this->fillingstationModel->find($mainData["fillingstation_idfillingstation"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['iddocuments' => $mainData['iddocuments'],
'type' => $mainData['type'],
'filename' => $mainData['filename'],
'uploaddate' => $mainData['uploaddate'],
'isapproved' => $mainData['isapproved'],
'fillingstation_idfillingstation' => $mainData['fillingstation_idfillingstation'],
'approvedby' => $mainData['approvedby'],
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

        $fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->documentsModel->insert($fields)) {
												
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
		
		$fields['iddocuments'] = $this->request->getPost('iddocuments');
$fields['type'] = $this->request->getPost('type');
$fields['filename'] = $this->request->getPost('filename');
$fields['uploaddate'] = $this->request->getPost('uploaddate');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');


        $this->validation->setRules([
			            'type' => ['label' => 'Type', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'filename' => ['label' => 'Filename', 'rules' => 'permit_empty|min_length[0]|max_length[450]'],
            'uploaddate' => ['label' => 'Uploaddate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->documentsModel->update($fields['iddocuments'], $fields)) {
				
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
		
			if ($this->documentsModel->where('iddocuments', $id)->delete()) {
								
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
