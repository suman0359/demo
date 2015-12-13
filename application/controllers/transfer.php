<?php
class Transfer  extends MY_Controller{
    
    public $_uid ; 
    
    public function __construct() {
        parent::__construct();
        $this->checklogin() ;
         $this->load->Model('Transfer_model', 'TM') ;
          $this->_uid = $this->session->userdata('uid');
    }
    public function index()
    {
        $data['transfer_list']=$this->CM->getAll('transfer','id DESC');
        $data['division_list']=  $this->CM->getAll('division','name ASC');
        $this->load->view('transfer/index',$data);
    }
    
    public function add()
    {
        
         $did = $this->session->userdata('division_id') ;
         if($did==0)
         {
             redirect ('error/accessdeny'); 
             
         }
          
         
       
       
          $data['id']="";
          $data['entry_by']="";
          $data['pid']="";
          $data['transfer_form']="";
          $data['transfer_to']="";
          $data['qty']="";
          $data['comments']="";
          $data['memo_no']="";
          $data['date']=date('d-m-Y');
          $data['jone_list'] = $this->CM->getAllWhere('jonal', array('div_id'=>$did), 'name ASC') ; 
        
        
          
          $this->load->library('form_validation');

          $this->form_validation->set_rules('pid', 'product', 'required');
          if ($this->form_validation->run() == FALSE)
          {
            $this->load->view('transfer/form', $data); 
          }
          else
          {
                // transfer  table start 
            
            $this->db->trans_start(); 
            $pur_info['transfer_from_div']= $did ;
            $pur_info['to_jonal']= $this->input->post('to_jonal') ;
            $pur_info['memo_no']=  $this->input->post('challan_no');
           
            $pur_info['comments']=  $this->input->post('comments');
            $pur_info['status']= 1;
            $pur_info['entryby']=$this->_uid;   
            
            $purchase_date= strtotime( $this->input->post('date'));  
            $pur_info['challan_date']=   date('Y-m-d', $purchase_date); 
            
            
            
            $pid=  $this->input->post('pid');
            $cost=  $this->input->post('price');
            $quantity=  $this->input->post('qty');
           
       
                            
            $purchase_id=$this->CM->insert('transfer',$pur_info);
             
             $order=count($pid);
                if(!empty($purchase_id))
                    {
                        for($i=0;$i<$order;$i++)
                        {
                            $product_id=$pid[$i];
                            $book_info=$this->CM->getwhere('books',array('id'=>$product_id));
                            $datas['transfer_id']=$purchase_id; //purchase item table start
                            $datas['book_id']=$pid[$i];
                            
                            
                            $datas['price']=$cost[$i];
                            $datas['quantity']=$quantity[$i];
                            
                            $datas['line_no']=$i;
                            $datas['status']=1;
                            $this->CM->insert('transfer_item',$datas);
                            
                             // Update Jonal  inventory 
                            // get Jonal current book info
                            $current_j_b = $this->CM->getwhere('inventory_jonal', array('jonal_id'=>$pur_info['to_jonal'], 'book_id' => $pid[$i] )) ;
                            if( !$current_j_b ) {
                            $datadd['jonal_id'] = $pur_info['to_jonal'] ; 
                            $datadd['book_id'] = $pid[$i]  ; 
                            $datadd['quantity'] = $quantity[$i]   ; 
                            $datadd['status'] = 1    ; 
                              $this->CM->insert('inventory_jonal',$datadd);
                            }
                            else 
                            {
                                $dataud['quantity'] = $quantity[$i]+$current_j_b->quantity  ; 
                                $this->CM->update('inventory_jonal', $dataud, $current_j_b->id) ;
                                
                            }
                            
                            // Update Division Book inventory 
                            $current_d_b = $this->CM->getwhere('inventory_division', array('division_id'=>$did, 'book_id' => $pid[$i] )) ;
                            $dataud['quantity'] = ($current_d_b->quantity-$quantity[$i])  ; 
                            $this->CM->update('inventory_division', $dataud, $current_d_b->id) ;
                                
                            
                        }
                    }
                    
                             $this->db->trans_complete(); 
                             
            
                    
                    
                    if($this->db->trans_status()=== TRUE)
                       {
                           $msg = "Operation Successfull!!";
                           $this->session->set_flashdata('success', $msg); 
                           redirect('report/jonaltransfer/'.$purchase_id);
                       }
                       else 
                       {
                           $msg = "There is an error, Please try again!!";
                           $this->session->set_flashdata('error', $msg); 
                       }
                       
                       
           redirect('transfer');
        }
     }
     
    
     
     
        public function suggation()
        {
            $term = $this->input->get('term') ; 
               $did = $this->session->userdata('division_id') ;
           $data =  $this->TM->division_book_suggation($term, $did) ; 
           foreach($data as $d)
           {
               $ds[] = array('label' => $d['book_name'], 'value' => $d['id']) ; 
               
           }
           echo json_encode($ds) ; 
        }
        
        
    
        public function getproduct($id)
        {
             $did = $this->session->userdata('division_id') ;
            $product=$this->TM->getDivBook($id, $did);
            echo json_encode($product);
        }
        
        public function printpreview($id)
        {
           
             
             $data['transfer_info']=$this->CM->getwhere('transfer',array('id'=>$id));
              $data['book_list']=$this->RM->getTrabsferBooks($id); 
              
              
            if(empty ($id) || empty ($data['purchase_info']))
            {
              //  redirect('report/report_item');
            }
           
              $this->load->view('transfer/printpreview',$data);    
              
             
              
        }
       
        
       
}

?>
