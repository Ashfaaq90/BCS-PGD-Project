<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Book database model
 */
class book_model extends dbModel{
    public function add_new($new_book) {
        //checking book code availability
        $res = mysqli_query($this->con,"SELECT * FROM `books` WHERE `book_code` = '".$new_book['book_code']."'");
        if(mysqli_num_rows($res) != 0){
            $this->error = "Book Code already in use";
            return FALSE;
        }
        $res = mysqli_query($this->con,"INSERT INTO `books` ( `book_code`, `book_name`, `book_desc`,  `price`, `author`,`qty`) "
                . "                                 VALUES ( '".$new_book['book_code']."', '".$new_book['book_name']."', '".$new_book['book_desc']."', '".$new_book['price']."', '".$new_book['author']."', '".$new_book['qty']."');");
    
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not add the book";
            return FALSE;
        }
        
    } 
    public function update($book_info) {
        //checking book code availability
        $res = mysqli_query($this->con,"SELECT * FROM `books` WHERE `book_code` = '".$book_info['book_code']."'");
        if(mysqli_num_rows($res) != 1){
            $this->error = "Book Not Found";
            return FALSE;
        }
        $res = mysqli_query($this->con,"UPDATE `books` SET  `book_name` = '".$book_info['book_name']."', `author` = '".$book_info['author']."', `book_desc` = '".$book_info['book_desc']."',`price` = '".$book_info['price']."', `qty` = '".$book_info['qty']."' WHERE `books`.`book_code` = '".$book_info['book_code']."';");
    
        if($res){
            return TRUE;
        } else {
            $this->error = "Could not add the book";
            return FALSE;
        }
        
    } 
    public function get_info($code) {
        $res = mysqli_query($this->con,"SELECT * FROM `books` WHERE `book_code` = '".$code."'");
        if(mysqli_num_rows($res) != 1){
            $this->error = "Book not found";
            return FALSE;
        }else{
            $res = mysqli_fetch_array($res);
            return $res;
        }
    }
    public function delete($code) {
        $res = mysqli_query($this->con,"DELETE FROM `books` WHERE `books`.`book_code` = '".$code."'");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function search($data, $field, $start = 0, $end = 10) {
        $res = mysqli_query($this->con,"SELECT * FROM `books` WHERE `".$field."` LIKE '%".$data."%' LIMIT ".$start.", ".$end."");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }else{
            $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $res;
            
        }
    }
    
    public function set_image($book_code) {
        //finding the image file name for the given book
        $pic = glob('media/books/'.$book_code.'.*');
        if(@file_exists($pic[0])){
            $fname = pathinfo($pic[0]);
            $fname = $fname['basename'];
        }else{
            $fname ='blank.png';
        }
        $res = mysqli_query($this->con,"UPDATE `books` SET `img_name` = '".$fname."' WHERE `books`.`book_code` = '".$book_code."';");
        if(!$res){
            $this->error = "Could not set image file name";
            return FALSE;
        }else{
            return TRUE;
            
        }
    }
    
    public function get_author_list() {
        $res = mysqli_query($this->con,"SELECT DISTINCT `author`  FROM `books`");
        if(!$res){
            $this->error = "Could not delete";
            return FALSE;
        }else{
            $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
        return $res;
        
        }
    }
    
} 