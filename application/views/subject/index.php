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
                <li class="active"><a href="<?php echo base_url()?>user">Subject</a></li>
            </ol>
        </section>
    <br/>

    
    


<!-- Start Working area --> 
<div class="col-md-8 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="searchbar " >
    <div class="col-md-8"  >
    </div>
        
        <div class="pull-right"> 
          <a href="<?php echo base_url()?>subject/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> Add subject</a> 
        </div>
        <div class="clearfix"></div>
   </div> 
    
    <div>
        
    <table class="table table-bordered table-hover ">
        <tr>
            <th id="action_btn_align">SL</th>
            <th id="action_btn_align">Subject Name</th>
            <th id="action_btn_align">Department Name</th>
            <th id="action_btn_align">Subject Code</th>
            <th id="action_btn_align">Action</th>
           
         </tr>
   
    
                     
         
         <?php 
          //  var_dump($company_list) ; 
          foreach ($subject_list as $subject){
              $department = $this->CM->getInfo('department', $subject['department_id']);
         ?>
         
         
      <tr id="action_btn_align">
          <td> <?php echo $subject['id'] ?></td>
          <td> <?php echo $subject['name'] ?></td>
          <td> <?php if (isset($department->name)) {
                    echo $department->name;
                } ?></td>
          <td> <?php echo $subject['subject_code'] ?></td>
         
          <td>     
                <a class="btn btn-primary btn-flat" href="<?php echo base_url(); ?>subject/edit/<?php echo $subject['id'] ?>">
                <i class="fa fa-pencil-square-o" ></i> Edit </a>
                
          </td>     
       </tr>
      <?php } ?>
            
     </table> 
</div>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>