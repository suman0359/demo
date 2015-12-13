<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisioninventory extends MY_Controller
{
     
    public $uid;
    public $module;

    public function __construct() {
    parent::__construct();
    $this->checklogin() ;
     
    $this->module='user';
    $this->uid=$this->session->userdata('uid');
    }
    
    
    public function index($div_id=1)
    {
     
        if( !$this->CM->checkpermission($this->module,'index', $this->uid) && $this->session->userdata('user_type')=='5')
             redirect ('error/accessdeny');
        
        if($this->session->userdata('user_type') == '3')
        {
            $div_id = $this->session->userdata('division_id');
            $data['div_list'] = array() ; 
        }else 
        {
            $data['div_list']=$this->CM->getAll('division') ; 
        }
        
          $data['division_info'] = $this->CM->getInfo('division', $div_id) ; 
          
                $no_rows= count($this->CM->getAllWhere('inventory_division', array('division_id'=>$div_id)));
                $this->load->library('pagination');
                $config['base_url'] = base_url().'divisioninventory/index/'.$div_id."/";
               
                $config['total_rows'] = $no_rows ;
                $config['per_page'] = 15;
                $config['full_tag_open'] = '<div class=" text-center"><ul class=" list-inline list-unstyled " id="listpagiction">';
                $config['full_tag_close'] = '</ul></div>';
                $config['prev_link'] = '&lt; Prev';
                $config['prev_tag_open'] = '<li class="link_pagination">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next &gt;';
                $config['next_tag_open'] = '<li class="link_pagination">';
                $config['next_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active_pagiction"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li class="link_pagination">';
                $config['num_tag_close'] = '</li>';
                $config['last_link'] = 'Last';
                $config['first_link'] = 'First';
                $this->pagination->initialize($config);     
        
        $data['content_list']=$this->CM->getAllWhere('inventory_division', array('division_id' => $div_id),   $this->uri->segment(4), $config['per_page']);
        
    	$this->load->view('division/divisioninventory', $data);
    }


    
    
    
    
    
}


