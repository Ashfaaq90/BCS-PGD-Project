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
                   $this->view('book_search_widget',$data);
                   ?> 
               </li>
               <li>
                  <?php
                   $this->view('author_widget',$data);
                   ?>
               </li>
                <li>
                   <?php
                   $this->view('printstore_widget',$data);
                   ?>
               </li>               
            </ul>
         </div>
         <!-- End Sidebar -->
         <!-- Content -->
         <div id="content">
            <!-- Products -->
            <div class="products" id="book_list">
               <h3>Search Books</h3>
               <ul>
                
               </ul>
            </div>
            <script type="text/javascript">
            function search_book(s_term, action, page = 1) {
                //Debug out
                console.log(action);
                if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                  if (this.readyState==4 && this.status==200) {
                    document.getElementById("book_list").innerHTML=this.responseText;                    
                  }
                }
                xmlhttp.open("POST","<?php echo $this->baseURL ?>bookstore/"+action+"/",true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("s_term="+s_term+"&pno="+page);
            }
            //calling search once to display latest books
            search_book("",'searchbycode')
            </script>
            <!-- End Products -->
         </div>
         <!-- End Content -->
         <div class="cl">&nbsp;</div>
      </div>
      <!-- End Main -->
