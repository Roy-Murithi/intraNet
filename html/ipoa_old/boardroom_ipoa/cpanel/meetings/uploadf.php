<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["meetingsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  meetings where `meetingsid`='".@$_GET["meetingsid"]."'");
	}else
	{
		$rs=@mysql_query("select * from meetings where `meetingsid`='".@$_GET["meetingsid"]."'");
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
$meetingsid=@$_GET['meetingsid'];
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat2.value=="" || document.frmUsers.txtDat5.value=="" || document.frmUsers.txtDat6.value=="" || document.frmUsers.file.value=="" )
			{
				alert("Enter valid Document information");
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
<form action="saveuploadf.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Upload document for      <?php
	$dbase="meetings";
	$unique="meetingsid";
	$unique_value=$meetingsid;
	$field="name";
	echo fetchValue($dbase,$unique,$unique_value,$field);
	?> meeting on <?php
	$dbase="meetings";
	$unique="meetingsid";
	$unique_value=$meetingsid;
	$field="day";
	echo fetchValue($dbase,$unique,$unique_value,$field);
	?></td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td width="47"></td>
    <td width="162" valign="top"><div align="right"><strong>Meeting Name </strong>: </div></td>
    <td width="10"></td>
    <td colspan="3" valign="top">
	<?php echo @$datax[1];?>
	
      <input name="meetingsid" type="hidden" id="meetingsid" value="<?php echo @$meetingsid;?>"></td>
  </tr>
  
  
  <tr>
    <td height="22"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Refference Number: </div></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><input name="txtDat2" type="text" id="txtDat2"></td>
    </tr>
  <tr>
    <td height="21"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">File Details:</div></td>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" valign="top"><textarea name="txtDat4" id="txtDat4" ></textarea></td>
    </tr>
  <tr>
    <td height="101"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td valign="top"><div align="right">Department:</div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat5" type="text" id="txtDat5"></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td valign="top"><div align="right">Submitted by: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat6" type="text" id="txtDat6"></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">File to upload: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input type="file" name="file"></td>
    </tr>
  
  <tr>
    <td height="37"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td width="135"></td>
    <td width="317"></td>
    <td width="93"></td>
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
		echo "<input type=\"button\" name=\"add\" value=\"Upload document\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('schedules.php','content','')"  /></td>
    <td></td>
    </tr>
</table>
</form>
</body>
