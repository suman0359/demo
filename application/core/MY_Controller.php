<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $_notification = "";

    public function __construct() {
        parent::__construct();

        $this->load->Model('Commons', 'CM');
        $this->load->model('Report_model', 'RM');
        $this->load->Model('Userauth_model', 'UA');

        $this->load->library('Encrypt');
        $uid = $this->session->userdata('uid');
    }

    public function checklogin() {
        if (!$this->session->userdata('user_logged')) {
            redirect('login');
        }
    }

}
