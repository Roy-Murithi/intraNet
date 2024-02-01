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
if(@$_GET["personid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  person where `personid`='".@$_GET['personid']."'");
	}
}

?>

<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this Staff?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

		if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid Staff information");
			}
			else
			{		
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(personid)
	{
			if(personid!="")
		{		if (document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid Staff information");
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
<form action="saveperson.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="1089" border="0" align="center" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  <tr>
    <td width="637" height="22" valign="top"> <p><img name="header" src="images/header.jpg" width="935" height="150" border="0" id="header" alt="" /></p>
      </td>
    <td width="448" valign="top"><div align="right"><?php
		$script="";
		//echo classBTN("btnReturn","Add new Staff","editperson.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="5" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="27" colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  style="border:thin dotted">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="19" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="216" valign="top">STAFF NAME </td>
            <td width="240" valign="top">POSITION</td>
            <td width="225" valign="top">DEPARTMENT NAME</td>
            <td width="161" valign="top">OFFICE LOCATION</td>
            <td width="224" valign="top">EMAIL ADDRESS</td> 
            <td width="64" valign="top">EXT</td>
            
          </tr>
	    
	    <?php

		$rs=@mysql_query("select * from person order by `names` asc");
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
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td>".($x+1)."</td><td>$data[1]</td> <td>$data[3]</td> <td>$data[7]</td> <td>$data[5]</td> <td>$data[2]</td> <td>$data[4]</td>
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

