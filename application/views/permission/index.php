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
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>category">Category</a></li>
            </ol>
        </section>
    <br/>

    
<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="col-md-12">
       
        <h4 class=" alert alert-info text text-success text-center">Select The Option</h4>
        
        <?php echo form_open('user/permissionset');
            
//            echo '<pre>';
//            print_r($plist);
//            exit();
            
            foreach($plist as $list){
        ?>
        
        <input type="hidden" name="module_name[]" value="<?php echo $list['module'] ?>" />
        <div>
            <label><?php 
            if($list['module']=="category") echo 'Category' ;
            else if($list['module']=="scategory") echo 'Sub Category' ;
            else if($list['module']=="teachers") echo 'Teachers' ;
            else if($list['module']=="subject") echo 'Subject' ;
            else if($list['module']=="books") echo 'Books' ;
            else if($list['module']=="maexecutive") echo 'Marketing Executive' ;
            else if($list['module']=="thana") echo 'Thana' ;
            else if($list['module']=="college") echo 'College' ;
            else if($list['module']=="transfer") echo 'Transfer' ;
            else if($list['module']=="department") echo 'Department' ;
            else if($list['module']=="product") echo 'Product' ;
            else if($list['module']=="supplier") echo 'Supplier' ;
            else if($list['module']=="producttype") echo 'Product Type' ;
            else if($list['module']=="user") echo 'user' ;
            else if($list['module']=="customer") echo 'Customer' ;
            else if($list['module']=="purchase") echo 'Purchase Product' ;
            else if($list['module']=="sale") echo 'Sale Product' ;
            else if($list['module']=="inventory") echo 'Inventory History' ;
            else if($list['module']=="report") echo 'All Report Term' ;
            else if($list['module']=="division") echo 'Division' ;
            else if($list['module']=="jonal") echo 'Jone / Jonal' ;
            else if($list['module']=="district") echo 'District' ;
            
           
            
           
            ?></label> &nbsp;&nbsp;
           <?php if(!empty($list['m_action'])){ 
               
               $listarray = explode(',', $list['m_action']) ;
               
               
               
               foreach($listarray as $key => $value ){
                 
                   ?>
             <input type="checkbox" name="<?php echo $list['module'] ?>_fname[]" value="<?php echo $value ;?>" <?php if($this->CM->checkpermissiontype($list['module'],$value,$user_type))  echo 'checked'; ?> />
             
             &nbsp;<?php 
             if($value=='index') echo 'Information View';
             else if($value=='add') echo 'ADD';
             else if($value=='edit') echo 'Edit';
             else if($value=='delete') echo 'Delete';
             else if($value=='delete_all') echo 'Delete All';
             else if($value=='permission') echo 'Permission';
             else if($value=='printpreview') echo 'Printpreview';
             else if($value=='product_info') echo 'Product Information  And Inventory History ';
             else if($value=='report_item') echo 'All Report Item';
             else if($value=='divisioninventory') echo 'Division Inventory';
             else if($value=='jonalinventory') echo 'Jona/ Jonal Inventory';
             else if($value=='collegeinventory') echo 'College Inventory';
             else if($value=='requisition') echo 'Requisition';
             else if($value=='transfer') echo 'Transfer';
             else if($value=='jonaltransfer') echo 'Jone/ Jonal Transfer';
             else if($value=='distribute') echo 'Distribute';
             else if($value=='jonaluser') echo 'Jonal User';
         
             ;?> &nbsp;&nbsp;
            
             <?php 

               }
                }
              ?>
            
          
            
        </div> 
        <hr/>
           <?php } ?> 
            
             <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
             <input type="hidden" name="user_type" value="<?php echo $user_type; ?>" />
           <input class="btn btn-lg btn-success " onclick="return confirm('Are you sure want to allow him ');" type="submit" value="Allow Permission" name="submit"/>
           <a href="<?php echo base_url()?>user"  class="btn btn-lg btn-danger"  >Cancel</a>
       <?php echo form_close()?>
        
    </div>
    


</div>


 
<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>