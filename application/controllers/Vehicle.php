<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('VehicleModel'); 
        $this->load->model('VehicletypeModel');
        $this->load->model('LocationModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle'] = $this->VehicleModel->get_vehicle();
        $data["vehicle_type"] = $this->VehicletypeModel->get_vehicle_type();
$data["location"] = $this->LocationModel->get_location();

        $this->load->view('template/header');
        $this->load->view('admin/vehicle_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_formview.php');
        $this->load->view('template/footer');
    }

    public function vehicleregistration()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle'] = $this->VehicleModel->get_vehicle();
        $data["vehicle_type"] = $this->VehicletypeModel->get_vehicle_type();
        $data["location"] = $this->LocationModel->get_location();

        $this->load->view('template/header');
        $this->load->view('pages/registervehicle',$data);
        $this->load->view('template/footer');
    }

    public function vehicleregistrationsave()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_number', 'vehicle_number', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_chasis_number', 'vehicle_chasis_number', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_no_of_passengers', 'vehicle_no_of_passengers', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('vehicle_weight', 'vehicle_weight', 'numeric|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('vehicle_is_available', 'vehicle_is_available', '|min_length[0]|max_length[45]');
            //$this->form_validation->set_rules('vehicle_is_active', 'vehicle_is_active', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_type_idvehicle_type', 'vehicle_type_idvehicle_type', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('Location_idLocation', 'Location_idLocation', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_number' => $this->input->post('vehicle_number'),
                    'vehicle_chasis_number' => $this->input->post('vehicle_chasis_number'),
                    'vehicle_yom' => $this->input->post('vehicle_yom'),
                    'vehicle_no_of_passengers' => $this->input->post('vehicle_no_of_passengers'),
                    'vehicle_weight' => $this->input->post('vehicle_weight'),
                    'vehicle_is_available' => 0,
                    'vehicle_is_active' => 0,
                    'vehicle_type_idvehicle_type' => $this->input->post('vehicle_type_idvehicle_type'),
                    'Location_idLocation' => $this->input->post('Location_idLocation'),
                    'isdelete' => 0,

                );

                $resultid = $this->VehicleModel->insert_vehicle($data);
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
   
       
        redirect("/vehicle/register");
    }

    public function formupdate($idvehicle)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle'] = $this->VehicleModel->getwhere_vehicle($idvehicle);
        $data['primaryid'] = $idvehicle;

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_number', 'vehicle_number', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_chasis_number', 'vehicle_chasis_number', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_yom', 'vehicle_yom', '|valid_date|min_length[0]');
$this->form_validation->set_rules('vehicle_no_of_passengers', 'vehicle_no_of_passengers', '|numeric|min_length[0]|max_length[11]');
$this->form_validation->set_rules('vehicle_weight', 'vehicle_weight', '|numeric|min_length[0]|max_length[11]');
$this->form_validation->set_rules('vehicle_is_available', 'vehicle_is_available', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_is_active', 'vehicle_is_active', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_type_idvehicle_type', 'vehicle_type_idvehicle_type', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('Location_idLocation', 'Location_idLocation', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_number' => $this->input->post('vehicle_number'),
'vehicle_chasis_number' => $this->input->post('vehicle_chasis_number'),
'vehicle_yom' => $this->input->post('vehicle_yom'),
'vehicle_no_of_passengers' => $this->input->post('vehicle_no_of_passengers'),
'vehicle_weight' => $this->input->post('vehicle_weight'),
'vehicle_is_available' => $this->input->post('vehicle_is_available'),
'vehicle_is_active' => $this->input->post('vehicle_is_active'),
'vehicle_type_idvehicle_type' => $this->input->post('vehicle_type_idvehicle_type'),
'Location_idLocation' => $this->input->post('Location_idLocation'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->VehicleModel->insert_vehicle($data);
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
        $this->load->view('/admin/vehicle_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idvehicle) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'vehicle_number' => $this->input->post('vehicle_number'),
'vehicle_chasis_number' => $this->input->post('vehicle_chasis_number'),
'vehicle_yom' => $this->input->post('vehicle_yom'),
'vehicle_no_of_passengers' => $this->input->post('vehicle_no_of_passengers'),
'vehicle_weight' => $this->input->post('vehicle_weight'),
'vehicle_is_available' => $this->input->post('vehicle_is_available'),
'vehicle_is_active' => $this->input->post('vehicle_is_active'),
'vehicle_type_idvehicle_type' => $this->input->post('vehicle_type_idvehicle_type'),
'Location_idLocation' => $this->input->post('Location_idLocation'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->VehicleModel->update_vehicle($idvehicle, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['vehicle'] = $this->VehicleModel->get_vehicle();
        
        $data["vehicle_type"] = $this->Vehicle_typeModel->get_vehicle_type();
$data["location"] = $this->LocationModel->get_location();

        
        $this->load->view('template/header');
        $this->load->view('admin/vehicle_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idvehicle) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->VehicleModel->delete_vehicle($idvehicle);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['vehicle'] = $this->VehicleModel->get_vehicle();
        
        $data["vehicle_type"] = $this->Vehicle_typeModel->get_vehicle_type();
$data["location"] = $this->LocationModel->get_location();


        $this->load->view('template/header');
        $this->load->view('admin/vehicle_tableview', $data);
        $this->load->view('template/footer');
    }
}
