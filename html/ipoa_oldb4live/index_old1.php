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
    <td width="10" height="9"></td>
    <td width="64"></td>
    <td width="188"></td>
    <td width="9"></td>
    <td width="189"></td>
    <td width="14"></td>
    <td width="111"></td>
    <td width="60"></td>
    <td width="55"></td>
  </tr>
  <tr>
    <td height="130" colspan="7" valign="top"><div align="center"><img src="images/ipoa logo.png" width="140" height="90" /></div></td>
    <td colspan="2" valign="top"><a href="../ictsupport/index.php"><img src="images/ictsupport.png" width="115" height="130" /></a></td>
    </tr>
  
  <tr>
    <td height="18"></td>
    <td colspan="2" valign="top">IPOA Intranet Access panel </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  
  
  <tr>
    <td height="14" colspan="9" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="129">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="system"><?php
		$script=""; 
		echo classBTN("btnApprove","<img src=\"images/logo2.png\" width=\"170\" height=\"99\" />","cpanel/controlpanel.php","","$script"); 
		?>&nbsp;<div class="disp" id="txtDisp">
      <div align="center">Complaints and Investigations</div>
      </div>
    </div></td>
    <td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="div">
      <?php
		$script=""; 
		echo classBTN("btnApprove","<img src=\"images/logo4.png\" width=\"170\" height=\"99\" />","paperlesso.php","","$script"); 
		?>
      &nbsp;
      <div id="div2" class="disp">
        <div align="center">Paperless Office </div>
      </div>
    </div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div3">
      <?php
	  	$script=""; 
		echo classBTN("btnApprove","<img src=\"images/logo7.png\" width=\"170\" height=\"99\" />","https://ex2k13.ipoa.go.ke/owa","","$script"); 
		?>
      &nbsp;
      <div id="div4" class="disp">
        <div align="center">IPOA E-Mails  portal  </div>
      </div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="123"></td>
    <td></td>
    <td valign="top"><div class="parentDiv" id="div5">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
      &nbsp;
      <div id="div6">
        <div align="center" class="disp">Human  Capital</div>
      </div>
    </div></td>
    <td></td>
    <td valign="top"><div class="parentDiv" id="div7">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
      &nbsp;
      <div id="div8">
        <div align="center" class="disp">Communications  and Outreach</div>
      </div>
    </div></td>
    <td></td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div9">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
      &nbsp;
      <div id="div10">
        <div align="center" class="disp">Audit  and Risk</div>
      </div>
    </div></td>
    <td></td>
  </tr>
  <tr>
    <td height="15"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="117"></td>
    <td></td>
    <td valign="top"><div class="parentDiv" id="div11">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
  &nbsp;
  <div id="div12">
    <div align="center" class="disp">Business  Services</div>
  </div>
    </div></td>
    <td></td>
    <td valign="top"><div class="parentDiv" id="div13">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
  &nbsp;
  <div id="div14">
    <div align="center" class="disp">Employee  Self Service</div>
  </div>
    </div></td>
    <td></td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div15">
      <?php
		$script="alert('System not configured')"; 
		echo classBTN("btnApprove","<img src=\"images/logo3.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		?>
  &nbsp;
  <div id="div16">
    <div align="center" class="disp">Inspection and Monitoring </div>
  </div>
    </div></td>
    <td></td>
  </tr>
  <tr>
    <td height="13" colspan="9" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</center>
</body>
</html>