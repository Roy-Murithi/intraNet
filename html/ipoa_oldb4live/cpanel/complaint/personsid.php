<?php

ob_start(); // added to take care of Warning: Cannot modify header information - headers already sent by (output started at // /var/www/html/ipoa/globalfunc.php:668) in /var/www/html/ipoa/cpanel/complaint/personsid.php on line 45

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
$datax21=@$_GET["txtDat21"];

if(@$_GET["searchp"]!="")
{
	if(@$_GET["nationalID"]!="")
	{
			if($field==3)
			{
				$rs=@mysql_query("select * from ".$pref."persons where `pf no`='".@$_GET['nationalID']."' and `officer`='Yes'");
			}else
			{
				$rs=@mysql_query("select * from ".$pref."persons where `ID No`='".@$_GET['nationalID']."' and `officer`='No'");
			}
			if($rs)
			{
				$counts=@mysql_num_rows($rs);
				if ($counts>0)
				{
					$datax=@mysql_fetch_array($rs);
					$rs1=@mysql_query("select * from ".$pref."complaint where `complaintid`='$complaintid' and (`complainant` like '%".$datax[0]."!~!%' or `againist` like '%".$datax[0]."!~!%' or `witnesses` like '%".$datax[0]."!~!%')");
					if($rs1)
					{
						$counts1=@mysql_num_rows($rs1);
						if ($counts1>0)
						{
							header("location:persons.php?index=$index&complaintid=$complaintid&fld=$field&sessid=smetsysmocmas&nationalID=$nationalID&txtDat21=$datax21");
					exit;
						}						
					}
				}else
				{
					header("location:persons.php?index=$index&complaintid=$complaintid&fld=$field&sessid=smetsysmocmas&nationalID=$nationalID&txtDat21=$datax21");
					exit;
				}
			}else
			{
				header("location:persons.php?index=$index&complaintid=$complaintid&fld=$field&sessid=smetsysmocmas&nationalID=$nationalID&txtDat21=$datax21");
				exit;
			}
	}else
	{
		header("location:persons.php?index=$index&complaintid=$complaintid&fld=$field&sessid=smetsysmocmas&nationalID=$nationalID&txtDat21=$datax21");
		exit;
	}
}
$person="Complainant";
 if(@$_GET['fld']=="2"){$person="Complainant";}elseif(@$_GET['fld']=="3"){$person="Defedant";}elseif(@$_GET['fld']=="4"){$person="Witness";}
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid persons");
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
<form  action="savepersonsid.php" method="get" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="5" height="21">&nbsp;</td>
    <td colspan="8" valign="top">Enter details for  <?php  echo @$person;?></td>
    <td width="17">&nbsp;</td>
    </tr>
	<?php if(@$person=="Complainant"){?>
  <tr>
    <td height="13" colspan="10" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="18"></td>
    <td colspan="2" valign="top">Anonymous complainant </td>
    <td width="55"></td>
    <td width="150"></td>
    <td width="199"></td>
    <td width="4"></td>
    <td width="102"></td>
    <td width="6"></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td width="21"></td>
    <td width="170"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td></td>
    <td colspan="3" valign="top"><input name="Button22" type="button" class="BTN" value="<?php echo "Add anonymous complainant"; ?>" style="padding-left:10px;padding-right:10px;" onclick="getPage('un_persons.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&fld=<?php echo $field;?>&searchp=yes')"></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="15"></td>
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
  <?php }?>
  <tr>
    <td height="14" colspan="10" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  
  <tr>
    <td height="18"></td>
    <td colspan="2" valign="top">Identified  complainant</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  
  
  
  
  <tr>
    <td height="40"></td>
    <td colspan="3" valign="top"><div align="right">
      <?php if(@$person=="Defedant"){?>Police force N<u>o</u><?php }else{?>National ID N<u>o</u> / Passport N<u>o</u><?php } ?> :</div></td>
    <td colspan="6" valign="top"><input name="nationalID" type="text" class="STR1" id="nationalID" value="<?php echo @$nationalID; ?>" />
      <input name="personsid" type="hidden" id="personsid"  value="<?php echo @$datax[0]; ?>"/>
      <input name="fld" type="hidden" id="fld"  value="<?php echo @$field; ?>"/>
      <input name="index" type="hidden" id="index"  value="<?php echo @$index; ?>"/>
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$complaintid; ?>"/>
	  <input name="sessid" type="hidden" id="sessid"  value="smetsysmocmas"/>	  </td>
    </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6" valign="top"><div align="left" id="trPType2" <?php if(@$person=="Defedant"){echo "style=\"display:block;\"";}else{echo "style=\"display:none;\"";}?>>
          <input name="txtDat21" type="radio" value="AP" onclick="document.allowcmd='99';document.txtDat21='AP';">
          Administration Police 
          <input name="txtDat21" type="radio" value="KP" onclick="document.allowcmd='99';document.txtDat21='KP';" >
          Kenya Police
	  <input name="txtDat21" type="radio" value="DCI" onclick="document.allowcmd='99';document.txtDat21='DCI';" >
          DCI
          <input name="txtDat21" type="radio" value="unkown" onclick="document.allowcmd='99';document.txtDat21='unkown';" >
      Unknown</div></td>
    </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td colspan="2" valign="top"><div align="right">
      <?php if(@$datax[0]!=""){echo "Names";} ?>
    </div></td>
    <td colspan="6" valign="top"><?php if(@$datax[0]!=""){echo "$datax[2]. $datax[3] $datax[4] $datax[5]";} ?></td>
    </tr>
 
  <tr>
    <td height="62"></td>
    <td></td>
    <td colspan="4" valign="top">
	    <div align="right">
	      <?php 
	if(@$datax[0]=="")
	{
		?><?php if(@$person=="Defedant"){$cmdCaption="Lookup Police force number";}else{$cmdCaption="Lookup National ID/Passport";} ?>
	      <input name="Button2" type="button" class="BTN" value="<?php echo $cmdCaption;?>" style="padding-left:10px;padding-right:10px;" onclick="<?php if(@$person=="Defedant"){?>if(document.allowcmd=='99'){getPage('personsid.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&fld=<?php echo $field;?>&searchp=yes&nationalID='+ document.frmUsers.nationalID.value +'&txtDat21='+ document.txtDat21 );}else{alert('Please select the type of police');}<?php }else{?>getPage('personsid.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&fld=<?php echo $field;?>&searchp=yes&nationalID='+ document.frmUsers.nationalID.value +'')<?php }?>"  />
	      <?php
	}else
	{
	?>
	      <input name="Button2" type="submit" class="BTN" value="<?php echo "Add new $person"; ?>" style="padding-left:10px;padding-right:10px;"  />
	      <?php
	}
	?>	
        </div></td>
    <td>&nbsp;</td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onclick="getPage('complaintdetails.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>')"  /></td>
    <td>&nbsp;</td>
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
    <td></td>
  </tr>
</table>
</form>

