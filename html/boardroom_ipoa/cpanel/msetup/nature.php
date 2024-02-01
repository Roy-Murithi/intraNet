<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
if(@$_GET["natureid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."complaintnature where `natureid`='".@$_GET['natureid']."'");
	}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this nature?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

		if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid nature information");
			}
			else
			{		
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(natureid)
	{
			if(natureid!="")
		{		if (document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid nature information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
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
<form action="savenature.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="529" height="22" valign="top">Edit Nature </td>
    <td width="167" valign="top"><div align="right"><?php
		$script="";
		echo classBTN("btnReturn","Add new Nature","editnature.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="35" colspan="3" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  style="border:thin dotted">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="292" valign="top">Nature Type</td>
		    <td width="492" valign="top">Description</td>
            <td width="160" valign="top">Action</td>
            <td width="4"></td>
	      </tr>
	    <tr>
	      <td height="5"></td>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td></td>
	      </tr>
	    
	    <?php

		$rs=@mysql_query("select * from ".$pref."complaintnature order by `natureid` asc");
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
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td>".($x+1)."</td><td>$data[1]</td><td>$data[2]</td>
					<td><a href=\"#\" onclick=\"getPage('editnature.php','content','natureid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"delPage('nature.php','content','natureid=$data[0]&del=99')\">Delete</a></td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

