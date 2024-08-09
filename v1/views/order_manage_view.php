<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * order management interfaces
 */
?>
<script type="text/javascript">
            function search_order(s_term, action, page = 1) {
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
            function mark_this_as(value, order_id) {
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
                xmlhttp.open("POST","<?php echo $this->baseURL ?>manage/setorderstatus/",true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("s_term="+order_id+"&status="+value);
            }
            function delete_order(order_id){
                //if (confirm("Do you really want to delete this order?")) {
                //    window.location.href ="<?php echo $this->baseURL ?>manage/deleteorder/"+order_id;
                //}
                window.location.href ="<?php echo $this->baseURL ?>manage/deleteorder/"+order_id;
            }
            search_order('', 'getordersbyid')
</script>
<div id="main" class="shell manage-books" align="center"  >
    <h3>Manage Orders</h3>
    <br>
    <input type="text" placeholder="Search by id" onkeyup="search_order(this.value, 'getordersbyid')" />    
    <select onchange="search_order(this.value, 'getorderbystatus')" >
                        <option value="" disabled selected>Search by status</option>
                        <option value="new">New</option>
                        <option value="processing">Processing</option>
                        <option value="printing" >Printing</option>
                        <option value="shipped" >Shipped</option>
                        <option value="rejected" >Rejected</option>
    </select>
    <input type="button" value="Reset" onclick="search_order('', 'getordersbyid')" />
    <br>
    <br>
    <div id="search_results">
        
    </div>
</div>
