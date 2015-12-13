<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?>
<?php $companyname = $this->session->userdata('companyname'); ?>
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
            <li class="active"><a href="<?php echo base_url() ?>purchase">Purchase</a></li>
            <li class="active"><a href="<?php echo base_url() ?>purchase/add">Add Purchase</a></li>
        </ol>
    </section>
    <br/>


    <!-- Start Working area --> 
    <div class="col-md-12 main-mid-area"> 
        <?php $this->load->view('common/error_show') ?>
        <h2> Book Requisition  </h2>




        <div class="col-md-12 margin_padding">

            <div class="col-md-9 ">
                <div class=" ">
                    <input type="text" name="term" id="term" value="" class="form-control"  placeholder="Type Book name her and select from Dropdown saggatiom..."/>
                </div>

                <br/>
                <?php
                echo form_open_multipart('');
                ?>
                <table class="table tableproduct table-responsive table-bordered col-md-12" id="plateVolumes" >  
                    <tbody>
                        <tr class="alert alert-info">

                            <th></th>
                            <th>Book  Name</th>
                            <th>Book Code</th>
                            <th>Book Price</th>
                            <th>Quantity</th>

                        </tr>

                    </tbody>


                </table>




                <table class="table table-responsive table-bordered col-md-12 " id="" >  
                    <tr class="alert alert-danger">

                        <th>Total Quantity</th>
                        <th> </th>

                    </tr>
                    <tr>

                        <td>
                            <?php
                            $form_input = array(
                                'name' => 't_qty',
                                'class' => 'form-control t_qty',
                                'value' => '',
                                'readonly' => 'readonly'
                            );
                            echo form_input($form_input);
                            ?>
                        </td>
                        <td>

                        </td>


                    </tr>
                </table>

                <div class="text-center">
                    <input type="submit" name="submit" value="Add perchase"  class="btn btn-lg btn-success" onClick="return confirm('Are you sure want to Submite');"/>
                </div>
            </div>




            <div class="col-md-3">



                <div class="control-group">
                    <label class="control-label">Date</label>
                    <div class="controls " id="sandbox-container" >
                        <input type="text" class="datepicker fill-up form-control col-md-2" name="date" value="<?php echo $date; ?>" readonly="" placeholder="YYY/MM/DD" required/>

                    </div>
                </div>



                <div class="control-group">


                    <label>College </label>
                    <div>

                        <?php
                        $class = 'class="form-control  required" required  id="college_id" ';
                        $sup_data = array("" => "Select College ");
                        foreach ($college_list as $sup) {
                            $sup_data[$sup['id']] = $sup['name'];
                        }
                        echo form_dropdown('college_id', $sup_data, $sid, $class);
                        ?>
                    </div>
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






            <?php echo form_close() ?>      

        </div>
    </div>
    <!-- End  Working area --> 



    <!-- start  add the row --> 



    <script>
        $(document).ready(function () {

//            $(".main-mid-area").on('change', '#division_id', function () {
//
//                var div_id = $(this).val();
//                $.ajax({
//                    url: "<?php echo base_url() ?>index.php/home/getjonal/" + div_id,
//                    beforeSend: function (xhr) {
//                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
//                        $("#jonal_id").html("<option>Loading .... </option>");
//
//                    }
//                })
//                        .done(function (data) {
//                            $("#jonal_id").html("<option value=''>Select a Jonal </option>");
//                            data = JSON.parse(data);
//                            $.each(data, function (key, val) {
//                                $("#jonal_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
//
//                            });
//
//
//                        });
//            });
//
//            $(".main-mid-area").on('change', '#jonal_id', function () {
//
//                var jone_id = $(this).val();
//                $.ajax({
//                    url: "<?php echo base_url() ?>index.php/home/getcollege/" + jone_id,
//                    beforeSend: function (xhr) {
//                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
//                        $("#college_id").html("<option>Loading .... </option>");
//
//                    }
//                })
//                        .done(function (data) {
//
//                            $("#college_id").html("<option value=''>Select a College </option>");
//                            data = JSON.parse(data);
//                            $.each(data, function (key, val) {
//                                $("#college_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
//
//                            });
//
//
//                        });
//            });


            // Department showing 

//            $(".col-md-3").on('change', '#college_id', function () {
//
//                var teacher = $(this).val();
//                $.ajax({
//                    url: "<?php echo base_url() ?>index.php/department/getdepartmentbyteacher/" + teacher,
//                    beforeSend: function (xhr) {
//                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
//                        $("#department_id").html("<option>Loading .... </option>");
//
//                    }
//                })
//                .done(function (data) {
//                    /* if ( console && console.log ) {
//                     console.log( "Sample of data:", data.slice( 0, 100 ) );
//                     }*/
//
//                    $("#department_id").html("<option value=''>Select a Department </option>");
//                    data = JSON.parse(data);
//                    $.each(data, function (key, val) {
//                        $("#department_id").append("<option value='" + val.id + "'>" + val.name + "</option>");
//                    });
//                });
//        });


            //Teacher Select 
            $(".main-mid-area").on('change', '#college_id', function () {
                var college_id = $(this).val();
                $(".main-mid-area").on('change', '#department_id', function () {

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
            });

            //-----------------------------------

            $(".new_form").hide();


            $("#term").autocomplete({
                source: '<?php echo base_url(); ?>index.php/requisition/suggation',
                minLength: 1,
                select: function (event, ui)
                {
                    $("#item").val(ui.item.value.name);
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




            /* $('#sandbox-container input').datepicker({
             KeyboardNavigation: false,
             todayHighlight: true,
             format: 'dd-mm-yyyy',
             autoclose: true
             });*/

            $("#add").click(function () {
                var row = "<tr class='frow'>" + $(".frow").html() + "</tr>";
                $(".tableproduct tr:last-child").last().after(row);
            });


            $("#remove").click(function () {
                $(".tableproduct tr:last-child").last().remove();
                call_all();
            });



        });


        function additemrow(id)
        {
            var id = id;
            getproduct(id);

        }


        function getproduct(id)
        {

            var id = parseInt(id);

            var flag = true;

            $(".pid").each(function (index) {
                // console.log( $( this ).val() );
                var d = parseInt($(this).val());
                // alert(id+"-"+d) ;
                if (id == d)
                {
                    var cv = parseInt($(".q_" + id).val());

                    $(".q_" + id).val(cv + 1);
                    call_all();
                    flag = false;
                }
            });

            if (flag) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>requisition/getproduct/" + id,
                    dataType: "json",
                    success: function (books) {

                        if (books != "")
                        {

                            $('.tableproduct').append('<tr id="line_' + books.id + '" >\n\
                                                              <td  ><i   class="remove_item glyphicon glyphicon-minus-sign btn btn-warning btn-xs "  itemid="' + books.id + '" ></i></td>\n\
                                                              <td><input name="pid[]" class=" pid"  value="' + books.id + '" type="hidden" >' + books.book_name + '</td>\n\
                                                              <td>' + books.book_code + ' </td>\n\
                                                              <td><input name="price[]" class=" "  value="' + books.rate + '" type="hidden" > ' + books.rate + '</td>\n\
                                                              <td> <input type="number" name="qty[]"   id="qty" min="1" value="1" class="q_' + books.id + ' qty form-control "  onChange="call_all()" /></td>\n\
                                                        </tr>');

                        }
                        else
                        {
                            alert("Item Not Fount By This Id " + id);
                        }
                    }
                });
            }
        }

        $(document.body).on('click', '.remove_item', function () {
            var id = $(this).attr("itemid");
            $("#line_" + id).remove();
            call_all();
        });





        $('.table').on("change", call_all);


        function toatalquantity() {
            var sum = 0;
            // or $( 'input[name^="ingredient"]' )
            $('input[name^="qty"]').each(function (i, e) {
                var v = parseInt($(e).val());
                if (!isNaN(v))
                    sum += v;
            });

            // alert(sum) ; 
            $(".t_qty").val(sum);
        }


        function toatalcost() {
            var sum = 0;
            // or $( 'input[name^="ingredient"]' )
            $('input[name^="total"]').each(function (i, e) {
                var v = parseInt($(e).val());
                if (!isNaN(v))
                    sum += v;
            });

            // alert(sum) ; 
            $(".t_price").val(sum);
        }




        function WO() {
            var table = document.getElementById("plateVolumes");



        }

        function call_all()
        {
            WO();
            toatalcost();
            toatalquantity();

        }

    </script>



    <?php $this->load->view('common/footer') ?>
        



