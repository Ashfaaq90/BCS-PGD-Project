<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 */

class order_model extends dbModel{
    
    public function add_new($order_info) {
        //add order info to order table
        $res = mysqli_query($this->con,"INSERT INTO `orders` (`user_id`, `courier`, `courier_address`, `courier_contact`, `total_amount`, `paid_amount`, `status`, `timestamp`) 
                                        VALUES ('".$order_info['user_id']."', '".$order_info['courier']."','".$order_info['courier_address']."', '".$order_info['courier_contact']."', '".$order_info['total_amount']."', '".$order_info['paid_amount']."', '".$order_info['status']."', CURRENT_TIMESTAMP);");
        if(!$res){
            $this->error = "could not add";
            return FALSE;
        }else{
            $order_id = mysqli_insert_id($this->con);
            //add order items to order_items table
            foreach ($_SESSION['cart'] as $key => $item) {
                 $total = $item['price']*$item['count'];
                 $res = mysqli_query($this->con,"INSERT INTO `order_items` (`order_id`, `item_type`, `item_code`, `description`, `qty`, `price`, `total`) 
                                                                    VALUES ( '".$order_id."', '".$item['type']."', '".$item['book_code']."','".$item['book_name']."', '".$item['count']."', '".$item['price']."', '".number_format($total, 2, '.', '')."');");
 
            }
            return $order_id;           
        }
    }
    public function get_info($order_id) {
        $res = mysqli_query($this->con,"SELECT * FROM `orders` WHERE `order_id` = '".$order_id."'");
        if(!$res){
            $this->error = "could not get";
            return FALSE;
        }else{
            $res = mysqli_fetch_array($res);
            return $res;
        }
    }
    
    public function get_order_items($order_id) {
        $res = mysqli_query($this->con,"SELECT * FROM `order_items` WHERE `order_id` = '".$order_id."'");
        if(!$res){
            $this->error = "could not get";
            return FALSE;
        }else{
            $res = mysqli_fetch_all ($res, MYSQLI_ASSOC);
            return $res;
        }
    }
    
    public function payment($paymet_info) {
        $res = mysqli_query($this->con,"UPDATE `orders` SET `paid_amount`= `paid_amount`+".$paymet_info['amount']." WHERE `order_id` = ".$paymet_info['order_id']."");
        if(!$res){
            $this->error = "could not set";
            return FALSE;
        }else{
            return $res;
        }
    }
    
    public function print_instructions($code, $instructions, $filename = null) {
        $res = mysqli_query($this->con,"INSERT INTO `print_instructions` ( `code`, `instruction`, `filename`) 
                                                                    VALUES ('".$code."', '".$instructions."', '".$filename."');");
        if(!$res){
            $this->error = "could not set";
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function get_order_list($user_id) {
        $res = mysqli_query($this->con,"SELECT * FROM `orders` WHERE `user_id` = ".$user_id);
        if(!$res){
            $this->error = "could not get";
            return FALSE;
        }else{
            $res = mysqli_fetch_all ($res, MYSQLI_ASSOC);
            return $res;
        }
    }
    public function get_instructions($code) {
        $qu = "SELECT * FROM `print_instructions` WHERE `code` = '".$code."';";
        $res = mysqli_query($this->con,$qu);
        if(!$res){
            $this->error = "could not get";
            return FALSE;
        }else{
            $res = mysqli_fetch_all ($res, MYSQLI_ASSOC);
            return $res;
        }
    }
    
    public function search($data, $field, $start = 0, $end = 10) {
        $res = mysqli_query($this->con,"SELECT * FROM `orders` WHERE `".$field."` LIKE '%".$data."%' LIMIT ".$start.", ".$end."");
        if(!$res){
            $this->error = "Could not find";
            return FALSE;
        }else{
            $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $res;
            
        }
    }
    public function change_status($state, $order_id) {
        $res = mysqli_query($this->con,"UPDATE `orders` SET `status` = '".$state."' WHERE `orders`.`order_id` = '".$order_id."';");
        if(!$res){
            $this->error = "Could not update";
            return FALSE;
        }else{
            return TRUE;
            
        }
    }
    public function delete($order_id) {
        $res = mysqli_query($this->con,"DELETE FROM `orders` WHERE `orders`.`order_id` = '".$order_id."'");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }
        
        $res = mysqli_query($this->con,"DELETE FROM `order_items` WHERE `order_items`.`order_id`= '".$order_id."'");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }else{
            return TRUE;
            
        }
    }
    
} 