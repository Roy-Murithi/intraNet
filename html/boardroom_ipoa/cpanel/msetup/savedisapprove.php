<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
//98 means disapproved
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$dest=removeTag(@$_GET["dest"]);

	$query="update ".$pref."complaint set `uneditable`='98' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Reffered complaint for investigation to ",$dest,"Reffered");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("The complaint has been disapproved")
	getPage("acomplaint.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
