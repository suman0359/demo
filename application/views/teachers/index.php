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
        <h1>Dashboard<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>home"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url() ?>jonal">College</a></li>
        </ol>
    </section>
    <br/>



    <div class="col-md-12 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>

        <div class="searchbar " >
            <div class="col-md-8"  >
            </div>

            <div class="pull-right"> 
                <a href="<?php echo base_url() ?>teachers/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> Add Teacher</a> 
            </div>
            <div class="clearfix"></div>
        </div> 


        <div class="col-md-12">

            <table class="table table-bordered table-hover ">
                <tr>
                    <th id="action_btn_align">SL</th>
                    <th id="action_btn_align">Teachers Name</th>
                    <th id="action_btn_align">Department Name</th>
                    <th id="action_btn_align">College Name</th>
                    <th id="action_btn_align">Action</th>

                </tr>



                <?php
                //var_dump($college_list) ; 
                foreach ($teachers_list as $teachers) {
                    $department = $this->CM->getInfo('department', $teachers['dep_id']);
                    $college = $this->CM->getInfo('college', $teachers['college_id']);
                    ?>


                    <tr id="action_btn_align">
                        <td> <?php echo $teachers['id'] ?></td>
                        <td> <?php echo $teachers['name'] ?></td>
                        <td> <?php
                if (isset($department->name)) {
                    echo $department->name;
                }
                    ?></td>
                        <td> <?php
                            if (isset($college->name)) {
                                echo $college->name;
                            }
                            ?></td>
                        <td>     
                            <a class="btn btn-primary btn-flat" href="<?php echo base_url(); ?>teachers/edit/<?php echo $teachers['id'] ?>">
                                <i class="fa fa-pencil-square-o" ></i> Edit </a>

                        </td>     
                    </tr>
<?php } ?>

            </table> 
        </div>

        <div>         
<?php echo $this->pagination->create_links();
?>  
        </div>

        <!-- End  Working area --> 
<?php $this->load->view('common/footer') ?>