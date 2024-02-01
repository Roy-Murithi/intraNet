<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
	


?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this person?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

		if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid person information");
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
				alert("Enter valid person information");
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
<form action="import_persons.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="3" valign="top">Upload persons</td>
    </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td width="147" height="25" valign="top"><div align="right">Excel File:</div></td>
    <td colspan="2" valign="top"><input type="file" name="file" /></td>
  </tr>
  <tr>
    <td height="23"></td>
    <td width="167">&nbsp;</td>
    <td width="386">&nbsp;</td>
  </tr>
  <tr>
    <td height="23"></td>
    <td valign="top"><input name="Submit" type="submit" class="BTN" value="    Upload    " /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="232"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

