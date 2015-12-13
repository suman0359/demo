<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jonal extends CI_Controller 
{
	public $uid;
	public $module;
        public $user_type;
        
	public function __construct() {
	parent::__construct();

	$this->load->model('Commons', 'CM') ;  
	$this->module='jonal';
	$this->uid=$this->session->userdata('uid');
        $this->user_type = $this->session->userdata('user_type');
        
        
    }

    public function index(){
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');
        
    	$data['jonal_list']=$this->CM->getTotalALL('jonal');

        $no_rows= $this->CM->getTotalRow('jonal');
        $this->load->library('pagination');
        $config['base_url'] = base_url().'jonal/index/';
       
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
        
        $data['jonal_list']=$this->CM->getTotalALL('jonal',$this->uri->segment(3), $config['per_page']);
        
        
    	$this->load->view('jonal/index', $data);
    }

    public function add()
    {
      if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
      
        //$data['id'] = $this->CM->getMaxID('user'); 
        //$data['department_list']=$this->CM->getAll('department');

        $data['division_list']=$this->CM->getTotalALL('division');
        $data['jonal_head_list']=$this->CM->getAllwhere('user', array('user_type' => 4)); // Here Jonal Head User Type ID is 4
        
//        echo "<pre>";
//        print_r($data['jonal_head_list']);
//        exit();
        
        $data['division_id']="";
        

        $data['name'] = "";
        //$data['status'] = "";
      
        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('jonal/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name'); 
            $datas['div_id'] = $this->input->post('division_id');
            $datas['jonal_head_id'] = $this->input->post('jonal_head');
            
            
            $datas['status'] = 1;
            //$datas['entryby']=$this->session->userdata('uid');       
            

            $insert = $this->CM->insert('jonal',$datas) ; 
            if($insert)
            {
                $msg = "Operation Successfull!!";
        		$this->session->set_flashdata('success', $msg);
                redirect('jonal'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
        		$this->session->set_flashdata('error', $msg);
        		$this->load->view('jonal/form', $data); 
            }
              redirect('jonal','refresh'); 
        }
        
    }

    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('jonal', $id) ; 
        $data['division_list']=$this->CM->getTotalALL('division');
        $data['jonal_head_list']=$this->CM->getAllwhere('user', array('user_type' => 4)); // Here Jonal Head User Type ID is 4
       
//        echo "<pre>";
//        print_r($data['jonal_head_list']);
//        exit();
       
        
        $data['name'] = $content->name;
        $data['division_id'] = $content->div_id;
        //$data['status'] = $content->status;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('jonal/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 
            $datas['div_id'] = $this->input->post('division_id');
            $datas['jonal_head_id'] = $this->input->post('jonal_head');      
 
                if($this->CM->update('jonal', $datas, $id)){
                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('jonal'); 
                }
        }
        
    }
    
    
    public function jonaluser($jonla_id){
        if (!$this->CM->checkpermissiontype($this->module, 'jonaluser', $this->user_type))
            redirect('error/accessdeny');
       
        
                $no_rows= count($this->CM->getAllWhere('user', array('jonal_id' => $jonla_id)));
                $this->load->library('pagination');
                $config['base_url'] = base_url().'user/index/';
               
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
        
        $data['user_list']=$this->CM->getAllWhere('user', array('jonal_id' => $jonla_id),   $this->uri->segment(3), $config['per_page']);
        $data['jonal'] = $this->CM->getInfo('jonal', $jonla_id) ; 
        $this->load->view('jonal/jonaluser',$data);  
    }
    
    
}