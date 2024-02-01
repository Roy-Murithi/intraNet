<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
include "globalfunc.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA Intranet</title>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
/*.parentDiv:hover .disp{
visibility:visible;
}*/
/*.disp{ visibility:hidden;}*/
.parentDiv{}
/*.disp1 {visibility:hidden;}*/
.parentDiv1 {}
</style>
</head>

<body>
<center>
<table width="638" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
  <tr>
    <td width="61" height="9"></td>
    <td width="71"></td>
    <td width="146"></td>
    <td width="58"></td>
    <td width="12"></td>
    <td width="201"></td>
    <td width="151"></td>
  </tr>
  <tr>
    <td height="90" colspan="7" valign="top"><div align="center"><img src="images/ipoa logo.png" width="140" height="90" /></div></td>
    </tr>
  <tr>
    <td height="18" valign="top"><a href="index.php">&lt;&lt;Back</a></td>
    <td colspan="2" valign="top">IPOA Paperless Office </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  
  
  <tr>
    <td height="14" colspan="7" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="129">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><div class="parentDiv" id="system"><?php
		$script=""; 
		echo classBTN("btnApprove","<img src=\"images/logo4.png\" width=\"170\" height=\"99\" style=\"border:none\" />","../boardroom_ipoa","","$script"); 
		?>&nbsp;<div class="disp" id="txtDisp"  style="width:210px;">
      <div align="center">Digital Boardroom </div>
              </div>
    </div></td>
    <td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="div">
      <?php
		$script=""; 
		echo classBTN("btnApprove","<img src=\"images/logo5.png\" width=\"170\" height=\"99\" style=\"border:none\"  />","cpanel/underconstruction.php?sessid=smetsysmocmas","","$script"); 
		?>
      &nbsp;
      <div id="div2" class="disp" style="width:210px;">
        <div align="center">Electronic Notice Board </div>
          </div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="37">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="13" colspan="7" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</center>
</body>
</html>