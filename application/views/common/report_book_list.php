
        <table class="table voucher_item_area" >
            <tr class="active voucher_header">
                <td>Sl</td>
                <td> Book  Name</td>
                <td>Book Code</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Total</td>
                
            </tr>
            <?php  
             $i=1;
             $total_price=0;
             $total_quantity=0;
            foreach($book_list as $book){
               
           
            ?>
            <tr class="voucher_item">
                <td><?php echo $i; ?></td>
                
                 <td>
                    <?php echo  $book['book_name']           ?>
                </td>
                 <td>
                    <?php echo $book['book_code']           ?>
                </td>
                
                
                <td><?php echo $book['quantity'] ;?></td>
                <td><?php echo $book['price'] ;?></td>
                <td><?php   echo $total=$book['quantity'] * $book['price'] ; ?> </td>
               
            </tr>
            <?php $total_price+=$total;
                  $total_quantity+=$book['quantity'];
            $i++ ; } 
            ?>
               <tr class="voucher_total">
                <td></td>
                <td></td>
                <td>Total Quantity</td>
                <td><?php echo $total_quantity ;?></td>
                <td>Total Price</td>
                <td><?php echo $total_price ;?></td>
                
            </tr>
            
            
        </table>
    