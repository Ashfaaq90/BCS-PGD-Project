<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * order management interfaces
 */
?>
<script type="text/javascript">
            function search_quot(s_term, action, page = 1) {
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
            function mark_this_as(value, id) {
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
                xmlhttp.open("POST","<?php echo $this->baseURL ?>manage/setquotstatus/",true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("s_term="+id+"&status="+value);
            }
            function delete_quot(quot_id){
                //if (confirm("Do you really want to delete this order?")) {
                //    window.location.href ="<?php echo $this->baseURL ?>manage/deleteorder/"+order_id;
                //}
                window.location.href ="<?php echo $this->baseURL ?>manage/deletequot/"+quot_id;
            }
            search_quot('', 'getquotbyid')
</script>
<div id="main" class="shell manage-list" align="center"  >
    <h3>Manage Quotations</h3>
    <br>
    <input type="text" placeholder="Search by id" onkeyup="search_quot(this.value, 'getquotbyid')" />    
    <select onchange="search_quot(this.value, 'getquotbystatus')" >
                        <option value="" disabled selected>Search by status</option>
                        <option value="new">New</option>
                        <option value="pending">Pending</option>
                        <option value="replied" >Replied</option>
    </select>
    <input type="button" value="Reset" onclick="search_quot('', 'getquotbyid')" />
    <br>
    <br>
    <div id="search_results">
        
    </div>
</div>
