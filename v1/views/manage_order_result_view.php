<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * manage interface book list result view
 */

?>
<table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Order Id</th>
			<th>Description</th>
            <th>Total Amount</th>
            <th>Total Paid</th>
            <th>Status</th>
                  
        </tr>
        <?php
        foreach ($data['res'] as $key => $value) {
            echo "<tr>";
                        
            echo "<td><a href='".$this->baseURL."cart/order/".$value['order_id']."'>".$value['order_id']."</a></td>";
            echo "<td></td>"; 			
            echo "<td>".$value['total_amount']."</td>";                         
            echo "<td>".$value['paid_amount']."</td>";                         
            echo "<td>".$value['status']."</td>";                         
                                    
            echo "</tr>";
        }
        ?>
        
        <tr>

            
        </tr>
    </table> 

<script type="text/javascript">
    
</script>
