<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["functionsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."functions where `functionsid`='".@$_GET['functionsid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."functions where `functionsid`='".@$_GET['functionsid']."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid functions name");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
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
<form action="savefunctions.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Edit Controlled Function </td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="47"></td>
    <td width="162"></td>
    <td width="10"></td>
    <td width="135"></td>
    <td width="317"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  <tr>
    <td height="25"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Function Name :</div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php echo @$datax[1]; ?>" />
      <input name="functionsid" type="hidden" id="functionsid"  value="<?php echo @$datax[0]; ?>"/></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="45"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><?php
	if( @$_GET["functionsid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new function\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('functions.php','content','')"  /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="123"></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

