<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('OrdersModel'); 
        $this->load->model('OrderitemsModel'); 
        $this->load->model('FillingstationModel');
        $this->load->model('VehicleModel');
        $this->load->model('EmployeeModel');
        $this->load->model('MaterialpriceModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['orders'] = $this->OrdersModel->get_orders();
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();
        $data["vehicle"] = $this->VehicleModel->get_vehicle();
        $data["employee"] = $this->EmployeeModel->get_employee();

        $this->load->view('template/header');
        $this->load->view('admin/orders_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/orders_formview.php');
        $this->load->view('template/footer');
    }

    public function placeorders()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $stationid =  $this->input->get('fillingstation_idfillingstation');
        $data["materialprices"] = $this->MaterialpriceModel->get_materialpricetoday();
        $data['fillingstation'] = $this->FillingstationModel->get_fillingstation_byid($stationid);
        
        $this->load->view('template/header');
        $this->load->view('pages/purchaseorders', $data);
        $this->load->view('template/footer');
    }

    public function placeorderssave()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

            $materialprices = $this->MaterialpriceModel->get_materialpricetoday();

            //$this->form_validation->set_rules('orderdate', 'orderdate', 'valid_date|min_length[0]');
            $this->form_validation->set_rules('amount', 'amount', 'numeric|min_length[0]');
            $this->form_validation->set_rules('discount', 'discount', 'numeric|min_length[0]');
            $this->form_validation->set_rules('tax', 'tax', 'numeric|min_length[0]');
            //$this->form_validation->set_rules('isapproved', 'isapproved', 'min_length[0]|max_length[4]');
            $this->form_validation->set_rules('fillingstation_idfillingstation', 'fillingstation_idfillingstation', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('approvedby', 'approvedby', 'min_length[0]|max_length[45]');
            //$this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('employee_idemployee', 'employee_idemployee', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');

           

            if ($this->form_validation->run()) 
            {
                
                $data = array(
                    'orderdate' => $this->input->post('orderdate'),
                    'amount' => $this->input->post('amount'),
                    'discount' => $this->input->post('discount'),
                    'tax' => $this->input->post('tax'),
                    'isapproved' => 0,
                    'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
                    'approvedby' => "none",
                    //'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
                    //'employee_idemployee' => $this->input->post('employee_idemployee'),
                    'isdelete' => 0,

                );

                $orderid = $this->OrdersModel->insert_orders($data);

                if($orderid>0){
                    $this->session->set_flashdata('message', 'Form submitted successfully!');
                }else{
                    $this->session->set_flashdata('error', 'Error in submitting form');
                }

                foreach($materialprices as $mat)
                { 

                // $this->form_validation->set_rules('Itm_'.$mat->materialtype, 'Itm_'.$mat->materialtype, 'min_length[0]|max_length[45]');
                // $this->form_validation->set_rules('Qty_'.$mat->materialtype, 'Qty_'.$mat->materialtype, 'numeric|min_length[0]');
                // $this->form_validation->set_rules('Total_'.$mat->materialtype, 'Total_'.$mat->materialtype, 'numeric|min_length[0]');
                // $this->form_validation->set_rules('orders_idorders', 'orders_idorders', 'required|min_length[0]|max_length[11]');
                //$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');
    
                
                if ($this->form_validation->run()) {
                
                    $data = array(
                        'itemname' => $this->input->post('Itm_'.$mat->materialtype),
                        'qty' => $this->input->post('Qty_'.$mat->materialtype),
                        'itemamount' => $this->input->post('Total_'.$mat->materialtype),
                        'orders_idorders' => $orderid,
                        'isdelete' => 0,
                    );
    
                    $orderitemid = $this->OrderitemsModel->insert_orderitems($data);
                    if($orderitemid>0){
                        $this->session->set_flashdata('message', 'Form submitted successfully!');
                    }else{
                        $this->session->set_flashdata('error', 'Error in submitting form');
                    }
                }else{
                    $this->session->set_flashdata('error', validation_errors());
                } 
                
            }//foreach end
                    
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        
        }else{
            $this->session->set_flashdata('error', "Bad Request");
        }

        redirect("dashboard");
    }

    public function formupdate($idorders)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['orders'] = $this->OrdersModel->getwhere_orders($idorders);
        $data['primaryid'] = $idorders;

        $this->load->view('template/header');
        $this->load->view('/admin/orders_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('orderdate', 'orderdate', '|valid_date|min_length[0]');
            $this->form_validation->set_rules('amount', 'amount', '|numeric|min_length[0]');
            $this->form_validation->set_rules('discount', 'discount', '|numeric|min_length[0]');
            $this->form_validation->set_rules('tax', 'tax', '|numeric|min_length[0]');
            $this->form_validation->set_rules('isapproved', 'isapproved', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('fillingstation_idfillingstation', 'fillingstation_idfillingstation', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('approvedby', 'approvedby', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('employee_idemployee', 'employee_idemployee', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'orderdate' => $this->input->post('orderdate'),
                    'amount' => $this->input->post('amount'),
                    'discount' => $this->input->post('discount'),
                    'tax' => $this->input->post('tax'),
                    'isapproved' => $this->input->post('isapproved'),
                    'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
                    'approvedby' => $this->input->post('approvedby'),
                    'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
                    'employee_idemployee' => $this->input->post('employee_idemployee'),
                    'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->OrdersModel->insert_orders($data);
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
        $this->load->view('/admin/orders_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idorders) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'orderdate' => $this->input->post('orderdate'),
'amount' => $this->input->post('amount'),
'discount' => $this->input->post('discount'),
'tax' => $this->input->post('tax'),
'isapproved' => $this->input->post('isapproved'),
'fillingstation_idfillingstation' => $this->input->post('fillingstation_idfillingstation'),
'approvedby' => $this->input->post('approvedby'),
'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
'employee_idemployee' => $this->input->post('employee_idemployee'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->OrdersModel->update_orders($idorders, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['orders'] = $this->OrdersModel->get_orders();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();
$data["vehicle"] = $this->VehicleModel->get_vehicle();
$data["employee"] = $this->EmployeeModel->get_employee();

        
        $this->load->view('template/header');
        $this->load->view('admin/orders_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idorders) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->OrdersModel->delete_orders($idorders);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['orders'] = $this->OrdersModel->get_orders();
        
        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation();
$data["vehicle"] = $this->VehicleModel->get_vehicle();
$data["employee"] = $this->EmployeeModel->get_employee();


        $this->load->view('template/header');
        $this->load->view('admin/orders_tableview', $data);
        $this->load->view('template/footer');
    }
}
