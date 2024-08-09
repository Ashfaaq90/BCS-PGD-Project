<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * manage interface book list result view
 */

?>
<table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Author</th>
            <th style="width: 400px;">Description</th>
            <th>Price</th>
			<th>Qty</th>
                           
        </tr>
        <?php
        foreach ($data['res'] as $key => $value) {
            echo "<tr>";
            echo "<td><a href='".$this->baseURL."manage/book/".$value['book_code']."'>".$value['book_code']."</a></td>";                         
            echo "<td>".$value['book_name']."</td>";                         
            echo "<td>".$value['author']."</td>";                         
            echo "<td>".$value['book_desc']."</td>";                         
            echo "<td>".$value['price']."</td>"; 
			echo "<td>".$value['qty']."</td>";  			
                        
            echo "</tr>";
        }
        
        
        ?>
        <tr>
            <td colspan="6" id="list_nav">
                <?php
                    if($data['pno'] >1 ){
                        echo '<button onclick="search_book(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']-1).')" >Back</button>';
                    }else{
                        echo '<button>>>></button>';
                    }
                    if(sizeof($data['res']) > 9 ){
                        echo '<button style="float:right;" onclick="search_book(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']+1).')" >Next</button>';
                    }else{
                        echo '<button style="float:right;" ><<<</button>';
                    }
                ?>                
            </td>
            
        </tr>
    </table> 
