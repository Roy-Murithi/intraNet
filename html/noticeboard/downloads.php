<?php include "conn.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA-Downloads</title>
<link rel="shortcut icon" href="./images/linklogo.bmp" label="IPOA">
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="scripts/counterajax.js"></script>
<script language="javascript">

function searchCourse(param)
{
	
	if(document.frmSearch.txtSearch.value.length<=2 && document.frmSearch.txtSearch.value.length!="")
	{
		alert("search keywords must be more than three Characters");
		return 0;
	}
	getPage('downloads.php','content',param+'&txtSearch='+document.frmSearch.txtSearch.value);
}


</script>

</head>
<style>
	html, body{ height:100%}
</style>
<body style="background-image:url(images/topback.png); background-repeat:repeat-x; background-position:top; margin:0px">
<center>


<?php
	include "theme/header.php";
?>
<table width="1024" border="0" cellpadding="0" cellspacing="0" style="height:100px;">
  <!--DWLayoutTable-->
  
  <tr>
    <td width="217" height="128" valign="top"><span class="Black_Header_Text">
      <?php include "theme/leftsidebar.php"; ?>
    </span></td>
    <td width="11">&nbsp;</td>
    <td width="796" valign="top"><div align="left">
      <?php include "functions/downloads/downloads.php"; ?>
    </div></td>
    </tr>
</table>
<?php
	include  "theme/tail.php";
?>
</center></body>

</html>
