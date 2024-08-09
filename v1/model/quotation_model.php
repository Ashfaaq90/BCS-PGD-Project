<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * quotation model
 */

class quotation_model extends dbModel{
    
    public function add_new($quotation) {
        //add order info to order table
        $res = mysqli_query($this->con,"INSERT INTO `quotation` ( `fullname`, `email`, `contactNo`, `jobname`, `referenceno`, `qty`, `col_spec`, `finishing`, `finish_size`, `papertype`, `specifications`, `filename`) 
            VALUES ('".$quotation['fullname']."', '".$quotation['email']."', '".$quotation['contactNo']."', '".$quotation['jobname']."', '".$quotation['referenceno']."', '".$quotation['qty']."', '".$quotation['col_spec']."', '".$quotation['finishing']."', '".$quotation['finish_size']."', '".$quotation['papertype']."', '".$quotation['specifications']."', '".$quotation['filename']."');");
        if(!$res){
            $this->error = "could not add";
            return FALSE;
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
    public function search($data, $field, $start = 0, $end = 10) {
        $res = mysqli_query($this->con,"SELECT * FROM `quotation` WHERE `".$field."` LIKE '%".$data."%' LIMIT ".$start.", ".$end."");
        if(!$res){
            $this->error = "Could not find";
            return FALSE;
        }else{
            $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $res;
            
        }
    }
    public function change_status($state, $id) {
        $res = mysqli_query($this->con,"UPDATE `quotation` SET `status` = '".$state."' WHERE `quotation`.`qt_id` = '".$id."';");
        if(!$res){
            $this->error = "Could not update";
            return FALSE;
        }else{
            return TRUE;
            
        }
    }
    public function delete($qt_id) {
        $res = mysqli_query($this->con,"DELETE FROM `quotation` WHERE `quotation`.`qt_id` = '".$qt_id."'");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }
        return TRUE;
        
    }
} 