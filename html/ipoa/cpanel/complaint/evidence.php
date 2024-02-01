<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid persons");
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
<form action="saveevidence.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Add Evidence </td>
    <td width="23">&nbsp;</td>
    </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="47"></td>
    <td width="166"></td>
    <td width="10"></td>
    <td width="137"></td>
    <td width="327"></td>
    <td width="21"></td>
    <td></td>
    </tr>
  <tr>
    <td height="25"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Evidence title   :</div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top">
	<textarea name="txtDat1" class="STR1" id="txtDat1" ></textarea>
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$complaintid; ?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  
    <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Upload Evidence:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat2" type="file" id="txtDat2" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="11"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><?php
		echo "<input type=\"button\" name=\"add\" value=\"Add new evidence\"  class=\"BTN\" onclick=\"saveUser()\">";
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('complaintdetails.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

