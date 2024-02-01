<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$dat1=removeTag(@$_POST["txtDat1"]);
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$pid=@$_POST["pid"];
$uneditableVal=@$_POST["uneditableVal"];
$pid1=@$_POST["pid1"];
$complaintfield=@$_POST["complaintfield"];
$status=removeTag(@$_POST["status"]);
$dat2=date("Y/m/d H:i:s");

	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."explanation");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$explanationidx="EXPL00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."explanation where `explanationid`='$explanationidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."explanation values('$explanationidx','$complaintid','$dat1','$dat2')";
	$rs=@mysql_query($query);
/*	$query="update ".$pref."investigation set `complaintid`='".$complaintid."#old'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);*/

$query="update ".$pref."complaint set `uneditable`='96',`$complaintfield`='$explanationidx',`approved for investigation`='0',`approval date`='-' where `complaintid`='$complaintid'";
$rs=@mysql_query($query);
	
if($uneditableVal=="96")
{
	$log="Re-opened a finalized case";
	$action="Re-opened";
	procLog($pref,$complaintid,$log,$action);
}


?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("The action completed successfully")
	getPage("<?php echo $pid; ?>.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&status=<?php echo @$status;?>");
</script>
</html>
