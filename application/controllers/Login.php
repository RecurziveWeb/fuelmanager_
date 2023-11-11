<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');         
        $this->load->library('form_validation'); 
    }

    public function index() 
    {
        $this->load->view('pages/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->view('pages/login');
    }

    public function checklogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
        
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[0]|max_length[15]');
        
            if ($this->form_validation->run()) {
                
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                $password_hash = hash_hmac('sha256',$password, $this->config->item('systemkey'));

                $result = $this->UsersModel->checkcredential($email, $password_hash);

                if(sizeof($result)>0){
                    $data = array(
                        'user_id' => $result[0]->idUsers,
                        'username' => $result[0]->firstname." ".$result[0]->lastname,
                        'email' => $result[0]->email
                    );

                    $this->session->set_userdata($data);
                    redirect("dashboard");

                }else{
                    $this->session->set_flashdata('error', 'Error in Credentials');
                    $this->load->view('pages/login');
                }


            }else{
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('pages/login');
            }
        }else{
            $this->session->set_flashdata('error', 'Bad Request');
            $this->load->view('pages/login');
        }
    }

    public function register()
    {
        $this->load->view('pages/register');
    }

    public function registeruser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules('firstname', 'firstname', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('lastname', 'lastname', 'min_length[0]|max_length[45]');
            $this->form_validation->set_rules('email', 'email', 'valid_email|min_length[0]|max_length[256]');
            $this->form_validation->set_rules('password', 'password', 'min_length[0]|max_length[300]');
            $this->form_validation->set_rules('phonenumber', 'phonenumber', 'min_length[0]|max_length[45]');


            if ($this->form_validation->run()) {
                
                $this->load->helper('string');

                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => hash_hmac('sha256',$this->input->post('password'), $this->config->item('systemkey')),
                    'phonenumber' => $this->input->post('phonenumber'),                    
                    'isadmin' => 0,
                    'isdealer' => 0,
                    'isdriver' => 0,
                    'isdelete' => 0,
                );

                $resultid = $this->UsersModel->insert_users($data);

                if($resultid>0){
                    $this->session->set_flashdata('message', 'Successfully Registerd');
                }else{
                    $this->session->set_flashdata('error', 'Error in Register');
                }
                
            }else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }else{
            $this->session->set_flashdata('error', "Bad Request");
        }
          
        $this->load->view('pages/login');
    }
}
