<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$action=@$_GET["action"];
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];


if($complaintid!="")
{
	if(@$_GET["del"]=="99")
	{
			if($action==0)
			{
				$strData= "findings";
			}elseif($action==1)
			{
				$strData= "recommendation";
			}elseif($action==2)
			{
				$strData="remarks";
			}elseif($action==3)
			{
				$strData= "conclusion";
			}
			$query="update ".$pref."investigation set `$strData`=''  where `complaintid`='$complaintid'";
			$rs=@mysql_query($query);
			header("location:myinvestigationdetails.php?complaintid=$complaintid&index=$index&sessid=smetsysmocmas");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."investigation where `complaintid`='".@$_GET['complaintid']."'");
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
				alert("Enter valid complaint name");
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
<form action="saveinv.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Edit <?php
	if($action==0)
	{
		$strData= "findings";
	}elseif($action==1)
	{
		$strData= "recommendation";
	}elseif($action==2)
	{
		$strData="remarks";
	}elseif($action==3)
	{
		$strData= "conclusion";
	}
	  echo $strData;?></td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="12"></td>
    <td width="273"></td>
    <td width="279"></td>
    <td width="5"></td>
    <td width="102"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  <tr>
    <td height="220"></td>
    <td></td>
    <td colspan="4" valign="top">
	<?php
	$strData="";
	if($action==0)
	{
		$strData= @$datax[4];
	}elseif($action==1)
	{
		$strData= @$datax[5];
	}elseif($action==2)
	{
		$strData= @$datax[6];
	}elseif($action==3)
	{
		$strData= @$datax[7];
	}
	if($strData=="-"){$strData="";}
	?>
	<textarea name="txtDat1" style="width:600px; height:250px;"><?php echo $strData; ?></textarea>
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$datax[1]; ?>" />
	  <input name="action" type="hidden" id="complaintid"  value="<?php echo @$action; ?>"/>
	  </td>
    <td></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">
      <?php
	if( @$_GET["complaintid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new complaint\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?>
    </div></td>
    <td>&nbsp;</td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('myinvestigationdetails.php','content','<?php echo "complaintid=$complaintid&index=$index&sessid=smetsysmocmas";?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="54"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="16"></td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</form>

