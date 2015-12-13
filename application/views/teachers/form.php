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
                <li class="active"><a href="<?php echo base_url()?>college">Teachers</a></li>
                <li class="active"><a href="<?php echo base_url()?>college/add">Add Teachers</a></li>
            </ol>
        </section>
    <br/>

    <!-- Start Working area --> 
<div class="col-md-10 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
    <h2> Add New Teacher </h2>
    

    <?php 
    echo form_open('') ; 
    ?>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
		    <label> Teacher Name </label>
		    <?php 
		    $form_input = array(
		        'name' => 'name',
		        'class' =>'form-control ', 
		        'value' => $name, 
		        'required' => 'required',
		        'placeholder'=>'Teacher Name',
		        'size' => '50'
		    );
		    echo form_input($form_input); 
		    ?>
		</div>
	</div>

    <div class="col-md-3">
        <div class="form-group">
       
            
            <label>Department Name </label>
            <div>
            <select name="department_id" class="form-group form-control" id="department_id">
            <option value="0" >select Option</option>
                <?php foreach ($department_list as $department) { ?>
                
                <option value="<?php echo $department["id"];?>" <?php if($department["id"]==$department_id){echo 'selected';} ?> >
                    <?php echo $department["name"]; ?>
                </option>

                <?php }?>
            </select>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
       
            
            <label>College Name </label>
            <div>
            <select name="college_id" class="form-group form-control" id="college_id">
            <option value="0" >select Option</option>
                <?php foreach ($college_list as $college) { ?>
                
                <option value="<?php echo $college["id"]; ?>" <?php if($college["id"]==$college_id){echo 'selected';} ?> >
                    <?php echo $college["name"]; ?>
                </option>

                <?php }?>
            </select>
            </div>
        </div>
    </div>


    <div class="col-md-10">
        <div class="form-group">
       
            
            <label>Teaches Address </label>
            <div>
                <textarea  name="address" class="form-group form-control" rows="6">
                    <?php if(isset($address)){echo $address;} ?>
                </textarea>
            </div>
        </div>
    </div>

	<!-- <div class="col-md-3">
		<label> Publication Status </label><br>
        <label class="radio-inline">
          <input type="radio" name="status" id="inlineRadio1" <?php if ($status==1) {
              echo "checked";
          } ?>  value="1"> Published
        </label>
        <label class="radio-inline">
          <input type="radio" name="status" id="inlineRadio2" <?php if ($status==0) {
            echo  "checked";
          } ?>  value="0"> Unpublished
        </label>
	</div>
     -->
		<div class="col-md-2"><br>
		<div class="pull-right"> 

    <?php 
    $form_input = array(
        'name' => 'submit',
        'class' =>'btn btn-lg btn-success ', 
        'value' => 'Add Teachers'
    );

    echo form_submit($form_input); 
    echo form_close() 
    ?> 

   </div> 
	</div>
</div>


<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>


