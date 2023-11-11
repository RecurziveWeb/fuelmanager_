<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicletype extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('VehicletypeModel'); 
        
        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_type'] = $this->VehicletypeModel->get_vehicle_type();
        
        $this->load->view('template/header');
        $this->load->view('admin/vehicle_type_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_type_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idvehicle_type)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['vehicle_type'] = $this->VehicletypeModel->getwhere_vehicle_type($idvehicle_type);
        $data['primaryid'] = $idvehicle_type;

        $this->load->view('template/header');
        $this->load->view('/admin/vehicle_type_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('vehicle_capacity', 'vehicle_capacity', '|numeric|min_length[0]|max_length[11]');
$this->form_validation->set_rules('vehicle_type', 'vehicle_type', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('vehicle_type_is_active', 'vehicle_type_is_active', '|min_length[0]|max_length[45]');
$this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'vehicle_capacity' => $this->input->post('vehicle_capacity'),
'vehicle_type' => $this->input->post('vehicle_type'),
'vehicle_type_is_active' => $this->input->post('vehicle_type_is_active'),
'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->VehicletypeModel->insert_vehicle_type($data);
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
        $this->load->view('/admin/vehicle_type_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idvehicle_type) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'vehicle_capacity' => $this->input->post('vehicle_capacity'),
'vehicle_type' => $this->input->post('vehicle_type'),
'vehicle_type_is_active' => $this->input->post('vehicle_type_is_active'),
'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->VehicletypeModel->update_vehicle_type($idvehicle_type, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['vehicle_type'] = $this->VehicletypeModel->get_vehicle_type();
        
        
        
        $this->load->view('template/header');
        $this->load->view('admin/vehicle_type_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idvehicle_type) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->VehicletypeModel->delete_vehicle_type($idvehicle_type);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['vehicle_type'] = $this->VehicletypeModel->get_vehicle_type();
        
        

        $this->load->view('template/header');
        $this->load->view('admin/vehicle_type_tableview', $data);
        $this->load->view('template/footer');
    }
}
