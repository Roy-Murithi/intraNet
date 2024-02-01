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
				$temprs=mysql_query("update support set viewed='99', viewedby='".$_SESSION['names']."',viewdate='".date("Y/m/d h:i:s")."' where supportid='$datax[0]'");
			}
		}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser(flag)
	{	
			if (flag=="0" )
			{
				document.frmUsers.resolved.value="";
			}
			else
			{
				//save user
				document.frmUsers.resolved.value="99";
								
			}
			document.frmUsers.submit()
	}
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style15 {font-size: 14px}
-->
</style>
<form action="saveprocessrequest.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="6" height="28"></td>
    <td colspan="4" valign="top"><span class="style15">ICT Action on request </span></td>
    <td width="20"></td>
  </tr>
  <tr>
    <td height="20"></td>
    <td width="103" valign="top"><div align="right">Viewed by: </div></td>
    <td width="4">&nbsp;</td>
    <td colspan="3" valign="top"><?php echo _getDirectoryUsername(@$datax[6]);?></td>
    </tr>

  
  
  
  
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">Request involves: </div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><?php echo @$datax[3]; ?>
      <input name="supportid" type="hidden" id="supportid" value="<?php echo @$datax[0]; ?>" /></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="18"></td>
    <td valign="top"><div align="right">Request:</div></td>
    <td></td>
    <td colspan="2" rowspan="2" valign="top" style="border:thin dotted;"> <?php 
					$str=str_replace(" ","&nbsp;",@$datax[2]);
					$str=str_replace("\n","<br />",$str);
					echo @$str; ?> </td>
    <td></td>
  </tr>
  <tr>
    <td height="72"></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="18"></td>
    <td valign="top"><div align="right">Status:</div></td>
    <td></td>
    <td colspan="2" valign="top">
	  <?php 
	if(@$datax[8]=="")
					{
						$att="<font color=\"Red\">Un attended</font>";
					}else
					{
						$att="<font color=\"Green\">Attended</font>";
					}
					echo $att;
	?>	</td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td valign="top"><div align="right">Resolved:</div></td>
    <td></td>
    <td colspan="2" valign="top"><?php 
	if(@$datax[12]=="")
					{
						$att="<font color=\"Red\">Unresolved</font>";
					}else
					{
						$att="<font color=\"Green\">Resolved</font>";
					}
					echo $att;
	?></td>
    <td></td>
  </tr>
  <tr>
    <td height="26"></td>
    <td>&nbsp;</td>
    <td></td>
    <td width="467"></td>
    <td width="116"></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Close" style="width:100px;" onclick="getPage('viewrequest.php','content','')"  /></td>
    <td></td>
  </tr>
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

