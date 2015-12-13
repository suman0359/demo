<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?>
<?php $companyname=$this->session->userdata('companyname'); ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 id="company_info">
                Dashboard
                <small ><?php if(!empty($companyname)) echo  $companyname; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>purchase">Edit Purchase</a></li>
            </ol>
        </section>
    <br/>

    

<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
    <?php $this->load->view('common/error_show') ?>
    <h2> Add New Purchase </h2>
   <div class="pull-right"> 
    <a href="<?php echo base_url()?>purchase/add" class="btn btn-info pull-right" > <i class="fa fa-plus-square gap">  </i> New Purchase</a> 
   </div>
        

    <?php
    echo form_open_multipart('');
    ?>

    <div class="col-md-12">
        
     <div class="control-group col-md-3">
          <label class="control-label">Date</label>
          <div class="controls " id="sandbox-container" >
              <input type="text" class="datepicker fill-up form-control col-md-2" name="date" placeholder="MM/DD/YYYY" required value="<?php echo $date; ?>" />
              <i class=""></i>
          </div>
       </div>
        <div class="col-md-4">
             <label class="control-label">Supplier</label>
            <?php
            $class = 'class="form-control " ';
            $sup_data = array("0" => "Select Category");
            foreach ($sup_list as $sup) {
            $sup_data[$sup['id']] = $sup['name'];
            }
            echo form_dropdown('sid', $sup_data, $sid, $class);
            ?>
        </div>

     <div class="control-group col-md-5">
          <label class="control-label">Purchaser</label>
          <input type="text" class="fill-up form-control" name="purchaser" required value="<?php echo $purchaser; ?>" />
       </div>
        <div class="clearfix"></div>
<br/>  
        <table class="table table-responsive table-bordered" id="plateVolumes" >  
            <tr class="alert alert-info">
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
              <?php 
                
                foreach ($pur_product_list as $value)
                {
                ?>
                <tr class="frow">
                        <td>
                        <?php
                        $class = 'class="form-control " ';
                        $pro_data = array("0" => "Select Category");
                        foreach ($pro_list as $pro) {
                            $pro_data[$pro['id']] = $pro['name'];
                        }
                        
                        $pid=$value['pid'];
                        
                        echo form_dropdown('pid[]', $pro_data,$pid, $class);
                        ?>
                    </td>

                    <td><input type='number' name="qty[]" id='qty' class="qty form-control"  onChange="WO()"  value="<?php echo $value['cost'];?>" /></td>
                    <td><input type='number' name="cost[]" id='price' class="price form-control"  onChange="WO()" required value="<?php echo $value['quantity'];?>" /></td>
                    <td><input type='text'  name="price[]" class="price form-control" readonly=""  value="<?php echo $value['total_p'];?>" /></td>
                </tr>
            <?php } ?>
        </table>
             <div class="text-right">
            <span class="btn btn-info btn-sm" id="add" >ADD ROW</span>
            <span class="btn btn-danger btn-sm" id="remove" >Remove ROW</span>
            </div>
    
    
<div class="clearfix"></div>

        <div class="col-md-12 ">
             <div class="form-group col-md-1"></div>
             <div class="form-group col-md-5 margin_padding">   
                 <label>Total Quantity</label>
                <?php
                $form_input = array(
                    'name' => 't_qty',
                    'class' => 'form-control t_qty',
                    'value' => $t_quantity,
                    'readonly' => 'readonly' 
                );
                echo form_input($form_input);
                ?>
            </div>
            <div class="form-group col-md-5">
            <label>Total Cost</label>
                <?php
                $form_input = array(
                    'name' => 't_price',
                    'class' => 'form-control t_price',
                    'value' => $t_price, 
                    'readonly' => 'readonly' , 
                );
                echo form_input($form_input);
                ?>
            </div>
             <div class="form-group col-md-1"></div>
        </div>  
       
        <div class=" text-center">
<?php
$form_input = array(
    'name' => 'submit',
    'class' => 'btn btn-lg btn-success ',
    'value' => 'Update Purchase'
);
echo form_submit($form_input);
?>           
<?php echo form_close() ?> 
            
    </div>
    <!-- End  Working area --> 

    
    
    
    
    
    
    
    
    
    
    
    <!-- start  add the row --> 

    <script>
        $(document).ready(function() {

            $('#sandbox-container input').datepicker();
     
            $("#add").click(function() {
                var row = "<tr class='frow'>" + $(".frow").html() + "</tr>";
                $(".table tr:last-child").last().after(row);
            });


            $("#remove").click(function() {
                $(".table tr:last-child").last().remove();
                toatalcost();
                toatalquantity();
            });

        });
        


$( '.table' ).on("change", toatalcost);  
$( '.table' ).on("change", toatalquantity);  

   function toatalquantity(){
    var sum = 0;
       // or $( 'input[name^="ingredient"]' )
       $( 'input[name^="qty"]' ).each( function( i , e ) {
           var v = parseInt( $( e ).val() );
           if ( !isNaN( v ) )
               sum += v;
       } );

              // alert(sum) ; 
             $(".t_qty").val(sum) ;   
       }  

         
   function toatalcost(){
    var sum = 0;
       // or $( 'input[name^="ingredient"]' )
       $( 'input[name^="price"]' ).each( function( i , e ) {
           var v = parseInt( $( e ).val() );
           if ( !isNaN( v ) )
               sum += v;
       } );

              // alert(sum) ; 
             $(".t_price").val(sum) ;   
       }  

         
     

function WO() {
var table = document.getElementById("plateVolumes");

for(var i = 0; i < table.rows.length; i++) 
{
    var row = table.rows[i];
    var qty = row.cells[1].childNodes[0].value;
	
    var price = row.cells[2].childNodes[0].value;
    var answer = (Number(qty) * Number(price));
    row.cells[3].childNodes[0].value = answer;
	
    }
	
}

    </script>

 

<?php $this->load->view('common/footer') ?>
        



