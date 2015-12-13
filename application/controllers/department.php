<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MY_Controller 
{
    public $uid;
    public $module;
    public $user_type;

    public function __construct() {
    parent::__construct();

    
    $this->module='department';
    $this->uid=$this->session->userdata('uid');
    $this->user_type = $this->session->userdata('user_type');
    }

    public function index()
    {
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');

        $data['content_list']=$this->CM->getAll('department');
        $this->load->view('department/index', $data);
    }

    public function add()
    {
      if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
       
        
        $data['name'] = "";
        //$data['status'] = "";
      
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('department/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name'); 
            
            $datas['status'] = 1;
          
            

            $insert = $this->CM->insert('department',$datas) ; 
            if($insert)
            {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('department'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('department/form', $data); 
            }
              redirect('department','refresh'); 
        }
        
    }


    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('department', $id) ; 
       
        
        
        $data['name'] = $content->name;
        //$data['status'] = $content->status;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('department/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 
            //$datas['status'] = $this->input->post('status');
            //$datas['entryby']=$this->session->userdata('uid');       
 
                if($this->CM->update('department', $datas, $id)){
                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('department'); 
                }
        }
        
}

    public function getdepartmentbyteacher($teacher){
        $department_list=$this->CM->getAllWhere('department', array('id' => $teacher));
       
        echo json_encode($department_list); 
        
    }


}