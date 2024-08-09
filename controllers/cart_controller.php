<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Shopping cart controller
 */
//displaying shopping cart
if($action == "index"){
   $data['title'] = "Shopping Cart | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('cart',$data);
   $page->end();  
   die();
      
}
//displaying order infomation
if($action == "order"){
    $input = new input();
    $order_id = $input->get_data();
    if(!$order_id){
        redirect('home'); 
    }
   $data['title'] = "Order No. ".$order_id." | GMA Printers";
   //loading order infomation
   load_model("order");
   $order = new order_model();
   $data['order_info'] = $order->get_info($order_id);
   //validating permission to see the order
   //(only the owner account of the order and staff type users can see)
   if(!($data['order_info']['user_id'] == $_SESSION['userid'] || $_SESSION['type'] == "staff")){
       redirect('home'); 
   }
   //loading order item list
   $data['order_items'] = $order->get_order_items($order_id);
   $page = new page();
   $page->begin($data);
   $page->view('order',$data);
   $page->end();  
   die();
      
}

//adding books to cart request
if($action == "addbook"){
    $input = new input();
    $code = $input->get_data();
    if(!$code){
        redirect('home'); 
    }
    //loading book info from db
    load_model("book");
    $book = new book_model();
    $item_data = $book->get_info($code);
    //get and set number of items to add
    $count = $input->post('item_count', 'number');
    $count = (is_null($count)) ? 1 : $count;
    $item_data['count'] = $count;    
    //set item type as book
    $item_data['type'] = " book";
    //INSERTING  book code to cart session array
    if(isset($_SESSION["cart"]) && !is_null($_SESSION["cart"]) ){
        //add to session - cart array
        //searching for already submitted same book code 
        $book_found = FALSE;
        foreach ($_SESSION["cart"] as $key => $value) {
            if($value['book_code'] == $code){
                //if that book already found add this count to thatv count
                $_SESSION["cart"][$key]['count'] = $_SESSION["cart"][$key]['count']+$count;
                $book_found = TRUE;
                break; 
            }            
        }
        if(!$book_found){
            //if not add the record to session
            array_push($_SESSION["cart"], $item_data);
        }
        
    }else{
        //if cart not set create and add to cart
        $_SESSION["cart"][0] = $item_data;        
    }
    //add everything to get total cart value
    $cart_total = 0;
    foreach ($_SESSION["cart"] as $key => $item) {
        $cart_total = $cart_total + ($item['price']*$item['count']);
    }
    
    $_SESSION['cart_total'] = $cart_total;
    redirect('cart');
    //echo '<pre>' . var_export($_SESSION, true) . '</pre>';
}


