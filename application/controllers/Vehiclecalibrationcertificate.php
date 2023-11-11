<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiclecalibrationcertificate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('VehiclecalibrationcertificateModel'); 
        $this->load->model('VehicleModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_calibration_certificate'] = $this->VehiclecalibrationcertificateModel->get_vehicle_calibration_certificate();
        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        $this->load->view('template/header');
        $this->load->view('admin/vehicle_calibration_certificate_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_calibration_certificate_formview.php');
        $this->load->view('template/footer');
    }

    public function vehiclecertification()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_calibration_certificate'] = $this->VehiclecalibrationcertificateModel->get_vehicle_calibration_certificate();
        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        $this->load->view('template/header');
        $this->load->view('pages/vehiclecertification',$data);
        $this->load->view('template/footer');
    }

    public function vehiclecertificatesave()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_calibration_certificate_name', 'vehicle_calibration_certificate_name', 'min_length[0]|max_length[45]');
            //$this->form_validation->set_rules('vehicle_calibration_certificate_issue_date', 'vehicle_calibration_certificate_issue_date', '|valid_date|min_length[0]');
            //$this->form_validation->set_rules('vehicle_calibration_certificate_expiry_date', 'vehicle_calibration_certificate_expiry_date', '|valid_date|min_length[0]');
            //$this->form_validation->set_rules('vehicle_calibration_certificate_is_active', 'vehicle_calibration_certificate_is_active', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
            //$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_calibration_certificate_name' => $this->input->post('vehicle_calibration_certificate_name'),
                    'vehicle_calibration_certificate_issue_date' => $this->input->post('vehicle_calibration_certificate_issue_date'),
                    'vehicle_calibration_certificate_expiry_date' => $this->input->post('vehicle_calibration_certificate_expiry_date'),
                    'vehicle_calibration_certificate_is_active' => 0,
                    'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
                    'isdelete' => 0,
                );

                $resultid = $this->VehiclecalibrationcertificateModel->insert_vehicle_calibration_certificate($data);
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
   
       
        redirect("vehicle/certificate/calibration");

    }

    public function formupdate($idvehicle_calibration_certificate)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_calibration_certificate'] = $this->VehiclecalibrationcertificateModel->getwhere_vehicle_calibration_certificate($idvehicle_calibration_certificate);
        $data['primaryid'] = $idvehicle_calibration_certificate;

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_calibration_certificate_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_calibration_certificate_name', 'vehicle_calibration_certificate_name', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_calibration_certificate_issue_date', 'vehicle_calibration_certificate_issue_date', '|valid_date|min_length[0]');
$this->form_validation->set_rules('vehicle_calibration_certificate_expiry_date', 'vehicle_calibration_certificate_expiry_date', '|valid_date|min_length[0]');
$this->form_validation->set_rules('vehicle_calibration_certificate_is_active', 'vehicle_calibration_certificate_is_active', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_idvehicle', 'vehicle_idvehicle', 'required|min_length[0]|max_length[11]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_calibration_certificate_name' => $this->input->post('vehicle_calibration_certificate_name'),
'vehicle_calibration_certificate_issue_date' => $this->input->post('vehicle_calibration_certificate_issue_date'),
'vehicle_calibration_certificate_expiry_date' => $this->input->post('vehicle_calibration_certificate_expiry_date'),
'vehicle_calibration_certificate_is_active' => $this->input->post('vehicle_calibration_certificate_is_active'),
'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->VehiclecalibrationcertificateModel->insert_vehicle_calibration_certificate($data);
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
        $this->load->view('/admin/vehicle_calibration_certificate_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idvehicle_calibration_certificate) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'vehicle_calibration_certificate_name' => $this->input->post('vehicle_calibration_certificate_name'),
'vehicle_calibration_certificate_issue_date' => $this->input->post('vehicle_calibration_certificate_issue_date'),
'vehicle_calibration_certificate_expiry_date' => $this->input->post('vehicle_calibration_certificate_expiry_date'),
'vehicle_calibration_certificate_is_active' => $this->input->post('vehicle_calibration_certificate_is_active'),
'vehicle_idvehicle' => $this->input->post('vehicle_idvehicle'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->VehiclecalibrationcertificateModel->update_vehicle_calibration_certificate($idvehicle_calibration_certificate, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['vehicle_calibration_certificate'] = $this->VehiclecalibrationcertificateModel->get_vehicle_calibration_certificate();
        
        $data["vehicle"] = $this->VehicleModel->get_vehicle();

        
        $this->load->view('template/header');
        $this->load->view('admin/vehicle_calibration_certificate_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idvehicle_calibration_certificate) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->VehiclecalibrationcertificateModel->delete_vehicle_calibration_certificate($idvehicle_calibration_certificate);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['vehicle_calibration_certificate'] = $this->VehiclecalibrationcertificateModel->get_vehicle_calibration_certificate();
        
        $data["vehicle"] = $this->VehicleModel->get_vehicle();


        $this->load->view('template/header');
        $this->load->view('admin/vehicle_calibration_certificate_tableview', $data);
        $this->load->view('template/footer');
    }
}
