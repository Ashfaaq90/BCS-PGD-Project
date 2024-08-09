<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Home page view
 */
?>

      <!-- Main -->
      <div id="main" class="shell">
         <!-- Sidebar -->
         <div id="sidebar">
            <ul class="categories">
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
             <h3>Welcome to the Printstore </h3>
             <p>Welcome to our online print ordering page. can you browse through our printing packages listed below and order online. If you don't see what you are looking for in the list bellow please fill out and submit our quotation form with your requirements</p>
             <br>
             <h4>Select your printing need from the list below.</h4>
             <ul class="printstore">
                 <li><a href="<?php echo $this->baseURL ?>printstore/service/businesscards">Business Cards</a></li>
                 <li><a href="<?php echo $this->baseURL ?>printstore/service/leaflets">Leaflets</a></li>
                 <li><a href="<?php echo $this->baseURL ?>printstore/service/bookletflt">Folded Leaflets</a></li>
                 <li>
                     Booklets
                     <ul>
                         <li><a href="<?php echo $this->baseURL ?>printstore/service/bookleta4">Booklets - A4</a></li>
                         <li><a href="<?php echo $this->baseURL ?>printstore/service/bookleta5">Booklets - Mini</a></li>
                         <li><a href="<?php echo $this->baseURL ?>printstore/service/bookletdl">Booklets - DL</a></li>                         
                     </ul>
                 </li>
             </ul>
         </div>
         <!-- End Content -->
         <div class="cl">&nbsp;</div>
      </div>
      <!-- End Main -->
