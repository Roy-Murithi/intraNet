<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["functionsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."functions where `functionsid`='".@$_GET['functionsid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."functions where `functionsid`='".@$_GET['functionsid']."'");
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
				alert("Enter valid functions name");
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
<form action="savefunctions.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="717" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="3" valign="top">Edit Controlled Pages to <?php echo @$datax[1]; ?> function</td>
    <td width="17">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="4" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td width="124" valign="top"><div align="right">Pages in:</div></td>
    <td width="7">&nbsp;</td>
    <td colspan="2" valign="top">
	<?php 

		$temp[0]="accessrights";
		$temp[1]="closed";
		$temp[2]="complaint";
		$temp[3]="complaintfilecheck";
		$temp[4]="dataentry";
		$temp[5]="investigation";
		$temp[6]="reports";
		
		for($x=0;$x<=8;$x++)
		{
			$pcount=@fetchRecordCount1("sm_main_accessreg","pagegroup",$temp[$x],"function",@$datax[1]);
			if((int)$pcount>0)
			{
			$filescount[$x]=" (".$pcount.")";
			}else
			{
			$filescount[$x]="";
			}
		}
	?>
	<select name="gppages">
		<option value="none" onclick="getSubPage('files.php','content','fid=none')">Select pages group</option>
		<option value="accessrights" onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Access Rights <?php echo  $filescount[0];?></option>
		<option value="closed"  onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Closed Investigations <?php echo $filescount[1];?></option>
		<option value="complaint"  onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Complaints <?php echo $filescount[2];?></option>
		<option value="complaintfilecheck"  onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">File Check <?php echo $filescount[3];?></option>
		<option value="dataentry" onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Data Entry <?php echo $filescount[4];?></option>
		<option value="investigation"  onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Investigations <?php echo $filescount[5];?></option>
		<option value="reports"  onclick="getSubPage('files.php','content','fid='+this.value+'&function=<?php echo @$datax[1];?>')">Reports <?php echo $filescount[6];?></option>

	</select>	</td>
    </tr>
  <tr>
    <td height="294"></td>
    <td colspan="4" valign="top"><iframe height="294" width="730" name="content" id="content" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" style="overflow:visible; " src="files.php?sessid=smetsysmocmas&fid=none">			</iframe>	</td>
    </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td width="561"></td>
    <td></td>
  </tr>
</table>
</form>

