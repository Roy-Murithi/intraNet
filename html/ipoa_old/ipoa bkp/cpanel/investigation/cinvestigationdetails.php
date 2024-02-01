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
					if($datap[20]=="99")
					{
						$div=$div."<div style=\"float:left;position:relative;\" ><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">Anonymous complainant: $datap[2]($datap[3]) </div></div>";
					}else
					{
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"viewpersons.php?url=asscomplaintdetails&personsid=$datap[0]&complaintid=$datax[0]&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">$datap[2]. $datap[3] $datap[4] $datap[5] </div></a></div>";
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
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"../$datap[2]\" target=\"_blank\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">File</div></a></div>";
				}
			}
		}
		return $div;
	}
}
function getEvidence1($pref,$datax,$index)
{
	$temp=array();
	$div="";
	$datax[12]=str_replace("-","",$datax[12]);
	if($datax[12]!="")
	{
		$temp=explode("!~!",$datax[12]);
		for($x=0;$x<sizeof($temp);$x++)
		{
			$rs1=@mysql_query("select * from ".$pref."evidence where `evidenceid`='". @$temp[$x] ."'");
			
			if($rs1)
			{
				$counts1=@mysql_num_rows($rs1);
				if ($counts1>0)
				{
					$datap=@mysql_fetch_array($rs1);
					
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"../$datap[2]\" target=\"_blank\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">File</div></a></div>";
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
    <td height="22" colspan="2" valign="top">Closing of investigation by head/deputy director of investigations</td>
    <td colspan="3" valign="top"><div align="right" style="font-size:20px;"><?php $valDat=fetchValue($pref."investigation","complaintid",$complaintid,0);echo "Investigation file N<u>o</u>: ".@$valDat;?></div></td>
    </tr>
  <tr>
    <td height="13" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="22" colspan="4" valign="top">Complaint  (<?php echo @$datax[26];?>) </td>
    <td width="146" valign="top"><?php
		$script="getPage('return.php','content','complaintid=$datax[0]&sessid=smetsysmocmas&index=$index&pid=cinvestigation&pid1=cinvestigationdetails&uneditableVal=95&rtitle=concluded investigation to Investigator&complaintfield=back_to_investigation')"; 
		echo classBTN1("btnReturn","Return to Investigator","#","","$script","#FF0000"); 
		?></td>
  </tr>
  <tr>
    <td width="15" height="55"></td>
    <td colspan="4" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo @$datax[1];?></td>
    </tr>
  <tr>
    <td height="3"></td>
    <td width="361"></td>
    <td width="165"></td>
    <td width="13"></td>
    <td></td>
    </tr>
  <tr>
    <td height="27"></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><div align="right">
      <?php

		
		$script="getPage('filecheckclose.php','content','complaintid=$datax[0]&sessid=smetsysmocmas&index=$index&pid=savecinvestigation&pid1=cinvestigationdetails&uneditableVal=93&rtitle=Close investigation&complaintfield=closed')"; 
		echo classBTN1("btnReturn","Finalize investigation","#","","$script","#FF0000"); 
		?>
    </div></td>
  </tr>
  

  
  
  <tr>
    <td height="6" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
</table>
<div id="canvas01" style="width:700px;">
	<div id="invdetailsh" style="width:700px;">
		<?php 
		echo classBTN("btnDet","Display investigators","#","","var div=document.getElementById('invdetails'); div.style.display='block';var div=document.getElementById('invdetailsh'); div.style.display='none';var div=document.getElementById('invdetailsh1'); div.style.display='block';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="invdetailsh1" style="width:700px; display:none;">
		<?php 
		echo classBTN("btnDet","Hide investigators","#","","var div=document.getElementById('invdetails'); div.style.display='none';var div=document.getElementById('invdetailsh'); div.style.display='block';var div=document.getElementById('invdetailsh1'); div.style.display='none';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="invdetails" style="display:none" >
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="14" height="18"></td>
			<td width="130" valign="top"><div align="right">Lead Investigator: </div></td>
		    <td width="10"></td>
		    <td width="490" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php 
	$invid=fetchValue($pref."investigation","complaintid",$complaintid,2);
	$invnames=fetchValue("staff","staffid",$invid,3);
	$img=fetchValue("staff","staffid",$invid,6);
	echo "<div  style=\" width:26px; height:26px;margin:2px;float:left;\" align=\"center\">";
							?>
              <img src="<?php 
				if(is_file("../../".$img))
				{
		  			echo "../../".$img;
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../../".$img;?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,20); ?>" width="<?php echo getPicW($pic,20); ?>">
              <?php
				echo "</div><div>$invnames</div>";
				
	?>
            &nbsp;</td>
		  </tr>
		  <tr>
		    <td height="7"></td>
		    <td></td>
		    <td></td>
	        <td></td>
		  </tr>
		  <tr>
		    <td height="18"></td>
		    <td valign="top"><div align="right">Support Investigators: </div></td>
		    <td></td>
            <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php 
	$invid1=fetchValue($pref."investigation","complaintid",$complaintid,13);
	$invid1=str_replace("-!~!","!~!",$invid1);
	if($invid1!="")
	{
		$temp=array();
		$temp=explode("!~!",$invid1);
		for($x=0;$x<sizeof($temp);$x++)
		{
			if($temp[$x]!="")
			{
			$invnames=fetchValue("staff","staffid",trim($temp[$x]),3);
			$img=fetchValue("staff","staffid",$temp[$x],6);
			echo "<div style=\"height:30px;\"><div  style=\" width:26px; height:26px;margin:2px;float:left;\" align=\"center\">";
							?>
              <img src="<?php 
				if(is_file("../../".$img))
				{
		  			echo "../../".$img;
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../../".$img;?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,20); ?>" width="<?php echo getPicW($pic,20); ?>">
            <?php
				echo "</div><div style=\"float:left\">$invnames</div>&nbsp;";
			}
			}
		}
		?></td>
		  </tr>
		  <tr>
		    <td height="10"></td>
		    <td></td>
		    <td></td>
           </tr>
		</table>
	</div>
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
			<tr>
			<td height="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
			</tr>
		</table>
</div>
<div id="canvas0" style="width:700px;">
	<div id="historydetailsh" style="width:700px;">
		<?php 
		echo classBTN("btnDet","Display complaint history","#","","var div=document.getElementById('historydetails'); div.style.display='block';var div=document.getElementById('historydetailsh'); div.style.display='none';var div=document.getElementById('historydetailsh1'); div.style.display='block';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="historydetailsh1" style="width:700px; display:none;">
		<?php 
		echo classBTN("btnDet","Hide complaint history","#","","var div=document.getElementById('historydetails'); div.style.display='none';var div=document.getElementById('historydetailsh'); div.style.display='block';var div=document.getElementById('historydetailsh1'); div.style.display='none';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="historydetails" style="display:none;">
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
		  <!--DWLayoutTable-->
		
		  <tr>
			<td width="14" height="21">&nbsp;</td>
			<td width="630" valign="top">Complaint history </td>
		  </tr>
		  <tr>
			<td height="32">&nbsp;</td>
			<td valign="top"  style="background-color:#FFCCCC; border: thin solid #FF9999"><?php 
			$rs=@mysql_query("select * from ".$pref."proclog where `complaintid`='$complaintid' order by `date` desc");
			$valDat="";
			if($rs)
			{
				$counts=@mysql_num_rows($rs);
				if ($counts>0)
				{
					for($x=0;$x<$counts;$x++)
					{
						$datac=mysql_fetch_array($rs);
						if($valDat=="")
						{
							$valDat="$datac[3] (<span style=\"font-size:9px;color:#459933;\">$datac[6] by $datac[4] on $datac[2]</span>)";
						}else
						{
							$valDat=$valDat."<br /><br />$datac[3]  (<span style=\"font-size:9px;color:#459933;\">$datac[6] by $datac[4] on $datac[2]</span>)";				
						}
						
					}
				}
			}
			
			
			echo $valDat;
			
			 ?>&nbsp;</td>
		  </tr>
		  <tr>
		    <td height="19">&nbsp;</td>
		    <td>&nbsp;</td>
	       </tr>
		</table>
	</div>
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
			<tr>
			<td height="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
			</tr>
		</table>
</div>
<div id="canvas" style="width:700px;">
	<div id="complaintdetailsh" style="width:700px;">
		<?php 
		echo classBTN("btnDet","Display persons & evidence","#","","var div=document.getElementById('complaintdetails'); div.style.display='block';var div=document.getElementById('complaintdetailsh'); div.style.display='none';var div=document.getElementById('complaintdetailsh1'); div.style.display='block';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="complaintdetailsh1" style="width:700px; display:none;">
		<?php 
		echo classBTN("btnDet","Hide persons & evidence","#","","var div=document.getElementById('complaintdetails'); div.style.display='none';var div=document.getElementById('complaintdetailsh'); div.style.display='block';var div=document.getElementById('complaintdetailsh1'); div.style.display='none';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="complaintdetails" style="display:none;">
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
		  <!--DWLayoutTable-->
		
		  <tr>
			<td width="15" height="21">&nbsp;</td>
			<td colspan="2" valign="top">Complainant(s)</td>
		  </tr>
		  <tr>
			<td height="70">&nbsp;</td>
			<td width="23">&nbsp;</td>
			<td width="662" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,2,$datax,$index); ?>&nbsp; </td>
		  </tr>
		  <tr>
			<td height="24">&nbsp;</td>
			<td colspan="2" valign="top">Suspect police</td>
		  </tr>
		  <tr>
			<td height="86">&nbsp;</td>
			<td>&nbsp;</td>
			<td valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,3,$datax,$index); ?>&nbsp;</td>
		  </tr>
		  <tr>
			<td height="22">&nbsp;</td>
			<td colspan="2" valign="top">Witnesses</td>
		  </tr>
		  <tr>
			<td height="71">&nbsp;</td>
			<td>&nbsp;</td>
			<td valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getPersons($pref,4,$datax,$index); ?>&nbsp;</td>
		  </tr>
		  <tr>
			<td height="18"></td>
			<td colspan="2" valign="top">Evidence</td>
		  </tr>
		  <tr>
			<td height="78"></td>
			<td>&nbsp;</td>
			<td valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo getEvidence($pref,$datax,$index); ?>&nbsp;</td>
		  </tr>
		</table>
	</div>
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
			<tr>
			<td height="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
			</tr>
		</table>
</div>
<div id="canvas1" style="width:700px;">
	<div id="detailsh" style="width:700px; ">
		<?php 
		echo classBTN("btnDet1","Display complaint details","#","","var div=document.getElementById('details'); div.style.display='block';var div=document.getElementById('detailsh'); div.style.display='none';var div=document.getElementById('detailsh1'); div.style.display='block';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="detailsh1" style="width:700px;display:none;">
		<?php 
		echo classBTN("btnDet1","Hide complaint details","#","","var div=document.getElementById('details'); div.style.display='none';var div=document.getElementById('detailsh'); div.style.display='block';var div=document.getElementById('detailsh1'); div.style.display='none';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<!--<div id="details" style="display:none;">-->
	<div id="details" style="display:none" >
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
		  <!--DWLayoutTable-->
		
		  <tr>
			<td width="12" height="21">&nbsp;</td>
			<td width="107" valign="top">Complain nature </td>
		  <td width="525" rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php 
			$natureDetails="";
	$rs1=@mysql_query("select * from ".$pref."complaintnature where `natureid`='".@$datax[5]."'");
	if($rs1)
	{
		$counts1=@mysql_num_rows($rs1);
		if ($counts1>0)
		{
			$data=@mysql_fetch_array($rs1);
			$natureDetails="$data[1] ($data[2])";
		}
	}
			
			echo $natureDetails; ?></td>
		  </tr>
		  <tr>
			<td height="13"></td>
			<td></td>
          </tr>
		  <tr>
		    <td height="13"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="24"></td>
		    <td valign="top">Incident Location </td>
		  <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo $datax[6]; ?></td>
		  </tr>
		  
		  <tr>
		    <td height="13"></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="10"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="22"></td>
		    <td valign="top">Incident Date </td>
		  <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo $datax[7]; ?></td>
		  </tr>
		  
		  <tr>
		    <td height="15"></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="10"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="18"></td>
		    <td valign="top">Date reported </td>
		  <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo $datax[8]; ?></td>
		  </tr>
		  <tr>
		    <td height="16"></td>
		    <td></td>
	      </tr>
		  <tr>
		    <td height="21"></td>
		    <td></td>
		    <td>&nbsp;</td>
	      </tr>
		</table>
	</div>
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
			<tr>
			<td height="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
			</tr>
		</table>
</div>
<div id="canvas2" style="width:700px;">
	<div id="invh" style="width:700px; display:none;">
		<?php 
		echo classBTN("btnDet1","Display investigations details","#","","var div=document.getElementById('investigations'); div.style.display='block';var div=document.getElementById('invh'); div.style.display='none';var div=document.getElementById('invh1'); div.style.display='block';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<div id="invh1" style="width:700px;">
		<?php 
		echo classBTN("btnDet1","Hide investigations details","#","","var div=document.getElementById('investigations'); div.style.display='none';var div=document.getElementById('invh'); div.style.display='block';var div=document.getElementById('invh1'); div.style.display='none';dyniframesize();"); 
		?>&nbsp;<br />&nbsp;
	</div>
	<!--<div id="details" style="display:none;">-->
	<div id="investigations" >
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
		  <!--DWLayoutTable-->
		
		  <tr>
			<td width="12" height="21">&nbsp;</td>
			<td width="107" valign="top"><div align="right">Findings</div></td>
		    <td width="525" rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php 
			
	$rs1=@mysql_query("select * from ".$pref."investigation where `complaintid`='".@$datax[0]."'");
	if($rs1)
	{
		$counts1=@mysql_num_rows($rs1);
		if ($counts1>0)
		{
			$data=@mysql_fetch_array($rs1);
		}
	}
			
			echo @$data[4]; ?></td>
		  </tr>
		  <tr>
			<td height="13"></td>
			<td></td>
          </tr>
		  <tr>
		    <td height="13"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="24"></td>
		    <td valign="top"><div align="right">Recomendations </div></td>
		    <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo @$data[5]; ?></td>
		  </tr>
		  
		  <tr>
		    <td height="13"></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="10"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="22"></td>
		    <td valign="top"><div align="right">Remarks </div></td>
		    <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo $data[6]; ?></td>
		  </tr>
		  
		  <tr>
		    <td height="15"></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="10"></td>
		    <td></td>
		    <td></td>
          </tr>
		  <tr>
		    <td height="18"></td>
		    <td valign="top"><div align="right">Conclusions</div></td>
		    <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo $data[7]; ?></td>
		  </tr>
		  <tr>
		    <td height="16"></td>
		    <td></td>
	      </tr>
		  <tr>
		    <td height="16"></td>
		    <td></td>
		    <td></td>
	      </tr>
		  <tr>
		    <td height="21"></td>
		    <td valign="top"><div align="right">Evidence</div></td>
		    <td rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A">
		      <?php 
			
			$rs=@mysql_query("select * from ".$pref."investigation where `complaintid`='".@$_GET['complaintid']."'");
			if($rs)
			{
				$counts=@mysql_num_rows($rs);
				if ($counts>0)
				{
					
					$dataz=@mysql_fetch_array($rs);
					echo getEvidence1($pref,$dataz,$index); 
				}
			}?> </td>
	       </tr>
		  <tr>
		    <td height="14"></td>
		    <td></td>
	       </tr>
		</table>
	</div>
		 <table style="margin-left:15px;"  width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
			<tr>
			<td height="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
			</tr>
		</table>
</div>
</form>

