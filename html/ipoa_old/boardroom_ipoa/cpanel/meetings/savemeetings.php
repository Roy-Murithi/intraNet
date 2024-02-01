<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$meetingsid=@$_POST["meetingsid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3="0";
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7="0";
$dat8=date("YmdHis");


//include ("globalfunc.php");
if($meetingsid!="" && $meetingsid!="undefined" && $meetingsid!=NULL)
{
	$query="update   meetings set 
	`name`='$dat1',
	`details`='$dat2',
	`flag`='$dat3',
	`day`='$dat4',
	`username`='$dat5',
	`password`='$dat6',
	`index`='$dat8'
	where `meetingsid`='$meetingsid'";
		
	$rs=@mysql_query($query);
	procLog($pref,$meetingsid,"Edited meeting and saved the changes","Updated");
}
else
{
	 $counts=0;
	$rs=@mysql_query("select * from  meetings");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			//strDat=(string)$valDat;
			$meetingsidx="SCH0".$counts;
			$rs1=@mysql_query("select * from meetings where `meetingsid`='$meetingsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$counts=$counts+1;
			
	}while($dup!=0);
	
	$query="insert into meetings values('$meetingsidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8')";
	$rs=@mysql_query($query);
	procLog($pref,$meetingsidx,"New meeting  scheduled to the system","Scheduled");
	$meetingsid=$meetingsidx;
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("fileupload.php","content","meetingsid=<?php echo @$meetingsid ?>");
</script>
</html>
