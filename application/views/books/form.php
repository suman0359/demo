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
                <li class="active"><a href="<?php echo base_url()?>college">Books</a></li>
                <li class="active"><a href="<?php echo base_url()?>college/add">Add Books</a></li>
            </ol>
        </section>
    <br/>

    <!-- Start Working area --> 
<div class="col-md-10 main-mid-area"> 
   <?php $this->load->view('common/error_show') ?>
    <h2> Add New Books </h2>
    

    <?php 
    echo form_open('') ; 
    ?>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
		    <label> Books Name </label>
		    <?php 
		    $form_input = array(
		        'name' => 'book_name',
		        'class' =>'form-control ', 
		        'value' => $name, 
		        'required' => 'required',
		        'placeholder'=>'Book Name',
		        'size' => '50'
		    );
		    echo form_input($form_input); 
		    ?>
		</div>
	</div>

    <div class="col-md-3">
        <div class="form-group">
       
            
            <label>Group Name </label>
            <div>
            <select name="group_id" class="form-group form-control" id="group_id">
            <option value="0" >select Option</option>
                <?php foreach ($group_list as $group) { ?>
                
                <option value="<?php echo $group["id"]; ?>" <?php if($group["id"]==$group_id){echo 'selected';} ?> >
                    <?php echo $group["name"]; ?>
                </option>

                <?php }?>
            </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label> Book Code </label>
            <?php 
            $form_input = array(
                'name' => 'book_code',
                'class' =>'form-control ', 
                'value' => $book_code, 
                'required' => 'required',
                'placeholder'=>'Book Code',
                'size' => '50'
            );
            echo form_input($form_input); 
            ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
       
            
            <label>Subject Name </label>
            <div>
            <select name="subject_id" class="form-group form-control" id="subject_id">
            <option value="0" >select Option</option>
                <?php foreach ($subject_list as $subject) { ?>
                
                <option value="<?php echo $subject["id"]; ?>" <?php if($subject["id"]==$subject_id){echo 'selected';} ?> >
                    <?php echo $subject["name"]; ?>
                </option>

                <?php }?>
            </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> Book Rate </label>
            <?php 
            $form_input = array(
                'type' => 'number',
                'name' => 'rate',
                'class' =>'form-control ', 
                'value' => $book_rate, 
                'required' => 'required',
                'placeholder'=>'Book Rate',
                'size' => '50'
            );
            echo form_input($form_input); 
            ?>
        </div>
    </div>



	<!-- <div class="col-md-4">
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
        'value' => 'Add Books'
    );

    echo form_submit($form_input); 
    echo form_close() 
    ?> 

   </div> 
	</div>
</div>





<!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>