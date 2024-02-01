<?php include "conn.php"; 
	$pageid=@$_GET['pageid'];
	$rsData=mysql_query("select * from `".$pref."page` where `pageid`='$pageid';");
		if($rsData)
		{
			$rows=mysql_num_rows($rsData);
			if($rows>0)
			{
				$datap=mysql_fetch_array($rsData);
			}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA - Pages</title>
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
	getPage('courses.php','content',param+'&txtSearch='+document.frmSearch.txtSearch.value);
}


</script>

</head>
<style>
	html, body{ height:100%}
	img.floatLeft 
	{ 
		float: left; 
		margin: 4px; 
	}
	img.floatRight 
	{ 
		float: right; 
		margin: 4px; 
	}
</style>
<body style="background-image:url(images/topback.png); background-repeat:repeat-x; background-position:top; margin:0px">
<center>


<?php
	include "theme/header.php";
?>
<table width="1024" border="0" cellpadding="0" cellspacing="0" style="height:100px;">
  <!--DWLayoutTable-->
  
  <tr>
    <td width="217" rowspan="2" valign="top"><span class="Black_Header_Text">
      <?php include "theme/leftsidebar.php"; ?>
    </span></td>
    <td width="12" height="18"></td>
    <td width="795" valign="top" style="font-size:20px;"><b><?php echo @$datap[1];?></b></td>
    </tr>
  <tr>
    <td height="297"></td>
    <td valign="top"><div align="left">
      <?php 
	 	$strData=str_replace("\n","<br/>",@$datap[2]);
		$strData=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$strData);
		$strData=str_replace("../../","",$strData);
		if($strData!="")
		{
	  		echo $strData;
		}else
		{
			echo "<div class=\"Black_Header_Text\"><b>This page was moved or the link is broken, report this error to ictdept@ipoa.go.ke</b></div>";
		}
	   ?>
    </div></td>
    </tr>
</table>
<?php
	include  "theme/tail.php";
?>
</center></body>

</html>
