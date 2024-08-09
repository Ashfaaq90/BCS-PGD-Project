<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * user registration
 */
?>
<!-- Main -->
      <div id="main" class="shell" align="center"  >
         <div id="login">
            <form method="post" action="<?php echo $this->baseURL ?>user/new" enctype="multipart/form-data">
               <table width="400px">
                  <tr>
                     <td height="31" colspan="2">
                        <h3 id="loginh3" align="center">
                        Customer Registration</h3>
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
                     <td height="31">First Name: </td>
                     <td><input type="text" name="firstName" required/></td>
                  </tr>
                  <tr>
                     <td height="31">Last Name: </td>
                     <td><input type="text" name="lastName" required/></td>
                  </tr>
                  <tr>
                     <td height="27">Email: </td>
                     <td><input type="text" name="email" required/></td>
                  </tr>
                  <tr>
                     <td height="31">Password: </td>
                     <td><input type="password" name="password" id="password" required/></td>
                  </tr>
                  <tr>
                     <td height="31">Confirm Password: </td>
                     <td><input type="password" name="confirmPW" id="confirmPW" required onchange="return Validate()"/></td>
                  </tr>
                  <tr>
                     <td height="34">Contact&nbsp;No:&nbsp;&nbsp; </td>
                     <td><input type="text" name="contactNo"/></td>
                  </tr>
                  <tr>
                     <td height="31" style="vertical-align:top">Address: </td>
                     <td><textarea name="address" id="address" cols="30" rows="3"></textarea></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td align="right"><button type="submit" name="save" id="save" class="btn btn-primary">
                        <i class="glyphicon glyphicon-save"></i>&nbsp;Register</button>
                     </td>
                  </tr>
               </table>
            </form>
         </div>
      </div>
      <!-- End Main -->