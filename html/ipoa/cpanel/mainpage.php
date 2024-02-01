<?php 
	session_start();
	ob_start(); // added to take care of "Warning: Cannot modify header information - headers already sent by..."
	
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//	//include "globalfunc.php";
	if(@$_SESSION['loggedIn']!=99)
	{
		header("location:../index.php?pid=0");
		exit;
	}
	$_GET['sessid']='smetsysmocmas2';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
	.body
	{
		background-image:url(images/topback.png);
		background-repeat:repeat-x;
		background-position:top;
		margin:0px;				
	}
	.ttback
	{
		background-image:url(images/back.png);
		background-repeat:repeat-y;
		background-position:left;		
	}
	#mnu:hover,#mnu1:hover,#mnu2:hover,#mnu3:hover,#mnu4:hover,#mnu5:hover,#mnu6:hover,#mnu7:hover {
	cursor:pointer;
	
	}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA | Independent Policing Oversight Authority</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {font-weight: bold}
-->
</style>
<script language="javascript" src="scripts/academicaffairs.js"></script>
<script language="javascript">
//#zz { opacity: .9; filter: alpha(opacity=50); -moz-opacity: .1;}	

		var doc=document;
		if(!doc.loading) 
		{ 
			doc.loading=new Image;
			doc.loading.src="images/loading.gif";
		}
	function openPage(page,url,container,param)
	{
	//var ajaxRequest;  // The variable that makes Ajax possible!

		getPage(url,container,param);	
	}
	function expandMNU(num)
	{
		var div=document.getElementById("mnucont"+num);
		var div1=document.getElementById("mnu"+num);
		if (div.style.display=="none")
		{
			div.style.display="block";
			div1.style.backgroundImage="url(./images/ofolder.png)";
		}else
		{
			div.style.display="none";
			div1.style.backgroundImage="url(./images/cfolder.png)";
		}
	}

	function autoCheck()
	{
		var ajaxRequest;  // The variable that makes Ajax possible!
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser cannot support this functionality!");
					return false;
				}
			}
		}
		
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				
				var strData= ajaxRequest.responseText;
					//alert(ajaxRequest.responseText)
				if(strData!="")
				{	
					var temp=new Array();
					temp=strData.split("!~~!");
					if(temp.length>0)
					{		
						for(x=0;x<temp.length;x++)
						{			
							var temp1=new Array();
							if(temp[x]!="")
							{
								temp1=temp[x].split("!~!");
								var div=document.getElementById(temp1[0]);
								if(div)
								{
									div.innerHTML=temp1[1];
								}
							}
						}
					}
				}
				setTimeout("autoCheck()",1000);		
			}
			
		}
		ajaxRequest.open("GET", "checkComplaints.php?sessid=smetsysmocmas&", true);
		
		ajaxRequest.send(null);
	}
</script>
<link rel="shortcut icon" href="./images/logo1.png" label="IPOA">
<style type="text/css">
<!--
.style4 {
	font-size: 12px;
	color: #000000;
	padding-left:37px;
	background-image:url(./images/cfolder.png);
	background-repeat:no-repeat;
	background-position:left center;
}
.subf {
	padding-left:37px;
	background-image:url(./images/sfolder.png);
	background-repeat:no-repeat;
	background-position:left center;
}
.esubf {
	padding-left:37px;
	background-image:url(./images/esfolder.png);
	background-repeat:no-repeat;
	background-position:left center;
}
-->
</style>

</head>
<center>
<?php
	include ("header.php");
?>
<body class="body" onload="<?php echo "getPage('index1.php','content','');autoCheck();";
?>">

