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
            <h1>Dashboard<small>Control panel</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>jonal">Jonal</a></li>
            </ol>
        </section>
    <br/>



    <div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="searchbar " >
    <div class="col-md-8"  >
    </div>
        
        <div class="pull-right"> 
          <a href="<?php echo base_url()?>jonal/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> Add Jonal</a> 
        </div>
        <div class="clearfix"></div>
   </div> 


   <div class="col-md-8 ">
        
    <table class="table table-bordered table-hover ">
        <tr>
            <th id="action_btn_align">SL</th>
            <th id="action_btn_align">Jone/Jonal Name</th>
            <th id="action_btn_align">Jone/Jonal Head Name</th>
            <th id="action_btn_align">Division Name</th>
            <th id="action_btn_align">Action</th>
           
         </tr>
   
                     
         
         <?php 
       		//  var_dump($company_list) ; 
         	foreach ($jonal_list as $jonal){
           $division = $this->CM->getInfo('division', $jonal['div_id'] );
           $jonal_head = $this->CM->getInfo('user', $jonal['jonal_head_id']);
         ?>
         
         
      <tr id="action_btn_align">
          <td> <?php echo $jonal['id'] ?></td>
          <td> <?php echo $jonal['name'] ?></td>
          <td> <?php echo $jonal_head->name; ?></td>
          <td> <?php echo $division->name; ?></td>
          <td>     
                <a class="btn btn-primary btn-flat" href="<?php echo base_url(); ?>jonal/edit/<?php echo $jonal['id'] ?>">
                <i class="fa fa-pencil-square-o" ></i> Edit </a>
                <a class="btn btn-warning btn-flat" href="<?php echo base_url(); ?>jonal/jonaluser/<?php echo $jonal['id'] ?>">
                <i class="fa fa-user" ></i> See Jonal User  </a>
                
          </td>     
       </tr>
      <?php } ?>
            
     </table> 
</div>

<div>         
    <?php echo $this->pagination->create_links();

    ?>  
    </div>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>