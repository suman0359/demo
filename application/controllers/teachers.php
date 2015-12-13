<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teachers extends CI_Controller {

    public $uid;
    public $user_type;
    public $module;

    public function __construct() {
        parent::__construct();

        $this->load->model('Commons', 'CM');
        $this->module = 'teachers';
        $this->uid = $this->session->userdata('uid');
        $this->user_type = $this->session->userdata('user_type');
        
        
    }

    public function index(){
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');

        $data['teachers_list'] = $this->CM->getTotalALL('teachers');

        $no_rows = $this->CM->getTotalRow('teachers');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'teachers/index/';

        $config['total_rows'] = $no_rows;
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

        $data['teachers_list'] = $this->CM->getTotalALL('teachers', $this->uri->segment(3), $config['per_page']);


        $this->load->view('teachers/index', $data);
    }

    public function add() {
       if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');


        $data['department_list'] = $this->CM->getAll('department', 'name ASC');
        $data['college_list'] = $this->CM->getAll('college', 'name ASC');


        $data['name'] = "";
        $data['department_id'] = "";
        $data['college_id'] = "";

        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'required', 'address', 'college_id', 'department_id');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('teachers/form', $data);
        } else {

            $datas['name'] = $this->input->post('name');
            $datas['college_id'] = $this->input->post('college_id');
            $datas['dep_id'] = $this->input->post('department_id');
            $datas['address'] = $this->input->post('address');

            $datas['status'] = 1;
            //$datas['entryby']=$this->session->userdata('uid');       


            $insert = $this->CM->insert('teachers', $datas);
            if ($insert) {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('teachers');
            } else {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('college/form', $data);
            }
            redirect('teachers', 'refresh');
        }
    }

    public function edit($id) {
        if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');

        $content = $this->CM->getInfo('teachers', $id);
        $data['department_list'] = $this->CM->getAll('department', 'name', 'ASC');
        $data['college_list'] = $this->CM->getAll('college', 'name', 'ASC');

        $data['name'] = $content->name;
        $data['address'] = $content->address;
        $data['college_id'] = $content->college_id;
        $data['department_id'] = $content->dep_id;
        //$data['status'] = $content->status;
        // $data['_id'] = $content->district_id;


        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'required', 'address', 'college_id', 'department_id');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('teachers/form', $data);
        } else {
            $datas['name'] = $this->input->post('name');
            $datas['college_id'] = $this->input->post('college_id');
            $datas['dep_id'] = $this->input->post('department_id');
            $datas['address'] = $this->input->post('address');
            //$datas['status'] = $this->input->post('status');
            //$datas['entryby']=$this->session->userdata('uid');       

            if ($this->CM->update('teachers', $datas, $id)) {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('teachers');
            }
        }
    }

    public function getteacherbycollage($collage) {
        $teachers_list = $this->CM->getAllWhere('teachers', array('college_id' => $collage));

        echo json_encode($teachers_list);
    }

}
