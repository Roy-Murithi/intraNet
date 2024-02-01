<?php

session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
function CompID() 
		{$rs=@mysql_query("select * from sm_main_complaint");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{ 
			$counts=$counts+1;
			$compidx="IPOA/CMU/".$counts."/2015";
			$rs1=@mysql_query("select * from sm_main_complaint where `complaintid`='$compidx'");
	echo $compidx;
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
	}
}while($dup =0);}
//include "globalfunc.php";

if(@$_GET["complaintid"]!="" or @$_GET["zindex"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."complaint where `complaintid`='".@$_GET['complaintid']."'");
	}else
	{
		
		$rs=@mysql_query("select * from ".$pref."complaint where `complaintid`='".@$_GET['complaintid']."' and `index`='".@$_GET['zindex']."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
		$rs=@mysql_query("select * from ".$pref."complaintdetails where `complaintid`='".@$_GET['complaintid']."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$dataz=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" || document.frmUsers.txtDat0.value=="" )
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
<link rel="stylesheet" type="text/css" media="all" href="../datepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../datepick/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"txtDat7",
			dateFormat:"%Y/%m/%d"
		});
		
	};
</script>
<body>
<form action="savecomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="9" valign="top">Add complaint </td>
    <td width="18">&nbsp;</td>
    <td width="54">&nbsp;</td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="11" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="12"></td>
    <td width="47"></td>
    <td width="162"></td>
    <td width="10"></td>
    <td width="81"></td>
    <td width="54"></td>
    <td width="26"></td>
    <td width="73"></td>
    <td width="218"></td>
    <td width="21"></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Complaint Number: </div></td>
    <td></td>
    <td colspan="8" valign="top"><input name="txtDat0" type="text" class="STR1" id="txtDat0" strlen(18) value="<?php echo CompID(); ?>"
