<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$invid=@$_GET["invid"];
$apdate=date("Y/m/d H:i:s");

		$query="update ".$pref."complaint set `uneditable`='96',`openned for investigation`='99',`openning date`='$apdate',`casefile no`='-',`case no`='-'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	$msg="Complaint opened for investigation";
	$log="Complaint opened for investigation";
	$action="opened";
	procLog($pref,$complaintid,$log,$action);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("<?php echo @$msg;?>")
	getPage("assigninvestigation.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
