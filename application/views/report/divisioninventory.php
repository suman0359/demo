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
                Reports : 
                <small>Inventory Report for <?php echo $division_info->name ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="#">Division Inventory </a></li>
            </ol>
        </section>
    <br/>

    
    


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="searchbar " >
  
    <div class="col-md-3 no-print pull-right"  >
        
        <select class="form-control col-md-3" id="chd">
            <option> Change Division  </option>
       
      <?php
    foreach ($div_list as $div) 
    {
      ?>
            <option value="<?php echo  $div['id'] ?>"> <?php echo $div['name'] ?>  </option>
        <?php } ?> 
             </select>
        <br/>
        <br/>
    </div>
        
          <div class="col-md-12 text-center"  >
        <h3> <?php echo $division_info->name ?> </h3>
          <div> Division Head :  <?php 
         $uinfo =  $this->CM->getinfo('user', $division_info->division_head); echo $uinfo->name  ; ?> </div>
        <div> Phone : <?php echo $uinfo->phone ;  ?>  </div>
    </div>
        <div class="clearfix"></div>
   </div> 
    
    <div>
        
    <table class="table table-bordered table-hover" >
        <tr>
            <th id="action_btn_align">Book ID</th>
            <th id="action_btn_align">Book Name</th>
            <th id="action_btn_align">Book Code</th>
            
            <th id="action_btn_align">Book Price</th>
            <th id="action_btn_align">Quantity</th>
           
         </tr>
   
     
         <?php 
       		//  var_dump($company_list) ; 
         	foreach ($content_list as $book){
                    $book_info = $this->CM->getInfo('books', $book['book_id'])
         ?>
         
         
      <tr id="action_btn_align">
          <td><?php echo $book['id'] ?></td>
          <td> <?php echo $book_info->book_name ?></td>
          <td> <?php echo $book_info->book_code ?></td>
          <td> <?php echo $book_info->rate ?></td>
          <td> <?php echo $book['quantity'] ?></td>
         
             
       </tr>
      <?php } ?>
            
     </table> 
</div>
    
    <script> 
    
       $(document).ready(function() {
           $("body").on('change', '#chd', function(){
               var did = $(this).val() ; 
               var url = "<?php echo base_url() ?>report/divisioninventory/"+did ;
               window.location.href = url; 
           });
       });
    </script>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>