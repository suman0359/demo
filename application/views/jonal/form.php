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
            <li><a href="<?php echo base_url() ?>home"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url() ?>jonal">Jonal</a></li>
            <li class="active"><a href="<?php echo base_url() ?>jonal/add">Add Jonal</a></li>
        </ol>
    </section>
    <br/>

    <!-- Start Working area --> 
    <div class="col-md-12 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>
        <h2> Add New jonal </h2>


        <?php
        echo form_open('');
        ?>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label> jonal Name </label>
                    <?php
                    $form_input = array(
                        'name' => 'name',
                        'class' => 'form-control ',
                        'value' => $name,
                        'required' => 'required',
                        'placeholder' => 'Jone/Jonal Name',
                        'size' => '50'
                    );
                    echo form_input($form_input);
                    ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">


                    <label>Division Name </label>
                    <div>
                        <select name="division_id" class="form-group form-control">
                            <option value="0" >select Option</option>
                            <?php foreach ($division_list as $division) { ?>

                                <option value="<?php echo $division["id"]; ?>" 
                                        <?php if ($division["id"] == $division_id) {
                                            echo 'selected';
                                        } ?> >
                                <?php echo $division["name"]; ?>
                                </option>

<?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">


                    <label>Jonal Head Name </label>
                    <div>
                        <select name="jonal_head" class="form-group form-control">
                            <option value="0" >select Option</option>
                            <?php foreach ($jonal_head_list as $jonal_head) { ?>

                                <option value="<?php echo $jonal_head["id"]; ?>" 
                                        <?php if ($jonal_head["id"] == $jonal_head) {
                                            echo 'selected';
                                        } ?> >
                                <?php echo $jonal_head["name"]; ?>
                                </option>

<?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-3">
                    <label> Publication Status </label><br>
            <label class="radio-inline">
              <input type="radio" name="status" id="inlineRadio1" <?php
if ($status == 1) {
    echo "checked";
}
?>  value="1"> Published
            </label>
            <label class="radio-inline">
              <input type="radio" name="status" id="inlineRadio2" <?php
if ($status == 0) {
    echo "checked";
}
?>  value="0"> Unpublished
            </label>
            </div> -->
            <div class="col-md-2"><br>
                <div class="pull-right"> 

                    <?php
                    $form_input = array(
                        'name' => 'submit',
                        'class' => 'btn btn-lg btn-success ',
                        'value' => 'Add Jone/Jonal'
                    );

                    echo form_submit($form_input);
                    echo form_close()
                    ?> 

                </div> 
            </div>
        </div>



        <!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>