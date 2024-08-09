<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Login view
 */

?>
      <!-- Main -->
      <div id="main" class="shell" align="center" style="padding-top:90px">
         <div id="login">
            <form action="<?php echo $this->baseURL;?>login/authenticate" method="post" name="loging" id="loging" onSubmit="return checkLogin()">
            <table border="0" width="300" align="center">
                  <tr>
                     <td>&nbsp;
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2" align="center">
                        <h3 id="loginh3">Login</h3>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <?php
                           //To display an error
                           if(isset($data['error'])){
                               echo '<span id="error">'.$data['error'].'</span>';	
                           }
                           ?>
                    </td>
                  </tr>
                  <tr>
                      <td height="43"><b>e-mail :</b></td>
                      <td><input type="email" name="umail" id="umail" size="40" 
                        placeholder="e-mail" /></td>
                 </tr>
                  <tr>
                      <td><b>Password:</b></td>
                     <td><input type="password" name="upass" id="upass" size="40"
                        placeholder="Password" /></td>
                  </tr>
                  <tr>
                      <td colspan="2">
                        <button type="submit" name="login" id="loginbutt"  class="btn btn-primary">
                        <span class="glyphicon glyphicon-log-in"> Login</span> 
                        </button>
                     </td>
                  </tr>
               </table>
        </form>
            <br/>
            
            <p style="color: #0182b5">Please register <a style="color:#F00" href="<?php echo $this->baseURL;?>user/register">here</a> if you are not a member. </p>
         </div>
            <br/>
            <br/>
            <br/>
            <br/>
      </div>
      <!-- End Main -->