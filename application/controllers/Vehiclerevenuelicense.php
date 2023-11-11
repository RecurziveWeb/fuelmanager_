<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiclerevenuelicense extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('VehiclerevenuelicenseModel'); 
        $this->load->model('VehicleModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_revenue_license'] = $this->VehiclerevenuelicenseModel->get_vehicle_revenue_license();
        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        $this->load->view('template/header');
        $this->load->view('admin/vehicle_revenue_license_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_revenue_license_formview.php');
        $this->load->view('template/footer');
    }

    public function vehiclerevenueform()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        $this->load->view('template/header');
        $this->load->view('pages/vehiclerevenuelicesen',$data);
        $this->load->view('template/footer');
    }

    public function vehiclerevenueformsave()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_revenue_license_name', 'vehicle_revenue_license_name', 'min_length[0]|max_length[45]');
            //$this->form_validation->set_rules('vehicle_revenue_license_issue_date', 'vehicle_revenue_license_issue_date', 'valid_date|min_length[0]');
            //$this->form_validation->set_rules('vehicle_revenue_license_expiry_date', 'vehicle_revenue_license_expiry_date', 'valid_date|min_length[0]');
            //$this->form_validation->set_rules('vehicle_revenue_license_is_active', 'vehicle_revenue_license_is_active', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');

            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_revenue_license_name' => $this->input->post('vehicle_revenue_license_name'),
                    'vehicle_revenue_license_issue_date' => $this->input->post('vehicle_revenue_license_issue_date'),
                    'vehicle_revenue_license_expiry_date' => $this->input->post('vehicle_revenue_license_expiry_date'),
                    'vehicle_revenue_license_is_active' => 0,
                    'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
                    'isdelete' => 0,

                );

                $resultid = $this->VehiclerevenuelicenseModel->insert_vehicle_revenue_license($data);
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

        redirect("vehicle/certificate/revenuelicesen");
    }

    public function formupdate($idvehicle_revenue_license)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_revenue_license'] = $this->VehiclerevenuelicenseModel->getwhere_vehicle_revenue_license($idvehicle_revenue_license);
        $data['primaryid'] = $idvehicle_revenue_license;

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_revenue_license_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_revenue_license_name', 'vehicle_revenue_license_name', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_revenue_license_issue_date', 'vehicle_revenue_license_issue_date', '|valid_date|min_length[0]');
$this->form_validation->set_rules('vehicle_revenue_license_expiry_date', 'vehicle_revenue_license_expiry_date', '|valid_date|min_length[0]');
$this->form_validation->set_rules('vehicle_revenue_license_is_active', 'vehicle_revenue_license_is_active', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_revenue_license_name' => $this->input->post('vehicle_revenue_license_name'),
'vehicle_revenue_license_issue_date' => $this->input->post('vehicle_revenue_license_issue_date'),
'vehicle_revenue_license_expiry_date' => $this->input->post('vehicle_revenue_license_expiry_date'),
'vehicle_revenue_license_is_active' => $this->input->post('vehicle_revenue_license_is_active'),
'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->VehiclerevenuelicenseModel->insert_vehicle_revenue_license($data);
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
        $this->load->view('/admin/vehicle_revenue_license_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idvehicle_revenue_license) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'vehicle_revenue_license_name' => $this->input->post('vehicle_revenue_license_name'),
'vehicle_revenue_license_issue_date' => $this->input->post('vehicle_revenue_license_issue_date'),
'vehicle_revenue_license_expiry_date' => $this->input->post('vehicle_revenue_license_expiry_date'),
'vehicle_revenue_license_is_active' => $this->input->post('vehicle_revenue_license_is_active'),
'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->VehiclerevenuelicenseModel->update_vehicle_revenue_license($idvehicle_revenue_license, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['vehicle_revenue_license'] = $this->VehiclerevenuelicenseModel->get_vehicle_revenue_license();
        
        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        
        $this->load->view('template/header');
        $this->load->view('admin/vehicle_revenue_license_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idvehicle_revenue_license) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->VehiclerevenuelicenseModel->delete_vehicle_revenue_license($idvehicle_revenue_license);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['vehicle_revenue_license'] = $this->VehiclerevenuelicenseModel->get_vehicle_revenue_license();
        
        $data["vehicle"] = $this->VehicleModel->get_vehicle();


        $this->load->view('template/header');
        $this->load->view('admin/vehicle_revenue_license_tableview', $data);
        $this->load->view('template/footer');
    }
}
