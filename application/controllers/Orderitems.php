<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderitems extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('OrderitemsModel'); 
        $this->load->model('OrdersModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['orderitems'] = $this->OrderitemsModel->get_orderitems();
        $data["orders"] = $this->OrdersModel->get_orders();

        $this->load->view('template/header');
        $this->load->view('admin/orderitems_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        $this->load->view('template/header');
        $this->load->view('/admin/orderitems_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idorderitems)
    {

        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        $data['orderitems'] = $this->OrderitemsModel->getwhere_orderitems($idorderitems);
        $data['primaryid'] = $idorderitems;

        $this->load->view('template/header');
        $this->load->view('/admin/orderitems_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('itemname', 'itemname', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('qty', 'qty', '|numeric|min_length[0]');
            $this->form_validation->set_rules('itemamount', 'itemamount', '|numeric|min_length[0]');
            $this->form_validation->set_rules('orders_idorders', 'orders_idorders', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'itemname' => $this->input->post('itemname'),
                    'qty' => $this->input->post('qty'),
                    'itemamount' => $this->input->post('itemamount'),
                    'orders_idorders' => $this->input->post('orders_idorders'),
                    'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->OrderitemsModel->insert_orderitems($data);
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
        $this->load->view('/admin/orderitems_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idorderitems) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'itemname' => $this->input->post('itemname'),
'qty' => $this->input->post('qty'),
'itemamount' => $this->input->post('itemamount'),
'orders_idorders' => $this->input->post('orders_idorders'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->OrderitemsModel->update_orderitems($idorderitems, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['orderitems'] = $this->OrderitemsModel->get_orderitems();
        
        $data["orders"] = $this->OrdersModel->get_orders();

        
        $this->load->view('template/header');
        $this->load->view('admin/orderitems_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idorderitems) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->OrderitemsModel->delete_orderitems($idorderitems);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['orderitems'] = $this->OrderitemsModel->get_orderitems();
        
        $data["orders"] = $this->OrdersModel->get_orders();


        $this->load->view('template/header');
        $this->load->view('admin/orderitems_tableview', $data);
        $this->load->view('template/footer');
    }
}
