<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 */
?>

         <!-- Content -->
  <div id="content">
    <h2>Business Cards</h2>
    <p>Never miss a business opportunity with professionally designed high quality business cards.</p>
    <p>Your design: Simply upload a sketch of how you want your business cards to look. Or upload a digital file of your logo and describe in the instructions field your desired layout. </p>
    <p> Please note that these prices are based on you providing complete supplied, useable files.  If you are requesting the design to be completed by GMA Prints, the price will need to be confirmed by phoning us directly. These prices are based on single sided business cards, leaflets or flyers. </p>
    <form action="<?php echo $this->baseURL ?>cart/addservice" method="post" enctype="multipart/form-data" >
        <input type="text" name="description" value="Business Cards" style="display: none;"/>
        <table width="666">
          <tr>
            <td width="92" nowrap="nowrap"><h4>Purchase</h4></td>
            <td width="562"><hr/></td>
          </tr>
        </table>
        <table width="635">
          <tr>
            <td width="105" height="30" align="right" scope="row">Qty:&nbsp;&nbsp;</td>
            <td width="99" height="30"><input type="radio" name="selection" value="250-250-750" checked="checked"> 250</td>
            <td width="292" height="30">Rs. 750.00</td>
          </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30"><input type="radio" name="selection" value="500-500-1000"  /> 500</td>
            <td height="30">Rs. 1000.00</td>
          </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30"><input type="radio" name="selection" value="1000-1000-1600" /> 1000</td>
            <td height="30">Rs. 1600.00</td>
          </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30"><input type="radio" name="selection" value="1500-1500-2100" /> 1500</td>
            <td height="30">Rs. 2100.00</td>
          </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30"><input type="radio" name="selection" value="2000-2000-2500" /> 2000</td>
            <td height="30">Rs. 2500.00</td>
          </tr>
        </table>
        <table width="666">
          <tr>
            <td width="73" height="36" nowrap="nowrap"><h4>Design</h4></td>
            <td width="581" height="36"><hr/></td>
          </tr>
        </table>
        <table>
          <tr>
            <td width="100" height="36" align="right">Design&nbsp;Service:&nbsp;&nbsp;</td>
            <td height="36" colspan="3">
              <select name="option3" id="select" style="height:30px;">
                  <option value="Artwork supplied-*-0" style="font-size:12px">I will supply the finished artwork</option>
                  <option value="Artwork charges-*-500" style="font-size:12px">Please create the design based on my instructions</option>
              </select>
            </td>
          </tr>
          <tr>
            <td height="36" align="right">Artwork/Sketch:&nbsp;&nbsp;</td>
            <td height="36" colspan="3"><input type="file" name="artwork" /></td>
          </tr>
          <tr>
            <td height="30" align="right">&nbsp;</td>
            <td height="30" colspan="3"><p style="font-size:10px; text-align: justify;">Upload a sketch of how you want your printed items to appear. Or upload   artwork in finished format such as Adobe PDF, Indesign, Illustrator, EPS   etc. For multiple files save as a ZIP file or email us at gmaprinters@gmail.com</p></td>
          </tr>
          <tr>
            <td height="105" align="right" valign="top">Instructions:&nbsp;&nbsp;</td>
            <td height="105" colspan="3"><textarea name="instructions" id="instructions" cols="45" rows="4"></textarea>
              <p style="font-size:10px">Give us detailed instructions of how you would like your items to appear. Our designers will provide you with a proof via email.</p></td>
          </tr>
          <tr>
              <td></td>
              <td>
                  <input style="width: 200px;" type="submit" value="Add to Cart"/>
              </td>
          </tr>
        </table>
        <table width="666">
          <tr>
            <td width="168" nowrap="nowrap"><h4>How to order online</h4></td>
            <td width="486"><hr/></td>
          </tr>
        </table>
        <p><b>Prices include design and proof:</b><br />
          Once we have designed your items and have your artwork on file you can re-order at a reduced rate for each subsequent order that uses that artwork without modification.<br />
          <br />
          <b>Shipping country/world-wide:</b><br />
          We will send your items by standard courier. In the case where your package exceeds our courier maximum size will will notify you of any additional charges.<br />
          <br />
          <b> Artwork Specifications:&nbsp;</b>for fonts and acceptable file formats see our Artwork Specifications page.</p>
    </form>
  </div>
  <!-- End Content -->
