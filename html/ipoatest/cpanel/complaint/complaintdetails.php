<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$complaintid=@$_GET['complaintid'];
$index=@$_GET['index'];
if(@$_GET["complaintid"]!="")
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
	if(!$datax)
	{
		header("location:complaint.php?index=$index&sessid=smetsysmocmas");
	}
}else
{?>
	<html>
		<script language="javascript" src="../scripts/counterajax.js"></script>
		<script language="javascript">
			alert("Error fetching the Complaints details");
			getPage("complaint.php","content","index=<?php echo Index;?>");
		</script>
	</html>
<?php
	exit;
}

function getPersons($pref,$field,$datax,$index)
{
	$temp=array();
	$div="";
	$datax[(int)$field]=str_replace("-","",$datax[(int)$field]);
	if($datax[(int)$field]!="")
	{
		$temp=explode("!~!",$datax[(int)$field]);
		for($x=0;$x<sizeof($temp);$x++)
		{
			$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='". @$temp[$x] ."'");
			
			if($rs1)
			{
				$counts1=@mysql_num_rows($rs1);
				if ($counts1>0)
				{
					$datap=@mysql_fetch_array($rs1);
					$onbehalfname="" ;
					if(@$datap[22]!="")
					{
						$rs2=@mysql_query("select * from ".$pref."persons where `personsid`='$datap[22]'");
						if($rs2)
						{
							$counts2=@mysql_num_rows($rs2);
							if ($counts2>0)
							{
								$dataz=@mysql_fetch_array($rs2);
								$onbehalfname="on behalf of $dataz[2]. $dataz[3] $dataz[4] $dataz[5]";
							}
						}
					}
					$deldiv="<a class=\"flink\" href=\"delpersonsid.php?personsid=$datap[0]&complaintid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px;padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;position:absolute;top:3px;left:5;\"><img src=\"../images/ico_drop.png\" /></div></a>";
					
					if($datap[20]=="99")
					{
						$div=$div."<div style=\"float:left;position:relative;\" ><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">Anonymous complainant: $datap[2]($datap[3]) </div>$deldiv</div>";
					}else
					{
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"persons.php?personsid=$datap[0]&complaintid=$datax[0]&sessid=smetsysmocmas&index=$index&fld=$field\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">$datap[2]. $datap[3] $datap[4] $datap[5] $onbehalfname</div></a> $deldiv</div>";
					}
				}
			}
		}
		return $div;
	}
}
function getAddP($field,$datax,$index)
{
	$div="";
	if($field==2)
	{
		$div="<a class=\"flink\" href=\"personsid.php?complaintid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}elseif($field==3)
	{
		$div="<a class=\"flink\" href=\"personsid.php?complaintid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}elseif($field==4)
	{
		$div="<a class=\"flink\" href=\"personsid.php?complaintid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}
	return $div;
}
function getAddE($datax,$index)
{

	$div="<a class=\"flink\" href=\"evidence.php?complaintid=$datax[0]&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	return $div;
}
function getEvidence($pref,$datax,$index)
{
	$temp=array();
	$div="";
	$datax[18]=str_replace("-","",$datax[18]);
	if($datax[18]!="")
	{
		$temp=explode("!~!",$datax[18]);
		for($x=0;$x<sizeof($temp);$x++)
		{
			$rs1=@mysql_query("select * from ".$pref."evidence where `evidenceid`='". @$temp[$x] ."'");
			
			if($rs1)
			{
				$counts1=@mysql_num_rows($rs1);
				if ($counts1>0)
				{
					$datap=@mysql_fetch_array($rs1);

					if($datap[2]!="none"){$strEv="<a class=\"flink\" href=\"../$datap[2]\" target=\"_blank\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">$datap[1] (View File)</div></a>";}else{$datap[1]=str_replace("\n","<br />",$datap[1]);
					$strEv="<div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">$datap[1]</div>";}
					$deldiv="<a class=\"flink\" href=\"delevidenceid.php?evidenceid=$datap[0]&complaintid=$datax[0]&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px;padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;position:absolute;top:3px;left:5;\"><img src=\"../images/ico_drop.png\" /></div></a>";
					$div=$div."<div style=\"float:left;position:relative;\" >$strEv $deldiv</div>";
				}
			}
		}
		return $div;
	}
}
?><head>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}

-->
</style>
</head>

 <form action="savecomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">

 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="3" valign="top">Editing of Involved persons by Complaints officers</td>
    <td colspan="4" valign="top"><div align="right" style="font-size:20px;"><?php echo "Complaint file N<u>o</u>: ".@$datax[0];?></div></td>
    </tr>
  <tr>
    <td height="13" colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="22" colspan="5" valign="top">Complaint  (<?php echo @$datax[26];?>) </td>
    <td colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td width="15" height="63"></td>
    <td colspan="5" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo @$datax[1];?></td>
    <td width="63" valign="top"><?php echo getUrgent($pref,@$datax[0],25,60);?></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td width="23"></td>
    <td width="348">&nbsp;</td>
    <td width="115">&nbsp;</td>
    <td colspan="3" valign="top"><div align="right">
      <?php

	  if(getPersons($pref,2,$datax,$index)=="" || getPersons($pref,3,$datax,$index)=="")
	  {
	  		$script= "alert('You must provide atleast one complainant and atleast one defedant')";
	  }else
	  {
			$script="getPage('savecommit.php','content','complaintid=$datax[0]&sessid=smetsysmocmas&index=$index')";
	  }	   
		echo classBTN("btnApprove","Submit for Approval","#","","$script"); 
		?>
    </div></td>
    </tr>
  
  
  <tr>
    <td height="6" colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  
  <tr>
    <td height="21">&nbsp;</td>
    <td colspan="6" valign="top">Complainant(s)</td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,2,$datax,$index); ?>&nbsp;<?php echo getAddP(2,$datax,$index); ?></td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="6" valign="top">Suspect Police </td>
  </tr>
  <tr>
    <td height="86">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,3,$datax,$index); ?>&nbsp;<?php echo getAddP(3,$datax,$index); ?></td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="6" valign="top">Witnesses</td>
  </tr>
  <tr>
    <td height="71">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,4,$datax,$index); ?>&nbsp;<?php echo getAddP(4,$datax,$index); ?></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td colspan="6" valign="top">Evidence</td>
  </tr>
  <tr>
    <td height="78"></td>
    <td>&nbsp;</td>
    <td colspan="5" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getEvidence($pref,$datax,$index); ?>&nbsp;<?php echo getAddE($datax,$index); ?></td>
  </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="77"></td>
    <td width="59"></td>
    <td></td>
    </tr>
<td colspan="3" valign="bottom" align="right"><input name="Button2" type="button" class="BTN" value="Entry Complete" style="width:100px;" onClick="getPage('complaint.php','content','')"  /></td>
</table>
</form>

