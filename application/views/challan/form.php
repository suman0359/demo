<?php
$this->load->view('common/css_link');
$this->load->view('common/header');
$this->load->view('common/sidebar');
//$this->load->view('common/control_panel');
?>
<?php $companyname=$this->session->userdata('companyname'); ?>
<?php $department_id=$this->uri->segment(3) ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-top:-10px!important;">
           <h1 id="company_info">
                Dashboard
                <small ><?php if(!empty($companyname)) echo  $companyname; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo base_url()?>transfer">Challan Entry</a></li>
                <li class="active"><a href="<?php echo base_url()?>transfer/add/<?php echo $department_id ;?>">Add Challan</a></li>
            </ol>
        </section>
    <br/>


<!-- Start Working area --> 
<div class="col-md-12 main-mid-area"> 
    <?php $this->load->view('common/error_show') ?>
    <h2> Add New Challan Entry </h2>


   

    <div class="col-md-12 margin_padding">
        
       <div class="col-md-9 ">
            <div class=" ">
            <input type="text" name="term" id="term" value="" class="form-control "  placeholder="Type item name or scan barcode..."/>
            <input type="text" name="department" id="department" value="<?php echo $department ;?>" class="hidden form-control" />
            </div>
           
           <br/>
            <?php
    echo form_open_multipart('transfer/add/'.$department);
    ?>
            <table class="table tableproduct table-responsive table-bordered col-md-12" id="plateVolumes" >  
                <tbody>
                <tr class="alert alert-info">
                    
                    <th></th>
                    <th>Product Name</th>
                    <th>Current Stock </th>
                    <th>Transfer Quantity</th>
                 
                </tr>
         
                </tbody>

                
            </table>
           
              
        
                
           
    
           
           
    </div>
         
        
        
        
    <div class="col-md-3">
        
     <div class="control-group">
          <label class="control-label">Challan No</label>
          <div class="controls "  >
              <input type="text" class="form-control col-md-2" id="challan_no" name="challan_no" value="" placeholder="challan Number" required/>
             
          </div>
       </div>
       <div class="control-group">
          <label class="control-label">Date</label>
          <div class="controls " id="sandbox-container" >
              <input type="text" class="datepicker fill-up form-control col-md-2" name="date" value="<?php echo $date ;?>" placeholder="YYY/MM/DD" required/>
             
          </div>
       </div>
        
  

        <div class="control-group">
             <label class="control-label">Challan To</label>
            <?php
            $class = 'class="form-control  required" ';
           
            foreach ($department_list as $department) {
            $department_select[$department['id']] = $department['name'];
            }
            echo form_dropdown('transfer_to', $department_select,2 , $class);
            ?>
        </div>
        
        <div class="control-group ">
          <label class="control-label">Comments</label>
        
          <?php 
                $form_textarea = array(
                                'name' => 'comments',
                                'class' => 'form-control ',
                                'value' => ' ',
                                'rows'=>'3'
                               
                            );
          echo form_textarea($form_textarea) ?>
       </div>
        
        </div>
        
        
    
    
<div class="clearfix"></div>

   

        <div class=" text-center">

<input type="submit" name="submit" value="Add Challan"  class="btn btn-lg btn-success" onClick="return confirm('Are you sure want to Submite');"/>
<?php echo form_close() ?>      
            </div>
        </div>
     </div>
    <!-- End  Working area --> 
    
    

    <!-- start  add the row --> 

    
    
<script>
        $(document).ready(function() {
            
            $( "#term" ).autocomplete({
		source: '<?php echo base_url() ; ?>index.php/transfer/suggation',
		minLength:1,
		select: function(event, ui)
		{
			var item=$( "#item" ).val(ui.item.value.name);
                        additemrow(ui.item.value) ;
                  }
	});
        
          $( "#term" ).focus(function() {
          $( "#term" ).val('') ; 
        });
        
        
        $( "#term" ).keypress(function( event ) {
            
            if ( event.which == 13 ) {
             var id = $(this).val() ;
            
             additemrow(id);
            
            }else 
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
     
            $("#add").click(function() {
                var row = "<tr class='frow'>" + $(".frow").html() + "</tr>";
                $(".tableproduct tr:last-child").last().after(row);
            });


            $("#remove").click(function() {
                $(".tableproduct tr:last-child").last().remove();
                
            });

        });
        




function additemrow(id)
{
    var id = id ; 
    getproduct(id);
   
  
}


function getproduct(id)
{
    var did;
   did=$("#department").val();
   
    var pid= parseInt(id);
    
    var flag = true ;  
    
    $( ".pid" ).each(function( index ) {
        // console.log( $( this ).val() );
       var d =  parseInt($(this).val()) ; 
      // alert(id+"-"+d) ;
       if(id == d)
           {
              var cv = parseInt($(".q_"+id).val()) ;  
                
               $(".q_"+id).val(cv+1) ; 
               
               flag = false ; 
           }
    });
    
    if(flag) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url() ; ?>transfer/getproduct/"+did+'/'+pid,
                dataType: "json",
                success: function(product){
                       if(product!="")
                           { 
                      
                                $('.tableproduct').append('<tr id="line_'+product.id+'" >\n\
                                                          <td  ><i   class="remove_item glyphicon glyphicon-minus-sign btn btn-warning btn-xs "  itemid="' +product.id +'" ></i></td>\n\
                                                          <td><input name="pid[]" class="pid"  value=" '+product.id+' " type="hidden">'+ product.name +'</td>\n\
                                                          <td><input name="" class="pid"  value="" type="hidden">'+ product.quantity +'</td>\n\
                                                          <td><input type="number" name="qty[]"   id="qty" min="1" value="1" max="'+product.quantity+'" class="q_'+product.id+' qty form-control "  onclick="toatalquantity()" /></td>\n\
                                                          </tr>');

                                  }
                                  else
                                      {
                                          alert("Item Not Available In Stock By This Id "+ id);
                                      }
                            }
                     });
     }
}
  
         $(document.body).on('click','.remove_item', function(){
                var id = $(this).attr("itemid") ;
                $("#line_"+id).remove();
               
               
              });
          

 
 


$( '.table' ).on("change", toatalquantity);  

   function toatalquantity(){
   
    var sum =parseInt(0) ;
       // or $( 'input[name^="ingredient"]' )
       $( 'input[name^="qty[]"]' ).each( function( i , e ) {
           var v = parseInt( $( e ).val() );
            
           if ( !isNaN( v ) )
               sum += v;
          
       } );

             //alert(sum) ; 
             $(".t_qty").val(sum) ;   
       }  


</script>

 

<?php $this->load->view('common/footer') ?>
        



