<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\PaymentsModel;
use App\Models\PaymentmethodModel;
use App\Models\OrdersModel;


class ApiPayments extends BaseController
{
    use ResponseTrait;

    protected $paymentsModel;
    protected $paymentmethodModel;
protected $ordersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->paymentsModel = new PaymentsModel();
        $this->paymentmethodModel = new PaymentmethodModel();
$this->ordersModel = new OrdersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $payments = new paymentsModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $paymentsData = $payments->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $payments->pager;

        return $this->respond([
            'payments' => $paymentsData,
            'pager' => $pager->makeLinks($page, $perPage, $paymentsData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $payments = new paymentsModel();

        $mainData = $this->$payments->find($id);
     
        $relatedDatapaymentmethod = $this->paymentmethodModel->find($mainData["paymentmethod_idpaymentmethod"]);
$relatedDataorders = $this->ordersModel->find($mainData["orders_idorders"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idpayments' => $mainData['idpayments'],
'paymentdate' => $mainData['paymentdate'],
'isreceived' => $mainData['isreceived'],
'paymentmethod_idpaymentmethod' => $mainData['paymentmethod_idpaymentmethod'],
'amount' => $mainData['amount'],
'orders_idorders' => $mainData['orders_idorders'],
'paymentmethod' => [ 
 'idpaymentmethod' => $relatedDatapaymentmethod['idpaymentmethod'],
 'method_name' => $relatedDatapaymentmethod['method_name'],
],
'orders' => [ 
 'idorders' => $relatedDataorders['idorders'],
 'orderdate' => $relatedDataorders['orderdate'],
 'amount' => $relatedDataorders['amount'],
 'discount' => $relatedDataorders['discount'],
 'tax' => $relatedDataorders['tax'],
 'isapproved' => $relatedDataorders['isapproved'],
 'fillingstation_idfillingstation' => $relatedDataorders['fillingstation_idfillingstation'],
 'approvedby' => $relatedDataorders['approvedby'],
 'vehicle_idvehicle' => $relatedDataorders['vehicle_idvehicle'],
 'employee_idemployee' => $relatedDataorders['employee_idemployee'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idpayments'] = $this->request->getPost('idpayments');
$fields['paymentdate'] = $this->request->getPost('paymentdate');
$fields['isreceived'] = $this->request->getPost('isreceived');
$fields['paymentmethod_idpaymentmethod'] = $this->request->getPost('paymentmethod_idpaymentmethod');
$fields['amount'] = $this->request->getPost('amount');
$fields['orders_idorders'] = $this->request->getPost('orders_idorders');


        $this->validation->setRules([
			            'paymentdate' => ['label' => 'Paymentdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isreceived' => ['label' => 'Isreceived', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'paymentmethod_idpaymentmethod' => ['label' => 'Paymentmethod idpaymentmethod', 'rules' => 'required|min_length[0]|max_length[11]'],
            'amount' => ['label' => 'Amount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'orders_idorders' => ['label' => 'Orders idorders', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->paymentsModel->insert($fields)) {
												
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
		
		$fields['idpayments'] = $this->request->getPost('idpayments');
$fields['paymentdate'] = $this->request->getPost('paymentdate');
$fields['isreceived'] = $this->request->getPost('isreceived');
$fields['paymentmethod_idpaymentmethod'] = $this->request->getPost('paymentmethod_idpaymentmethod');
$fields['amount'] = $this->request->getPost('amount');
$fields['orders_idorders'] = $this->request->getPost('orders_idorders');


        $this->validation->setRules([
			            'paymentdate' => ['label' => 'Paymentdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'isreceived' => ['label' => 'Isreceived', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'paymentmethod_idpaymentmethod' => ['label' => 'Paymentmethod idpaymentmethod', 'rules' => 'required|min_length[0]|max_length[11]'],
            'amount' => ['label' => 'Amount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'orders_idorders' => ['label' => 'Orders idorders', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->paymentsModel->update($fields['idpayments'], $fields)) {
				
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
		
			if ($this->paymentsModel->where('idpayments', $id)->delete()) {
								
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
