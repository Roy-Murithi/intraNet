<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$countyid=@$_POST["countyid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$action=removeTag(@$_POST["action"]);

//include ("globalfunc.php");
if($action==0)
	{
		$strData= "findings";
	}elseif($action==1)
	{
		$strData= "recommendation";
	}elseif($action==2)
	{
		$strData="remarks";
	}elseif($action==3)
	{
		$strData= "conclusion";
	}
$query="update ".$pref."investigation set `$strData`='$dat1'  where `complaintid`='$complaintid'"; 
	$rs=@mysql_query($query);
		$log="Added information on $strData";
	$action="$strData";
procLog($pref,$complaintid,$log,$action);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Changes in <?php echo $strData;?> saved")
	getPage("myinvestigationdetails.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&complaintid=<?php echo @$complaintid;?>");
</script>
</html>
