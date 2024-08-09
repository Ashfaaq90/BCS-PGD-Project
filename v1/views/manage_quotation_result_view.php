<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * manage interface book list result view
 */

?>
<table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Id</th>
            <th>From</th>
            <th>info</th>
            <th>Job Name</th>
            <th>Status</th>
                 
        </tr>
        <?php
        foreach ($data['res'] as $key => $value) {
            echo "<tr>";
            echo "<td><a href='".$this->baseURL."manage/getquotbyid/".$value['qt_id']."'>".$value['qt_id']."</a></td>";                         
            echo "<td>".$value['fullname']."</td>";                         
            echo "<td>
                    <b>Ref#:</b> ".$value['referenceno']."<br>
                    <b>email:</b> ".$value['email']."<br>
                    <b>contact:</b> ".$value['contactNo']."<br>
                    <b>qty:</b> ".$value['qty']."<br>
                    <b>Color spec:</b> ".$value['col_spec']."<br>
                    <b>Finishing:</b> ".$value['finishing']."<br>
                    <b>Finish size:</b> ".$value['finish_size']."<br>
                    <b>Paper type:</b> ".$value['papertype']."<br>
                    <b>Spec:</b> ".$value['specifications']."<br>
                    <a href='".$this->baseURL."media/artwork/".$value['filename']."' download> Artwork File</a>    
                 </td>";                         
            echo "<td>".$value['jobname']."</td>";                         
            echo "<td>".$value['status']."</td>";                         
                         
            echo "</tr>";
        }
        ?>
        
        <tr>
            <td colspan="6" id="list_nav">
                <?php
                    if($data['pno'] >1 ){
                        echo '<button onclick="search_quot(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']-1).')" >Back</button>';
                    }else{
                        echo '<button>>>></button>';
                    }
                    if(sizeof($data['res']) > 9 ){
                        echo '<button style="float:right;" onclick="search_quot(\''.$data['s_term'].'\',\''.$data['s_function'].'\','.($data['pno']+1).')" >Next</button>';
                    }else{
                        echo '<button style="float:right;" ><<<</button>';
                    }
                ?>                
            </td>
            
        </tr>
    </table> 

<script type="text/javascript">
    
</script>
