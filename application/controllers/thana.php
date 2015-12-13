<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thana extends CI_Controller 
{
	 

	public $uid;
    public $module;
    public $user_type;

    public function __construct() {
    parent::__construct();

    $this->load->model('Commons', 'CM') ;  
    $this->module='thana';
    $this->uid=$this->session->userdata('uid');
    $this->user_type = $this->session->userdata('user_type');
    }

    public function index(){
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');

    	$data['thana_list']=$this->CM->getTotalALL('thana');
       
        
    	$no_rows= $this->CM->getTotalRow('thana');
        $this->load->library('pagination');
        $config['base_url'] = base_url().'thana/index/';
       
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
        
        $data['thana_list']=$this->CM->getTotalALL('thana',$this->uri->segment(3), $config['per_page']);
        $this->load->view('thana/index',$data);    
    }

    public function add(){
        if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
      
       // $data['id'] = $this->CM->getMaxID('user'); 
     
        $data['subject_user']=$this->CM->getAllWhere('user', array('user_type' => '3'));
        
        $data['name'] = "";

        //$data['status'] = "";
      
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('thana/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name'); 
            
            $datas['status'] = 1;
            //$datas['entryby']=$this->session->userdata('uid');       
            

            $insert = $this->CM->insert('thana',$datas) ; 
            if($insert)
            {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('thana'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('thana/form', $data); 
            }
              redirect('thana','refresh'); 
        }
        
    }

    // Edit Subject 
    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('thana', $id) ; 
        //$data['division_user']=$this->CM->getAllWhere('user', array('user_type' => '3'));
       
        
        $data['name'] = $content->name;
        //$data['status'] = $content->status;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('thana/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 

            //$datas['status'] = $this->input->post('status');
            //$datas['entryby']=$this->session->userdata('uid');       
      if($this->CM->update('thana', $datas, $id)){
                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('thana'); 
                }
        }
        
    }

}