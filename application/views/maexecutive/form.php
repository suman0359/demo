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
<div class="col-md-9 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
    <h2> Add New User </h2>
    

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
        'required' => 'required',
        'placeholder'=>'User Name'
        
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
        'type'=>'email',
        'required' => 'required',
         'placeholder'=>'Name@gmail.com'
        
    );
    echo form_input($form_input); 
    ?>
    
</div>
    
   
<div class="form-group">
    
    <label>Password  </label>
    <?php 
    $form_input = array(
        'name' => 'password',
        'class' =>'form-control ', 
        'value' => '',
         
        'placeholder'=>'********'
    );
    echo form_password($form_input); 
    ?>
    
</div>
   
<div class="form-group">
    
    <label>Phone  </label>
    <?php 
    $form_input = array(
        'name' => 'phone',
        'class' =>'form-control ', 
        'value' => $phone,
         'placeholder'=>'01**  ** ** **'
        
    );
    echo form_input($form_input); 
    ?>
    
</div> 
<div class="form-group">
    
    <label>Image  </label>
    <?php 
    $form_input = array(
        'name' => 'image',
        'class' =>'', 
        'value' => '',
        'type'=>'file'
         
        
    );
    echo form_input($form_input); 
    if($image){
    ?>
    
    <img src="<?php echo base_url()?>uploads/<?php echo $image; ?>" style="height:40px; width: 50px; margin-top: 1px;" />
    <?php } ?>
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
        'required' => 'required',
         'placeholder'=>'Address'
    );
    echo form_textarea($form_input); 
    ?>
    
</div> 

<div class="form-group col-md-6">
    
    <label>Division  </label>
    <div>
    
        <?php
        
        $dname=array("0"=>'All');
        $class='class="form-control division_id" ';
        foreach($division_list as $division){ 
            $dname[$division['id']]=$division['name'];
            }
         
            echo form_dropdown('division_id',$dname,$division_id,$class);
            
            ?>
      
        
        
    </div>
</div>

<div class="form-group col-md-6">
    
    <label> Jonal  </label>
  
    
      
            <div>
            <select name="jonal_id" class="form-group form-control" id="jonal_id">
            <?php 
            if($jonal_id !== ''){
            $jonal = $this->CM->getInfo('jonal', $jonal_id); 

            ?>
            <option value="<?php echo $jonal->id?>" ><?php echo $jonal->name; ?> </option>
            <?php } else {?>
            <option value="0" >select Division First </option>
                 <?php } ?>
            </select>
            </div>
        
        
   
</div>

    
    
<div class=" text-center">
     
    <?php 
    $form_input = array(
        'name' => 'submit',
        'class' =>'btn btn-lg btn-success ', 
        'value' => 'Add User'
        
       
    );
    echo form_submit($form_input); 
    ?>
    
</div>
   <?php echo form_close() ?> 
    
    <script>
    $(document).ready(function(){

       
        $(".main-mid-area").on('change', '.division_id', function(){

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


    }); 

</script>


</div>
<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>
        
     

     
 