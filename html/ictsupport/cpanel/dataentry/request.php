<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$facultyid=@$_GET['personid'];
$reslvd=@$_GET['reslvd'];
if(@$_GET["supportid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  support where `supportid`='".@$_GET['supportid']."'");
	}
	
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this request?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="529" height="22" valign="top">Help request to ICT </td>
    <td width="167" valign="top"><div align="right"><?php
		$script="";
		echo classBTN("btnReturn","Make new request","editrequest.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="27" colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  style="border:thin dotted">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="386" valign="top">Request</td>
            <td width="68" valign="top">Viewed</td>
            <td width="60" valign="top">Attended</td>
            <td width="136" valign="top">Action</td>
          </tr>
	    
	    <?php

		$rs=@mysql_query("select * from support where personid='". $_SESSION['userid'] ."' and resolved='$reslvd' order by `index` desc");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$color="#FFFFFF";
				for($x=0;$x<$counts;$x++)
				{
					if($color=="#FFFFFF")
					{
						$color="#ABD8DA";
					}else
					{
						$color="#FFFFFF";
					}
					$data=@mysql_fetch_array($rs);
					if($data[5]!="99")
					{
						$edit="<a href=\"#\" onclick=\"getPage('editrequest.php','content','supportid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"delPage('request.php','content','supportid=$data[0]&del=99')\">Delete</a>";
					}else
					{
						$edit="<a href=\"#\" onclick=\"getPage('userviewrequest.php','content','supportid=$data[0]')\">View</a> ";
					}
					if($data[8]=="")
					{
						$att="<font color=\"Red\">No</font>";
					}else
					{
						$att="<font color=\"Green\">Yes</font>";
					}
					if($data[5]=="")
					{
						$vwd="<font color=\"Red\">No</font>";
					}else
					{
						$vwd="<font color=\"Green\">Yes</font>";
					}
					$str=str_replace(" ","&nbsp;",$data[2]);
					$str=str_replace("\n","<br />",$str);
					
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td  valign=\"top\">".($x+1)."</td><td valign=\"top\">$str</td><td valign=\"top\">$vwd</td><td valign=\"top\">$att</td>
					<td valign=\"top\">$edit</td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

