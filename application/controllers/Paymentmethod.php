<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmethod extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('PaymentmethodModel'); 
        
        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['paymentmethod'] = $this->PaymentmethodModel->get_paymentmethod();
        
        $this->load->view('template/header');
        $this->load->view('admin/paymentmethod_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/paymentmethod_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idpaymentmethod)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['paymentmethod'] = $this->PaymentmethodModel->getwhere_paymentmethod($idpaymentmethod);
        $data['primaryid'] = $idpaymentmethod;

        $this->load->view('template/header');
        $this->load->view('/admin/paymentmethod_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('method_name', 'method_name', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'method_name' => $this->input->post('method_name'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->PaymentmethodModel->insert_paymentmethod($data);
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
        $this->load->view('/admin/paymentmethod_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idpaymentmethod) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'method_name' => $this->input->post('method_name'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->PaymentmethodModel->update_paymentmethod($idpaymentmethod, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['paymentmethod'] = $this->PaymentmethodModel->get_paymentmethod();
        
        
        
        $this->load->view('template/header');
        $this->load->view('admin/paymentmethod_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idpaymentmethod) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->PaymentmethodModel->delete_paymentmethod($idpaymentmethod);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['paymentmethod'] = $this->PaymentmethodModel->get_paymentmethod();
        
        

        $this->load->view('template/header');
        $this->load->view('admin/paymentmethod_tableview', $data);
        $this->load->view('template/footer');
    }
}
