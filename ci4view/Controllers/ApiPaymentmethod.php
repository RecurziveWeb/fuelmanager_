<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\PaymentmethodModel;


class ApiPaymentmethod extends BaseController
{
    use ResponseTrait;

    protected $paymentmethodModel;
    
    protected $validation;
	
	public function __construct()
	{
	    $this->paymentmethodModel = new PaymentmethodModel();
        
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $paymentmethod = new paymentmethodModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $paymentmethodData = $paymentmethod->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $paymentmethod->pager;

        return $this->respond([
            'paymentmethod' => $paymentmethodData,
            'pager' => $pager->makeLinks($page, $perPage, $paymentmethodData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $paymentmethod = new paymentmethodModel();

        $mainData = $this->$paymentmethod->find($id);
     
        

         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idpaymentmethod' => $mainData['idpaymentmethod'],
'method_name' => $mainData['method_name'],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idpaymentmethod'] = $this->request->getPost('idpaymentmethod');
$fields['method_name'] = $this->request->getPost('method_name');


        $this->validation->setRules([
			            'method_name' => ['label' => 'Method name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->paymentmethodModel->insert($fields)) {
												
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
		
		$fields['idpaymentmethod'] = $this->request->getPost('idpaymentmethod');
$fields['method_name'] = $this->request->getPost('method_name');


        $this->validation->setRules([
			            'method_name' => ['label' => 'Method name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->paymentmethodModel->update($fields['idpaymentmethod'], $fields)) {
				
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
		
			if ($this->paymentmethodModel->where('idpaymentmethod', $id)->delete()) {
								
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
