<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * management interface view
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
      <div id="main" class="shell manage-list" align="center"  >
          <a href="<?php echo $this->baseURL ?>manage/books"><button>Manage Bookstore</button></a>          
          <a href="<?php echo $this->baseURL ?>manage/orders"><button>Manage Orders</button></a>          
          <a href="<?php echo $this->baseURL ?>manage/quotation"><button>Manage Quotation</button></a>      
		  <a href="<?php echo $this->baseURL ?>manage/quotation"><button>Operational Reports</button></a>		  
          <br>
		  <br>
		  <br>
		  <br>
		  <br>
          
      </div>
      <!-- End Main -->