<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$complaintid=@$_POST["complaintid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2="-";
$dat3="-";
$dat4="-";
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7=removeTag(@$_POST["txtDat7"]);
$dat8=date("Y/m/d H:i:s");
$dat9="0";
$dat10="-";
$dat11="0";
$dat12="-";
$dat13="0";
$dat14="-";
$dat15="0";
$dat16="-";
$dat19="-";
$dat20="-";
$dat21="-";
$dat22="-";
$dat23="-";
$dat24="-";
$dat25=@$_POST['status'];
$dat26=removeTag(@$_POST['txtDat26']);
$dat27=date("YmdHis");
//include ("globalfunc.php");
if($complaintid!="" && $complaintid!="undefined" && $complaintid!=NULL)
{
	$query="update  ".$pref."complaint set 
	`complaint`='$dat1',
	`natureid`='$dat5',
	`incident location`='$dat6',
	`incident date`='$dat7',
	`status`='$dat25',
	`anonymous`='$dat26',
	`index`='$dat27'
	where `complaintid`='$complaintid'";
		
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Edited complaint and saved the changes","Updated");
}
else
{
	$valDat=fetchValue($pref."tracker","varname","complaint",1);
	do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('complaint','$valDat')";
				$rs=@mysql_query($query);
			}
			$complaintidx="CMPL0".$valDat;
			$rs1=@mysql_query("select * from  ".$pref."complaint where `complaintid`='$complaintidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);
	
	$query="insert into  ".$pref."complaint values('$complaintidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','$dat12','$dat13','$dat14','$dat15','$dat16','0','-','$dat19','$dat20','$dat21','$dat22','$dat23','$dat24','$dat25','$dat26','$dat27','-','-','-')";
	$rs=@mysql_query($query);
	$query="update ".$pref."tracker set value='$valDat' where `varname`='complaint'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintidx,"New complaint added to the system","Added");
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
<?php if($complaintid!="" && $complaintid!="undefined" && $complaintid!=NULL)
{?>
	getPage("complaint.php","content","index=<?php echo (int)@$_POST['index']; ?>");
<?php }else
{?>
	getPage("complaintdetails.php","content","complaintid=<?php echo $complaintidx;?>&index=<?php echo (int)@$_POST['index']; ?>");
<?php
}
?>
</script>
</html>
