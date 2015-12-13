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
                <small>Inventory Report for <?php echo $college_info->name ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="#">College Inventory </a></li>
            </ol>
        </section>
    <br/>

    
    


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="searchbar " >
        
    <div class=" col-md-9 no-print pull-right "  >
        <div class="col-md-4">  
            <?php if(!empty($div_list)) { ?>
        <select class="form-control " id="chd">
            <option> Change Division  </option>
       
      <?php
    foreach ($div_list as $div) 
    {
      ?>
            <option value="<?php echo  $div['id'] ?>"> <?php echo $div['name'] ?>  </option>
        <?php } ?> 
             </select>
        <?php } ?>
        </div>
        <div class="col-md-4"> 
            
            <?php if(!empty($jone_list)) { ?> 
            <select class="form-control" id="jonal_id" name="jonal_id">
            <option> Change Jonal  </option>
       
      <?php
    foreach ($jone_list as $jonal) 
    {
      ?>
            <option value="<?php echo  $jonal['id'] ?>"> <?php echo $jonal['name'] ?>  </option>
        <?php } ?> 
             </select>
            <?php } ?>
        </div>
        
        <div class="col-md-4"> 
            
            <?php if(!empty($jone_list)) { ?> 
            <select class="form-control" id="college_id" name="college_id">
            <option> Change  College </option>
       
      <?php
    foreach ($jone_list as $jonal) 
    {
      ?>
            <option value="<?php echo  $jonal['id'] ?>"> <?php echo $jonal['name'] ?>  </option>
        <?php } ?> 
             </select>
            <?php } ?>
        </div>
        
        
        <br/>
        <br/>
    </div>
        
          <div class="col-md-12 text-center"  >
        <h3> Inventory Report <br/> <?php echo $college_info->name ?> </h3>
           
          
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
           $("body").on('change', '#college_id', function(){
               var cid = $(this).val() ; 
                var url = "<?php echo base_url() ?>report/collegeinventory/"+cid ;
                window.location.href = url; 
           });
           
           
        $("body").on('change', '#chd', function(){

        var div_id = $(this).val() ; 
        $.ajax({
          url: "<?php echo base_url() ?>index.php/home/getjonal/"+div_id,

          beforeSend: function( xhr ) {
            xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            $("#jonal_id").html("<option>Loading .... </option>") ; 

          }
        })
      .done(function( data ) {
       /* if ( console && console.log ) {
          console.log( "Sample of data:", data.slice( 0, 100 ) );
        }*/
      
         $("#jonal_id").html("<option value=''>Select a Jonal </option>"); 
            data=JSON.parse(data);
        $.each(data, function(key, val) {
              $("#jonal_id").append("<option value='"+val.id+"'>"+val.name+"</option>");
              
            });  
            

   });
   
   
        $("body").on('change', '#jonal_id', function(){

        var j_id = $(this).val() ; 
        $.ajax({
          url: "<?php echo base_url() ?>index.php/home/getcollege/"+j_id,

          beforeSend: function( xhr ) {
            xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            $("#college_id").html("<option>Loading .... </option>") ; 

          }
        })
      .done(function( data ) {
       /* if ( console && console.log ) {
          console.log( "Sample of data:", data.slice( 0, 100 ) );
        }*/
      
         $("#college_id").html("<option value=''>Select a College</option>"); 
            data=JSON.parse(data);
        $.each(data, function(key, val) {
              $("#college_id").append("<option value='"+val.id+"'>"+val.name+"</option>");
              
            });  
            

   });
   });
   
   
 }); 
 
       });
    </script>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>