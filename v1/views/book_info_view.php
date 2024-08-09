<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * book management interface view
 */


//displaying error msg box if available
if(@$_SESSION['error']){
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['error']; ?>");
        
    </script>
<?php
    unset($_SESSION['error']);
}
?>
    <script type="text/javascript">
        function delete_book(book_code){
            if(confirm("are you sure you want to delete this book?")){
                window.location.href = "<?php echo $this->baseURL ?>manage/delbook/"+book_code ;
            }
        }
    </script>
<!-- Main -->
      <div id="main" class="shell manage-books" align="center"  >
           <div id="book_info" >
               <form method="post" action="<?php echo $this->baseURL."manage/updatebook/".$data['book_info']['book_code'] ?>" enctype="multipart/form-data">
                   <table>
                        <tr>
                            <td rowspan="10" style="text-align: center;">
                                <?php
                                    //search profile picture file
                                    $pic = glob('media/books/'.$data['book_info']['book_code'].'.*');
                                    if(@file_exists($pic[0])){
                                        $pic_url =$pic[0]."?ref=".rand();
                                    }else{
                                        $pic_url ='media/books/blank.png';
                                    }
                                    
                                ?>
                                <img src="<?php echo $this->baseURL.$pic_url ?>" >

                            </td>
                            <td colspan="2" style="text-align: center; font-weight: bold;"><?php echo $data['book_info']['book_name'] ?></td>
                        </tr>
                        <tr>
                            <td><label for="book_code">Book Id:</label></td>
                            <td><input type="text" id="book_name" name="book_code" disabled="" value="<?php echo $data['book_info']['book_code'] ?>" /></td>
                        </tr>
                        <tr>
                            <td><label for="book_name">Book Name:</label></td>
                            <td><input type="text" id="book_name" name="book_name" value="<?php echo $data['book_info']['book_name'] ?>" /></td>
                        </tr>
                        <tr>
                            <td><label for="author">Author:</label></td>
                            <td><input type="text" id="author" name="author" value="<?php echo $data['book_info']['author'] ?>" /></td>
                        </tr>
                        <tr>
                            <td><label for="book_desc">Description:</label></td>
                            <td><textarea id="book_desc" name="book_desc" rows="4" ><?php echo $data['book_info']['book_desc'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="price">Price:</label></td>
                            <td><input type="number" min="1" step="any"  id="price" name="price" value="<?php echo $data['book_info']['price'] ?>" /></td>
                        </tr>
                        <tr>
                            <td><label for="image">New image:</label></td>
                            <td><input type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" /></td>
                        </tr>
						<tr>
                            <td><label for="book_code">Qty:</label></td>
                            <td><input type="text" id="qty" name="qty" disabled="" value="<?php echo $data['book_info']['qty'] ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" style="padding:5px; margin-bottom: 5px" id="submit" name="submit"  value="Update" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="button" style="padding:5px; margin-bottom: 5px;     background-color: #ff7254;" id="del" name="del"  value="Delete Book" onclick="delete_book('<?php echo $data['book_info']['book_code'] ?>')" /></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center; ">
                                <a href="<?php echo $this->baseURL; ?>manage/books/">
                                    <input type="button" style="float: none; width: 90%" value="Go Back to Book Manager">
                                </a>
                            </td>
                        </tr>
                    </table>
               </form>
           </div>          
      </div>
      <!-- End Main -->