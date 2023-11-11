<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('UsersModel'); 
        
        $this->load->library('form_validation'); 
    }

    public function index() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['users'] = $this->UsersModel->get_users();
        
        $this->load->view('template/header');
        $this->load->view('admin/users_tableview', $data);
        $this->load->view('template/footer');
    }

    public function formview()
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $this->load->view('template/header');
        $this->load->view('/admin/users_formview.php');
        $this->load->view('template/footer');
    }

    public function formupdate($idUsers)
    {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }

        $data['users'] = $this->UsersModel->getwhere_users($idUsers);
        $data['primaryid'] = $idUsers;

        $this->load->view('template/header');
        $this->load->view('/admin/users_updateview.php',$data);
        $this->load->view('template/footer');
    }

    public function create() {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('firstname', 'firstname', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('lastname', 'lastname', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('email', 'email', '|valid_email|min_length[0]|max_length[256]');
            $this->form_validation->set_rules('password', 'password', '|min_length[0]|max_length[300]');
            $this->form_validation->set_rules('isadmin', 'isadmin', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('isdealer', 'isdealer', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('isdriver', 'isdriver', '|min_length[0]|max_length[4]');
            $this->form_validation->set_rules('phonenumber', 'phonenumber', '|min_length[0]|max_length[45]');
            $this->form_validation->set_rules('isdelete', 'isdelete', 'required|min_length[0]|max_length[1]');


            if ($this->form_validation->run()) {
                
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'isadmin' => $this->input->post('isadmin'),
                    'isdealer' => $this->input->post('isdealer'),
                    'isdriver' => $this->input->post('isdriver'),
                    'phonenumber' => $this->input->post('phonenumber'),
                    'isdelete' => $this->input->post('isdelete'),

                );

                $resultid = $this->UsersModel->insert_users($data);
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
        $this->load->view('/admin/users_formview.php');
        $this->load->view('template/footer');
    }

    public function edit($idUsers) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
              
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'isadmin' => $this->input->post('isadmin'),
                'isdealer' => $this->input->post('isdealer'),
                'isdriver' => $this->input->post('isdriver'),
                'phonenumber' => $this->input->post('phonenumber'),
                'isdelete' => $this->input->post('isdelete'),

            );

            $resultid = $this->UsersModel->update_users($idUsers, $data);

            if($resultid>0){
                $this->session->set_flashdata('message', 'Form updated successfully!');
            }else{
                $this->session->set_flashdata('error', 'Error in updating form');
            }
        }
        
        $data['users'] = $this->UsersModel->get_users();
        
        
        
        $this->load->view('template/header');
        $this->load->view('admin/users_tableview', $data);
        $this->load->view('template/footer');
    }

    public function delete($idUsers) {
        if(!$this->session->userdata('email')){    
            redirect('login/auth');
        }
       
        $resultid = $this->UsersModel->delete_users($idUsers);

        if($resultid>0){
            $this->session->set_flashdata('message', 'Row Delete successfully!');
        }else{
            $this->session->set_flashdata('error', 'Error in Delete Row');
        }
        
        $data['users'] = $this->UsersModel->get_users();
        
        

        $this->load->view('template/header');
        $this->load->view('admin/users_tableview', $data);
        $this->load->view('template/footer');
    }
}