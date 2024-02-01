<?php
date_default_timezone_set("Africa/Nairobi");
include "globalfunc.php";

// ####################################### IPOA CORPORATE COLORS ##############################################
// ####################################### Compiled By Njeru  ################################################

//"#ffde17";     // used for highlighting a row i.e when moving over the booking table #ffde17 : IPOA YELLOW
//"#0098a2";    // background colour for the main body # IPOA GREEN
//"#fbb040";    // background colour for banner # IPOA ORANGE for banner
//"#000000";    // font colour for banner  # IPOA Black
// ####################################### IPOA Colors ########################################################
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>IPOA Intranet Site <?php $y = date("Y"); print $y;?> </title>
<LINK REL="SHORTCUT ICON" HREF="http://intranet.ipoa.go.ke/ipoa/images/ipoa_favicon.png">
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="lib/jquery.tools.js"></script>

<!-- Java Script Code to run the Real time clock-->

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
</head>

<body>
<center>
<div id="wrap">
  <div id="top_box">
    <div id="logo">
       
    </div>
      
    
	<div id="menu">
      <h2><div align="left" id="clockbox"></div> </h2> <!-- Call the clock box and display system time-->
	  <ul>
	    <li><a href="https://icloudf1.ipoa.go.ke" target="_blank" > iPOACloud</a></li>
        <li><a href="http://intranet.ipoa.go.ke/directory/"target="_blank" > eDirectory</a></li>
        <li><a href="https://outlook.office.com/"target="_blank" >eMail</a></li>
        <li><a href="http://gallery.ipoa.go.ke/gallery/" target="_blank"> eGallery</a></li>
		<li><a href="https://hrms.ipoa.go.ke/" target="_blank" >HRMS</a></li>
		       
      </ul>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="content_top"></div>
  <div id="content">
    <div id="prew_box">
	
	         <div class="scrollable">

				<div class="items">
					<div class="item">
					  <div class="header1">
					    <img src="images/2020/March/Data-Security-IPOA-01.jpg" alt="" title="" />
				      </div> 
           			</div> <!-- item --> 
					
                    <div class="item">
					    <div class="header2">
						  <img src="images/2019/September/ipoa commissioners1.jpg" alt="" title="" />
						</div>						
					</div> <!-- item -->
					<div class="item">
					    <div class="header3">
						   <img src="images/2020/March/Data-Security-IPOA-01.jpg" alt="" title="" />
						</div>						
					</div> <!-- item -->
					
					<div class="item">
					    <div class="header4">
						   <img src="images/2020/March/Data-Security-IPOA-01.jpg" alt="" title="" />

						</div>						
					</div> <!-- item -->
                                        
                    <div class="item">
					    <div class="header4"> 
						   <img src="images/2019/September/ipoa commissioners1.jpg" alt="" title="" /> 
						</div>						
					</div> <!-- item -->              											
					
				</div> <!-- items -->
			</div> <!-- scrollable -->
	  <div style="height: 10px"></div>
		  <div class="navi"></div> <!-- create automatically the point dor the navigation depending on the numbers of items -->		         <div style="clear: both"></div>
    </div>
      
   <table width="727" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
  <tr>
    <td width="10" height="9"></td>
    <td width="64"></td>
    <td width="202"></td>
    <td width="10"></td>
    <td width="200"></td>
    <td width="9"></td>
    <td width="214"></td>
    <td width="1"></td>
    <td width="17"></td>
  </tr>
      
  <tr>
    <td height="14" colspan="9" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="129">&nbsp;</td>
          
    
    <td>&nbsp;</td>
    <td valign="top"><div class="parentDiv" id="system"><?php
		$script=""; 
		echo classBTN("btnApprove","<img src=\"images/iCLOUDConnect-Live.png\" width=\"170\" height=\"99\" />","https://icloudf1.ipoa.go.ke/","","$script"); 
		?>&nbsp;<div class="disp" id="txtDisp">
      <div align="center">Live ECM System </div>
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
        <div align="center">Internal Directory </div>
      </div>
    </div></td>
    
