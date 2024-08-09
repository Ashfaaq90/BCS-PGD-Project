<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Book page view - public
 */
?>
      <!-- Main -->
      <div id="main" class="shell">
             <h3>Shopping Cart</h3>
             <div id="cart" class="cart">
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
                    if(isset($_SESSION['cart']) && !is_null($_SESSION['cart'])){
                        foreach ($_SESSION['cart'] as $key => $item) {
                            $total = $item['price']*$item['count'];
                            $item_link = ($item['type'] == ' book') ? $this->baseURL.'bookstore/book/'.$item['book_code'] : $this->baseURL.'printstore';
                            $remove_link = ($item['type'] != 'service-opt') ? '<a href="'.$this->baseURL.'cart/remove/'.$key.'"> [Remove] </a>' : '<a href="'.$this->baseURL.'cart/remove/'.$key.'"> [↳] </a>';
                            echo '<tr>';
                            echo '<td> &nbsp;'.$remove_link.($key+1).'</td>';
                            echo '<td><a href="'.$item_link.'">'.$item['book_name'].'</a></td>';
                            echo '<td>'.$item['count'].'</td>';
                            echo '<td>'.number_format($item['price'], 2, '.', '').'</td>';
                            echo '<td>'.number_format($total, 2, '.', '').'</td>';
                            echo '</tr>';
                            $total_qty += $item['count'];
                            $total_amount += ($total);
                        }
                    }
                    if(isset ($_SESSION['shipping']['status'])){
                        echo '<tr>';
                        echo '<td>*</td>';
                        echo '<td> Courier charges <a href="'.$this->baseURL.'cart/clearshipping">[Remove]</a></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td>'.number_format($this->courier_charges, 2, '.', '').'</td>';
                        echo '</tr>';
                         $total_amount += ($this->courier_charges);
                    }
                    $_SESSION['cart_total'] = $total_amount;
                    echo '<tr>
                            <td style="text-align:left;"> <a  style="color:red;" href="'.$this->baseURL.'cart/clear">Clear Cart</a></td>
                            <td></td>
                            <td>('.$total_qty.')</td>
                            <td>Total is </td>
                            <td>'.$this->currency.' '.number_format($total_amount, 2, '.', '').'</td>
                          </tr>';
                    ?>
                    
                </table>
                 
                 <a href="<?php echo $this->baseURL ?>"><input style="width: 100%;" type="button" value="Continue Shopping"/></a>
                 <div id="place_order_box">
                    <?php
                    if(empty($_SESSION["firstname"])){ 
                        //if user is not logged in
                         echo '<span>Please </span>
                               <a href="'.$this->baseURL.'login"><input type="button" value="Login"/></a>
                               <span> or </span>
                               <a href="'.$this->baseURL.'user/register"><input type="button" value="Register"/></a>
                               <span>first to place the order</span>';
                     }else{
                         //if user alrady logged in
                         if(isset($_SESSION['shipping']['status'])){
                            //if shipping info already selected
                             ?>
                     <form method="post" action="<?php echo $this->baseURL ?>cart/addshipping">
                         <h4>Shipping</h4>
                         <label for="store_pick">I will come and pick it up from  GMA Printers</label>
                         <input type="radio" id="store_pick" name="shiping" value="store_pick"  onchange="show_shipping_info(this.value)"><br>
                         <label for="courier" >Courier this to my address</label>
                         <input type="radio" id="courier" name="shiping" value="courier" checked="checked" onchange="show_shipping_info(this.value)"><br>
                         <div id="shipping_info" style="display: block;">
                             <?php
                                echo '<span>'.$_SESSION['shipping']['address'].'';
                                echo ' | '.$_SESSION['shipping']['contact'].'</span>';
                             ?>                             
                         </div>
                         <script type="text/javascript">
                             function show_shipping_info(state){
                                 console.log(state);
                                 if(state == "courier"){
                                     document.getElementById("shipping_info").style.display="block";
                                 }else{
                                     document.getElementById("shipping_info").style.display="none";
                                     window.location.href = "<?php echo $this->baseURL ?>cart/clearshipping";
                                     
                                 }
                                 
                             }
                         </script>
                     </form>   
                         <?php
                             
                         }else{
                            //if shipping not selected
                             //loading users address and contact data
                             load_model("user");
                             $user = new user_model();
                             $user_info = $user->get_info($_SESSION['umail']);
                             ?>
                     <form method="post" action="<?php echo $this->baseURL ?>cart/addshipping">
                         <h4>Shipping</h4>
                         <label for="store_pick">I will come and pick it up from  GMA Printers</label>
                         <input type="radio" id="store_pick" name="shiping" value="store_pick" checked="checked" value="courier" onchange="show_shipping_info(this.value)"><br>
                         <label for="courier" >Courier this to my address</label>
                         <input type="radio" id="courier" name="shiping" value="courier"  onchange="show_shipping_info(this.value)"><br>
                         <div id="shipping_info" style="display: none;">
                             <label for="address">Courier to this address</label>
                             <br>
                             <textarea id= "address" name="address" required><?php echo $user_info['address'] ?></textarea>
                             <br>
                             <label for="contact">Contact number</label>
                             <br>
                             <input type="tel" name="contact" id="contact" value="<?php echo $user_info['uphone'] ?>"  />
                             <br>                             
                             <input type="submit" value="Add Shipping" style="margin: 5px 20px;" required />
                             
                         </div>
                         <script type="text/javascript">
                             function show_shipping_info(state){
                                 console.log(state);
                                 if(state == "courier"){                                     
                                     document.getElementById("shipping_info").style.display="block";
                                 }else{
                                     document.getElementById("shipping_info").style.display="none";
                                 }
                                 
                             }
                         </script>
                     </form>   
                         <?php
                             
                         }               
                                                                           
                         echo '<a href="'.$this->baseURL.'cart/placeorder"><input style="width: 625px; margin-left:0px;" type="button" value="Place Order"/></a>';
                     }

                    ?>
                 </div>               
             </div>
            <!-- End Products -->
         <div class="cl"> </div>
      </div>
      <!-- End Main -->

