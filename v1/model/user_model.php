<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * User database model
 */
class user_model extends dbModel{
    
    public function authenticate($umail, $upass) {
        $res = mysqli_query($this->con,"SELECT * FROM `user` WHERE `usermail` = '".$umail."'");
        //checking email address
        if(mysqli_num_rows($res) != 1){
            $this->error = "e-mail not found";
            return FALSE;
        }
        //comparing password
        $res = mysqli_fetch_array($res);
        if($res['password'] != md5($upass)){
            $this->error = "Invalid password";
            return FALSE;           
        }else{
            return TRUE;
        }
    }
    public function get_info($umail) {
        $res = mysqli_query($this->con,"SELECT * FROM `user` WHERE `usermail` = '".$umail."'");
        $res = mysqli_fetch_array($res);
        return $res;
    }
    public function get_info_by_id($userid) {
        $res = mysqli_query($this->con,"SELECT * FROM `user` WHERE `userid` = '".$userid."'");
        $res = mysqli_fetch_array($res);
        return $res;
    }
    
    public function add_new($data) {
        //checking for availability
        if($this->get_info($data['usermail'])){
           //email already registerd
           $this->error = "This email is already registered";
           return FALSE;            
        }
        $res = mysqli_query($this->con,"INSERT INTO `user` (`userid`, `usermail`, `password`, `firstname`, `lastname`, `uphone`, `address`, `type`) "
                .                                   "VALUES (NULL, '".$data['usermail']."', '".$data['password']."', '".$data['firstname']."', '".$data['lastname']."', '".$data['uphone']."', '".$data['address']."', 'customer');");
    
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not be added to the database";
            return FALSE;
        }
    }
    
    public function update_info($data) {
        
        $res = mysqli_query($this->con,"UPDATE `user` SET `firstname` = '".$data['firstname']."', `lastname` = '".$data['lastname']."', `uphone` = '".$data['uphone']."', `address` = '".$data['address']."' WHERE `user`.`userid` = ".$_SESSION['userid'].";");
           
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not be added to the database";
            return FALSE;
        }
    }
    
    public function delete($uid) {
        
        $res = mysqli_query($this->con,"DELETE FROM `user` WHERE `user`.`userid` = ".$uid);
           
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not Delete";
            return FALSE;
        }
    }
    
    public function pass_update($uid, $new_pass) {
        
        $res = mysqli_query($this->con,"UPDATE `user` SET `password` = '".$new_pass."' WHERE `user`.`userid` = ".$uid.";");
            
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not Update";
            return FALSE;
        }
    }
    
} 