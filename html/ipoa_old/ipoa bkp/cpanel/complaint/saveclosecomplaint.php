<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$dat1=removeTag(@$_POST["txtDat1"]);
//$dat2=@$_POST["txtDat2"];
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$pid=@$_POST["pid"];
$uneditableVal=@$_POST["uneditableVal"];
$pid1=@$_POST["pid1"];
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
	//closed_complaint

$query="update ".$pref."complaint set `uneditable`='92',`approved for investigation`='0',`approval date`='-',`date_closed_complaint`='$dat2',`closed_complaint`='$explanationidx'  where `complaintid`='$complaintid'";
$rs=@mysql_query($query);
$action="Closed";
	procLog($pref,$complaintid,"Closed complaint",$action);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("The complaint closed successfully")
	getPage("<?php echo $pid; ?>.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
