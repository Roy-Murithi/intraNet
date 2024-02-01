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
$nationalID=@$_GET["nationalID"];
$index=@$_GET["index"];
$field=@$_GET["fld"];

if(@$_GET["personsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."persons where `personsid`='".@$_GET['personsid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."persons where `personsid`='".@$_GET['personsid']."'");
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
$person="Complainant";
 if(@$_GET['fld']=="2"){$person="Complainant";}elseif(@$_GET['fld']=="3"){$person="Defedant";}elseif(@$_GET['fld']=="4"){$person="Witness";}
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat2.value=="" )
			{
				alert("Enter valid infor about source");
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
<form action="save_un_persons.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<input name="fld" type="hidden" id="fld"  value="<?php echo @$field; ?>"/>
<input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$complaintid; ?>"/>
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="6" height="21">&nbsp;</td>
    <td colspan="9" valign="top">Add anonymous complainant details </td>
    <td width="27">&nbsp;</td>
    </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="10" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="2"></td>
    <td width="44"></td>
    <td width="2"></td>
    <td width="158"></td>
    <td width="4"></td>
    <td width="10"></td>
    <td width="147"></td>
    <td width="175"></td>
    <td width="146"></td>
    <td width="20"></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><div align="right">Source:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat2" type="text" class="STR1" id="txtDat2" style="width:300px;" value="<?php echo @$datax[2]; ?>" /></td>
    <td colspan="3" valign="top">e.g Social media, anonymous e.t.c </td>
    </tr>
  
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
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
    <td></td>
    <td colspan="2" valign="top"><div align="right">Short description:</div></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top">
	<textarea name="txtDat3" class="STR1" id="txtDat3" style="width:300px;" ><?php echo @$datax[3]; ?></textarea></td>
    <td colspan="3" valign="top">e.g facebook social network, unamed person e.t.c </td>
    </tr>
  
 
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><?php
	if( @$_GET["personsid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"add anonymous\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td colspan="2" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('contact.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
</body>

