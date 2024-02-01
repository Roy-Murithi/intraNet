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
$filecheckid=@$_GET["filecheckid"];

if($filecheckid!="")
{
		$rs=@mysql_query("select * from ".$pref."filecheck where `filecheckid`='$filecheckid'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
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
				alert("Enter valid check");
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
<form action="saveeditfilecheck.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$index;?>" />
<input type="hidden" name="filecheckid" value="<?php echo @$datax[0];?>" />

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="8" valign="top">Edit file check </td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td colspan="2" rowspan="2" valign="top"><div align="right">Check name: </div></td>
    <td width="12"></td>
    <td width="98"></td>
    <td width="16"></td>
    <td width="102"></td>
    <td width="308"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  <tr>
    <td height="34"></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" size="50" value="<?php echo @$datax[1];?>" /></td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  
  <tr>
    <td height="25"></td>
    <td colspan="2" valign="top"><div align="right">Mandatory:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input name="mand" type="radio" value="99" <?php if(@$datax[2]=="99" || @$datax[2]==""){ echo "checked=\"checked\"";}?> />
      Yes 
      <input name="mand" type="radio" value="0" <?php if(@$datax[2]=="0"){ echo "checked=\"checked\"";}?> />
      No</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="25"></td>
    <td width="95">&nbsp;</td>
    <td width="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td colspan="3" valign="top"><div align="right">
      <?php
		$script="saveUser()";
		echo classBTN("btnReturn","save Check","#","","$script","#FF0000"); 
		?>
    </div></td>
    <td>&nbsp;</td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('filecheck.php','content','<?php echo "complaintid=$complaintid&index=$index&sessid=smetsysmocmas";?>')"  /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td height="243"></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="16"></td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</form>

