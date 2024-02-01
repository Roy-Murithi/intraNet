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
	$temp[1]="Deputy Director Finance and Planning";
	$temp[2]="Deputy Director Legal Services";
	$temp[3]="Deputy Director Inspections, Monitoring and Preventive Services";
	$temp[4]="Deputy Director Legal Services";
	$temp[5]="Deputy Director Investigations and Forensics Services";
	$temp[6]="Deputy Director,Complaints Management and Counselling Services";
        $temp[8]="Deputy Director Human Resource Management";
        $temp[9]="Deputy Director ICT";

	$temp[10]="Senior Assistant Director, Monitoring and Preventive Services";
	$temp[11]="Senior Assistant Director, Counselling Services";
	$temp[12]="Senior Assistant Director, Prosecution and Litigation";
	$temp[13]="Senior Assistant Director, Investigations";
	$temp[14]="Senior Assistant Director, Forensics";
	$temp[15]="Senior Assistant Director, Legal";
	$temp[16]="Senior Assistant Director, Complaints Management and Call Center";
	$temp[17]="Senior Assistant Director of Communication and Outreach";
	$temp[18]="Senior Assistant Director, Supply Chain Management";
	$temp[19]="Senior Assistant Director, Finance";
	$temp[20]="Senior Assistant Director, Security Services";
	$temp[21]="Senior Assistant Director, Human Resource and Administration";
	$temp[22]="Senior Assistant Director, Accounts";
	$temp[23]="Senior Assistant Director, Internal Audit and Risk";
	$temp[24]="Senior Assistant Director, Planning";
	$temp[25]="Senior Assistant Director, ICT";
        $temp[26]="Senior Assistant Director, Inspections";
        $temp[27]="Senior Assistant Director, Communications";
        $temp[28]="Senior Assistant Director, Legal Audit, Human rights and Compliance";
        $temp[29]="Senior Assistant Director, Regional Cordination";
        $temp[30]="Senior Assistant Director, Research Policy and Strategy";
        $temp[31]="Senior Assistant Director, Administration";
        $temp[32]="Senior Assistant Director, Records Management";
	
	$temp[33]="Principal Officer, Preventive Services";
	$temp[34]="Senior Systems, Network, and Security Administrator";

	$temp[35]="Principal Communications Officer";
	$temp[35]="Principal Performance and Evaluation Officer";
	$temp[37]="Principal Human Resource Officer";
	$temp[38]="Principal Inspection Officer";
	$temp[39]="Principal Strategy and Research officer";
	$temp[40]="Principal Finance/Accounts Officer";
	$temp[41]="Principal Risk and Audit Officer";
	$temp[42]="Principal Supply Chain Management Officer";
	$temp[43]="Principal Monitoring Office";
	$temp[44]="Principal Research Officer";
	$temp[45]="Principal Office Administrator ";
	$temp[46]="Principal Investigations Officer";
	$temp[47]="Principal Forensic officer";
	$temp[48]="Principal Security Officer";
	$temp[49]="Principal Legal Officer";
	$temp[50]="Principal Complaints Management Officer";
	$temp[51]="Principal Counseling Officer";
        $temp[52]="Principal Accountant";
	$temp[53]="Principal Systems, Network, and Security Administrator";

	
	$temp[54]="Senior Communications Officer";
	$temp[55]="Senior Planning, Monitoring and Evaluation Officer";
	$temp[56]="Senior Psychologist";
	$temp[57]="Senior Legal Officer";
	$temp[58]="Senior Human Resource Officer";
	$temp[59]="Senior Supply Chain Management Officer";
	$temp[60]="Senior Research officer";
	$temp[61]="Senior Records Officer";
	$temp[62]="Senior Risk and Audit Officer";
	$temp[63]="Senior Database and Applications Administrator";
	$temp[64]="Senior Security Officer ";
	$temp[65]="Senior Monitoring Officer";
	$temp[66]="Senior Investigations Officer";
	$temp[67]="Senior Administration Officer";
	$temp[68]="Senior Accountant";
	$temp[69]="Senior Procurement Officer";
	$temp[70]="Senior Inspection Officer";
	$temp[71]="Senior Complaints Management officer";
	$temp[72]="Senior Counseling Officer";
	$temp[73]="Senior Office Assistant";
	$temp[74]="Senior Clerical Officer";
	$temp[75]="Senior Security Officer";
	$temp[76]="Senior Forensic officer";
	$temp[77]="Senior Driver";
	$temp[78]="Senior Officer, Preventive Services";
	$temp[79]="CEO-Secretary";
 
	$temp[80]="Finance Officer/Accountant";
	$temp[80]="Planning, Monitoring and Evaluation Officer";
	$temp[81]="Monitoring Officer";
	$temp[82]="Communication and Outreach Officer"; 	
	$temp[83]="Human Resource Officer";
	$temp[84]="Support Staff";
	$temp[85]="Supply Chain Management Officer";
	$temp[86]="Strategy and Research Officer";
	$temp[87]="Records Management Officer";
	$temp[88]="Risk and Audit Officer";
	$temp[89]="Investigations Officer";
	$temp[90]="Senior Customer Care Assistant";
	$temp[91]="Psychologist";
	$temp[92]="Procurement Officer";
	$temp[93]="Security Officer";
	$temp[94]="Complaints Management Officer";
	$temp[95]="Complaints Officer";
	$temp[96]="Clerical Officer";
	$temp[97]="Legal Officer";
	$temp[98]="Accountant";
        $temp[99]="Accountant II";
	$temp[100]="Audit Assistant";
	$temp[101]="Driver";
	$temp[102]="Board Chair";
	$temp[103]="Board Member";
	$temp[104]="Chief Clerical Officer-Accounts";
	$temp[105]="Chairperson";
	$temp[106]="Vice Chairperson";
	$temp[107]="Commissioner";
	$temp[108]="Regional Coordinator";
	$temp[109]="Head of Regions";
	$temp[110]="Database and Systems Analyst";
	$temp[111]="Inspections Officer";
	$temp[112]="Senior Monitoring Officer";
	$temp[113]="Senior Inspections Officer";
        $temp[114]="Human Resource Assistant";
        $temp[115]="Senior Records Management Assistant";

        $temp[116]="Assistant Director, Monitoring and Preventive Services";
	$temp[117]="Assistant Director, Counselling Services";
	$temp[118]="Assistant Director, Prosecution and Litigation";
	$temp[119]="Assistant Director, Investigations";
	$temp[120]="Assistant Director, Forensics";
	$temp[121]="Assistant Director, Legal";
	$temp[122]="Assistant Director, Complaints Management";
	$temp[123]="Assistant Director, Communication";
	$temp[124]="Assistant Director, Supply Chain Management";
	$temp[125]="Assistant Director, Finance";
	$temp[126]="Assistant Director, Security Services";
	$temp[127]="Assistant Director, Human Resource";
	$temp[128]="Assistant Director, Accounts";
	$temp[129]="Assistant Director, Internal Audit and Risk";
	$temp[130]="Assistant Director, Planning";
	$temp[131]="Assistant Director, Systems, Network, and Security";
        $temp[132]="Assistant Director, Inspections";
        $temp[133]="Assistant Director, Regional Office";
        $temp[134]="Assistant Director, Legal Audit, Human rights and Compliance";
        $temp[135]="Assistant Director, Legal";
        $temp[136]="Assistant Director, Research Policy and Strategy";
        $temp[137]="Assistant Director, Administration";
        $temp[138]="Assistant Director, Records Management";

        $temp[139]="Chief Clerical Officer-Human Resource";
        $temp[140]="Chief Clerical Officer-Administration";
        $temp[141]="Principal Administration Officer";
        $temp[142]="Senior Customer Care Assistant";
       

       



	
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
    <td valign="top"><div align="right"> Directorate:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top">
    
	<?php // These are the Directorates
	$tempdept=array();
	$tempdept[0]="Board";
	$tempdept[1]="Investigations and Forensics Services Directorate";
	$tempdept[2]="Complaints Management and Counselling Services Directorate";
	$tempdept[3]="Legal Services Directorate";
	$tempdept[4]="Inspections, Monitoring and Preventive Services Directorate";
	$tempdept[5]="Finance and Planning Direcorate";
	$tempdept[6]="Human Resource and Administration Directorate";
	$tempdept[7]="ICT Directorate";
		
	?>
	<select name="txtDat7" id="txtDat7">
      <option value="none">Select Directorate</option>
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
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right"> Department:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top">
    
	<?php // These are the Departments
	$tempdept=array();
	$tempdept[0]="Board";
	$tempdept[1]="Administration";
	$tempdept[2]="Business Services";
	$tempdept[3]="CEO's Office";
	$tempdept[4]="Corporate Communications";
	$tempdept[5]="Prosecution and Litigation";
	$tempdept[6]="Complaints Management";
	$tempdept[7]="Counselling Services";
	$tempdept[8]="Finance and Accounts";
	$tempdept[9]="Human Resource";
	$tempdept[10]="ICT";
	$tempdept[11]="Monitoring, and Preventive Services";
	$tempdept[12]="Investigations";
	$tempdept[13]="Legal Services";
	$tempdept[14]="Planning Monitoring and Evaluation";
	$tempdept[15]="Supply Chain Management";
	$tempdept[16]="Internal Audit";
	$tempdept[17]="Security Services";
 	$tempdept[18]="Regional Offices";
        $tempdept[19]="Legal Audit, Human rights and Compliance";
        $tempdept[20]="Inspections";
        $tempdept[21]="Finance";
        $tempdept[22]="Accounts";
        $tempdept[23]="Planning";
        $tempdept[24]="Records Management";
        $tempdept[25]="Forensics";
        $tempdept[26]="Research Policy and Strategy";
	
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

