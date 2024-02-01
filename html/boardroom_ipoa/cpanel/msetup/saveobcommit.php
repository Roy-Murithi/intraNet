<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$OBid=@$_GET["OBid"];
$index=@$_GET["index"];

	$query="update ".$pref."OB set `uneditable`='99' where `OBid`='$OBid'";
	$rs=@mysql_query($query);
	procLog($pref,$OBid,"Ooccurence submitted","Submited");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Occurence has been submitted, this Occurence is no longer editable")
	getPage("obcomplaint.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
