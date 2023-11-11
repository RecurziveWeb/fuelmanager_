<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\OrderitemsModel;
use App\Models\OrdersModel;


class ApiOrderitems extends BaseController
{
    use ResponseTrait;

    protected $orderitemsModel;
    protected $ordersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->orderitemsModel = new OrderitemsModel();
        $this->ordersModel = new OrdersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $orderitems = new orderitemsModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $orderitemsData = $orderitems->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $orderitems->pager;

        return $this->respond([
            'orderitems' => $orderitemsData,
            'pager' => $pager->makeLinks($page, $perPage, $orderitemsData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $orderitems = new orderitemsModel();

        $mainData = $this->$orderitems->find($id);
     
        $relatedDataorders = $this->ordersModel->find($mainData["orders_idorders"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idorderitems' => $mainData['idorderitems'],
'itemname' => $mainData['itemname'],
'qty' => $mainData['qty'],
'itemamount' => $mainData['itemamount'],
'orders_idorders' => $mainData['orders_idorders'],
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

        $fields['idorderitems'] = $this->request->getPost('idorderitems');
$fields['itemname'] = $this->request->getPost('itemname');
$fields['qty'] = $this->request->getPost('qty');
$fields['itemamount'] = $this->request->getPost('itemamount');
$fields['orders_idorders'] = $this->request->getPost('orders_idorders');


        $this->validation->setRules([
			            'itemname' => ['label' => 'Itemname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'qty' => ['label' => 'Qty', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'itemamount' => ['label' => 'Itemamount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'orders_idorders' => ['label' => 'Orders idorders', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->orderitemsModel->insert($fields)) {
												
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
		
		$fields['idorderitems'] = $this->request->getPost('idorderitems');
$fields['itemname'] = $this->request->getPost('itemname');
$fields['qty'] = $this->request->getPost('qty');
$fields['itemamount'] = $this->request->getPost('itemamount');
$fields['orders_idorders'] = $this->request->getPost('orders_idorders');


        $this->validation->setRules([
			            'itemname' => ['label' => 'Itemname', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'qty' => ['label' => 'Qty', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'itemamount' => ['label' => 'Itemamount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'orders_idorders' => ['label' => 'Orders idorders', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->orderitemsModel->update($fields['idorderitems'], $fields)) {
				
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
		
			if ($this->orderitemsModel->where('idorderitems', $id)->delete()) {
								
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
