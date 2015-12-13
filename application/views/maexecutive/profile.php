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
   
   <div class="col-md-12 profile">
  <table class="table table-hover ">
    <tr>
      <td>Name :</td>
      <td><?php echo $user_info->name;?></td>
    </tr> 
    
    <tr>
      <td>Phone</td>
      <td><?php echo $user_info->phone;?></td>
    </tr> 
    <tr> 
      <td>E-mail</td>
      <td><?php echo $user_info->email;?></td>
    </tr> 
    <tr> 
      <td>Picture</td>
      <td><?php if($user_info->image){?>
          <img src="<?php echo base_url()?>uploads/<?php echo $user_info->image; ?>" style="height: 90px ; width: 100px;"/> 
          <?php } ?>
      </td>
    </tr> 
    <tr>
      <td>Address</td>
      <td><?php echo $user_info->address;?></td>
    </tr> 
 </table>
        
 </div>
            
            
            
            
            


<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>