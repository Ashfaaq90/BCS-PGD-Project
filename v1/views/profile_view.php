<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * user registration
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
      <div id="main" class="shell" align="center"  >
         <div id="profile">
            <h3 id="loginh3" align="center">Your Profile</h3> 
            <div style="width:100%; min-height: 50px; margin-top: 20px;">
                <div style="width: 40%; display: inline-block">
             
                    <?php
                        //search profile picture file
                        $pic = glob('media/users/'.$data['udata']['userid'].'.*');
                        if(@file_exists($pic[0])){
                            $pic_url =$pic[0]."?ref=".rand();
                        }else{
                            $pic_url ='media/users/blank.jpg';
                        }
                        //find full file name with extention from name
                
                    
                    ?>
                    <img style="height: 150px; border: solid #15155a; " src="<?php echo $this->baseURL.$pic_url ?>" >
                    <form method="post" style="margin: 10px;padding: 5px; background-color: #d8d7d7;" action="<?php echo $this->baseURL ?>user/picupdate" enctype="multipart/form-data">
                        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" style=" width: 200px;"/>
                        <input type="submit" value="Update Photo" />
                    </form>
                </div>
                <div id="profile-info" style="width: 50%;display: inline-block">
                    <form method="post" action="<?php echo $this->baseURL ?>user/update">
                        <div >
                            <label for="firstName" >First Name:</label>
                            <input type="text" id="firstName" value="<?php echo $data['udata']['firstname']; ?>" name="firstName">
                        </div>
                        <div >
                            <label for="lastName" >Last Name:</label>
                            <input  type="text" id="lastName" value="<?php echo $data['udata']['lastname']; ?>" name="lastName">
                        </div>
                        <div >
                            <label for="contactNo" >Contact No:</label>
                            <input  type="text" id="contactNo" name="contactNo" value="<?php echo $data['udata']['uphone']; ?>">
                        </div>
                        <div >
                            <label style="margin-bottom: 25px;" for="address" >Address :</label>
                            <textarea  name="address" id="address" cols="30" rows="3"><?php echo $data['udata']['address']; ?></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
            <div style="width:100%; min-height: 50px; margin-top: 20px;">
                <div  id="accoutset">
                    <p>You can delete your account anytime by clicking the button below. 
                        This will delete all your personal information including your name, 
                        contact number, email and picture from our system. 
                        however it would not remove any transaction records like invoices.</p>
                    <button style="margin: 10px; width: 300px;"  onclick="dell_account()">Delete Account</button>
                    <script type="text/javascript">
                        function dell_account(){
                            if(confirm("are you sure you want to delete?")){
                                window.location.href = "<?php echo $this->baseURL ?>user/delete";
                            }
                        }
                    </script>
                </div>
                <div  id="chpass">
                    <form method="post" action="<?php echo $this->baseURL ?>user/chpass">
                        <div >
                            <label for="newpass" >New Password:</label>
                            <input type="password" id="newpass"  name="newpass">
                        </div>
                        <div >
                            <label for="reppass" >Repeat New Password:</label>
                            <input  type="password" id="reppass"  name="reppass">
                        </div>
                        <div>
                            <input type="submit" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
            <div style="width:100%; min-height: 50px; margin-top: 20px;">
                <h3>My Orders</h3>
                <br>
                <table class="order_list">
                    <tr>
                        <th>Time Stamp</th>
                        <th>Order Id</th>
                        <th>Total Amount</th>
                        <th>Total Paid</th>
                        <th>Status</th>
                    </tr>
                <?php
                //display all the oders of this user
                load_model('order');
                $order_model = new order_model();
                $orders = $order_model->get_order_list($_SESSION['userid']);
                foreach ($orders as $key => $order) {
                    echo '<tr>';
                    echo '  <td>'.$order['timestamp'].'</td>';
                    echo '  <td><a href="'.$this->baseURL.'cart/order/'.$order['order_id'].'">#'.$order['order_id'].',</a></td>';
                    echo '  <td>'.$order['total_amount'].'</td>';                    
                    echo '  <td>'.$order['paid_amount'].'</td>';                    
                    echo '  <td>'.$order['status'].'</td>';                    
                    echo '</tr>';
                }
                ?>
                </table>
            </div>
         
         </div>
      </div>
      <!-- End Main -->