<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?>
<?php $companyname = $this->session->userdata('companyname'); ?>
<?php $department_id = $this->uri->segment(3) ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top:-10px!important;">
        <h1 id="company_info">
            Dashboard
            <small ><?php if (!empty($companyname)) echo $companyname; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url() ?>transfer">Distribute Book </a></li>

        </ol>
    </section>
    <br/>


    <!-- Start Working area --> 
    <div class="col-md-12 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>
        <h2> Distribute book to teacher </h2>




        <div class="col-md-12 margin_padding">

            <div class="col-md-9 ">
                <div class="slect_book">
                    <table class="table table-striped"> 
                        <tr class="alert alert-warning">
                            <th>Book  Name</th>
                            <th>Current Stock </th> 
                            <th> </th>
                        </tr>
                        <?php
                        foreach ($allbooks as $book) {
                            ?>
                            <tr>
                                <td> <?php echo $book['book_name'] ?> </td>
                                <td> <?php echo $book['quantity'] ?> </td>
                                <td> <a href="JavaScript:void(0)" class="btn btn-xs btn-success pull-right add_book_row" onclick="return additemrow(<?php echo $book['id'] ?>)" item-id="<?php echo $book['id'] ?>" > add </a> </td>
                            </tr>

                        <?php } ?>
                    </table> 
                </div>  

                <br/>
                <?php
                echo form_open('');
                ?>
                <table class="table tableproduct table-responsive table-bordered col-md-12" id="plateVolumes" >  
                    <tbody>
                        <tr class="alert alert-info">

                            <th></th>
                            <th>Book  Name</th>
                            <th>Book Code </th>
                            <th>Book Price</th>
                            <th>Current Stock </th>
                            <th>Transfer QTY</th>

                        </tr>

                    </tbody>
                </table>

            </div>


            <div class="col-md-3">

                <div class="control-group">
                    <label class="control-label">Date</label>
                    <div class="controls " id="sandbox-container" >
                        <input type="text" class="datepicker fill-up form-control col-md-2" name="date" value="<?php echo $date; ?>" placeholder="YYY/MM/DD" required/>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">School/Collage</label> <br/>
                    <input type="hidden" name="college_id" id="college_id_value" value="<?php echo $cid ?>" />
                    <b> <?php echo $college->name; ?> </b>

                    <a class="btn btn-xs btn-primary  "  data-target="#college_list" data-toggle="modal" href="JavaScript:void(0)">Change College</a>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Department</label>
                    <?php
                    $class = 'class="form-control  required" required  id="department_id" ';
                    $sup_data = array("" => "Select Department ");
                    foreach ($department_list as $sup) {
                        $sup_data[$sup['id']] = $sup['name'];
                    }
                    echo form_dropdown('department_id', $sup_data, $sid, $class);
                    ?>

                </div>

                <div class="control-group">
                    <label>Teacher </label>
                    <div>
                        <select name="teacher_id" class="form-group form-control" id="teacher_id">
                            <option value="0" >select  Teacher </option>

                        </select>
                    </div>
                </div>

                


                <div class="control-group ">
                    <label class="control-label">Comments</label>

                    <?php
                    $form_textarea = array(
                        'name' => 'comments',
                        'class' => 'form-control ',
                        'value' => ' ',
                        'rows' => '3'
                    );
                    echo form_textarea($form_textarea)
                    ?>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class=" text-center">

                <input type="submit" name="submit" value="Submit"  class="btn btn-lg btn-success" onClick="return confirm('Are you sure want to Submite');"/>
                <?php echo form_close() ?>      
            </div>
        </div>
    </div>
    <!-- End  Working area --> 



    <!-- start  add the row --> 

    <div class="modal fade" id="college_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">  Select a College First </h4>
                </div>
                <div class="modal-body ">
                    Select a College  
                    <?php
                    $class = 'class="form-control " id="collage_id" ';
                    $collages[''] = 'Select a College';
                    foreach ($colage_list as $collage) {
                        $collages[$collage['id']] = $collage['name'];
                    }
                    echo form_dropdown('collage_id', $collages, '', $class);
                    ?>
                    <br/> 
                    <br/> 

                </div>

            </div>
        </div>
    </div>





    <script>
        $(document).ready(function () {

<?php if (!$cid) { ?>
                $("#college_list").modal(
                        {
                            backdrop: 'static',
                            keyboard: false
                        }
                );
<?php } ?>

            $("body").on('change', '#collage_id', function () {
                var cid = $(this).val();
                var url = "<?php echo base_url() ?>distribute/add/" + cid;
                window.location.href = url;
            });



            $("#term").autocomplete({
                source: '<?php echo base_url(); ?>index.php/distribute/suggation',
                minLength: 1,
                select: function (event, ui)
                {
                    var item = $("#item").val(ui.item.value.name);
                    additemrow(ui.item.value);
                }
            });

            $("#term").focus(function () {
                $("#term").val('');
            });


            $("#term").keypress(function (event) {

                if (event.which == 13) {
                    var id = $(this).val();

                    additemrow(id);

                } else
                {
                    // auto complete 
                }

            });


            $('#sandbox-container input').datepicker({
                KeyboardNavigation: false,
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                autoclose: true
            });

            $("#add").click(function () {
                var row = "<tr class='frow'>" + $(".frow").html() + "</tr>";
                $(".tableproduct tr:last-child").last().after(row);
            });


            $("#remove").click(function () {
                $(".tableproduct tr:last-child").last().remove();

            });

        });



        //Teacher Select 
            
                $(".main-mid-area").on('change', '#department_id', function () {
                
                    var college_id = document.getElementById("college_id_value");
                    var college_id = college_id.value;
                    var department_id = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url() ?>index.php/home/getteacherbycollegeanddepartment/" + college_id + "/" + department_id,
                        beforeSend: function (xhr) {
                            xhr.overrideMimeType("text/plain; charset=x-user-defined");
                            $("#teacher_id").html("<option>Loading .... </option>");

                        }
                    })
                            .done(function (data) {

                                $("#teacher_id").html("<option value=''>Select a Teacher </option>");
                                data = JSON.parse(data);
                                $.each(data, function (key, val) {
                                    $("#teacher_id").append("<option value='" + val.id + "'>" + val.name + "</option>");

                                });


                            });
                });
        





        function additemrow(id)
        {
            var id = id;
            getproduct(id);


        }


        function getproduct(id)
        {

            var cid = $("#college_id").val();

            var pid = parseInt(id);

            var flag = true;

            $(".pid").each(function (index) {
                // console.log( $( this ).val() );
                var d = parseInt($(this).val());
                // alert(id+"-"+d) ;
                if (id == d)
                {
                    var cv = parseInt($(".q_" + id).val());

                    $(".q_" + id).val(cv + 1);

                    flag = false;
                }
            });

            if (flag) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>distribute/getproduct/" + cid + "/" + pid,
                    dataType: "json",
                    success: function (book) {
                        if (book != "")
                        {

                            $('.tableproduct').append('<tr id="line_' + book.book_id + '" >\n\
                                                              <td  ><i   class="remove_item glyphicon glyphicon-minus-sign btn btn-warning btn-xs "  itemid="' + book.book_id + '" ></i></td>\n\
                                                              <td><input name="pid[]" class="pid"  value=" ' + book.book_id + ' " type="hidden">' + book.book_name + '</td>\n\
                                                              <td>' + book.book_code + '</td>\n\
                                                              <td> <input name="price[]" class=" "  value="' + book.rate + '" type="hidden" > ' + book.rate + 'TK </td>\n\
                                                               <td><input name="" class="pid"  value="" type="hidden">' + book.quantity + '</td>\n\
                                                              <td><input type="number" name="qty[]"   id="qty" min="1" value="1" max="' + book.quantity + '" class="q_' + book.book_id + ' qty form-control "  onclick="toatalquantity()" /></td>\n\
                                                              </tr>');

                        }
                        else
                        {
                            alert("Item Not Available In Stock By This Id " + id);
                        }
                    }
                });
            }
        }

        $(document.body).on('click', '.remove_item', function () {
            var id = $(this).attr("itemid");
            $("#line_" + id).remove();


        });






        $('.table').on("change", toatalquantity);

        function toatalquantity() {

            var sum = parseInt(0);
            // or $( 'input[name^="ingredient"]' )
            $('input[name^="qty[]"]').each(function (i, e) {
                var v = parseInt($(e).val());

                if (!isNaN(v))
                    sum += v;

            });

            //alert(sum) ; 
            $(".t_qty").val(sum);
        }


    </script>



    <?php $this->load->view('common/footer') ?>
        



