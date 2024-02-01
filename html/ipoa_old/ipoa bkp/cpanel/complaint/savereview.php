<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
//97 means approved
$query="update ".$pref."complaint set `uneditable`='99' where `complaintid`='$complaintid'";
$rs=@mysql_query($query);

$log="Cancelled reffer of complaint";
$action="Cancelled";
procLog($pref,$complaintid,$log,$action);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Complaint reffer has been reversed")
	getPage("acomplaintdetails.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&complaintid=<?php echo @$complaintid; ?>");
</script>
</html>
