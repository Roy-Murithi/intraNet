<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["personid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from person where `personid`='".@$_GET['personid']."'");
	}else
	{
		$rs=@mysql_query("select * from person where `personid`='".@$_GET['personid']."'");
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
				alert("Enter valid person name");
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
<form action="saveperson.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="8" valign="top">Edit person </td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="56"></td>
    <td width="153"></td>
    <td width="10"></td>
    <td width="125"></td>
    <td width="57"></td>
    <td width="136"></td>
    <td width="134"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  <tr>
    <td height="25"></td>
    <td></td>
    <td valign="top"><div align="right">Names:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php echo @$datax[1]; ?>" />
      <input name="personid" type="hidden" id="personid"  value="<?php echo @$datax[0]; ?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Password:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat9" type="text" class="STR1" id="txtDat9" /></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  <tr>
    <td height="30"></td>
    <td></td>
    <td valign="top"><div align="right">Email:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat2" type="text" class="STR1" id="txtDat2" value="<?php echo @$datax[2]; ?>" /></td>
    <td rowspan="4" valign="top"><img src="<?php if(@$datax[0]!="")
		  	{
				if($datax[8]!="99")
				{
					if(is_file("../".$datax[6]))
					{
						echo "../".$datax[6];
						$pic="../".$datax[6];
					}
					else
					{
						echo "../photo/avator.png";
						$pic="../photo/avator.png";
					}
					
				}else
				{
					echo "../photo/group.png";
				}
		  	}
		  else
		  	{
		  		echo "../photo/avator.png";
				$pic="../photo/avator.png";
			}
		  ?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,97); ?>" width="<?php echo getPicW($pic,97); ?>"  /></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Post:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat3" type="text" class="STR1" id="txtDat3" value="<?php echo @$datax[3]; ?>" /></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Extension:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat4" type="text" class="STR1" id="txtDat4" value="<?php echo @$datax[4]; ?>" /></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Office:</div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat5" type="text" class="STR1" id="txtDat5" value="<?php echo @$datax[5]; ?>" /></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Photo:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input type="file" name="file" /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Department:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top">
	<?php
	$temp=array();
	$temp[0]="ICT";
	$temp[1]="Security";
	$temp[2]="Business";
	$temp[3]="Finance";
	$temp[4]="Complaints & Legal";
	$temp[5]="Investigations";
	$temp[6]="Risk and Audit";
	$temp[7]="Inspection and Monitoring";
	$temp[8]="Communications";
	$temp[9]="Human Capital";
	$temp[10]="CEO";
	?>
	<select name="txtDat7" id="txtDat7">
	
		<option value="none">Select a Department</option>
		<?php
		for($x=0;$x<sizeof($temp);$x++)
		{
			if(@$datax[7]==$temp[$x]){$selected= "selected=\"selected\"";}else{$selected= "";}
			echo "<option value=\"$temp[$x]\" $selected >$temp[$x]</option>";
		}
		?>
	</select>	</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td valign="top"><div align="right">E-Mail Type: </div></td>
    <td></td>
    <td valign="top"><input name="txtDat8" type="radio" value="0" <?php if(@$datax[8]=="" || @$datax[8]=="0"){echo "checked=\"checked\"";}?>   />
      Individual </td>
    <td colspan="3" valign="top"><input name="txtDat8" type="radio" value="99" <?php if(@$datax[8]=="99"){echo "checked=\"checked\"";}?> />
      Group</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
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
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><?php
	if( @$_GET["personid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new person\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td colspan="3" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('person.php','content','')"  /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="68"></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

