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
                <li class="active"><a href="<?php echo base_url()?>department">Department</a></li>
                <li class="active"><a href="#">Add Department</a></li>
            </ol>
        </section>
    <br/>

    <!-- Start Working area --> 
<div class="col-md-9 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
    <h2> Add New Department </h2>
    

    <?php 
    echo form_open('') ; 
    ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label> Division Name </label>
            <?php 
            $form_input = array(
                'name' => 'name',
                'class' =>'form-control ', 
                'value' => $name, 
                'required' => 'required',
                'placeholder'=>'Department Name',
                'size' => '50'
                
            );
            echo form_input($form_input); 
            ?>
        </div>
    </div>

    
    
    <div class="col-md-3"><br>
        <div class="pull-right"> 

    <?php 
    $form_input = array(
        'name' => 'submit',
        'class' =>'btn btn-lg btn-success ', 
        'value' => 'Add Department'
       
    );

    echo form_submit($form_input); 
    echo form_close() 
    ?> 

   </div> 
    </div>
</div>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>

