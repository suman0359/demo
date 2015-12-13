<?php

class Purchase extends MY_Controller {

    public $_uid;
    public $user_type;

    public function __construct() {
        parent::__construct();
        $this->checklogin();
        $this->load->model('Purchase_model', 'PM');
        $this->load->model('Report_model', 'RM');
        $this->_uid = $this->session->userdata('uid');
        $this->user_type = $this->session->userdata('user_type');
        $this->module = 'purchase';

        if ($this->session->userdata('user_type') !== '1')
            redirect('error/accessdeny');
    }

    public function index() {
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');


        $data;
        $this->load->view('purchase/index', $data);
    }

    public function add($rid = NULL) {
        if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');

        $data['pro_list'] = $this->CM->getAll('books');
        $data['div_list'] = $this->CM->getAll('division', 'id DESC');
        //$data['executive_list'] = $this->CM->getAllWhere('user', array('user_type' => 5), 'id DESC');
        $data['id'] = "";
        $data['name'] = "";
        $data['cid'] = "";
        $data['pid'] = "";
        $data['sid'] = "";
        $data['price'] = "";
        $data['qty'] = "";
        $data['total_p'] = "";
        $data['t_price'] = "";
        $data['t_qty'] = "";
        $data['comments'] = "";
        $data['memo_no'] = "";
        $data['date'] = date('d-m-Y');

        $data['books'] = array();
        $data['rid'] = '';
        if ($rid != NULL) {
            $data['books'] = $this->RM->getRequisitionBooks($rid);
            $data['rid'] = $rid;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pid', 'product', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('purchase/form', $data);
        } else {
            //purchase table operation
            $this->db->trans_start();



            $division_id = $this->input->post('division_id');
            $jonal_id = $this->input->post('jonal_id');
            $college_id = $this->input->post('college_id');
            $teacher_id= $this->input->post('teacher_id');
            $department_id = $this->CM->getIdWhere('id', 'id', $teacher_id, 'teachers');
            
            $department_id = $department_id->id;
            
            
            //New supplier Create




            if (empty($college_id)) {
                $msg = "Must selecta  college ...";
                $this->session->set_flashdata('error', $msg);
                redirect('purchase/add');
            }




            $pur_info['transfer_to'] = $college_id;
            $pur_info['memo_no'] = $this->input->post('memo_no');
            $pur_info['comments'] = $this->input->post('comments');
            $pur_info['status'] = 1;
            $pur_info['entryby'] = $this->_uid;
            $pur_info['rid'] = $this->input->post('rid');
            $purchase_date = strtotime($this->input->post('date'));
            $pur_info['challan_date'] = date('Y-m-d', $purchase_date);

            $pur_info['transfer_from_div'] = $division_id;
            $pur_info['to_jonal']= $jonal_id;
            $pur_info['college_id']=$college_id;
            $pur_info['teacher_id']=$teacher_id;
            

            $pid = $this->input->post('pid');
            $cost = $this->input->post('price');
            $quantity = $this->input->post('qty');



            $purchase_id = $this->CM->insert('transfer', $pur_info);

            $order = count($pid);
            if (!empty($purchase_id)) {
                for ($i = 0; $i < $order; $i++) {
                    $product_id = $pid[$i];
                    $book_info = $this->CM->getwhere('books', array('id' => $product_id));
                    $datas['transfer_id'] = $purchase_id; //purchase item table start
                    $datas['book_id'] = $pid[$i];


                    $datas['price'] = $cost[$i];
                    $datas['quantity'] = $quantity[$i];

                    $datas['line_no'] = $i;
                    $datas['status'] = 1;
                    $this->CM->insert('transfer_item', $datas);

                    // Update Division inventory 
                    // get divition current book info
                    $current_d_b = $this->CM->getwhere('inventory_college', array('college_id' => $college_id, 'book_id' => $pid[$i]));
                    if (!$current_d_b) {
                        $datadd['college_id'] = $college_id;
                        $datadd['book_id'] = $pid[$i];
                        $datadd['quantity'] = $quantity[$i];
                        $datadd['status'] = 1;
                        $this->CM->insert('inventory_college', $datadd);
                    } else {
                        $dataud['quantity'] = $quantity[$i] + $current_d_b->quantity;
                        $this->CM->update('inventory_college', $dataud, $current_d_b->id);
                    }
                }
            }

            if ($pur_info['rid'] != "") {
                $dataqu['accept'] = 1;
                $this->CM->update('requisition', $dataqu, $rid);
            }


            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('report/transfer/' . $purchase_id);
            } else {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                redirect('purchase/add');
            }
        }
    }

    public function suggation() {
        $term = $this->input->get('term');

        $data = $this->PM->product_suggation($term);
        foreach ($data as $d) {
            $ds[] = array('label' => $d['book_name'], 'value' => $d['id']);
        }
        echo json_encode($ds);
    }

    public function getproduct($id) {

        $product = $this->CM->getwhere('books', array('id' => $id));
        echo json_encode($product);
    }

    public function printpreview($id) {
        if (!$this->CM->checkpermissiontype($this->module, 'printpreview', $this->user_type))
            redirect('error/accessdeny');


        if (!$this->CM->checkpermission($this->module, 'printpreview', $this->uid))
            redirect('error/accessdeny');



        $data['purchase_info'] = $this->CM->getwhere('purchase', array('id' => $id));

        if (empty($id) || empty($data['purchase_info'])) {
            redirect('report/report_item');
        }
        $data['company_info'] = $this->CM->getwhere('company_information', array('id' => 1));
        $this->load->view('purchase/printpreview', $data);
    }

}

?>