<table width="1024" border="0" cellpadding="0" cellspacing="0" style="background-image:url(images/cpback.png); background-position:left; background-repeat:repeat-y;" >
  <!--DWLayoutTable-->
   <tr>
    <td width="12" height="476" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="204" valign="top">
	<div align="left"><strong>Main Controls</strong></div>	<div class="style3 Blue_Header_Text"  >
		<?php if(@$_SESSION["member"]!="99"){?>
	  	<div align="left" ><a href="#"  onclick="getPage('users.php','content','')">Admin Users</a></div>
		<?php }?>
 		  <div align="left" class="HorizontalRuler">&nbsp;</div>		  
		  <div id="mnu1" align="left" class="style4" onclick="expandMNU('1')" >Complaints Management</div>
		  <div id="mnucont1" style="display:none; margin-left:10px;">
                    <div align="left" class="subf"><a href="#"  onclick="getPage('underconstruction.php','content','')">Temporary Intake</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('complaint/complaint.php','content','')">Complaints Intake(<font color="#FF0000"><span id="counter9"><?php echo  fetchRecordCount($pref."complaint","uneditable",0);?></span></font>)</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('complaint/acomplaint.php','content','')">Submitted Complaints(<font color="#FF0000"><span id="counter8"><?php echo  fetchRecordCount($pref."complaint","uneditable",99);?></span></font>)</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('complaint/dcomplaint.php','content','')">Refered Complaints(<font color="#FF0000"><span id="counter7"><?php echo  fetchRecordCount($pref."complaint","uneditable",98);?></span></font>)</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('complaint/apcomplaint.php','content','')">Approved Complaints</a></div>  
			<div align="left" class="esubf"><a href="#"  onclick="getPage('complaint/ccomplaint.php','content','')">Closed Complaints(<font color="#FF0000"><span id="counter10"><?php echo  fetchRecordCount($pref."complaint","uneditable",92);?></span></font>)</a></div>
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu2" align="left" class="style4" onclick="expandMNU('2')">Investigations Management</div>
		  <div id="mnucont2" style="display:none;  margin-left:10px;">
		    <div align="left" class="subf"><a href="#"  onclick="getPage('investigation/assigninvestigation.php','content','')">Job Tasking(<font color="#FF0000"><span id="counter1"><?php echo  fetchRecordCount($pref."complaint","uneditable",97);?></span></font>)</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('investigation/investigation.php','content','')">Investigations</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('investigation/myinvestigation.php','content','')">My Cases</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('investigation/cinvestigation.php','content','')">Finalize investigation(<font color="#FF0000"><span id="counter2"><?php echo  fetchRecordCount($pref."complaint","uneditable",94);?></span></font>)</a></div>
		    <div align="left" class="esubf"><a href="file:///C|/Shares/Investigations" target="_blank" >Open Shared folder</a></div>
			
		    
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu3" align="left" class="style4" onclick="expandMNU('3')">Finalized Investigations</div>
		  <div id="mnucont3" style="display:none;  margin-left:10px;">
		    <div align="left" class="esubf"><a href="#"  onclick="getPage('closed/investigation.php','content','status=3')">Finalized Investigations(<font color="#FF0000"><span id="counter11"><?php echo  fetchRecordCount($pref."complaint","uneditable",93);?></span></font>)</a></div>
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu4" align="left" class="style4" onclick="expandMNU('4')">Archives</div>
		  <div id="mnucont4" style="display:none;  margin-left:10px;">
		    <div align="left" class="esubf"><a href="#"  onclick="getPage('closed/archive.php','content','status=3')">Archives(<font color="#FF0000"><span id="counter12"><?php echo  fetchRecordCount2($pref."archive");?></span></font>)</a></div>
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu5" align="left" class="style4" onclick="expandMNU('5')">Reports</div>
		  <div id="mnucont5" style="display:none;  margin-left:10px;">
		  	<div align="left" class="subf"><a href="#"  onclick="getPage('reports/get_report.php','content','status=4')">Summary Report</a></div>
		  	<div align="left" class="subf"><a href="#"  onclick="getPage('reports/duration.php','content','status=0')">Duration History</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('reports/investigation.php','content','status=0')">Unattended to(<font color="#FF0000"><span id="counter3"><?php echo  fetchRecordCount($pref."complaint","uneditable",96);?></span></font>)</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('reports/investigation.php','content','status=1')">Under Investigation(<font color="#FF0000"><span id="counter4"><?php echo  fetchRecordCount($pref."complaint","uneditable",95);?></span></font>)</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('reports/investigation.php','content','status=2')">Concluded Investigation(<font color="#FF0000"><span id="counter5"><?php echo  fetchRecordCount($pref."complaint","uneditable",94);?></span></font>)</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('reports/investigation.php','content','status=3')">Finalized Investigation(<font color="#FF0000"><span id="counter6"><?php echo  fetchRecordCount($pref."complaint","uneditable",93);?></span></font>)</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('reports/get_report.php','content','status=4')">Monthly Reports</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('underconstruction.php','content','status=5')">Quarterly Reports</a></div>
			<div align="left" class="subf"><a href="#"  onclick="getPage('underconstruction.php','content','status=6')">Annual Reports</a></div>
			
			<div align="left" class="subf"><a href="#"  onclick="getPage('reports/summary.php','content','')">Performance Report</a></div>
			<div align="left" class="esubf"><a href="#"  onclick="getPage('reports/contact.php','content','')">Contacts</a></div>
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu6" align="left" class="style4" onclick="expandMNU('6')">Setups</div>
		  <div id="mnucont6" style="display:none;  margin-left:10px;">
		  <div align="left" class="subf"><a href="#"  onclick="getPage('investigation/filecheck.php','content','')">Investigation File Audit</a></div>
		  <div align="left" class="subf"><a href="#"  onclick="getPage('complaintfilecheck/filecheck.php','content','')">Complaints File Audit</a></div>
		  <div align="left" class="subf"><a href="#"  onclick="getPage('complaint/nature.php','content','')">Setup Complaint Nature</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('dataentry/town.php','content','')">Setup Region/Towns/Area</a></div>
		    <div align="left" class="subf"><a href="#"  onclick="getPage('dataentry/county.php','content','')">Setup County</a></div>
		    <div align="left" class="<?php if(@$_SESSION["member"]!="99"){echo "subf";}else{echo "esubf";}?>"><a href="#"  onclick="getPage('dataentry/ward.php','content','')">Setup Wards</a></div>
			<?php if(@$_SESSION["member"]!="99"){?>
		    <div align="left" class="esubf"><a href="#"  onclick="getPage('staff/staff.php','content','')">Staff</a></div>
			<?php }?>
		  </div>
		  <?php if(@$_SESSION["member"]!="99"){?>
		   <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu7" align="left" class="style4" onclick="expandMNU('7')">Access Rights</div>
		  <div id="mnucont7" style="display:none;  margin-left:10px;">
		  <div align="left" class="subf"><a href="#"  onclick="getPage('accessrights/functions.php','content','')">Controlled Functions</a></div>
		  <div align="left" class="esubf"><a href="#"  onclick="getPage('accessrights/cpages.php','content','')">Controlled Pages</a></div>
		  </div>
		  <?php }?>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div align="left" class="LinkText"><a href="#"  onclick="getPage('logout.php','content','')">Logout</a></div>
      </div></td>
    <td width="4" valign="top" ><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="804" valign="top">
	  <div id="container">
	    <iframe height="476" width="804" name="content" id="content" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" style="overflow:visible; ">			</iframe>
      </div></td>
    </tr>
   <tr>
     <td height="43" colspan="4" valign="top" style="background-image:url(images/cpbot.png); background-position:left top; background-repeat:no-repeat;"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
</table>
<table width="1024" border="0" cellpadding="0" cellspacing="0"   >
  <!--DWLayoutTable-->
<tr><td width="221" height="19" valign="top">&nbsp; </td>
  <td width="803" valign="top"><img src="images/tailImage.png" width="800" height="80" /></td>
</tr>
</table>


</body>
</center>
</html>
