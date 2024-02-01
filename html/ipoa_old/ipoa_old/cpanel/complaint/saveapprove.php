<?php 
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
//97 means approved
$apdate=date("Y/m/d H:i:s");
$query="update ".$pref."complaint set `uneditable`='97',`approved for investigation`='99',`approval date`='$apdate'  where `complaintid`='$complaintid'";
$rs=@mysql_query($query);
procLog($pref,$complaintid,"Approved complaint for investigation","Approved");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Complaint has been approved for investigation and sent to Head of investigations by head/deputy director complaints")
	getPage("acomplaint.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
