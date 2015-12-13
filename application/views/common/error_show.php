 
<?php
       $suc = $this->session->flashdata('success') ; 
       $error = $this->session->flashdata('error') ;
       if($suc){
       ?>
         
         
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?php echo $suc ;?>
</div>
       <?php } 
       if($error){
       ?>
          
         <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?php echo $error ;?>
</div>
       <?php } 
       
       if(validation_errors()){
       ?>
          
         <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?php echo validation_errors() ;?>
</div>
       <?php } ?>
       
 