<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Quotation page view
 */
?>
<!-- Main -->
	<div id="main" class="shell">
		<div style="box-shadow: 0px 0px 5px #888888; padding-bottom:20px; border-radius: 15px 50px;">
        	<form method="post" action="<?php echo $this->baseURL ?>quotation/submit" enctype="multipart/form-data">
		  <table width="860">
		      <tr>
		        <td>&nbsp;</td>
		        <td height="108" colspan="3"><h3 id="loginh3" align="Left">Request a Quote</h3>
		          <h4>Please fill out this form to request us a Quote</h4></td>
	          </tr>
			  	<tr>
		        <td valign="top">&nbsp;</td>
		        <td height="35" valign="top">Reference No:</td>
		        <td height="35" valign="top"><input name="referenceno" type="text" readonly id="referenceno" size="40" value="100124" /></td>
		        <td height="35">&nbsp;</td>
	          </tr>
		      <tr>
		        <td width="77" valign="top">&nbsp;</td>
		        <td width="141" height="35" valign="top">Full Name:</td>
		        <td width="240" height="35" valign="top"><input name="fullname" type="text" id="fullname" size="40"/></td>
		        <td width="382" height="35">&nbsp;</td>
		      
	          </tr>
		      <tr>
		        <td valign="top">&nbsp;</td>
		        <td height="35" valign="top">Email:</td>
		        <td height="35" valign="top"><input name="email" type="text" id="email" size="40"/></td>
		        <td height="35"><p style="font-style:italic; font-size: 12px;"></p></td>
	          </tr>
		      <tr>
		        <td valign="top">&nbsp;</td>
		        <td height="35" valign="top">Contact&nbsp;No:&nbsp;&nbsp; </td>
		        <td height="35" valign="top"><input name="contactNo" type="text" size="40"/></td>
		        <td height="35">&nbsp;</td>
	          </tr>
		      <tr>
		        <td valign="top">&nbsp;</td>
		        <td height="35" valign="top">Job Name:</td>
		        <td height="35" valign="top"><input name="jobname" type="text" id="jobname" size="40" /></td>
		        <td height="35"><p style="font-style:italic; font-size: 12px;"></p></td>
	          </tr>

		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td width="141" height="35" valign="top">Quantity:</td>
		        <td width="240" height="35" valign="top"><input name="qty" type="text" id="qty" size="40"/></td>
		        <td height="35" style="width:10px"></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top">Colour Specification:</td>
		        <td height="35" valign="top"><input name="col_spec" type="text" id="col_spec" size="40"/></td>
		        <td height="35" style="width:10px"><p style="font-style:italic; font-size: 12px;">* I.E. Full Colour, 2 Pantones (include numbers if you can), Gloss or UV coating</p></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top">Finishing:</td>
		        <td height="35" valign="top"><input name="finishing" type="text" size="40"/></td>
		        <td height="35" style="width:10px"><p style="font-style:italic; font-size: 12px;">* Folding, binding or scoring etc..</p></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top">Finish Size:</td>
		        <td height="35" valign="top"><input name="finish_size" type="text" id="finish_size" size="40" /></td>
		        <td height="35" style="width:10px"><p style="font-style:italic; font-size: 12px;">* Size of the cut and bound document</p></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top">Paper Type:</td>
		        <td height="35" valign="top"><input name="papertype" type="text" id="papertype" size="40" /></td>
		        <td height="35" style="width:10px"><p style="font-style:italic; font-size: 12px;">* Cover,text or paper weight (Lbs or Pts); Gloss or Matt; or specify a particular brand.</p></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top" style="vertical-align:top">Other Specifications:</td>
		        <td height="35" valign="top" style="width:10px"><label>
		          <textarea name="specifications" id="specifications" cols="32" rows="3"></textarea>
	            </label></td>
		        <td height="35" valign="top" style="width:10px"><p style="font-style:italic; font-size: 12px;">* Anything else we should know.</p></td>
	        </tr>
		      <tr>
		        <td valign="top" style="vertical-align:top">&nbsp;</td>
		        <td height="35" valign="top" style="vertical-align:top">Upload a file:</td>
		        <td height="35" valign="top" style="width:10px"><label>
		          <input type="file" name="artwork" id="artwork" />
	            </label></td>
		        <td height="35" style="width:10px"></td>
	          </tr>
		      <tr>
		        <td></td>
		        <td></td>
		        <td align="left"><button type="submit" name="update" id="update" class="btn btn-primary"> <i class="glyphicon glyphicon-edit"></i>Submit</button></td>
		        <td align="right">&nbsp;</td>
	          </tr>
		</table>
</form>
        </div>
		<!-- End Content -->
	</div>
	