/></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td valign="top"><div align="right"><strong>Complaint  type</strong>: </div></td>
    <td></td>
    <td colspan="7" valign="top"><select name="txtDat26"   class="STR1" id="txtDat26" style="width:300px;">
      <option value="Complainant Report" <?php if(@$datax[26]=="Complainant Report"){echo "selected=\"selected\"";} ?>>Complainant Report</option>
      <option value="Notification" <?php if(@$datax[26]=="Notification"){echo "selected=\"selected\"";} ?>>Notification</option>
      <option value="Own motion" <?php if(@$datax[26]=="Own motion"){echo "selected=\"selected\"";} ?>>Own motion</option>	
    </select></td>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr>
    <td height="43"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Complaint  category:</div></td>
    <td>&nbsp;</td>
    <td colspan="8" valign="top">
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
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$datax[0]; ?>"/>
      <input name="zindex" type="hidden" id="zindex"  value="<?php echo @$_GET['zindex']; ?>"/>
      <div id="infor"><?php echo $tempData; ?></div></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">complaint desciption:</div></td>
    <td></td>
    <td colspan="5" rowspan="2" valign="top"><textarea name="txtDat1" id="txtDat1"><?php echo @$datax[1]; ?></textarea></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="98"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
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
    <td></td>
    </tr>
  <tr>
    <td height="5"></td>
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
    <td></td>
    </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td valign="top"><div align="right">Priority:</div></td>
    <td></td>
    <td valign="top"><input name="status" type="radio" value="0" <?php if(@$datax[25]!="99"){echo "checked";}?>>
      Ordinary</td>
    <td colspan="2" valign="top"><input name="status" type="radio" value="98" <?php if(@$datax[25]=="98"){echo "checked";}?>>
      Medium</td>
    <td valign="top"><input name="status" type="radio" value="99" <?php if(@$datax[25]=="99"){echo "checked";}?>> 
    High</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  <tr>
    <td height="24"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Age group of affected : </div></td>
    <td></td>
    <td colspan="5" valign="top">
	<select name="txtDatx1" id="txtDatx1">
		<option value="Infant" <?php if(@$dataz[1]=="Infant"){echo "selected=\"selected\"";} ?>>Infant</option>
		<option value="Child" <?php if(@$dataz[1]=="Child"){echo "selected=\"selected\"";} ?>>Child</option>
		<option value="Adult" <?php if(@$dataz[1]=="Adult" || @$dataz[1]==""){echo "selected=\"selected\"";} ?>>Adult</option>
		<option value="Senior citizen" <?php if(@$dataz[1]=="Senior citizen"){echo "selected=\"selected\"";} ?>>Senior citizen</option>
	</select>
	</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="25"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Complaint lodge mode : </div></td>
    <td></td>
    <td colspan="5" valign="top"><select name="txtDatx2" id="txtDatx2">
      <option value="Email" <?php if(@$dataz[2]=="Email"){echo "selected=\"selected\"";} ?>>Email</option>
      <option value="Social media" <?php if(@$dataz[2]=="Social media"){echo "selected=\"selected\"";} ?>>Social media</option>
      <option value="Mail" <?php if(@$dataz[2]=="Mail"){echo "selected=\"selected\"";} ?>>Mail</option>
      <option value="Telephone" <?php if(@$dataz[2]=="Infant"){echo "selected=\"selected\"";} ?>>Telephone</option>
	  <option value="Walk in" <?php if(@$dataz[2]=="Walk in" || @$dataz[2]==""){echo "selected=\"selected\"";} ?>>Walk in</option>
	  <option value="Website" <?php if(@$dataz[2]=="Website"){echo "selected=\"selected\"";} ?>>Website</option>
    </select></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="23"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">County : </div></td>
    <td></td>
    <td colspan="5" valign="top"><select name="txtDatx3" id="txtDatx3">
	    <?php
		$rs=@mysql_query("select * from ".$pref."county order by `county` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$datac=mysql_fetch_array($rs);
					if($datac[1]==@$datax[9])
					{
						$selected="selected=\"selected\"";
					}else
					{
						$selected="";
					}
					echo "<option value=\"$datac[1]\" $selected >$datac[1]</option>\n";
				}
			}
		}
		?>
        </select></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Complainant nature : </div></td>
    <td></td>
    <td colspan="5" valign="top"><select name="txtDatx4" id="txtDatx4">
      <option value="Entity/Organiation" <?php if(@$dataz[4]=="Entity/Organiation"){echo "selected=\"selected\"";} ?>>Entity/Organiation</option>
      <option value="Civilian"   <?php if(@$dataz[4]=="Civilian" || @$dataz[4]==""){echo "selected=\"selected\"";} ?>>Civilian</option>
      <option value="Police" <?php if(@$dataz[4]=="Police"){echo "selected=\"selected\"";} ?>>Police</option>
    </select></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td valign="top"><div align="right">Police station involved : </div></td>
    <td></td>
    <td colspan="5" valign="top"><input name="txtDatx5" type="text" class="STR1" id="txtDatx5" value="<?php echo @$dataz[5]; ?>" /></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="21"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Nature of Complaint : </div></td>
    <td></td>
    <td colspan="5" valign="top">
	<select name="txtDatx6" id="txtDatx6">
		<option value="New complaint" <?php if(@$dataz[6]=="New complaint" || @$dataz[6]=="" ){echo "selected=\"selected\"";} ?>>New complaint</option>
		<option value="Follow up" <?php if(@$dataz[6]=="Follow up"){echo "selected=\"selected\"";} ?>>Follow up</option>
		<option value="Refferals" <?php if(@$dataz[6]=="Refferals" ){echo "selected=\"selected\"";} ?>>Refferals</option>
		<option value="Own Motions" <?php if(@$dataz[6]=="Own Motions"){echo "selected=\"selected\"";} ?>>Own Motions</option>
    </select>
    </td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="31"></td>
    <td>&nbsp;</td>
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
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><?php
	if( @$_GET["complaintid"]!="" or @$_GET["zindex"]!="")
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
    <td></td>
    </tr>
</table>
</form>
</body>