if($action == "remove"){
    $input = new input();
    $key = $input->get_data();
    unset($_SESSION['cart'][$key]);
    $cart_total = 0;
    foreach ($_SESSION["cart"] as $key => $item) {
        $cart_total = $cart_total + ($item['price']*$item['count']);
    }
    $_SESSION['cart_total'] = $cart_total;
    redirect('cart'); 
}
if($action == "placeorder"){
   $data['title'] = "Order | GMA Printers";
   $new_order['user_id'] = $_SESSION['userid'];
   $new_order['courier'] = $_SESSION['shipping']['status'];
   $new_order['courier_address'] = $_SESSION['shipping']['address'];
   $new_order['courier_contact'] = $_SESSION['shipping']['contact'];
   $new_order['total_amount'] = $_SESSION['cart_total'];
   $new_order['paid_amount'] = 0;
   $new_order['status'] = "new";
   //checking number of items in the order
   if(is_null($_SESSION['cart'])){
     redirect('cart');   
   }
   //storing order in the DB
   load_model("order");
   $order = new order_model();
   $new_order['order_id'] = $order->add_new($new_order); 
   //clearing shopping cart
   $_SESSION['cart'] = NULL;
   $_SESSION['shipping'] = NULL;
   $_SESSION['cart_total'] = 0.00;
   //redirectiong to displaying order
   redirect('cart/order/'. $new_order['order_id']);  
   die();
}
if($action == "addshipping"){
    $input = new input();
    $_SESSION['shipping']['status'] = TRUE;
    $_SESSION['shipping']['address']  = $input->post('address', 'address');
    $_SESSION['shipping']['contact']  = $input->post('contact', 'string');
    //echo '<pre>' . var_export($_SESSION, true) . '</pre>';
    redirect('cart');
}
if($action == "clearshipping"){
    $_SESSION['shipping'] = NULL;
    redirect('cart');
}
if($action == "clear"){
    $_SESSION['cart'] = NULL;
    $_SESSION['shipping'] = NULL;
    $_SESSION['cart_total'] = 0.00;
    redirect('home'); 
}
//dummy payment gateway action
if($action == "payment"){
    $input = new input();
    $paymet_info['order_id'] = $input->get_data();
    $paymet_info['amount'] = $input->post('amount', 'number');
    //updating payment to database
    load_model("order");
    $order = new order_model();
    $order->payment($paymet_info);
    //redirect('cart/order/'.$paymet_info['order_id']);
    //dummy payment gateway animation
    ?>

<img src="<?php echo $baseURL; ?>/media/payment.gif" style="margin: auto; width: 50%; display: block;" />
<script type="text/javascript">
    setTimeout(function(){window.location.replace("<?php echo $baseURL."cart/order/".$paymet_info['order_id']; ?>")}, 1000);
    
</script>

    <?php
    die();    
}
//add printing service request to the cart
if($action == "addservice"){
    //echo '<pre>' . var_export($_FILES, true) . '</pre>';
    //loading requested order infomation
    $input = new input();
    $item_data['book_code']= uniqid();
    $item_data['count'] = $input->post('selection', 'service-qty');
    $item_data['price'] = $input->post('selection', 'service-price')/$item_data['count'];
    $item_data['book_name'] = $input->post('description', 'paragraph')."-".$input->post('selection', 'service-option');
    $item_data['type'] = "service";
    //storing in session 
    if(isset($_SESSION["cart"]) && !is_null($_SESSION["cart"]) ){
        //add to session - cart array
        array_push($_SESSION["cart"], $item_data);
        
    }else{
        //if cart not set create and add to cart
        $_SESSION["cart"][0] = $item_data;        
    }
    //storing order option data
    if(isset($_POST['option1'])){
        $input = new input();
        $option_data['book_code']= $item_data['book_code'];
        //get pricing method 
        //* =  one price for all
        //# =  price per 1
        if($input->post('option1', 'service-qty') == "*"){
            //one price addition for all
            $option_data['count'] = '1';
        }else{
            //price addition for each 
            $option_data['count'] =  $item_data['count'];
        }
        $option_data['price'] = $input->post('option1', 'service-price');
        $option_data['book_name'] = " > ".$input->post('option1', 'service-option');
        $option_data['type'] = "service-opt";
        array_push($_SESSION["cart"], $option_data);
    }
    if(isset($_POST['option2'])){
        $input = new input();
        $option_data['book_code']= $item_data['book_code'];
        //get pricing method 
        //* =  one price for all
        //# =  price per 1
        if($input->post('option2', 'service-qty') == "*"){
            //one price addition for all
            $option_data['count'] = '1';
        }else{
            //price addition for each 
            $option_data['count'] =  $item_data['count'];
        }
        $option_data['price'] = $input->post('option2', 'service-price');
        $option_data['book_name'] = " > ".$input->post('option2', 'service-option');
        $option_data['type'] = "service-opt";
        array_push($_SESSION["cart"], $option_data);
    }
    if(isset($_POST['option3'])){
        $input = new input();
        $option_data['book_code']= $item_data['book_code'];
        //get pricing method 
        //* =  one price for all
        //# =  price per 1
        if($input->post('option3', 'service-qty') == "*"){
            //one price addition for all
            $option_data['count'] = '1';
        }else{
            //price addition for each 
            $option_data['count'] =  $item_data['count'];
        }
        $option_data['price'] = $input->post('option3', 'service-price');
        $option_data['book_name'] = " > ".$input->post('option3', 'service-option');
        $option_data['type'] = "service-opt";
        array_push($_SESSION["cart"], $option_data);
    }
    $cart_total = 0;
    foreach ($_SESSION["cart"] as $key => $item) {
        $cart_total = $cart_total + ($item['price']*$item['count']);
    }    
    $_SESSION['cart_total'] = $cart_total;
    //storing design files and instructions
    $instructions = $input->post('instructions', 'paragraph');
    if(isset($_FILES['artwork'])){
        $uploader = new uploader();
        $file_name = $uploader->artwork_upload('artwork', 'media/artwork/',$item_data['book_code']);             
    }
    load_model("order");
    $order = new order_model();
    $order->print_instructions($item_data['book_code'], $instructions, $file_name);
    redirect('cart');
    //echo '<pre>' . var_export($_SESSION, true) . '</pre>';
    
    
    
}
