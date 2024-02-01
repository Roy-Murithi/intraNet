<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["msetupid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  msetup where `msetupid`='".@$_GET['msetupid']."'");
	}else
	{
		$rs=@mysql_query("select * from msetup where `msetupid`='".@$_GET['msetupid']."'");
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
				alert("Enter valid msetup");
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
<body onLoad="">
<form action="savemeetings.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Add meeting Category </td>
    <td width="72">&nbsp;</td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td width="47"></td>
    <td width="162" valign="top"><div align="right"><strong>Meeting Category </strong>: </div></td>
    <td width="10"></td>
    <td colspan="4" valign="top"><input name="txtDat1" type="text" id="txtDat1" value="<?php echo @$datax[1];?>">
      <input name="msetupid" type="hidden" id="msetupid" value="<?php echo @$datax[0];?>"></td>
  </tr>
  
  
  <tr>
    <td height="24"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Category desciption:</div></td>
    <td>&nbsp;</td>
    <td colspan="2" rowspan="2" valign="top"><textarea name="txtDat2" id="txtDat2"><?php echo @$datax[2]; ?></textarea></td>
    <td width="21">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="98"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td height="27">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="135">&nbsp;</td>
    <td width="317">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><?php
	if( @$_GET["msetupid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new meeting\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('meetings.php','content','')"  /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="46"></td>
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
</body>