<td>&nbsp;</td>
    <td colspan="2" valign="top"><div class="parentDiv" id="div3">
      <?php
	  	$script=""; 
		//<div class="link1"><a href="https://www.google.com/"target="_blank" class="active">Click to access Google</a></div>
		echo classBTN("btnApprove","<img src=\"images/email.png\" width=\"170\" height=\"99\" />","https://outlook.office.com/","","$script"); 
		?>
      &nbsp;
      <div id="div4" class="disp">
        <div align="left">IPOA Emails</div>
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
		//echo classBTN("btnApprove","<img src=\"images/employee-portal.png\" width=\"170\" height=\"99\" />","#","","$script"); 
		echo classBTN("btnApprove","<img src=\"images/employee-portal.png\" width=\"170\" height=\"99\" />","https://hrms.ipoa.go.ke","","$script");
		?>
      &nbsp;
      <div id="div10">
        <div align="center" class="disp">
          <div align="center">EMPLOYEE SELF SERVICE (HRMS)</div>
        </div>
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
	echo classBTN("btnApprove","<img src=\"images/password-reset-min.png\" width=\"170\" height=\"99\" />","http://selfservice.ipoa.go.ke:8888/showLogin.cc","","$script"); 
		?>
  &nbsp;
  <div id="div12">
    <div align="center" class="disp">AD Password Reset</div>
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
		echo classBTN("btnApprove","<img src=\"images/TEST-iPOACloud.png\" width=\"170\" height=\"99\" />","https://icloudtest.ipoa.go.ke/","","$script"); 
		?>&nbsp;
        <div class="disp" id="txtDisp">
      <div align="center">Test ECM System </div>
      </div>
    </div></td>
         
    <td></td>
  </tr>
  <tr>
    <td height="13" colspan="9" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
  </tr>
  
  
  
</table>
 <div class="content_bot"></div>
  <div id="footer_bg">
    <div id="footer_top">
      
      <div align="left" id="footer_top_column1">
        <h3>External Resources </h3>
        <div class="foot_pad">
          <div class="link1"><a href="http://www.ipoa.go.ke/"  target="_blank" class="active">Click To Access IPOA Website</a></div>
          <div class="link2"><a href="https://twitter.com/IPOA_KE"target="_blank" class="active">Follow IPOA On Twitter</a></div>
          <div class="link3"><a href="https://www.facebook.com/Independent-Policing-Oversight-Authority-IPOA-KENYA-216217745216109/" target="_blank" class="active">Like IPOA On Facebook</a></div>
          <div class="link4"><a href="https://itax.kra.go.ke/KRA-Portal/"target="_blank" class="active">Click to File KRA Returns</a></div>
	   </div>
      </div>
      
      <div align="left" id="footer_top_column2">
        <h3>Quick/Emergency Contacts</h3> 
        <h2 style="color:#ffde17"> GA Insurance          <p>&nbsp;</p>
Tel: Safaricom: 0709 626 400 |  email: careteam@gakenya.com</h2> 
        <!--<h2 style="color:#ffde17"> Garissa Office Tel: 0777040400 </h2> -->
        <!--<h2 style="color:#ffde17"> Mombasa Office Tel: 0799019998 </h2> -->
        <!--<h2 style="color:#ffde17"> Kisumu Office Tel: 0799862244 </h2> -->
         
        <p>&nbsp;</p>
      </div>
      
      <div align="left" id="footer_top_column3">
       <h3> ICT Service Delivery Tools</h3>
        <ul class="ls">
            <li><a href="http://ictservices.ipoa.go.ke/nagios/" target="_blank" class="active">ICT Server & Network Monitoring-Nagios </a></li>
            <li><a href="http://ictservices.ipoa.go.ke/cacti/"target="_blank" class="active">ICT Bandwidth Monitoring-Cacti </a></li>
            <li><a href="http://intranet.ipoa.go.ke/ipoa/"target="_blank" class="active"> IPOA Online Survey (eSurvey) </a></li>
            <li><a href="http://bugzilla.ipoa.go.ke/"target="_blank" class="active"> Software Bug Tracker (Bugzilla) </a></li>      
            <li><a href="http://intranet.ipoa.go.ke/ictsupport/index.php"target="_blank" class="active"> ICT Intranet Support System</a></li>
            <li><a href="http://intranet.ipoa.go.ke/ipoa/cpanel/controlpanel.php"target="_blank" class="active"> CIMS - Complaints and Management</a></li>
            
   	    </ul>
      </div>
     
      <div class="clear"></div>
    </div>
    <div id="footer_bot">
      <p>Copyright <?php $y = date("Y"); print $y;?>. <!-- Do not remove -->
      IPOA </p>
    </div>
  </div>
</div>
</center>
</body>
</html>