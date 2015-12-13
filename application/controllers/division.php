<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Division extends CI_Controller 
{
    public $uid;
    public $module;
    public $user_type;

    public function __construct() {
    parent::__construct();

    $this->load->model('Commons', 'CM') ;  
    $this->module='division';
    $this->uid=$this->session->userdata('uid');
    $this->user_type = $this->session->userdata('user_type');
    }

    public function index()
    {
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');
        $data['division_list']=$this->CM->getAll('division');
        $this->load->view('division/index', $data);
    }

    public function add()
    {
      if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
      
       // $data['id'] = $this->CM->getMaxID('user'); 
     
        $data['division_user']=$this->CM->getAllWhere('user', array('user_type' => '3'));
        
        $data['name'] = "";
        $data['division_head'] = "";
        //$data['status'] = "";
      
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('division/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name'); 
            $datas['division_head'] = $this->input->post('division_head'); 
            
            $datas['status'] = 1;
            //$datas['entryby']=$this->session->userdata('uid');       
            

            $insert = $this->CM->insert('division',$datas) ; 
            if($insert)
            {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('division'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('division/form', $data); 
            }
              redirect('division','refresh'); 
        }
        
    }


    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('division', $id) ; 
        $data['division_user']=$this->CM->getAllWhere('user', array('user_type' => '3'));
       
        
        $data['name'] = $content->name;
        $data['division_head'] = $content->division_head;
        //$data['status'] = $content->status;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('division/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 
            $datas['division_head'] = $this->input->post('division_head'); 
            //$datas['status'] = $this->input->post('status');
            //$datas['entryby']=$this->session->userdata('uid');       
 
                if($this->CM->update('division', $datas, $id)){
                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('division'); 
                }
        }
        
    }


}