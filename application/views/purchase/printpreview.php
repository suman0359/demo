<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');

?>
<?php $companyname=$this->session->userdata('companyname'); ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-top:-10px!important;">
              <h1 id="company_info">
                Dashboard
                <small ><?php if(!empty($companyname)) echo  $companyname; ?></small>
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
        <div class="col-md-offset-4 col-md-6 voucher_top">
            
           <address class="company_info">
                 <strong><h2><?php echo $company_info->name  ?></h2></strong>
                  <?php if(!empty($company_info->address)){ ?>  <abbr> Address:</abbr> <?php echo $company_info->address  ?><br/><?php }?>
                    <?php if(!empty($company_info->mobile_number)){ ?> <abbr >Mobile Number:</abbr> <?php echo $company_info->mobile_number  ?><br/><?php }?>
                    <?php if(!empty($company_info->email)){ ?><abbr >Email Address:</abbr> <?php echo $company_info->email  ?><br/><?php }?>
                    <?php if(!empty($company_info->website)){ ?><abbr >Web site:</abbr> <?php echo $company_info->website  ?><br/><?php }?>




          </address>
            
               
            
        </div>
     </div>
    
       <?php  $uid=$this->uri->segment(3); 
        if(!empty ($uid)) { ?>
    
    <div class="col-md-12 margin_padding voucher_memo_area">
       
        <h3>Purchase Voucher</h3>  
        <table width="100%"> 
            <tr>
                
           <td> 
        
            <table >
                <tr>
                    <td>Id :</td>
                    <td><?php echo $purchase_info->id; ?></td>
                </tr>
                <tr>
                    <td>Purchase By :</td>
                    <td> <?php echo $purchase_info->purchase_by; ?> </td>
                </tr>
                <tr>
                    <td>Purchase Date :</td>
                    <td>
                    <?php  $purchase_date=strtotime($purchase_info->purchase_date); 
                   echo date('d-m-Y',$purchase_date);        
                    ?>
                    </td>
                </tr>
                
              
            </table>
           </td>
               
          <td> 
                <table class="pull-right">
                <tr>
                    <td>Memo No :</td>
                    <td><?php echo $purchase_info->memo_no; ?></td>
                </tr>
                <tr>
                    <td>Purchase From :</td>
                    
                    <td> <?php  $supplier=$this->CM->getwhere('supplier',array('id'=>$purchase_info->supplier_id)); 
                                echo $supplier->cname; 
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
                <td>Price</td>
                <td>Total</td>
                
            </tr>
            <?php $purchase_item=$this->CM->getAllWhere('purchase_item',array('purchase_id'=>$purchase_info->id));
             $i=1;
             $total_price=0;
             $total_quantity=0;
            foreach($purchase_item as $purchase){
               
           
            ?>
            <tr class="voucher_item">
                <td><?php echo $i; ?></td>
                
                 <td>
                    <?php  $product=$this->CM->getwhere('product',array('id'=> $purchase['product_id']))  ;
                           echo $product->name;
                     ?>
                </td>
                
                <td><?php echo $product=$purchase['product_id'] ;?></td>                
                <td><?php echo $purchase['quantity'] ;?></td>
                <td><?php echo $purchase['price'] ;?></td>
                <td><?php   echo $total=$purchase['quantity'] * $purchase['price'] ; ?> </td>
               
            </tr>
            <?php $total_price+=$total;
                  $total_quantity+=$purchase['quantity'];
            $i++ ; } 
            ?>
               <tr class="voucher_total">
                <td></td>
                <td></td>
                <td>Total Quantity</td>
                <td><?php echo $total_quantity ;?></td>
                <td>Total Price</td>
                <td><?php echo $total_price ;?></td>
                
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
    
    <?php } ?>

    <!-- start  add the row --> 

    
 

<?php $this->load->view('common/footer') ?>
        




