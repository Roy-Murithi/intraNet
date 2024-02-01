<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$apdate=date("Y/m/d H:i:s");
//include ("globalfunc.php");

	$query="update ".$pref."investigation set `date concluded`='$apdate' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	$query="update ".$pref."complaint set `uneditable`='94',`concluded`='99',`date concluded`='$apdate'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
		$log="Concluded investigation";
	$action="Concluded";
procLog($pref,$complaintid,$log,$action);

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Investigation concluded")
	getPage("myinvestigation.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
