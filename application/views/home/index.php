  
     
<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
$this->load->view('common/control_panel');
?>
    
    
    <div class="col-md-12 home-page"> 
    
    
    <h2 class="alert alert-success text-center">Welcome BBT Book Management !</h2>
    <div class="list-unstyled list-inline home_menu"> 
     <?php
     $this->load->view('common/menu') ;
     ?>
    </div>
    <div class="clearfix"></div>
    
    
    </div>
    
    
<?php
$this->load->view('common/footer');

?>



     
 



