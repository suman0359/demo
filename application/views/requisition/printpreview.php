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
               


          </address>
            
               
            
        </div>
     </div>
    
     
       <?php  $uid=$this->uri->segment(3); 
        if(!empty ($uid)) { ?>
    
    <div class="col-md-12 margin_padding voucher_memo_area">
       
        <h3>Requisition Voucher</h3>  
        <table width="100%"> 
            <tr>
                
           <td> 
        
            <table >
                <tr>
                    <td >Id :</td>
                    <td><?php echo $requisition_info->id; ?></td>
                </tr>
                <tr>
                    <td>Requested  By :</td>
                    <td> <?php 
                    $emp=$this->CM->getwhere('user',array('id'=>$requisition_info->requisition_by)); 
                    echo $emp->name ; 
                     ?> </td>
                </tr>
                <tr>
                    <td>Request Date :</td>
                    <td>
                    <?php  $requisition_date=strtotime($requisition_info->requisition_date); 
                   echo date('d-m-Y',$requisition_date);        
                    ?>
                    </td>
                </tr>
                
              
            </table>
           </td>
               
          <td> 
                <table class="pull-right">
                 
              
                    
                </tr>
                <tr>
                    <td> Division : </td>
                    <td> 
                    <?php 
                    $college=$this->CM->getwhere('college',array('id'=>$requisition_info->id)); 
                    $div=$this->CM->getwhere('division',array('id'=>$college->division_id)); 
                                echo $div->name; 
                          ?> 
                    </td>
                </tr>
               
                <tr>
                    <td> Jonal  : </td>
                    <td> 
                    <?php  $jone=$this->CM->getwhere('jonal',array('id'=>$college->jonal_id)); 
                                echo $jone->name; 
                          ?> 
                    </td>
                </tr>
                 <tr>
                    <td>For College  :</td>
                    
                    <td> 
                   <?php  
                                echo $college->name; 
                          ?> 
                    </td>
                    
                
              
            </table>
          </td>
            </tr>
        </table>
           
     </div >
    
    
     
     
    <div class="col-md-12 margin_padding ">
        <?php 
        $this->load->view('common/report_book_list') ;
        ?>
        
        <u>  Sender Comment :  </u> <br />
        <?php echo $requisition_info->comments ; ?>
    </div>
    
      
         <div class="col-md-12 margin_padding voucher_bottom_area">
             <table width="100%"> 
                 <tr> 
                     <td> 
       
            <table >
                <tr>
                    <td>Check  by </td>
                    
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
                    <td>Approve by   </td>
                    
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
    
     
       <?php if($requisition_info->accept == 1) { ?>
         <div class="clearfix"></div>
     <div class="alert alert-info text-center"> This requisition already accept and send book according on this. </div>
     <?php } ?>
     
     <div class=" text-center no-print"> 
       
     
     
     
         <a href="JavaScript:history.back(-1)" class="btn btn-warning"> Back </a>
         <?php 
         if(($requisition_info->accept != '1') AND ($this->session->userdata('user_type')=='1')) { ?>
         <a href="<?php echo base_url() ?>index.php/purchase/add/<?php echo $requisition_info->id ?>" class="btn btn-success"> Make it Chalan  </a>
      <?php } ?>
     </div>
     
       
    <!-- End  Working area --> 
    
    <?php } ?>

    <!-- start  add the row --> 

    
 

<?php $this->load->view('common/footer') ?>
        




