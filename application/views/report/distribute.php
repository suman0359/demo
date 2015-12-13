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
                <small> Book Distribute Report  </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?php echo base_url()?>report"><i class="fa "></i> Report</a></li>
                <li class="active"><a href="#">Book Distribute Report  </a></li>
            </ol>
        </section>
    <br/>

    
    


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
   
    <div class="searchbar " >
  
    <div class="col-md-12 no-print"  >
        <?php 
        echo form_open() ; 
        ?>
        <label class="col-md-2"> Start Date 
         <input type="text" id="sdate" class="datepicker  form-control " name="sdate" value="<?php echo $sdate ;?>" placeholder="dd-mm-yyyy" required/>
             </label>
         <label class="col-md-2"> End Date 
          <input type="text" id="edate" class="datepicker  form-control " name="edate" value="<?php echo $edate ;?>" placeholder="DD-MM-YYY" required/>
        </label>
        <label> 
            Division 
            <select class="form-control col-md-3" id="division_id" name="did" required>
            <option value="all"> All Division </option>
       
      <?php
    foreach ($div_list as $div) 
    {
      ?>
            <option value="<?php echo  $div['id'] ?>" <?php if($did ==  $div['id']) echo' selected="selected" ' ?>  > <?php echo $div['name'] ?>  </option>
        <?php } ?> 
             </select>
        </label>
        <label> 
            Jonal 
            <select class="form-control col-md-3" id="jonal_id" name="jid" required>
            <option value="all"> All Jonal  </option>
 
             </select>
        </label>
         <label> 
            College  
            <select class="form-control col-md-3" id="college_id" name="cid" required>
            <option value="all"> All College   </option>
 
             </select>
        </label>
        <label>
            &nbsp;
            <input type="submit" name="sumbit" value="Search" class="btn btn-primary form-control col-md-1" />
        </label>
        <br/>
        <br/>
        <?php echo form_close() ;  ?> 
    </div>
        <div class="text-center">
        <h3> Chalan/Shipment Report </h3>
        <div> From <?php echo date('d-m-Y', strtotime($sdate)) ?> to <?php echo date('d-m-Y', strtotime($edate)) ?>   </div>
        <?php if(!empty ($jonal_info)) { ?>
        <h4> Jonal :  <?php echo $jonal_info->name ?>  </h4>
           
        <?php } else echo "<div> All Jonal </div>"; ?> 
        
        </div>
          <?php if(!empty ($content_list)) {  ?> 
     
        <div class="clearfix"></div>
   </div> 
    
    <div>
        
    <table class="table table-bordered table-hover" >
        <tr>
            <th >DID</th>
          
            <th >Date </th>
            
            
            <th >Collage </th>
            <th >Teacher </th>
            <th >Department </th>
            <th >Send By </th>
            <th > Total Book </th>
            <th >Comment </th>
            <th></th>
         </tr>
   
         <?php 
 foreach ($content_list as $content) { 
         ?> 
         
         <tr>
             <td> <?php echo $content['did'] ?>  </td>
              
             <td> <?php echo date( "d-m-Y" , strtotime($content['distribute_date'] )) ; ?>  </td>
            
             <td> <?php echo $content['cname'] ?>  </td>
             <td> <?php echo $content['tname'] ?>  </td>
             <td> <?php echo $content['depname'] ?>  </td>
             <td> <?php echo $content['empname'] ?>  </td>
             <td> <?php echo $content['bookqty'] ?>  </td>
             <td> <?php echo $content['comments'] ?>  </td>
             <td> <div class="no-print"> <a href="<?php echo base_url() ?>index.php/distribute/printpreview/<?php echo $content['did'] ?>" class="btn btn-link"> view </a> </div> </td>
         </tr>
         
         <?php } ?> 
         
            
     </table> 
</div>
    
    <?php } else {?>
    <br/> 
    <br/> 
    <br/> 
    <br/> 
    <div class="alert alert-danger text-center">
        No data Found! 
    </div>
    
    <?php } ?>
    <script> 
    
       $(document).ready(function() {
           
             $('').datepicker({
                             KeyboardNavigation: false,
                              todayHighlight: true,
                               format: 'dd-mm-yyyy',
                                autoclose: true
                
            });
                   
                   
                   
                   
        $(".no-print").on('change', '#division_id', function(){

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
 }); 

$("body").on('change', '#jonal_id', function(){

        var jone_id = $(this).val() ; 
        $.ajax({
          url: "<?php echo base_url() ?>index.php/home/getcollege/"+jone_id,

          beforeSend: function( xhr ) {
            xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            $("#college_id").html("<option>Loading .... </option>") ; 

          }
        })
      .done(function( data ) {
      
         $("#college_id").html("<option value=''>Select a College </option>"); 
            data=JSON.parse(data);
        $.each(data, function(key, val) {
              $("#college_id").append("<option value='"+val.id+"'>"+val.name+"</option>");
              
            });  
            

   });
 }); 
 


       });
    </script>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>