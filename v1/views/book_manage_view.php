<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * books management interface view
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
<!-- Main -->
        <script type="text/javascript">
            function add_book_dialog(){
                document.getElementById('add_book').style.display = "block";
                document.getElementById('add_book_button').style.display = "none";
                
            }
            function hide_add_book_dialog(){
                document.getElementById('add_book').style.display = "none";
                document.getElementById('add_book_button').style.display = "inline-block";
                
            }
            function search_book(s_term, action, page = 1) {
                if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                  if (this.readyState==4 && this.status==200) {
                    document.getElementById("search_results").innerHTML=this.responseText;                    
                  }
                }
                xmlhttp.open("POST","<?php echo $this->baseURL ?>manage/"+action+"/",true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("s_term="+s_term+"&pno="+page);
            }
        </script>
      <div id="main" class="shell manage-books" align="center"  >
           <h3 id="loginh3" align="center">Manage Book Store</h3> 
           <button id="add_book_button" onclick="add_book_dialog()">Add Book </button>
           <div id="add_book" style="display:none;">
               <form method="post" action="<?php echo $this->baseURL ?>manage/newbook" enctype="multipart/form-data">
                   <table>
                        <tr>
                            <td colspan="2" style="text-align: center; font-weight: bold;">Add Book</td>
                        </tr>
                        <tr>
                            <td><label for="book_code">Book Id:</label></td>
                            <td><input type="text" id="book_name" name="book_code" /></td>
                        </tr>
                        <tr>
                            <td><label for="book_name">Book Name:</label></td>
                            <td><input type="text" id="book_name" name="book_name" /></td>
                        </tr>
                        <tr>
                            <td><label for="author">Author:</label></td>
                            <td><input type="text" id="author" name="author" /></td>
                        </tr>
                        <tr>
                            <td><label for="book_desc">Description:</label></td>
                            <td><textarea id="book_desc" name="book_desc" rows="4" ></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="price">Price:</label></td>
                            <td><input type="number" min="1" step="any"  id="price" name="price" /></td>
                        </tr>
						<tr>
                            <td><label for="price">Qty:</label></td>
                            <td><input type="text" min="1" step="any"  id="qty" name="qty" /></td>
                        </tr>
                        <tr>
                            <td><label for="image">Image:</label></td>
                            <td><input type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" /></td>
                        </tr>
                        <tr>
                            <td><input type="button" onclick="hide_add_book_dialog()" style="width: 100px; padding: 5px; margin-bottom: 5px; margin-left: 30px;" id="cancel"  value="Cancel" /></td>
                            <td><input type="submit" style="padding:5px; margin-bottom: 5px" id="submit" name="submit"  value="Add Book" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>

                    </table>
               </form>
           </div>
           <div id="book_search">
               <label for=""><b>Search</b></label>
               <input type="text" onchange="search_book(this.value,'bookbyid')" onkeyup="search_book(this.value,'bookbyid')" placeholder="By Book Id"/>
               <input type="text" onchange="search_book(this.value,'bookbyname')" onkeyup="search_book(this.value,'bookbyname')" placeholder="By Book Name"/>
               <input type="text" onchange="search_book(this.value,'bookbyauthor')" onkeyup="search_book(this.value,'bookbyauthor')" placeholder="By Author"/>
               
           </div>
           <div id="search_results">
               <script type="text/javascript">
                   //running default search once at the start
                   search_book("",'bookbyid');
               </script>
           </div>
           
          
      </div>
      <!-- End Main -->