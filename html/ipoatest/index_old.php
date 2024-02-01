<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
include "globalfunc.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title> IPOA Intranet </title>
<LINK REL="SHORTCUT ICON" HREF="http://intranet.ipoa.go.ke/ipoa/images/ipoa_favicon.png" />
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!-- Java Script Start Code to run the Real time clock-->

<script type="text/javascript">
tday=new Array("SUNDAY","MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
if(nyear<1000) nyear+=1900;
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>
<!-- Java Script end Code to run the Real time clock-->


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
 <h2> <div id="clockbox"></div> </23> <!-- Call the clock box and display system time-->
 
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
    <td height="130" colspan="7" valign="top"><div align="center"><img src="images/ipoa_header.png" width="600" height="120" /></div></td>
    <td colspan="2" valign="top"><a href="../ictsupport/index.php"><img src="images/ictsupport.png" width="115" height="130" /></a></td>
    </tr>
  
  <tr>
    <td height="18"></td>
    <td colspan="2" valign="top"> <h2>INTRANET SERVICES</h2> </td>
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
		echo classBTN("btnApprove","<img src=\"images/iCLOUDConnectYellowLive.png\" width=\"170\" height=\"99\" />","http://icloudconnect.ipoa.go.ke/icloud/","","$script"); 
		?>&nbsp;<div class="disp" id="txtDisp">
      <div align="center">iPOACloud Connect System</div>
      </div>
    </div></td>
   
 
<td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="div">
      <?php
	   $script=""; 
		echo classBTN("btnApprove","<img src=\"images/internaldirectory.png\" width=\"170\" height=\"99\" style=\"border:none\" />","../directory","","$script"); 
		?>
      &nbsp;
      <div id="div2" class="disp">
        <div align="center">Internal Telephone Directory </div>
      </div>
    </div></td>
    
<td>&nbsp;</td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div3">
      <?php
	  	$script=""; 
		//<div class="link1"><a href="https://www.google.com/"target="_blank" class="active">Click to access Google</a></div>
		echo classBTN("btnApprove","<img src=\"images/email.png\" width=\"170\" height=\"99\" />","https://mail.busgateway.is.co.za","","$script"); 
		?>
      &nbsp;
      <div id="div4" class="disp">
        <div align="left"> Webmail(mail.busgateway.is.co.za)</div>
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
		$script="";
		echo classBTN("btnApprove","<img src=\"images/ictservices.png\" width=\"170\" height=\"99\" />","http://intranet.ipoa.go.ke/ictservices/","","$script"); 
		?>
      &nbsp;
      <div id="div6">
        <div align="center" class="disp">ICT Monitoring Station</div>
      </div>
    </div></td>
    <td></td>
    
	<td valign="top"><div class="parentDiv" id="div7">
    
     <?php
		//$script="alert('System not configured')"; 
		//echo classBTN("btnApprove","<img src=\"images/photogallery.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		//?>
    
       <?php 
		echo classBTN("btnApprove","<img src=\"images/gallery2017.png\" width=\"170\" height=\"99\" />","http://gallery.ipoa.go.ke/gallery/","","$script"); 
		?>
           
      &nbsp;
      <div id="div8">
        <div align="center" class="disp">Photo Gallery</div>
      </div>
    </div></td>
    <td></td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div9">
      <?php
		//$script="alert('System not configured')"; 
		//echo classBTN("btnApprove","<img src=\"images/repository.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		echo classBTN("btnApprove","<img src=\"images/CIMSLegacyWhite.png\" width=\"170\" height=\"99\" />","cpanel/controlpanel.php","","$script");
		?>
      &nbsp;
      <div id="div10">
        <div align="center" class="disp">Complaints & Investigations</div>
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
	    $script=""; 
	echo classBTN("btnApprove","<img src=\"images/e_noticeboard.png\" width=\"170\" height=\"99\" />","http://intranet.ipoa.go.ke/noticeboard/","","$script"); 
		?>
  &nbsp;
  <div id="div12">
    <div align="center" class="disp">Electronic Notice Board</div>
  </div>
    </div></td>
    <td></td>
    
    <td valign="top"><div class="parentDiv" id="div13">
      <?php
		//$script="alert('System not configured')"; 
		 echo classBTN("btnApprove","<img src=\"images/external_resources.png\" width=\"170\" height=\"99\" />","http://intranet.ipoa.go.ke/externalservices/","","$script"); 
		?>        
  &nbsp;
  <div id="div16">
    <div align="center" class="disp">External Resources</div>
  </div>
    </div></td>
   
   
  <td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="system"><?php
		$script=""; 
		//echo classBTN("btnApprove","<img src=\"images/CIMSLegacyBlack.png\" width=\"170\" height=\"99\" />","cpanel/controlpanel.php","","$script");
		echo classBTN("btnApprove","<img src=\"images/ipoacloudtest.png\" width=\"170\" height=\"99\" />","http://icloudtest/","","$script"); 
		?>&nbsp;
        <div class="disp" id="txtDisp">
      <div align="center">Test/Quality Assurance Environment</div>
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

<div id="footer_bot">
      <h6>Copyright <?php $y = date("Y"); print $y;?>. IPOA </h6><!-- Do not remove -->  
    </div>

</center>

</body>
</html>