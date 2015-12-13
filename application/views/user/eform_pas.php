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
                <li class="active"><a href="<?php echo base_url()?>user/add">User password change</a></li>
            </ol>
        </section>
    <br/>
   <?php 

 $uri=$this->uri->segment('2');

?>

 <div class="col-md-8 main-mid-area"> 
 
     <ul class="nav nav-tabs" role="tablist">
      <li class="<?php if($uri=="profile") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/profile/<?php echo  $user_info->id; ?>">Profile</a></li>
      <li class="<?php if($uri=="update") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/update/<?php echo  $user_info->id; ?>">Update Profile</a></li>
      <li class="<?php if($uri=="password") echo "active";  ?>"><a href="<?php  echo base_url();  ?>user/password/<?php echo  $user_info->id; ?>">Change Password</a></li>
   </ul>
   
    <?php 
    echo form_open_multipart('') ; 
    ?>

<div class="form-group">
    <label>New Password:  </label>
    <input type="password" name="Password"   class="chkpassword form-control" placeholder="******" />
</div>
    
    <div class="form-group">
    <label>Confirm Password:  </label>
    <input type="password" name="RePassword"  class="chkpassword form-control" placeholder="******" />
   
   
    <div id="hpassword" class="hide alert alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong id="mag"></strong> 
    </div>
    
</div>
    
 <p id="validation"></p>
    
<div class=" text-center">
     
    <?php 
    $form_input = array(
        'name' => 'submit',
        'class' =>'btn btn-lg btn-success ', 
        'value' => 'Change password'
    );
    echo form_submit($form_input); 
    ?>
    
</div>
   <?php echo form_close() ?> 
    
    

</div>
    <script>
     $(function(){
         $(".chkpassword").on('change', function(){
        checkpassword() ; 
       
     });    
        
function checkpassword(){
 var pass1 = $('input[name=Password]').val();
            var pass2 = $('input[name=RePassword]').val();
            
            if( pass1 !=="" && pass2 !=="")
                { 
                     if(pass1 !== pass2)
                         {
                             
                            
                            
                             $("#hpassword").removeClass('hide') ; 
                             $("#hpassword").removeClass('alert-success') ; 
                             $("#hpassword").addClass('alert-danger') ; 
                             $("#mag").text('Please check your password') ;
                             $(".chkpassword").css("border-color","red") ;
                         }else
                             {
                                 
                            
                             
                             $("#hpassword").removeClass('hide') ; 
                             $("#hpassword").removeClass('alert-danger') ; 
                             $("#hpassword").addClass('alert-success') ; 
                             $("#mag").text('Password Match !') ; 
                              $(".chkpassword").css("border-color","green") ;
                             }
                } 
         
          
  }
     });
    //.keyup();
</script>
<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>
