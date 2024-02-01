<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
include "globalfunc.php";
$category=@$_GET['category'];
//$parentm=@$_GET['parentm'];
$level=@$_GET['level'];
$menus=@$_GET['menus'];
$menuid=@$_GET['menuid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script  src="scripts/counterajax.js"></script>
<script language="javascript">
	function getPageMenu(flag)
	{
		var iframe=document.getElementById("pages");
		if(Number(flag)==0)
		{
			iframe.src="menupage.php?validauth=99";
		}else
		{
			iframe.src="menupage1.php?validauth=99";
		}
	}
</script>
</head>
<body onload="">

<form name="frmMenu" action="savemainmenu.php" method="post" enctype="multipart/form-data">
<table width="800" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
  <tr>
    <td height="22" colspan="3" valign="top"><div align="right">External Link </div></td>
    <td width="156" valign="top"><input name="txtDat2" type="text" id="txtDat2" value="http://" /></td>
    <td width="53">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="4" rowspan="7" valign="top" class="VerticalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="480" rowspan="7" valign="top">
	  <iframe src="menuitems.php?level=<? echo (int)$level;?>&category=<? echo $category; ?>&parentm=<? echo $menuid;?>" height="418" width="480" scrolling="no" frameborder="0">	</iframe></td>
  </tr>
  <tr>
    <td height="22" colspan="3" valign="top"><div align="right">Menu Text </div></td>
    <td valign="top"><input name="txtDat1" type="text" id="txtDat1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="10" height="67">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td valign="top"><input name="Submit" type="submit" class="BTN" value="Add to menu" />
    <input type="hidden" name="menuid" value="<?php echo $menuid;?>" />
	<input type="hidden" name="parent" value="" />
    <input name="category" type="hidden" id="category" value="<?php echo $category;?>" />
	<input name="level" type="hidden" id="level" value="0" />	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="4" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="4" valign="top"><a href="#" onclick="getPageMenu(0)">Recent Pages</a>| <a href="#" onclick="getPageMenu(99)">Search Page</a> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="287" colspan="5" valign="top">
	  <iframe src="menupage.php?validauth=99" style="height:267px; width:296px;" scrolling="auto" id="pages"></iframe></td>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr>
    <td height="24">&nbsp;</td>
    <td valign="top"><input name="txtDat1a" type="hidden" id="txtDat1a" /></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><input name="Submit" type="submit" class="BTN" value="Add to menu" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

</body>



</html>
