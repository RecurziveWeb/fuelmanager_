<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\OrdersModel;
use App\Models\FillingstationModel;
use App\Models\VehicleModel;
use App\Models\EmployeeModel;


class Orders extends BaseController
{
	
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
	
	public function index()
	{
		$data = [
			'controller'    	=> 'orders',
			'title'     		=> 'orders'				
		];

		//$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_fillingstation"] = $this->fillingstationModel->FillingstationModelgetlist($column, $colid);
//$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_vehicle"] = $this->vehicleModel->VehicleModelgetlist($column, $colid);
//$data["selectdata_employee"] = $this->employeeModel->EmployeeModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_employee"] = $this->employeeModel->EmployeeModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/orders_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'orders',
			'title'     		=> 'orders'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->ordersModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->ordersModel->update($fields['idorders'], $fields)) {
				
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
		
		$id = $this->request->getPost('idorders');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->ordersModel->where('idorders', $id)->delete()) {
								
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

		$result = $this->ordersModel->ordersModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idorders .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idorders,
$value->orderdate,
$value->amount,
$value->discount,
$value->tax,
$value->isapproved,
$value->fillingstation_idfillingstation,
$value->approvedby,
$value->vehicle_idvehicle,
$value->employee_idemployee,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idorders');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->ordersModel->where('idorders' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->ordersModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->ordersModel->update($fields['idorders'], $fields)) {
				
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
		
		$id = $this->request->getPost('idorders');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->ordersModel->where('idorders', $id)->delete()) {
								
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
