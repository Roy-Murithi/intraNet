<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$OBid=@$_GET['OBid'];
$index=@$_GET['index'];
$url=@$_GET['url'];
if(@$_GET["OBid"]!="")
{
	$rs=@mysql_query("select * from ".$pref."OB where `OBid`='".@$_GET['OBid']."'");
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
		header("location:obcomplaint.php?index=$index&sessid=smetsysmocmas");
	}
}else
{?>
	<html>
		<script language="javascript" src="../scripts/counterajax.js"></script>
		<script language="javascript">
			alert("Error fetching the Occurence details");
			getPage("obcomplaint.php","content","index=<?php echo Index;?>");
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
					$deldiv="<a class=\"flink\" href=\"delpersonsid.php?personsid=$datap[0]&OBid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px;padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;position:absolute;top:3px;left:5;\"><img src=\"../images/ico_drop.png\" /></div></a>";
					if($datap[20]=="99")
					{
						$div=$div."<div style=\"float:left;position:relative;\" ><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">Anonymous complainant: $datap[2]($datap[3]) </div>$deldiv</div>";
					}else
					{
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"persons.php?personsid=$datap[0]&OBid=$datax[0]&sessid=smetsysmocmas&index=$index&fld=$field\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">$datap[2]. $datap[3] $datap[4] $datap[5] </div></a>$deldiv</div>";
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
		$div="<a class=\"flink\" href=\"personsid.php?OBid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}elseif($field==3)
	{
		$div="<a class=\"flink\" href=\"personsid.php?OBid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}elseif($field==4)
	{
		$div="<a class=\"flink\" href=\"personsid.php?OBid=$datax[0]&fld=$field&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:5px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
	}
	return $div;
}
function getAddE($datax,$index)
{

	$div="<a class=\"flink\" href=\"evidence.php?OBid=$datax[0]&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\"><img src=\"../images/ico_add.png\" /></div></a>";
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
					$deldiv="<a class=\"flink\" href=\"delevidenceid.php?evidenceid=$datap[0]&OBid=$datax[0]&sessid=smetsysmocmas&index=$index\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin:2px;padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;position:absolute;top:3px;left:5;\"><img src=\"../images/ico_drop.png\" /></div></a>";
					$div=$div."<div style=\"float:left;position:relative;\" ><a class=\"flink\" href=\"../$datap[2]\" target=\"_blank\"><div id=\"persons\" class=\"persons\" style=\" border: thin solid #7Ba89A; margin-left:20px;margin-top:2px;margin-bottom:2px;  padding-top:3px; padding-bottom:3px; padding-left:10px; padding-right:5px;\">File</div></a>$deldiv</div>";
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
    <td height="22" colspan="4" valign="top">Occurence details </td>
    <td colspan="3" valign="top"><div align="right" style="font-size:20px;"><?php echo "Occurence N<u>o</u>: ".@$datax[1];?></div></td>
    </tr>
  <tr>
    <td height="13" colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="22" colspan="5" valign="top">Occurence</td>
    <td width="119" valign="top"><div align="right">
      <?php
		$script="getPage('obreturn.php','content','OBid=$datax[0]&sessid=smetsysmocmas&index=$index&pid=sobcomplaint')"; 
		echo classBTN1("btnReturn","  Return to registry  ","#","","$script","#FF0000"); 
		?>
    </div></td>
    <td width="62" valign="top"><div align="right">
      <?php
		$script="getPage('$url.php','content','obid=$datax[0]&sessid=smetsysmocmas&index=$index')"; 
		echo classBTN("btnReturn","  Close  ","#","","$script","#FF0000"); 
		?>
    </div></td>
  </tr>
  <tr>
    <td width="15" height="66"></td>
    <td colspan="6" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"><?php echo @$datax[5];?></td>
    </tr>
  <tr>
    <td height="5"></td>
    <td width="107"></td>
    <td width="4"></td>
    <td width="261"></td>
    <td width="132"></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="5" colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="9"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  

  
  
  
  <tr>
    <td colspan="2" rowspan="2" valign="top"><div align="right">Refference Number: </div></td>
    <td height="22"></td>
    <td colspan="4" valign="top"style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[1];?> </td>
    </tr>
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Occurence date: </div></td>
    <td></td>
    <td colspan="4" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[2];?> </td>
    </tr>
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" valign="top"><div align="right">Casefile Number: </div></td>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td colspan="4" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[3];?> </td>
    </tr>
  
  
  
  
  
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="18" colspan="2" valign="top">Nature of Occurence: </td>
    <td></td>
    <td colspan="4" rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[4];?> </td>
    </tr>
  <tr>
    <td height="11"></td>
    <td></td>
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
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><div align="right">Remarks:</div></td>
    <td></td>
    <td colspan="4" rowspan="2" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[5];?> </td>
    </tr>
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="9"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" valign="top"><div align="right">Recorded by: </div></td>
    <td height="22"></td>
    <td colspan="4" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[6];?> </td>
    </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="top"><div align="right">Recorded on: </div></td>
    <td></td>
    <td colspan="4" valign="top" style="background-color:#ABD8DA; border: thin solid #7Ba89A"> <?php echo @$datax[8];?> </td>
    </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="13" colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</form>

