<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('PaymentsModel'); 
        $this->load->model('PaymentmethodModel');
$this->load->model('OrdersModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['payments'] = $this->PaymentsModel->get_payments();
        $data["paymentmethod"] = $this->PaymentmethodModel->get_paymentmethod();
$data["orders"] = $this->OrdersModel->get_orders();

        $this->load->view('template/header');
        $this->load->view('admin/payments_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/payments_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idpayments)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['payments'] = $this->PaymentsModel->getwhere_payments($idpayments);
        $data['primaryid'] = $idpayments;

        $this->load->view('template/header');
        $this->load->view('/admin/payments_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('paymentdate', 'paymentdate', '|valid_date|min_length[0]');
$this->form_validation->set_rules('isreceived', 'isreceived', '|min_length[0]|max_length[4]');
$this->form_validation->set_rules('paymentmethod_idpaymentmethod', 'paymentmethod_idpaymentmethod', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('amount', 'amount', '|numeric|min_length[0]');
$this->form_validation->set_rules('orders_idorders', 'orders_idorders', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'paymentdate' => $this->input->post('paymentdate'),
'isreceived' => $this->input->post('isreceived'),
'paymentmethod_idpaymentmethod' => $this->input->post('paymentmethod_idpaymentmethod'),
'amount' => $this->input->post('amount'),
'orders_idorders' => $this->input->post('orders_idorders'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->PaymentsModel->insert_payments($data);
                if($resultid>0){
                    $this->session->set_flashdata('message', 'Form submitted successfully!');
                }else{
                    $this->session->set_flashdata('error', 'Error in submitting form');
                }
                
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }else{
            $this->session->set_flashdata('error', "Bad Request");
        }
   
       
        $this->load->view('template/header');
        $this->load->view('/admin/payments_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idpayments) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'paymentdate' => $this->input->post('paymentdate'),
'isreceived' => $this->input->post('isreceived'),
'paymentmethod_idpaymentmethod' => $this->input->post('paymentmethod_idpaymentmethod'),
'amount' => $this->input->post('amount'),
'orders_idorders' => $this->input->post('orders_idorders'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->PaymentsModel->update_payments($idpayments, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['payments'] = $this->PaymentsModel->get_payments();
        
        $data["paymentmethod"] = $this->PaymentmethodModel->get_paymentmethod();
$data["orders"] = $this->OrdersModel->get_orders();

        
        $this->load->view('template/header');
        $this->load->view('admin/payments_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idpayments) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->PaymentsModel->delete_payments($idpayments);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['payments'] = $this->PaymentsModel->get_payments();
        
        $data["paymentmethod"] = $this->PaymentmethodModel->get_paymentmethod();
$data["orders"] = $this->OrdersModel->get_orders();


        $this->load->view('template/header');
        $this->load->view('admin/payments_tableview', $data);
        $this->load->view('template/footer');
    }
}
