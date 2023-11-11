<?php


namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PaymentsModel;
use App\Models\PaymentmethodModel;
use App\Models\OrdersModel;


class Payments extends BaseController
{
	
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
	
	public function index()
	{
		$data = [
			'controller'    	=> 'payments',
			'title'     		=> 'payments'				
		];

		//$data["selectdata_paymentmethod"] = $this->paymentmethodModel->PaymentmethodModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_paymentmethod"] = $this->paymentmethodModel->PaymentmethodModelgetlist($column, $colid);
//$data["selectdata_orders"] = $this->ordersModel->OrdersModelgetbyid($column, $colid, $value, $valueid);
$data["selectdata_orders"] = $this->ordersModel->OrdersModelgetlist($column, $colid);



		echo view("admin/layouts/header",$data);
		echo view("admin/layouts/sidebar",$data);
		echo view("admin/layouts/breadcrumb",$data);
		echo view("admin/pages/payments_view",$data);
		echo view("admin/layouts/footer",$data);

	}

	public function form()
	{
		$data = [
			'controller'    	=> 'payments',
			'title'     		=> 'payments'				
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->paymentsModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->paymentsModel->update($fields['idpayments'], $fields)) {
				
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
		
		$id = $this->request->getPost('idpayments');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->paymentsModel->where('idpayments', $id)->delete()) {
								
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

		$result = $this->paymentsModel->paymentsModelgetbyfk();

		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<a class="btn btn-info" onClick="save('. $value->idpayments .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->idpayments,
$value->paymentdate,
$value->isreceived,
$value->paymentmethod_idpaymentmethod,
$value->amount,
$value->orders_idorders,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('idpayments');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->paymentsModel->where('idpayments' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->paymentsModel->insert($fields)) {
												
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

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->paymentsModel->update($fields['idpayments'], $fields)) {
				
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
		
		$id = $this->request->getPost('idpayments');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->paymentsModel->where('idpayments', $id)->delete()) {
								
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
