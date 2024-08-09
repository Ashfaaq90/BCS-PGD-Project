<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 */
?>
  <!-- Content -->
  <div id="content">
    <h2>Booklets - Mini (170x280 mm)</h2>
    <p><b>Your design: </b>Simply upload a sketch of how you want your booklets to look. Or upload a digital file of your logo and describe in the instructions field your desired layout.</p>
    <p>Prices exclude GST.</p>
    <p> Please note that these prices are based on you providing complete supplied, useable files.  If you are requesting the design to be completed by Silverdale Design & Print, the price will need to be confirmed by phoning us direct on 0800 SILPRINT. These prices are based on single sided business cards, leaflets or flyers. </p>
    <form action="<?php echo $this->baseURL ?>cart/addservice" method="post" enctype="multipart/form-data">
    <input type="text" name="description" value="Booklets - A5" style="display: none;"/>
    <table width="666">
      <tr>
        <td width="92" nowrap="nowrap"><h4>Purchase</h4></td>
        <td width="562"><hr/></td>
      </tr>
    </table>
    <table width="610" id="t01" border="1px">
      <tr>
        <th width="95" style="padding-left:5px"><div align="center">Qty:&nbsp;/Size</div></th>
        <th width="95" ><div align="center">250</div></th>
        <th width="95" ><div align="center">500</div></th>
        <th width="95" ><div align="center">1000</div></th>
        <th width="95" ><div align="center">1500</div></th>
        <th width="95" ><div align="center">2000</div></th>
      </tr>
      <tr>
        <td width="95" height="30" style="padding-left:5px">8 Pages</td>
        <td width="95"  height="30" style="padding-left:5px"> <input type="radio" name="selection" value="8 Page-250-1000">
          Rs. 1000</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="8 Page-500-1550">
          Rs. 1550</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="8 Page-1000-2300">
          Rs. 2300</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="8 Page-1500-2800">
          Rs. 2800</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="8 Page-2000-3200">
          Rs. 3200</td>
      </tr>
      <tr>
        <td width="95" height="30"  style="padding-left:5px">16 Pages</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="16 Page-250-3100">
          Rs. 3100</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="16 Page-500-3900">
          Rs. 3900</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="16 Page-1000-4500">
          Rs. 4500</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="16 Page-1500-5000">
          Rs. 5000</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="16 Page-2000-5400">
          Rs. 5400</td>
      </tr>
      <tr>
        <td width="95" height="30"  style="padding-left:5px">24 Pages</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="24 Page-250-5300">
          Rs. 5300</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="24 Page-500-6000">
          Rs. 6000</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="24 Page-1000-6900">
          Rs. 6900</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="24 Page-1500-7500">
          Rs. 7500</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="24 Page-2000-8000">
          Rs. 8000</td>
      </tr>
      <tr>
        <td width="95" height="30"  style="padding-left:5px">32 Pages</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="32 Page-250-8100">
          Rs. 8100</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="32 Page-500-8700">
          Rs. 8700</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="32 Page-1000-9800">
          Rs. 9800</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="32 Page-1500-10300">
          Rs. 10300</td>
        <td width="95"  height="30" style="padding-left:5px"><input type="radio" name="selection" value="32 Page-2000-10750">
          Rs. 10750</td>
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
        <td height="45" align="right">Finish:&nbsp;</td>
        <td width="169" height="45">
           <select name="option1" id="select2" style="height:30px;">
                    <option value="Semi Gloss Finish-*-0"  style="font-size:12px">Semi Gloss</option>
                    <option value="High Gloss Finish-*-0" style="font-size:12px">High Gloss</option>
                    <option value="Matt Finish-*-0" style="font-size:12px">Matt</option>
           </select>
        <td width="44">Stock:&nbsp;&nbsp;</td>
        <td width="332" height="45">
            <select name="option2" id="select3" style="height:30px;">
                <option value="Regular Stock-*-0" style="font-size:12px">Regular</option>
                <option value="Heavy Stock-1-1" style="font-size:12px">Heavy</option>
              </select>
        </td>
      </tr>
      <tr>
        <td width="100" height="36" align="right">Design&nbsp;Service:&nbsp;&nbsp;</td>
        <td height="36" colspan="3"><label>
            <select name="option3" id="select" style="height:30px;">
                  <option value="Artwork supplied-*-0" style="font-size:12px">I will supply the finished artwork</option>
                  <option value="Artwork charges-*-500" style="font-size:12px">Please create the design based on my instructions</option>
                </select>
          </label></td>
      </tr>
      <tr>
        <td height="36" align="right">Artwork/Sketch:&nbsp;&nbsp;</td>
        <td height="36" colspan="3"><input type="file" name="artwork"/></td>
      </tr>
      <tr>
        <td height="30" align="right">&nbsp;</td>
        <td height="30" colspan="3"><p style="font-size:10px">Upload a sketch of how you want your printed items to appear. Or upload   artwork in finished format such as Adobe PDF, Indesign, Illustrator, EPS   etc. For multiple files save as a ZIP file or email us at gmaprinters@gmail.com</p></td>
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
      <b>Shipping NZ-Wide:</b><br />
      We will send your items by standard courier. In the case where your package exceeds our courier maximum size will will notify you of any additional charges.<br />
      <br />
      <b> Artwork Specifications:&nbsp;</b>for fonts and acceptable file formats see our Artwork Specifications page.</p>
    </form>
  </div>
  <!-- End Content -->