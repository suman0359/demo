<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userauth extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Userauth_model');
    }

    public function index() {
        
    }

    public function login() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'email', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $msg = "There is an error, Please try again!!";
            $this->session->set_flashdata('error', $msg);
            $this->load->view('userauth/login');
        } else {

            $email = $this->input->post('email');
            $password = $this->input->post('password');


            $checkdata = $this->Userauth_model->checklogin($email, $password);


            if (!empty($checkdata)) {
                $userinfo = array(
                    'username' => $checkdata->name,
                    'email' => $checkdata->email,
                    'uid' => $checkdata->id,
                    'user_type' => $checkdata->user_type,
                    'permissiond' => $checkdata->pdepartment,
                    //'image'=$checkdata->image,
                    'user_type' => $checkdata->user_type,
                    'division_id' => $checkdata->division_id,
                    'jonal_id' => $checkdata->jonal_id,
                    'user_logged' => TRUE
                );

                $this->session->set_userdata($userinfo);
                /*
                  $logininfo = $this->Logins->updateLoginInfo($uid);
                 */
                redirect('./');
            } else {
                $msg = "There is an error in login, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('userauth/login');
            }
        }
    }

    public function logout() {
        //$msg = "Operation Successfull!!";
        //$this->session->set_flashdata('success', $msg);

        $this->session->sess_destroy();
        redirect('userauth/login', 'refresh');
    }

}
