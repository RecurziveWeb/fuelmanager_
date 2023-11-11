<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

use App\Models\OrdersModel;
use App\Models\FillingstationModel;
use App\Models\VehicleModel;
use App\Models\EmployeeModel;


class ApiOrders extends BaseController
{
    use ResponseTrait;

    protected $ordersModel;
    protected $fillingstationModel;
protected $vehicleModel;
protected $employeeModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->ordersModel = new OrdersModel();
        $this->fillingstationModel = new FillingstationModel();
$this->vehicleModel = new VehicleModel();
$this->employeeModel = new EmployeeModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function read()
	{

        $orders = new ordersModel();
     
        // Get the current page from the URL query string (e.g., /users?page=2)
        $page = $this->request->getVar('page') ?? 1;

        // Set the number of items to display per page
        $perPage = 20; // You can adjust this according to your needs.

        // Get the users with pagination
        $ordersData = $orders->paginate($perPage, 'default', $page);

        // Get the pagination links for the view
        $pager = $orders->pager;

        return $this->respond([
            'orders' => $ordersData,
            'pager' => $pager->makeLinks($page, $perPage, $ordersData->total),
        ], 200);

	}

    public function readOne($id)
	{

        $orders = new ordersModel();

        $mainData = $this->$orders->find($id);
     
        $relatedDatafillingstation = $this->fillingstationModel->find($mainData["fillingstation_idfillingstation"]);
$relatedDatavehicle = $this->vehicleModel->find($mainData["vehicle_idvehicle"]);
$relatedDataemployee = $this->employeeModel->find($mainData["employee_idemployee"]);


         if ($mainData === null) {
             // Return a 404 Not Found response if the resource doesn't exist
             return $this->failNotFound('Resource not found');
         }

         $resource = ['idorders' => $mainData['idorders'],
'orderdate' => $mainData['orderdate'],
'amount' => $mainData['amount'],
'discount' => $mainData['discount'],
'tax' => $mainData['tax'],
'isapproved' => $mainData['isapproved'],
'fillingstation_idfillingstation' => $mainData['fillingstation_idfillingstation'],
'approvedby' => $mainData['approvedby'],
'vehicle_idvehicle' => $mainData['vehicle_idvehicle'],
'employee_idemployee' => $mainData['employee_idemployee'],
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
'vehicle' => [ 
 'idvehicle' => $relatedDatavehicle['idvehicle'],
 'vehicle_number' => $relatedDatavehicle['vehicle_number'],
 'vehicle_chasis_number' => $relatedDatavehicle['vehicle_chasis_number'],
 'vehicle_yom' => $relatedDatavehicle['vehicle_yom'],
 'vehicle_no_of_passengers' => $relatedDatavehicle['vehicle_no_of_passengers'],
 'vehicle_weight' => $relatedDatavehicle['vehicle_weight'],
 'vehicle_is_available' => $relatedDatavehicle['vehicle_is_available'],
 'vehicle_is_active' => $relatedDatavehicle['vehicle_is_active'],
 'vehicle_type_idvehicle_type' => $relatedDatavehicle['vehicle_type_idvehicle_type'],
 'Location_idLocation' => $relatedDatavehicle['Location_idLocation'],
],
'employee' => [ 
 'idemployee' => $relatedDataemployee['idemployee'],
 'fristname' => $relatedDataemployee['fristname'],
 'lastname' => $relatedDataemployee['lastname'],
 'epf' => $relatedDataemployee['epf'],
 'dateofbirth' => $relatedDataemployee['dateofbirth'],
 'isactive' => $relatedDataemployee['isactive'],
 'isavailable' => $relatedDataemployee['isavailable'],
 'employeetype_idemployeetype' => $relatedDataemployee['employeetype_idemployeetype'],
],
];

 
         // Return the resource as a JSON response
         return $this->respond($resource);

	}

	public function save()
	{

        $response = array();

        $fields['idorders'] = $this->request->getPost('idorders');
$fields['orderdate'] = $this->request->getPost('orderdate');
$fields['amount'] = $this->request->getPost('amount');
$fields['discount'] = $this->request->getPost('discount');
$fields['tax'] = $this->request->getPost('tax');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');
$fields['employee_idemployee'] = $this->request->getPost('employee_idemployee');


        $this->validation->setRules([
			            'orderdate' => ['label' => 'Orderdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'amount' => ['label' => 'Amount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'discount' => ['label' => 'Discount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'tax' => ['label' => 'Tax', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],
            'employee_idemployee' => ['label' => 'Employee idemployee', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->ordersModel->insert($fields)) {
												
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
		
		$fields['idorders'] = $this->request->getPost('idorders');
$fields['orderdate'] = $this->request->getPost('orderdate');
$fields['amount'] = $this->request->getPost('amount');
$fields['discount'] = $this->request->getPost('discount');
$fields['tax'] = $this->request->getPost('tax');
$fields['isapproved'] = $this->request->getPost('isapproved');
$fields['fillingstation_idfillingstation'] = $this->request->getPost('fillingstation_idfillingstation');
$fields['approvedby'] = $this->request->getPost('approvedby');
$fields['vehicle_idvehicle'] = $this->request->getPost('vehicle_idvehicle');
$fields['employee_idemployee'] = $this->request->getPost('employee_idemployee');


        $this->validation->setRules([
			            'orderdate' => ['label' => 'Orderdate', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'amount' => ['label' => 'Amount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'discount' => ['label' => 'Discount', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'tax' => ['label' => 'Tax', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'isapproved' => ['label' => 'Isapproved', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],
            'fillingstation_idfillingstation' => ['label' => 'Fillingstation idfillingstation', 'rules' => 'required|min_length[0]|max_length[11]'],
            'approvedby' => ['label' => 'Approvedby', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
            'vehicle_idvehicle' => ['label' => 'Vehicle idvehicle', 'rules' => 'required|min_length[0]|max_length[11]'],
            'employee_idemployee' => ['label' => 'Employee idemployee', 'rules' => 'required|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = "fail";
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->ordersModel->update($fields['idorders'], $fields)) {
				
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
		
			if ($this->ordersModel->where('idorders', $id)->delete()) {
								
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
