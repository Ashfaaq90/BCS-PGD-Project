<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Site header
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
   <head>
       <title><?php echo $data['title'];?></title>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" href="<?php echo $this->baseURL;?>css/style.css" type="text/css" media="all" />
      <script type="text/javascript" src="<?php echo $this->baseURL;?>js/jquery-1.6.2.min.js"></script>
      <script type="text/javascript" src="<?php echo $this->baseURL;?>js/jquery.jcarousel.min.js"></script>
      <script type="text/javascript" src="<?php echo $this->baseURL;?>js/functions.js"></script>
   </head>
   <body>
      <!-- Header -->
      <div id="header" class="shell">
          <div id="logo"><a href="<?php echo $this->baseURL ?>"><img src="<?php echo $this->baseURL;?>css/images/logo.png" height="50" width="auto"/></a></div>
         <!-- Navigation -->
        <div id='cssmenu'>
            <ul>
               <li><a href='<?php echo $this->baseURL;?>'><span>Home</span></a></li>
               <li class='active has-sub'><a style="padding: 12px 20px;" href='#'><span>Services</span></a>
                  <ul>
                     <li class='has-sub'><a href='<?php echo $this->baseURL;?>printstore'><span>Printstore</span></a></li>
                     <li class='has-sub'><a href='<?php echo $this->baseURL;?>bookstore'><span>Bookstore</span></a></li>
                  </ul>
               </li>
               
               <?php
               if(isset($_SESSION['umail'])){
                   echo "<li><a href='".$this->baseURL."user/profile'><span>Profile</span></a></li>";
               }else{
                   echo "<li><a href='".$this->baseURL."user/register'><span>Register</span></a></li>";
               }
               ?>
               <li class='last'><a href='<?php echo $this->baseURL;?>page/about'><span>About Us</span></a></li>
               <?php 
               if(isset($_SESSION['type'])){
               	if($_SESSION['type']=="staff"){
               		echo "<li class='last'><a href='".$this->baseURL."manage'><span>Manage</span></a></li>";
               	}
               }
                 ?>
				  <?php 
               if(isset($_SESSION['type'])){
               	if($_SESSION['type']!="staff"){
               		echo "<li class='last'><a href='".$this->baseURL."quotation'><span>Quotation</span></a></li>";
               	}
               }
                 ?>
            </ul>
         </div>
         <!-- End Navigation -->
         <div class="cl">&nbsp;</div>
         <!-- Login-details -->
         <div id="login-details">
            <p style="font-size:14px">Welcome, 
               <?php 
                  if(empty($_SESSION["firstname"])){ 
                      echo "Guest  ".'<a href="'.$this->baseURL.'login">(Login)</a>.';
                  }else{
                    echo '<a href="'.$this->baseURL.'user/profile">'.$_SESSION['firstname'].'</a> ';
                    echo '<a href="'.$this->baseURL.'user/logout">(Logout)</a>.';
                  }
                  ?>
            </p>
            <p>
                <a href="<?php echo $this->baseURL ?>cart" class="cart" >
                    <img src="<?php echo $this->baseURL;?>css/images/cart-icon.png" alt="" />
                </a>
                Shopping Cart  
                <a href="<?php echo $this->baseURL ?>cart" class="sum">
                    <?php echo $this->currency.(isset($_SESSION['cart_total']) ? number_format($_SESSION['cart_total'], 2, '.', '') : '0.00'); ?>
                </a>
            </p>
         </div>
         <!-- End Login-details -->
      </div>
      <!-- End Header -->