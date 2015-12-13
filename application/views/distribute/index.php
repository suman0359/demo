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
        <section class="content-header">
          <h1 id="company_info">
                Dashboard
                <small ><?php if(!empty($companyname)) echo  $companyname; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>transfer">Challan Entry</a></li>
            </ol>
        </section>
    <br/>


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   

    

        
          <h3 data-toggle="modal" data-target="#myModal" href=""  class="alert alert-info text-center" >  <a href="">Add Challan </a></h3> 
        
    
  
    
    <div class="modal fade department" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Choose Challan From</h4>
      </div>
      <div class="modal-body ">
        
           
            <?php
           
            $department_list=$this->CM->getall('division');
            $class = 'class="form-control  required" ';
            $department_name = array("0" => "Select Supplier");
            foreach ($department_list as $department) {
                ?>
            <a href="<?php echo base_url() ?>transfer/add/<?php echo $department['id'] ?>" class="btn btn-lg btn-success" style="margin: 5px 0px"> <?php echo $department['name'] ?> </a>
            <?php 
            
            }
             
            ?>
          
          
      </div>
       
    </div>
  </div>
</div>
   
<!-- Modal -->

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>