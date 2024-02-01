<?php include "conn.php"; 
	$postid=@$_GET['postid'];
	$flag=@$_GET['flag'];
	if((int)$flag==0)
	{
	$rsData=mysql_query("select * from `".$pref."post` where `postid`='$postid';");
		if($rsData)
		{
			$rows=mysql_num_rows($rsData);
			if($rows>0)
			{
				$datap=mysql_fetch_array($rsData);
			}
		}
	}else
	{
		$rsPost=mysql_query("select * from ".$pref."post order by `others` desc");
		if($rsPost)
		{
		
			$rows=mysql_num_rows($rsPost);
			if($rows>0)
			{
				$html="";
				for($xp=0;$xp<$rows;$xp++)
				{
					
					$datap=mysql_fetch_array($rsPost);
					$html=$html. "
					<div style=\"width:535px;float:left\">
						<div style=\"width:30px;float:left;margin-top:4px;\"><img src=\"images/pointer.gif\"/></div>
						<div style=\"width:505px;float:left;font-size:12px;\"><b><a href=\"$datap[4]?postid=$datap[0]\">$datap[1]</a></b><font style=\"font-size:10px;\"> - Posted on $datap[5]</font></div>				
					</div>";
				}
			}
		}
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA-News</title>
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
    <td width="218" rowspan="2" valign="top"><span class="Black_Header_Text">
      <?php include "theme/leftsidebar.php"; ?>
    </span></td>
    <td width="14" height="18"></td>
    <td width="792" valign="top" style="font-size:20px;"><b><?php if((int)$flag==0)
	{ echo @$datap[1];}else{echo "All posts";}?>
    </b></td>
    </tr>
  <tr>
    <td height="297"></td>
    <td valign="top"><div align="left">
      <?php 
	  	if((int)$flag==0)
		{
			$strData=str_replace("\n","<br/>",@$datap[2]);
			$strData=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$strData);
			$strData=str_replace("../../","",$strData);
			if($strData!="")
			{
				echo "<div style=\"font-size:10px;\">(Posted on $datap[5], by $datap[3])</div>";
				echo $strData;
			}else
			{
				echo "<div class=\"Black_Header_Text\"><b>This page was moved or the link is broken, report this error to ictdept@ipoa.go.ke</b></div>";
			}
		}else
		{
			echo $html;
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
