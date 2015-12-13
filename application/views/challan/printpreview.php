<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?>


    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-top:-10px!important;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>purchase">Purchase</a></li>
                <li class="active"><a href="<?php echo base_url()?>purchase/add">Add Purchase</a></li>
            </ol>
        </section>
    <br/>


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
 


   

    <div class="col-md-12 margin_padding">
        <div class="col-md-offset-4 col-md-4 voucher_top">
            
           <address class="company_info">
                  <strong><h2><?php echo $company_info->name  ?></h2></strong>
                  <abbr> Address:</abbr> <?php echo $company_info->address  ?><br/>
                  <abbr >Mobile Number:</abbr> <?php echo $company_info->mobile_number  ?><br/>
                  <abbr >Email Address:</abbr> <?php echo $company_info->email  ?><br/>
                  <abbr >Web site:</abbr> <?php echo $company_info->website  ?><br/>



          </address>
            
               
            
        </div>
     </div>
    <div class="col-md-12 margin_padding voucher_memo_area">
       
        <h3>Challan Voucher</h3>  
        
       <table width="100%"> 
            <tr>
                
           <td>  
            <table>
                <tr>
                    <td>Id :</td>
                    <td><?php echo $transfer_product->id; ?></td>
                </tr>
                  <tr>
                    <td>Challan From :</td>
                    
                    <td> <?php  $challan_from=$this->CM->getwhere('department',array('id'=>$transfer_product->transfer_form)); 
                                echo $challan_from->name; 
                          ?> 
                    </td>
                    
                </tr>
                <tr>
                    <td>Challan Date :</td>
                    <td>
                    <?php  
                    $challan_date=strtotime($transfer_product->challan_date); 
                    echo date('d-m-Y',$challan_date);
                    ?>
                    </td>
                </tr>
                
              
            </table>
        </td>
        <td> 
        
                <table class="pull-right">
                <tr>
                    <td>Challan No :</td>
                    <td><?php echo $transfer_product->challan_no; ?></td>
                </tr>
                <tr>
                    <td>Challan To :</td>
                    
                    <td> <?php  $challan_to=$this->CM->getwhere('department',array('id'=>$transfer_product->transfer_to)); 
                                echo $challan_to->name; 
                          ?> 
                    </td>
                    
                </tr>
               
                
              
            </table>
        </td>
            </tr>
       </table>
     </div >
    
    <div class="col-md-12 margin_padding ">

        <table class="table voucher_item_area" >
            <tr class="active voucher_header">
                <td>Sl</td>
                <td>Product Name</td>
                <td>Id</td>
                <td>Quantity</td>
              
                
            </tr>
            <?php $transfer_item=$this->CM->getAllWhere('transfer_item',array('transfer_id'=>$transfer_product->id));
             $i=1;
             $total_quantity=0;
            foreach($transfer_item as $transfer){
               
           
            ?>
            <tr class="voucher_item">
                <td><?php echo $i; ?></td>
                
                 <td>
                    <?php  $product=$this->CM->getwhere('product',array('id'=> $transfer['product_id']))  ;
                           echo $product->name;
                     ?>
                </td>
                
                <td><?php echo $product=$transfer['product_id'] ;?></td>                
                <td><?php echo $transfer['quantity'] ;
                            $total_quantity += $transfer['quantity']  ;?></td>
        
               
            </tr>
            <?php 
            $i++ ; } 
            ?>
               <tr class="voucher_total">
                <td></td>
                <td></td>
              
                <td>Total Quantity</td>
                <td><?php echo $total_quantity ;?></td>
                
            </tr>
            
            
        </table>
        
    </div>
    
     
         <div class="col-md-12 margin_padding voucher_bottom_area">
        
       <table width="100%"> 
            <tr>
                
           <td> 
            <table >
                <tr>
                    <td>Approve BY </td>
                    
                </tr>
                <tr class="voucher_bottom_left">
                    <td>Name: .................................................... </td>
                    
                </tr>
                <tr class="voucher_bottom_left">
                    <td>Date: ...................................................... </td>
                    
                </tr>
              
            </table>
        </td>
        <td>
         
               <table class="pull-right" >
                <tr>
                    <td>Approve BY </td>
                    
                </tr>
                <tr class="voucher_bottom_left">
                    <td>Name: .................................................... </td>
                    
                </tr>
                <tr class="voucher_bottom_left">
                    <td>Date: ...................................................... </td>
                    
                </tr>
              
            </table>
        </td>
            </tr>
       </table>
     </div >
    
    <!-- End  Working area --> 
    
    

    <!-- start  add the row --> 

    
 

<?php $this->load->view('common/footer') ?>
        




