  
     
<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
 
?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-top:-10px!important;">
            <h1>
               Reports 
                <small>All Reports </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="#">Reports  </a></li>
            </ol>
        </section>
    <br/>
    
    
    
    <div class="col-md-12 home-page"> 
    
    
     
    
  
    
  
    
    
    
    <div class="col-md-3 col-sm-4 home-icon" > 
    <a class=" btn-primary   btn-lg btn-block text-center " href="<?php echo base_url(); ?>report/requisition"> 
           <i class="fa fa-user fa-3x"></i>  <br/>
        Book Requisition Request  </a>
    </div>
    
    
    
    
    
    
    
    
    <div class="col-md-3 col-sm-4 home-icon" > 
    <a class=" btn-primary   btn-lg btn-block text-center " href="<?php echo base_url(); ?>report/distribute"> 
           <i class="fa fa-user fa-3x"></i>  <br/>
       Book Distribution Report </a>
    </div>
    
        <?php if($this->session->userdata('user_type')==1) {  ?> 
        
    <div class="col-md-3 col-sm-4 home-icon" > 
    <a class=" btn-primary   btn-lg btn-block text-center " href="<?php echo base_url(); ?>report/transfer"> 
           <i class="fa fa-user fa-3x"></i>  <br/>
        Shipment   Report </a>
    </div>
    
    
    
    <div class="col-md-3 col-sm-4 home-icon" > 
    <a class=" btn-primary   btn-lg btn-block text-center " href="<?php echo base_url(); ?>report/collegeinventory"> 
           <i class="fa fa-user fa-3x"></i>  <br/>
      College Inventory </a>
    </div>
    
    <?php } ?>
    
    <div class="clearfix"></div>
    
    
    </div>
    
    
<?php
$this->load->view('common/footer');

?>



     
 



