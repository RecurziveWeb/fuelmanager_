<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\OrderitemsModel;
use App\Models\OrdersModel;


class Orderitems extends BaseController
{
	
    protected $orderitemsModel;
	protected $ordersModel;

    protected $validation;
	
	public function __construct()
	{
	    $this->orderitemsModel = new OrderitemsModel();
		$this->ordersModel = new OrdersModel();

       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{
		$data = [
			'controller'    	=> 'orderitems',
			'title'     		=> 'orderitems'				
		];

		//$data["selectdata_orders"] = $this->ordersModel->OrdersModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_orders"] = $this->ordersModel->OrdersModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/orderitems_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'orderitems',
			'title'     		=> 'orderitems'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->orderitemsModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->orderitemsModel->update($fields['idorderitems'], $fields)) {
				
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
		
		$id = $this->request->getPost('idorderitems');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->orderitemsModel->where('idorderitems', $id)->delete()) {
								
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

		$result = $this->orderitemsModel->orderitemsModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idorderitems .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idorderitems,
$value->itemname,
$value->qty,
$value->itemamount,
$value->orders_idorders,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idorderitems');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->orderitemsModel->where('idorderitems' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->orderitemsModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->orderitemsModel->update($fields['idorderitems'], $fields)) {
				
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
		
		$id = $this->request->getPost('idorderitems');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->orderitemsModel->where('idorderitems', $id)->delete()) {
								
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
