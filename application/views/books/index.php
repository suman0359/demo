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
            <li class="active"><a href="<?php echo base_url() ?>jonal">Books</a></li>
        </ol>
    </section>
    <br/>



    <div class="col-md-12 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>

        <div class="searchbar " >
            <div class="col-md-8"  >
            </div>

            <div class="pull-right"> 
                <a href="<?php echo base_url() ?>books/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> Add Books</a> 
            </div>
            <div class="clearfix"></div>
        </div> 


        <div class="col-md-12">

            <table class="table table-bordered table-hover ">
                <tr>
                    <th id="action_btn_align">SL</th>
                    <th id="action_btn_align">Books Name</th>
                    <th id="action_btn_align">Books Code</th>
                    <th id="action_btn_align">Subject Name</th>
                    <th id="action_btn_align">Books Rate</th>
                    <th id="action_btn_align">Books Group</th>
                    <th id="action_btn_align">Action</th>

                </tr>



                <?php
                //var_dump($college_list) ; 
                foreach ($books_list as $books) {
                    $group = $this->CM->getInfo('group', $books['group_id']);
                    $subject = $this->CM->getInfo('tbl_subject', $books['subject_id']);
                    ?>


                    <tr id="action_btn_align">
                        <td> <?php echo $books['group_id']; ?></td>
                        <td> <?php echo $books['book_name'] ?></td>
                        <td> <?php echo $books['book_code'] ?></td>
                        <td> <?php echo $subject->name; ?></td>
                        <td> <?php echo $books['rate'] ?></td>
                        <td> <?php echo $group->name; ?></td>

                        <td>     
                            <a class="btn btn-primary btn-flat" href="<?php echo base_url(); ?>books/edit/<?php echo $books['id'] ?>">
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