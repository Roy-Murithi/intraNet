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
				alert("Enter valid Staff name");
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
    <td colspan="8" valign="top">Edit Staff </td>
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
    <td valign="top"><div align="right">Staff Name:</div></td>
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
    <td valign="top"><div align="right">Office Location:</div></td>
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
    <td valign="top"><div align="right"> Position:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top">
    
	<?php // These are Designations/Positions
	$temp=array();
	
	$temp[0]="Chief Executive Officer";
	$temp[1]="Director Business Services";
	$temp[2]="Director Legal Services";
	$temp[3]="Director Investigations Research & Monitoring";
	$temp[4]="Director Complaints Management And Legal Services";
	$temp[5]="Director Investigations";
	
	$temp[7]="Head of Inspections and Monitoring";
	$temp[8]="Head of Strategy and Research";
	$temp[8]="Head of Finance and Accounts";
	$temp[10]="Head of Investigations";
	$temp[11]="Head of Forensics";
	$temp[12]="Head of Legal Services";
	$temp[13]="Head of Complaints";
	$temp[14]="Head of Corporate Communication and Outreach";
	$temp[15]="Head of Supply Chain Management";
	$temp[16]="Head of Procurement";
	$temp[17]="Head of Security Services";
	$temp[18]="Head of Human Capital";
	$temp[19]="Head of Accounts";
	$temp[20]="Head of Risk and Audit";
	$temp[21]="Head of Monitoring Unit";
	$temp[22]="Head of ICT";
	
	$temp[23]="Database Administrator";
	$temp[24]="Network Administrator";
	$temp[25]="System Administrator";

	$temp[26]="Principal Communication and Outreach Officer";
	$temp[27]="Principal Planning, Monitoring and Evaluation Officer";
	$temp[28]="Principal Human Resource Management Officer";
	$temp[29]="Principal Inspection and Monitoring Officer";
	$temp[30]="Principal Strategy and Research officer";
	$temp[31]="Principal Finance/Accounts Officer";
	$temp[32]="Principal Risk and Audit Officer";
	$temp[33]="Principal Network Administrator";
	$temp[34]="Principal Database Administrator";
	$temp[35]="Principal System Administrator";
	$temp[36]="Principal Administration Officer";
	$temp[37]="Principal Investigations Officer";
	$temp[38]="Principal Forensic officer";
	$temp[39]="Principal Security Officer";
	$temp[40]="Principal Legal Officer";
	$temp[41]="Principal Complaints Officer";
	$temp[42]="Principal Counseling Officer";
	
	$temp[43]="Senior Communication and Outreach Officer";
	$temp[44]="Senior Planning, Monitoring and Evaluation Officer";
	$temp[45]="Senior Psychologist";
	$temp[46]="";
	$temp[47]="Senior Human Resource Officer";
	$temp[48]="Senior Supply Chain Officer";
	$temp[49]="Senior Research officer";
	$temp[50]="Senior Records Officer";
	$temp[51]="Senior Risk and Audit Officer";
	$temp[52]="Senior Network Administrator";
	$temp[53]="Senior Database Administrator";
	$temp[54]="Senior Inspection and Monitoring Officer";
	$temp[55]="Senior Investigations Officer";
	$temp[56]="Senior Administration Officer";
	$temp[57]="Senior Accountant";
	$temp[58]="Senior procurement Officer";
	$temp[59]="Senior System Administrator";
	$temp[60]="Senior Complaints  officer";
	$temp[61]="Senior Counseling Officer";
	$temp[62]="Senior Office Assistant";
	$temp[63]="Senior Clerical Officer";
	$temp[64]="Senior Security Officer";
	$temp[65]="Senior Forensic officer";
	$temp[66]="Senior Legal Officer";
	$temp[67]="Senior Driver";
	$temp[68]="Secretary-Chairman";
	$temp[69]="Secretary-CEO";
 
	$temp[70]="Finance Officer/Accountant";
	$temp[71]="Planning, Monitoring and Evaluation Officer";
	$temp[72]="Monitoring Officer";
	$temp[73]="Communication and Outreach Officer"; 	
	$temp[74]="Human Resource Assistant";
	$temp[75]="Supply Chain Management Officer";
	$temp[76]="Strategy and Research Officer";
	$temp[77]="Support Staff";
	$temp[78]="Records Management Officer";
	$temp[79]="Risk and Audit Officer";
	$temp[80]="Investigations Officer";
	$temp[81]="Customer Care Assistant";
	$temp[82]="Psychologist";
	$temp[83]="Security Officer";
	$temp[84]="Complaint Management Officer";
	$temp[85]="Complaints Officer I";
	$temp[86]="Clerical Officer";
	$temp[87]="Legal Officer";
	$temp[88]="Driver";
	
	$temp[]="Assistant Finance Officer/Assistant Accountant";
	$temp[89]="Assistant Human Resource Management Officer";
	$temp[90]="Assistant Supply Chain Management Officer";
	$temp[91]="Assistant Records Management Officer";
 	$temp[92]="Assistant Administration Officer";
	$temp[93]="Assistant Network Administrator";
	$temp[94]="Assistant Procurement Officer";
	$temp[95]="Front Office Assistant II";
	$temp[96]="Front Office Assistant I";
	$temp[97]="Office Assistant";
	
	?>
     
	<select name="txtDat3" id="txtDat3">
      <option value="none">Select Position</option>
      <?php
		for($x=0;$x<sizeof($temp);$x++)
		{
			if(@$datax[3]==$temp[$x]){$selected= "selected=\"selected\"";}else{$selected= "";}
			echo "<option value=\"$temp[$x]\" $selected >$temp[$x]</option>";
		}
		?>
    </select>    </td>
    <td></td>
    <td></td>
  </tr>
  

   <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right"> Department:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top">
    
	<?php // These are the Departments
	$tempdept=array();
	$tempdept[0]="Administration";
	$tempdept[1]="Board";
	$tempdept[2]="Business Services";
	$tempdept[3]="CEO's Office";
	$tempdept[4]="Communication and Outreach";
	$tempdept[5]="Complaints and Legal";
	$tempdept[6]="Complaints Management";
	$tempdept[7]="Counselling Psychology";
	$tempdept[8]="Finance and Accounts";
	$tempdept[9]="Human Resource";
	$tempdept[10]="ICT";
	$tempdept[11]="Inspections and Monitoring";
	$tempdept[12]="Investigations";
	$tempdept[13]="Legal Services";
	$tempdept[14]="Planning Monitoring and Evaluation";
	$tempdept[15]="Procurement";
	$tempdept[16]="Risk and Audit";
	$tempdept[17]="Security Services";
	
	?>
	<select name="txtDat7" id="txtDat7">
      <option value="none">Select Department</option>
      <?php
		for($x=0;$x<sizeof($tempdept);$x++)
		{
			if(@$datax[7]==$tempdept[$x]){$selected= "selected=\"selected\"";}else{$selected= "";}
			echo "<option value=\"$tempdept[$x]\" $selected >$tempdept[$x]</option>";
		}
		?>
    </select></td>
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
		echo "<input type=\"button\" name=\"add\" value=\"Add new Staff\"  class=\"BTN\" onclick=\"saveUser()\">";
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

