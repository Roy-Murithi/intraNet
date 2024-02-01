<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$pid=@$_GET["pid"];
$pid1=@$_GET["pid1"];
$uneditableVal=@$_GET["uneditableVal"];
$complaintfield=@$_GET["complaintfield"];
//include "globalfunc.php";

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
function isCheckOk()
{
	
	<?php
		$rs=@mysql_query("select * from ".$pref."filecheck  order by `check` desc");
		$strCond="";
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					
					$data=mysql_fetch_array($rs);
					if($data[2]=="99")
					{
						if($strCond=="")
						{
							$strCond="document.frmUsers.chkDat$x.checked==true";
						}else
						{
							$strCond=$strCond." && document.frmUsers.chkDat$x.checked==true";
						}
					}					
				}
				if($strCond!="")
				{
					echo "
					if($strCond)
					{
						return true;
					}else
					{
						return false;
					}					
					";
				}
				
			}
		}
	
	?>
}
function addChk(chkID,x)
{
	var chkDat=document.getElementById("chkDat"+x);
	var chkVar=document.getElementById("chkVar");
	if(chkDat.checked==true)
	{
		if(chkVar.value=="")
		{
			chkVar.value=chkID+"!~!";
		}else
		{
			chkVar.value=chkVar.value+chkID+"!~!";
		}
	}else
	{
		chkVar.value=chkVar.value.replace(chkID+"!~!","");
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
<form action="return.php" method="get" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" id="chkVar" name="chkVar" />
<input type="hidden" id="complaintid" name="complaintid" value="<?php echo $complaintid;?>" />
<input type="hidden" id="index" name="index" value="<?php echo $index;?>" />
<input type="hidden" id="pid" name="pid" value="<?php echo $pid;?>" />
<input type="hidden" id="pid1" name="pid1" value="<?php echo $pid1;?>" />
<input type="hidden" id="uneditableVal" name="uneditableVal" value="<?php echo $uneditableVal;?>" />
<input type="hidden" id="complaintfield" name="complaintfield" value="<?php echo $complaintfield;?>" />
<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="5" valign="top">Set up file check </td>
    </tr>
  <tr>
    <td height="21" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td width="17" height="134"></td>
    <td colspan="3" valign="top">
	<?php
		$rs=@mysql_query("select * from ".$pref."filecheck  order by `check` desc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=mysql_fetch_array($rs);
					echo "<div style=\"float:left;width:200px;\"><input type=\"checkbox\" name=\"chkDat$x\" id=\"chkDat$x\" onClick=\"addChk('$data[0]','$x');\" />$data[1]</div>\n";
				}
			}
		}
	
	?>
	
	&nbsp;</td>
    <td width="33"></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td width="463"></td>
    <td width="162" valign="top"><?php

		
		$script="if(isCheckOk()==true){getPage('return.php','content','complaintid=$complaintid&sessid=smetsysmocmas&index=$index&pid=savecinvestigation&pid1=cinvestigationdetails&uneditableVal=93&rtitle=Finalize investigation&complaintfield=closed&chkVar='+document.frmUsers.chkVar.value)}else{alert('You must check options with sterix')}"; 
		echo classBTN1("btnReturn","Validate and proceed","#","","$script","#FF0000"); 
		?></td>
    <td width="109" valign="top"><?php

		
		$script="getPage('cinvestigationdetails.php','content','complaintid=$complaintid&sessid=smetsysmocmas&index=$index')"; 
		echo classBTN("btnReturn","Cancel","#","","$script","#FF0000"); 
		?></td>
    <td></td>
  </tr>
  <tr>
    <td height="18" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
</table>
</form>

