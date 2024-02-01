<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$dat1=removeTag(@$_POST["txtDat1"]);
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$pid=@$_POST["pid"];
$uneditableVal=@$_POST["uneditableVal"];
$pid1=@$_POST["pid1"];
if($dat1!="")
{
$query="update ".$pref."investigation set `assignment`='$dat1'  where `complaintid`='$complaintid'";
$rs=@mysql_query($query);

$log="Assigment details attached to investigation assignment";
$action="Attached";
procLog($pref,$complaintid,$log,$action);
}

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("saveassign1.php","content","complaintid=<?php echo @$complaintid;?>&index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
