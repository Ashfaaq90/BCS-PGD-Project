<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Book page view - public
 */
?>
      <!-- Main -->
      <div id="main" class="shell">
         <!-- Sidebar -->
         <div id="sidebar">
            <ul class="categories">
                <li>
                   <?php
                   $this->view('Authors_widget',$data);
                   ?>
               </li>  			   
            </ul>
         </div>
         <!-- End Sidebar -->
         <!-- Content -->
         <div id="content">
            <!-- Products -->
            <div class="products"></div>
            <div class="book" >
               <h3><?php echo $data['book_info']['book_name'] ?></h3>
               <image src="<?php echo $this->baseURL."media/books/".$data['book_info']['img_name'] ?>" />
               <div id="book_details" >
                   <p><?php echo $data['book_info']['book_desc'] ?> </p>
                   <a id="author" >By <?php echo $data['book_info']['author'] ?></a>
                   <p>Price : <?php echo $this->currency." ".$data['book_info']['price'] ?></p>
                   <form action="<?php echo $this->baseURL."cart/addbook/".$data['book_info']['book_code'] ?>" method ="post" >
                       <input type="submit" value="Add" style="width: 50px;"/>
                       <input type="number" step="1" name="item_count" style="width: 50px;" id="item_count" value="1" onkeyup="change_label(this.value)" />
                       <label id="count_label" for="item_count"  > book to the cart.</label>
                       <script>
                           function change_label(val){
                                if(val>1){
                                    document.getElementById('count_label').innerHTML = " books to the cart.";
                                }else{
                                    document.getElementById('count_label').innerHTML = " book to the cart.";
                                }
                            }
                       </script>
                   </form>
                   <form action="<?php echo $this->baseURL."cart/addbook/".$data['book_info']['book_code'] ?>" method ="post" >
                       <input id="buy_now_button" type="submit" value="Buy Now"/>
                   </form>
               </div>
            </div>
            <div >
                <a href="<?php echo $this->baseURL ?>bookstore" style="font-size: 20px;">
                  <<  Go back to Bookstore</a>
            </div>
            
            <!-- End Products -->
         </div>
         <!-- End Content -->
         <div class="cl"> </div>
      </div>
      <!-- End Main -->

