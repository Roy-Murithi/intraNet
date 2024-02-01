<?php
session_start();
$names=$_SESSION['names'];
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$apdate=date("Y/m/d H:i:s");

/*
96-Unattended to
95-Under investigation
94-Concluded
93-Closed
	*/
	$query="update ".$pref."investigation set `date closed`='$apdate',`closed by`='$names'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	$query="update ".$pref."complaint set `uneditable`='93',`date closed`='$apdate'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query); 
		
	$log="Investigation finalized";
	$action="Closed";
	procLog($pref,$complaintid,$log,$action);
	
	
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Investigation finalized successfully")
	getPage("cinvestigation.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
