<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["complaintid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."complaint where `complaintid`='".@$_GET['complaintid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."complaint where `complaintid`='".@$_GET['complaintid']."'");
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
				alert("Enter valid complaint");
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
<form action="savecomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="9" valign="top">Add complaint </td>
    <td width="72">&nbsp;</td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="10" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td width="47"></td>
    <td width="162" valign="top"><div align="right"><strong>Complaint  type</strong>: </div></td>
    <td width="10"></td>
    <td colspan="7" valign="top"><select name="txtDat26"   class="STR1" id="txtDat26" style="width:300px;">
	<option value="Complainant Report" <?php if(@$datax[26]=="Complainant Report"){echo "selected=\"selected\"";} ?>>Complainant Report</option>
	<option value="Notification" <?php if(@$datax[26]=="Notification"){echo "selected=\"selected\"";} ?>>Notification</option>
	<option value="Own motion" <?php if(@$datax[26]=="Own motion"){echo "selected=\"selected\"";} ?>>Own motion</option>	
	</select></td>
    </tr>
  
  
  <tr>
    <td height="43"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Complaint  category:</div></td>
    <td>&nbsp;</td>
    <td colspan="7" valign="top">
	<select name="txtDat5" id="txtDat5" onChange="var tempx=document.getElementById('infor'); tempx.innerHTML=document.temp[this.options.selectedIndex];">
	  <?php
		$rs=@mysql_query("select * from ".$pref."complaintnature order by `natureid` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$datac=mysql_fetch_array($rs);
					if($datac[0]==@$datax[5])
					{
						$selected="selected=\"selected\"";
						$tempData=$datac[2];
					}else
					{
						$selected="";
					}
					echo "<option value=\"$datac[0]\" $selected >$datac[1]</option>\n";
				}
			}
		}
		?>
	  </select>
	<script language="javascript">
		document.temp=new Array();
		<?php
		$rs=@mysql_query("select * from ".$pref."complaintnature order by `natureid` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					
					$datac=mysql_fetch_array($rs);					
					if(@$datax[0]=="" && $x==0){$tempData=$datac[2]; }
					echo "document.temp[$x]=\"$datac[2]\";\n";
				}
			}
		}
		?>
	</script>	
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$datax[0]; ?>"/><div id="infor"><?php echo @$tempData; ?></div></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">complaint desciption:</div></td>
    <td></td>
    <td colspan="5" rowspan="2" valign="top"><textarea name="txtDat1" id="txtDat1"><?php echo @$datax[1]; ?></textarea></td>
    <td width="21"></td>
    <td></td>
    </tr>
  <tr>
    <td height="98"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Incident Location: </div></td>
    <td></td>
    <td colspan="5" valign="top"><input name="txtDat6" type="text" class="STR1" id="txtDat6" style="width:300px;" value="<?php echo @$datax[6]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Incident Date: </div></td>
    <td></td>
    <td colspan="5" valign="top"><input name="txtDat7" type="text" class="STR1" id="txtDat7" value="<?php echo @$datax[7]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="5"></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="81"></td>
    <td width="54"></td>
    <td width="26"></td>
    <td width="73"></td>
    <td width="218"></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="31"></td>
    <td></td>
    <td valign="top"><div align="right">Priority:</div></td>
    <td></td>
    <td valign="top"><input name="status" type="radio" value="0" <?php if(@$datax[25]!="99"){echo "checked";}?>>
      Ordinary</td>
    <td colspan="2" valign="top"><input name="status" type="radio" value="98" <?php if(@$datax[25]=="98"){echo "checked";}?>>
      Medium</td>
    <td valign="top"><input name="status" type="radio" value="99" <?php if(@$datax[25]=="99"){echo "checked";}?>> 
    High</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="47"></td>
    <td></td>
    <td>&nbsp;</td>
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
    <td colspan="2" valign="top"><?php
	if( @$_GET["complaintid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new complaint\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td colspan="3" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('complaint.php','content','')"  /></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>
</body>
