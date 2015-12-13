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
    <input type="password" name="password" class="form-control"  value="" autocomplete="off" />
    
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
<div class="form-group user_type_option">
    
    <label>User Type </label>
    <div>
        <select name="user_type" class="form-group form-control" id="user_type">
            <option value="0" <?php if($user_type==0) echo 'selected' ;?> >select Option</option>
            <option value="1" <?php if($user_type==1) echo 'selected' ;?>  >Supper Admin</option>
            <option value="2" <?php if($user_type==2) echo 'selected' ;?>  >Admin</option>
            <option value="3" <?php if($user_type==3) echo 'selected' ;?>  >Division User </option>
            <option value="4" <?php if($user_type==4) echo 'selected' ;?>  >Jonal Head </option>
        </select>
    </div>
</div>

   <div class="form-group">
    
    <label>Allow Department </label>
    <div>
    
        <?php
        
        $dname=array("0"=>'All');
        $class='class="form-control" ';
        foreach($department_list as $department){ 
            $dname[$department['id']]=$department['name'];
            }
         
            echo form_dropdown('pdepartment',$dname,$pdepartment,$class);
            
            ?>
      
        
        
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
    
    

</div>

<script type="text/javascript">
    
    $(".user_type_option").on('change', '#user_type', function () {
                
    var college_id = document.getElementById("college_id_value");
    var college_id = college_id.value;
    var department_id = $(this).val();
    // $.ajax({
    //     url: "<?php echo base_url() ?>index.php/home/getteacherbycollegeanddepartment/" + college_id + "/" + department_id,
    //     beforeSend: function (xhr) {
    //         xhr.overrideMimeType("text/plain; charset=x-user-defined");
    //         $("#teacher_id").html("<option>Loading .... </option>");

    //     }
    // })
    //         .done(function (data) {

    //             $("#teacher_id").html("<option value=''>Select a Teacher </option>");
    //             data = JSON.parse(data);
    //             $.each(data, function (key, val) {
    //                 $("#teacher_id").append("<option value='" + val.id + "'>" + val.name + "</option>");

    //             });


    //         });
});

</script>

<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>
        
     

     
 