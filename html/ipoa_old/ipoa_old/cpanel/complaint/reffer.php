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
$pid=@$_GET["pid"];
$pid1=@$_GET["pid1"];
$uneditableVal=@$_GET["uneditableVal"];

		$rs=@mysql_query("select * from ".$pref."investigation where `complaintid`='".@$_GET['complaintid']."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid reason");
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
<form action="savereffer.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="pid" value="<?php echo @$pid;?>" />
<input type="hidden" name="pid1" value="<?php echo @$pid1;?>" />
<input type="hidden" name="index" value="<?php echo @$index;?>" />
<input type="hidden" name="complaintid" value="<?php echo @$complaintid;?>" />
<input type="hidden" name="uneditableVal" value="<?php echo @$uneditableVal;?>" />

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="7" valign="top">Provide explanation for Refering this complaint </td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="8" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="12"></td>
    <td width="91"></td>
    <td width="266"></td>
    <td width="195"></td>
    <td width="5"></td>
    <td width="102"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  <tr>
    <td height="202"></td>
    <td></td>
    <td colspan="5" valign="top">
	
	  <textarea name="txtDat1" style="width:600px; height:200px;"></textarea>      </td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="10"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td colspan="2" valign="top"><div align="right">Refered to: </div></td>
    <td colspan="4" valign="top"><select name="txtDat2" id="txtDat2">
	<option value="NPSC" <?php if(@$datax[2]=="NPSC"){ echo "selected=\"selected\"";}?>>NPSC</option>
	<option value="IAU" <?php if(@$datax[2]=="IAU"){ echo "selected=\"selected\"";}?>>IAU</option>
	<option value="KSJ" <?php if(@$datax[2]=="KSJ"){ echo "selected=\"selected\"";}?>>KSJ</option> 
    </select></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="16"></td>
    <td></td>
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
    <td valign="top"><div align="right">
      <?php
		//$script="getPage('savereturn.php','content','complaintid=$complaintid&sessid=smetsysmocmas&index=$index&pid=$pid')"; 
		$script="saveUser()";
		echo classBTN1("btnReturn","save and return to Complaints","#","","$script","#FF0000"); 
		?>
    </div></td>
    <td>&nbsp;</td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('<?php echo $pid1;?>.php','content','<?php echo "complaintid=$complaintid&index=$index&sessid=smetsysmocmas";?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
  
  
  
  
  
  <tr>
    <td height="76"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="16"></td>
    <td colspan="8" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</form>

