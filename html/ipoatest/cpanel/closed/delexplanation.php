<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$explanationid=@$_GET["explanationid"];
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];

	$value=fetchValue($pref."complaint","complaintid",$complaintid,15);
	$value=str_replace($explanationid."!~!","",$value);
	
	$query="update ".$pref."complaint set `closed`='$value' where `complaintid`='$complaintid'";	
	$rs=@mysql_query($query);
	
	$query="delete from ".$pref."explanation where `explanationid`='$explanationid'";	
	$rs=@mysql_query($query);
	
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("investigationdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
