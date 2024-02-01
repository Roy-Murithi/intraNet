<?php 
	session_start();
	if(@$_SESSION['loggedIn']!=99)
	{
		header("location:../index.php?pid=0");
		exit;
	}
	$_GET['sessid']='smetsysmocmas2';
$page=@$_GET['pid'];
if(@$_GET['ID'])
{
	$param="ID=".$_GET['ID'];
}
else
{
	$param="";
}
include("enumpage.php");
if($page>0)
{
 	$url=getPage("$page");
}else
{
	$url=0;
}
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
	#mnu,#mnu1,#mnu2,#mnu3,#mnu4,#mnu5,#mnu6,#mnu7 {
		background-image:url(images/sep.png);
		background-repeat:no-repeat;
		background-position:bottom left;	
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA | Cpanel</title>
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
	function expandMNU(theDiv)
	{
		var div=document.getElementById(theDiv);
		if (div.style.display=="none")
		{
			div.style.display="block";
		}else
		{
			div.style.display="none";
		}
	}
</script>
<link rel="shortcut icon" href="./images/linklogo.bmp" label="IPOA">
<style type="text/css">
<!--
.style4 {
	font-size: 16px;
	color: #000000;
}
-->
</style>
</head>
<center>
<?php
	include ("header.php");
?>
<body class="body" onload="<?
if($url!="")
{
	echo "getPage('$url','content','$param');";
}else
{
	echo "getPage('index1.php','content','$param');";
}
?>">

<table width="1024" border="0" cellpadding="0" cellspacing="0" style="background-image:url(../images/cpback.png); background-position:left; background-repeat:repeat-y;" >
  <!--DWLayoutTable-->
   <tr>
    <td width="12" height="476" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="204" valign="top">
	<div align="left"><strong>Main Controls</strong></div>	<div class="style3 Blue_Header_Text"  >
	  
	  <div align="left" class="LinkText"><a href="#"  onclick="getPage('users.php','content','')">Users</a></div>
 		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu" align="left" class="style4" onclick="expandMNU('mnucont1')">Appearance</div>
		  <div id="mnucont1" style="display:none; margin-left:10px;">
		    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=0')">Main menu</a></div>		  
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=1')">Top Menu</a></div>
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=2')">Highlights</a></div>	
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=3')">Quick Links</a></div>	
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=4')">Community</a></div>	
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=5')">Links To</a></div>	
			    <div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=6')">Legal Note</a></div>
				<div align="left" class="LinkText"><a href="#"  onclick="getPage('menu.php','content','category=7')">Home Tabs</a></div>
				<div align="left" class="HorizontalRuler">&nbsp;</div>
				<div align="left" class="LinkText"><a href="#"  onclick="getPage('slider/slider.php','content','sessid=smetsysmocmas')">Slider image</a></div>
		  </div>
		  
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  		  <div id="mnu4" align="left" class="style4" onclick="expandMNU('mnucont5')">Posts</div>
		  <div id="mnucont5" style="display:none;  margin-left:10px;">
		    <div align="left" class="LinkText"><a href="#"  onclick="getPage('pages/page.php','content','')">Pages</a></div>
		    <div align="left" class="LinkText"><a href="#"  onclick="getPage('posts/posts.php','content','')">Posts</a></div>
			<div align="left" class="HorizontalRuler">&nbsp;</div>
			<div align="left" class="LinkText"><a href="#" onclick="getPage('gallery/album.php','content','')">Gallery</a></div>
		  </div>
		  <div align="left" class="HorizontalRuler">&nbsp;</div>
		  <div id="mnu6" align="left" class="style4" onclick="expandMNU('mnucont7')">Downloads</div>
		  <div id="mnucont7" style="display:none;  margin-left:10px;">
		    <div align="left" class="LinkText"><a href="#"  onclick="getPage('downloads/category.php','content','')">Downloads category</a></div>
		    <div align="left" class="LinkText"><a href="#"  onclick="getPage('downloads/downloadcategory.php','content','')">Downloads</a></div>
			<div align="left" class="HorizontalRuler">&nbsp;</div>
			<div align="left" class="LinkText"><a href="#" onclick="getPage('#','content','')">Cleanup</a></div>
		  </div>
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
     <td height="43" colspan="4" valign="top" style="background-image:url(../images/cpbot.png); background-position:left top; background-repeat:no-repeat;"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
</table>


</body>
</center>
</html>
