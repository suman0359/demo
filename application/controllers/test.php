<?php
class test extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Customize');
    }
    public function index()
    {
        $data['pur_count']=$this->CM->getAll('pur_info','id DESC');
        $this->load->view('test/index',$data);
    }
    public function add()
    {
         $data['pro_list']=$this->CM->getAll('product');
         $data['sup_list']=  $this->CM->getAll('supplier','id DESC');
       
        $data['id']="";
        $data['name']="";
        $data['cid']="";
        $data['pid']="";
        $data['sid']="";
        $data['price']="";
        $data['qty']="";
        $data['t_price']="";
        $data['t_qty']="";
        
        
          
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pid', 'product', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('test/form', $data); 
        }
        else
        {
           
            $pur_info['date']=  $this->input->post('date');
            $pur_info['sid']=  $this->input->post('sid');
            $pur_info['purchaser']=  $this->input->post('purchaser');
            $pur_info['status']= 1;
            
         
            $id=$this->CM->insert('pur_info',$pur_info);
            
            /*
            echo "<pre>";
            print_r($id);
            exit();
            */
            
            $pid=  $this->input->post('pid');
            $cost=  $this->input->post('cost');
            $quantity=  $this->input->post('qty');
           // $price=  $this->input->post('price');
        
           
                            
            
            $order=count($pid);
                if(!empty($pid))
                    {
                        for($i=0;$i<$order;$i++)
                        {
                            $datas['cid']=$id;
                            $datas['pid']=$pid[$i];
                            $datas['cost']=$cost[$i];
                            $datas['quantity']=$quantity[$i];
                            $datas['status']=1;
                            
                            $this->CM->insert('pur_product',$datas);
                        }
                    }
                    
                    if($this->input->post('t_price'))
                    {
                        
                     $total['t_cost']=  $this->input->post('t_price');
                     $total['t_quantity']=  $this->input->post('t_qty');
                     $total['status']= 1;
                     $total['cid']=$id;    
                     
                        
                     $this->CM->insert('pur_count',$total);
                    
                    }   
                    if($id)
                       {
                           $msg = "Operation Successfull!!";
                           $this->session->set_flashdata('success', $msg); 
                           redirect('purchase');
                       }
                       else 
                       {
                           $msg = "There is an error, Please try again!!";
                           $this->session->set_flashdata('error', $msg); 
                       }
                       
                       
           redirect('purchase');
        }
     }
     
     
     
     public function edit($id)
        {
         
             $data['pro_list']=$this->CM->getAll('product');
             $data['sup_list']=  $this->CM->getAll('supplier','id DESC');
             
             $purchase=$this->CM->getInfo('pur_info',$id);
             
             $pur_count=$this->Customize->getWhere('pur_count',array('cid'=>$id));
             $data['pur_product_list']=$this->Customize->getAllWhere('pur_product',array('cid'=>$id));         
            
            $data['id']=$purchase->id;
            $data['date']=$purchase->date;
            $data['t_cost']=$pur_count->t_cost;
            $data['t_quantity']=$pur_count->t_quantity;
            
            $this->load->library('form_validation');

            $this->form_validation->set_rules('pid', 'product', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('purchase/eform', $data); 
            }
            else
            {
                
                
                $this->CM->delete_where('pur_product',array('cid'=>$id));
                $this->CM->delete_where('pur_count',array('cid'=>$id));
                
                
                
                $pur_info['date']=  $this->input->post('date');
                $pur_info['status']= 1;

                $this->CM->update('pur_info',$pur_info,$id);


                $pid=  $this->input->post('pid');
                $sid=  $this->input->post('sid');
                $cost=  $this->input->post('cost');
                $quantity=  $this->input->post('quantity');



                $order=count($pid);
                    if(!empty($pid))
                        {
                            for($i=0;$i<$order;$i++)
                            {
                                $datas['cid']=$id;
                                $datas['pid']=$pid[$i];
                                $datas['sid']=$sid[$i];
                                $datas['cost']=$cost[$i];
                                $datas['quantity']=$quantity[$i];
                                $datas['status']=1;

                                $this->CM->insert('pur_product',$datas);


                            }
                        }

                        if($this->input->post('t_cost'))
                        {
                         $total['t_cost']=  $this->input->post('t_cost');
                         $total['t_quantity']=  $this->input->post('t_quantity');
                         $total['status']= 1;
                         $total['cid']=$id;    
                        $this->CM->insert('pur_count',$total);

                        }



            }
            redirect('purchase');
         }

         
         
         
        public function delete($id)
        {
               if($this->CM->delete_db('pur_info',$id))
               { 
                   $this->CM->delete_where('pur_product',array('cid'=>$id));
                   $this->CM->delete_where('pur_count',array('cid'=>$id));
                   
               $msg = "Operation Successfull!!";
               $this->session->set_flashdata('success', $msg);
               } 
                else 
               {
               $msg = "There is an error, Please try again!!";
               $this->session->set_flashdata('error', $msg);
               }

               redirect('purchase');
        }
    
     
    
}

?>
