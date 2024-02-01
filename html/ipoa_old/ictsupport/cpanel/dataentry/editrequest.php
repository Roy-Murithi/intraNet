<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["supportid"]!="")
{
		$rs=@mysql_query("select * from support where `supportid`='".@$_GET['supportid']."'");
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
			if (document.frmUsers.request.value=="" )
			{
				alert("Enter valid request");
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
.style15 {font-size: 14px}
-->
</style>
<form action="saverequest.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="6" height="28"></td>
    <td colspan="4" valign="top"><span class="style15">Request for ICT Help </span></td>
    <td width="19"></td>
  </tr>
  <tr>
    <td height="5"></td>
    <td width="105"></td>
    <td width="354"></td>
    <td width="131"></td>
    <td width="102"></td>
    <td></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td valign="top">Request involves: </td>
    <td colspan="3" valign="top"><select name="requesttype" >
      <option value="computer" <?php if(@$datax[3]=="computer"){echo "selected=\"selected\"";} ?>>Computer</option>
      <option value="internet" <?php if(@$datax[3]=="internet"){echo "selected=\"selected\"";} ?>>Internet</option>
      <option value="printer" <?php if(@$datax[3]=="printer"){echo "selected=\"selected\"";} ?>>Printer</option>	
      <option value="phone" <?php if(@$datax[3]=="phone"){echo "selected=\"selected\"";} ?>>Phone</option>
      <option value="software" <?php if(@$datax[3]=="software"){echo "selected=\"selected\"";} ?>>Software</option>
      <option value="viruses" <?php if(@$datax[3]=="viruses"){echo "selected=\"selected\"";} ?>>Viruses</option>	
      <option value="others" <?php if(@$datax[3]=="others"){echo "selected=\"selected\"";} ?>>Others</option>	
    </select>
      <input name="supportid" type="hidden" id="supportid" value="<?php echo @$datax[0]; ?>" /></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td valign="top">Request:</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="289"></td>
    <td colspan="4" valign="top"><textarea name="request" id="request" style="width:690px; height:287px;"><?php echo @$datax[2]; ?></textarea></td>
    <td></td>
  </tr>
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="22"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><?php
		echo "<input type=\"button\" name=\"edit\" value=\"Submit request\"  class=\"BTN\" onclick=\"saveUser()\">";
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('request.php','content','')"  /></td>
    <td></td>
  </tr>
</table>
</form>

