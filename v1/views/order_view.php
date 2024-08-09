<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Book page view - public
 */

//loading relevent user data
load_model("user");
$user = new user_model();
$user_info = $user->get_info_by_id($data['order_info']['user_id']);

?>
      <!-- Main -->
      <div id="main" class="shell">
             <h3>Order #<?php echo $data['order_info']['order_id'] ?>
             </h3>
             <div id="cart" class="order cart">
                 <p><b>Name: </b><?php echo $user_info['firstname']." ".$user_info['lastname'] ?></p>
                 <?php
                 if(!empty($data['order_info']['courier'])){
                     echo '<p><b>Courier to: </b>'.$data['order_info']['courier_address'].'</p>';
                     echo '<p><b>Contact number: </b>'.$data['order_info']['courier_contact'].'</p>';
                 }
                 ?>
                 <p><i>on <?php echo $data['order_info']['timestamp']?></i></p>
                 
                 <table>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Qty.</th>
                        <th>Price</th>
                        <th>Total</th>

                    </tr>
                    <?php
                    $total_qty = 0;
                    $total_amount = 0;
                    //$order= new order_model();
                    global $order;
                    foreach ($data['order_items'] as $key => $item) {
                        $total  = $item['qty']*$item['price'];
                        //loading printing instruction data
                        $ins_description ="";
                        $artwork_link = "";
                        if($item['item_type'] == "service"){
                            $instructions =$order->get_instructions($item['item_code']);                            
                            $ins_description = "<br><span class='sub_text'>".$instructions[0]['instruction']."</span>";
                            if(!empty($instructions[0]['filename'])){
                                $artwork_link = '<br><a href="'.$this->baseURL.'/media/artwork/'.$instructions[0]['filename'].'" download>Artwork File</a>';
                            }
                        }
                        
                        echo '<tr>';
                        echo '<td>'.($key+1).'</td>';
                        echo '<td>'.$item['description'].'</a>'.$ins_description.$artwork_link.'</td>';
                        echo '<td>'.$item['qty'].'</td>';
                        echo '<td>'.$item['price'].'</td>';
                        echo '<td>'.number_format($total, 2, '.', '').'</td>';
                        echo '</tr>';                            
                    }
                    
                    if($data['order_info']['courier'] == '1'){
                            $total = $item['price']*$item['qty'];
                            echo '<tr>';
                            echo '<td>*</td>';
                            echo '<td>Courier charges</a></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td>'.number_format($this->courier_charges, 2, '.', '').'</td>';
                            echo '</tr>';                       
                    }
                    echo '<tr>
                            <td style="text-align:left;"></td>
                            <td></td>
                            <td></td>
                            <td>Total is </td>
                            <td>'.$this->currency.' '.number_format($data['order_info']['total_amount'], 2, '.', '').'</td>
                          </tr>';
                    echo '<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total paid </td>
                            <td>'.$this->currency.' '.number_format($data['order_info']['paid_amount'], 2, '.', '').'</td>
                          </tr>';
                    //calculating the balance
                    $balance = $data['order_info']['total_amount']-$data['order_info']['paid_amount'];
                    //setup delete link only for staff
                    if($_SESSION['type'] == 'staff'){
                        $del_link = ' <a  style="color:red;" href="'.$this->baseURL.'manage/deleteorder/'.$data['order_info']['order_id'].'">Delete</a>';
                    }else{
                        $del_link = "";
                    }
                    echo '<tr>
                            <td style="text-align:left;">'.$del_link.'</td>
                            <td></td>
                            <td></td>
                            <td>Amount due</td>
                            <td>'.$this->currency.' '.number_format($balance, 2, '.', '').'</td>
                          </tr>';
                    ?>                    
                </table>
                <br>
                <div class="order_status_box"> 
                    <?php
                 //if payment is due display payment options else display order status
                 if($data['order_info']['total_amount'] > $data['order_info']['paid_amount']){
                     ?>                 
                    <form method="post"  action="<?php echo $this->baseURL."cart/payment/".$data['order_info']['order_id'] ?>">
                     <h4>Payment</h4>
                     <br>
                     <label>Amount:</label>
                     <input type="number" name="amount" step="any" value="<?php echo number_format($balance, 2, '.', ''); ?>"/>
                     <input type="submit" value="Pay Now"/>    
                    </form>
                      <?php
                 } else {
                     switch ($data['order_info']['status']) {
                         case "new":
                            echo '<h4><b>Status: </b>Order pending</h4>';
                             break;
                         case "process":
                            echo '<h4><b>Status: </b>Order processing</h4>';
                             break;
                         case "complete":
                            echo '<h4><b>Status: </b>Order Complete</h4>';
                             break;
                         case "complete":
                            echo '<h4><b>Status: </b>Order Rejected</h4>';
                             break;

                         default:
                             break;
                     }
                 }
                 ?>
                 </div>
             </div>
            <!-- End Products -->
         <div class="cl"> </div>
      </div>
      <!-- End Main -->

