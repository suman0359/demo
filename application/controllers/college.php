<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class College extends CI_Controller 
{
	 

	public $uid;
    public $module;
    public $user_type;

    public function __construct() {
    parent::__construct();

    $this->load->model('Commons', 'CM') ;  
    $this->module='college';
    $this->uid=$this->session->userdata('uid');
    $this->user_type = $this->session->userdata('user_type');
    }

    public function index(){
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');

    	$data['college_list']=$this->CM->getTotalALL('college');
        $data['district_list']=$this->CM->getTotalALL('district');
        $data['thana_list']=$this->CM->getTotalALL('thana');

        $no_rows= $this->CM->getTotalRow('college');
        $this->load->library('pagination');
        $config['base_url'] = base_url().'college/index/';
       
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
        
        $data['college_list']=$this->CM->getTotalALL('college',$this->uri->segment(3), $config['per_page']);
        
    	$this->load->view('college/index', $data);
    }

    public function add()
    {
      if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
      
        //$data['id'] = $this->CM->getMaxID('user'); 
        //$data['department_list']=$this->CM->getAll('department');

        $data['district_list']=$this->CM->getAll('district', 'name ASC' );
       $data['division_list']=$this->CM->getAll('division', 'name ASC');
        
        

        $data['name'] = '';
        $data['district_id'] = '';
        $data['thana_id'] = '';
        $data['address'] = '';
        $data['district_id'] = '';
        $data['division_id'] = '';
        $data['jonal_id'] = '';
        $data['executive_id'] = '';
        
        
        
        
      
        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'required', 'address');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('college/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name');
            $datas['district_id'] = $this->input->post('district_id');
            $datas['thana_id'] = $this->input->post('thana_id');
            $datas['address'] = $this->input->post('address');
            $datas['division_id'] = $this->input->post('division_id');
            $datas['jonal_id'] = $this->input->post('jonal_id');
            $datas['executive_id'] = $this->input->post('executive_id');

            $datas['status'] = 1;
            //$datas['entryby']=$this->session->userdata('uid');       
            

            $insert = $this->CM->insert('college',$datas) ; 
            if($insert)
            {
                $msg = "Operation Successfull!!";
        		$this->session->set_flashdata('success', $msg);
                redirect('college'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
        		$this->session->set_flashdata('error', $msg);
        		$this->load->view('college/form', $data); 
            }
              redirect('college','refresh'); 
        }
        
    }

    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('college', $id) ; 
        $data['district_list']=$this->CM->getAll('district', 'name ASC');
        $data['division_list']=$this->CM->getAll('division', 'name ASC');
        
        $data['name'] = $content->name;
        $data['district_id'] = $content->district_id;
        $data['thana_id'] = $content->thana_id;
        $data['address'] = $content->address;
        $data['division_id'] = $content->division_id;
        $data['jonal_id'] = $content->jonal_id;
        $data['executive_id'] = $content->executive_id;
        
        
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required', 'address');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('college/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 
            $datas['district_id'] = $this->input->post('district_id');
            $datas['thana_id'] = $this->input->post('thana_id');
            $datas['address'] = $this->input->post('address');
            $datas['division_id'] = $this->input->post('division_id');
            $datas['jonal_id'] = $this->input->post('jonal_id');
            $datas['executive_id'] = $this->input->post('executive_id');
            //$datas['entryby']=$this->session->userdata('uid');       
 
                if($this->CM->update('college', $datas, $id)){
                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('college'); 
                }
        }
        
    }
}