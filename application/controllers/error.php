<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->checklogin() ;
    }
    
    public function index()
    {
     
        $datav = "";
    	$this->load->view('error/index', $datav);
    }


    
    public function accessdeny()
    {
     
        $datav = "";
    	$this->load->view('error/accessdeny', $datav);
    }


    
    
    
    
}


