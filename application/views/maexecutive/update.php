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
                <li class="active"><a href="<?php echo base_url()?>user">User</a></li>
                <li class="active"><a href="<?php echo base_url()?>user/add">Add User</a></li>
            </ol>
        </section>
    <br/>


<!-- Start Working area --> 
<div class="col-md-8 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   <?php 

 $uri=$this->uri->segment('2');

?>
    <ul class="nav nav-tabs" role="tablist">
      <li class="<?php if($uri=="profile") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/profile/<?php echo  $user_info->id; ?>">Profile</a></li>
      <li class="<?php if($uri=="update") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/update/<?php echo  $user_info->id; ?>">Update Profile</a></li>
      <li class="<?php if($uri=="password") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/password/<?php echo  $user_info->id; ?>">Change Password</a></li>
   </ul>
   
   
    

    <?php 
    echo form_open_multipart('') ; 
    ?>


<div class="form-group">
    <label> User Name </label>
    <?php 
    $form_input = array(
        'name' => 'name',
        'class' =>'form-control ', 
        'value' => $name, 
        'required' => 'required'
    );
    echo form_input($form_input); 
    ?>
</div>

<div class="form-group">
    
    <label>Email  </label>
    <?php 
    $form_input = array(
        'name' => 'email',
        'class' =>'form-control ', 
        'value' => $email,
    );
    echo form_input($form_input); 
    ?>
    
</div>



<div class="form-group">
    
    <label>Phone  </label>
    <?php 
    $form_input = array(
        'name' => 'phone',
        'class' =>'form-control ', 
        'value' => $phone,
        
    );
    echo form_input($form_input); 
    ?>
    
</div>
   
    
    

<div class="form-group">
    
    <label>Picture  </label>
    <input type="file" name="image" value="" />
    <img src="<?php echo base_url()  ?>uploads/<?php echo $image ;?>" style=" height: 70px; width: 80px; margin-top: 2px;" />
    
</div>
    
   
    

    <div class="form-group">
    <label> User Address </label>
    <?php 
    $form_input = array(
        'name' => 'address',
        'class' =>'form-control ', 
        'value' => $address, 
        'rows' => 3, 
        'cols' => 5, 
        'size' => 100, 
        'required' => 'required'
    );
    echo form_textarea($form_input); 
    ?>
    
</div>


    
    
<div class=" text-center">
     
    <?php 
    $form_input = array(
        'name' => 'submit',
        'class' =>'btn btn-lg btn-success ', 
        'value' => 'Update'
        
       
    );
    echo form_submit($form_input); 
    ?>
    
</div>
   <?php echo form_close() ?> 
    
    

</div>
<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>
        
     

     
 