<?php 
	session_start();
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
	#mnu0:hover,#mnu1:hover,#mnu2:hover {
	cursor:pointer;
	
	}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Directory - IPOA</title>
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
<link rel="shortcut icon" href="./images/logo1.png" label="JKUAT">
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
<body class="body" onload="<?php if(@$_SESSION['member']!="99"){echo "getPage('index1.php','content','');";}else{echo "getPage('meetings/documents.php','content','meetingsid=". @$_SESSION['meetingsid'] ."');";};
?>">

<table width="1024" border="0" cellpadding="0" cellspacing="0" style="background-image:url(images/cpback.png); background-position:left; background-repeat:repeat-y;" >
  <!--DWLayoutTable-->
   <tr>
    <td width="12" rowspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="204" height="210" valign="top">
	<div align="left"><strong>Main Controls</strong></div>	<div class="style3 Blue_Header_Text"  >

	  
	  <div align="left" ><a href="#"  onclick="getPage('users.php','content','')">Users</a></div>
	      <div align="left" class="HorizontalRuler">&nbsp;</div>
	      <div id="mnu0" align="left" class="style4" onclick="expandMNU('0')" >Directory</div>
	      <div id="mnucont0" style="display:none; margin-left:10px;">
	        <div align="left" class="subf"><a href="#"  onclick="getPage('dataentry/person.php','content','')">Edit Person</a></div>
	        <div align="left" class="esubf"><a href="#"  onclick="getPage('dataentry/upload.php','content','')">Upload Persons</a></div>
	      </div>
	  <div align="left" class="HorizontalRuler">&nbsp;</div>
		    
		  <div align="left" class="LinkText"><a href="#"  onclick="getPage('logout.php','content','')">Logout</a></div>
      </div></td>
    <td width="4" rowspan="2" valign="top" ><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="4">&nbsp;</td>
    <td width="800" rowspan="2" valign="top">
	  <div id="container">
	    <iframe height="476" width="800" name="content" id="content" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" style="overflow:visible; ">			</iframe>
      </div></td>
    </tr>
   <tr>
     <td height="266">&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   
   <tr>
     <td height="43" colspan="5" valign="top" style="background-image:url(images/cpbot.png); background-position:left top; background-repeat:no-repeat;"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
</table>
<table width="1024" border="0" cellpadding="0" cellspacing="0"   >
  <!--DWLayoutTable-->
<tr><td width="221" height="19" valign="top">&nbsp; </td>
  <td width="803" valign="top"><img src="images/tailImage.png" width="800" height="100" /></td>
</tr>
</table>


</body>
</center>
</html>
