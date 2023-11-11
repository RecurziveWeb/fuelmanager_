<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fillingstation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('FillingstationModel'); 
        $this->load->model('UsersModel');

        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['fillingstation'] = $this->FillingstationModel->get_fillingstation();
        $data["users"] = $this->UsersModel->get_users();

        $this->load->view('template/header');
        $this->load->view('admin/fillingstation_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/fillingstation_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idfillingstation)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['fillingstation'] = $this->FillingstationModel->getwhere_fillingstation($idfillingstation);
        $data['primaryid'] = $idfillingstation;

        $this->load->view('template/header');
        $this->load->view('/admin/fillingstation_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('fillingstation_name', 'fillingstation_name', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('fillingstation_address', 'fillingstation_address', 'min_length[0]|max_length[450]');
            $this->form_validation->set_rules('numberoffueldespencers', 'numberoffueldespencers', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('capacityofpetroltank', 'capacityofpetroltank', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('capacityofdieseltank', 'capacityofdieseltank', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('capacityofsuperpetrol', 'capacityofsuperpetrol', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('capacityofsuperdiesel', 'capacityofsuperdiesel', 'numeric|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('district', 'district', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('Users_idUsers', 'Users_idUsers', 'required|min_length[0]|max_length[11]');
            $this->form_validation->set_rules('isapproved', 'isapproved', 'min_length[0]|max_length[4]');
            $this->form_validation->set_rules('approvedby', 'approvedby', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'fillingstation_name' => $this->input->post('fillingstation_name'),
                    'fillingstation_address' => $this->input->post('fillingstation_address'),
                    'numberoffueldespencers' => $this->input->post('numberoffueldespencers'),
                    'capacityofpetroltank' => $this->input->post('capacityofpetroltank'),
                    'capacityofdieseltank' => $this->input->post('capacityofdieseltank'),
                    'capacityofsuperpetrol' => $this->input->post('capacityofsuperpetrol'),
                    'capacityofsuperdiesel' => $this->input->post('capacityofsuperdiesel'),
                    'district' => $this->input->post('district'),
                    'Users_idUsers' => $this->input->post('Users_idUsers'),
                    'isapproved' => 0,
                    'approvedby' => "pending",
                    'isdelete' => 0,

                );

                $resultid = $this->FillingstationModel->insert_fillingstation($data);
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
        $this->load->view('/admin/fillingstation_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idfillingstation) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'fillingstation_name' => $this->input->post('fillingstation_name'),
                'fillingstation_address' => $this->input->post('fillingstation_address'),
                'numberoffueldespencers' => $this->input->post('numberoffueldespencers'),
                'capacityofpetroltank' => $this->input->post('capacityofpetroltank'),
                'capacityofdieseltank' => $this->input->post('capacityofdieseltank'),
                'capacityofsuperpetrol' => $this->input->post('capacityofsuperpetrol'),
                'capacityofsuperdiesel' => $this->input->post('capacityofsuperdiesel'),
                'district' => $this->input->post('district'),
                'Users_idUsers' => $this->input->post('Users_idUsers'),
                'isapproved' => $this->input->post('isapproved'),
                'approvedby' => $this->input->post('approvedby'),
                'isdelete' => $this->input->post('isdelete'),
            );

            $resultid = $this->FillingstationModel->update_fillingstation($idfillingstation, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['fillingstation'] = $this->FillingstationModel->get_fillingstation();
        
        $data["users"] = $this->UsersModel->get_users();

        
        $this->load->view('template/header');
        $this->load->view('admin/fillingstation_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idfillingstation) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->FillingstationModel->delete_fillingstation($idfillingstation);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['fillingstation'] = $this->FillingstationModel->get_fillingstation();
        
        $data["users"] = $this->UsersModel->get_users();


        $this->load->view('template/header');
        $this->load->view('admin/fillingstation_tableview', $data);
        $this->load->view('template/footer');
    }

    public function unapprovallist()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data["fillingstations"] = $this->FillingstationModel->get_fillingstation_unapproved();    
        
        $this->load->view('template/header');
        $this->load->view('pages/unapprovedfuelstations', $data);
        $this->load->view('template/footer');
    }

    public function unapprovallistbyid($id)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data["fillingstation"] = $this->FillingstationModel->get_fillingstation_unapprovedbyid($id);    
        
        $this->load->view('template/header');
        $this->load->view('pages/fuelstationdoc', $data);
        $this->load->view('template/footer');
    }

    public function approve($idfillingstation) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'isapproved' => $this->input->post('isapproved'),
                'approvedby' => $this->input->post('approvedby')
            );

            $resultid = $this->FillingstationModel->update_fillingstation($idfillingstation, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
       redirect("dashboard");
    }
}
