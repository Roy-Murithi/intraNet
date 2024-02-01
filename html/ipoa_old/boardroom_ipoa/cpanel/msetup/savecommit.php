<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];

	$query="update ".$pref."complaint set `uneditable`='99' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Submitted complaint for approval","Submited");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Complaint has been sent to registry in-charge, this complaint is no longer editable")
	getPage("complaint.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
