<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");

//include ("globalfunc.php");
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$dat31=date("Y/m/d H:i:s");

if(@$_GET["complaintid"]!="")
{
	$rs=@mysql_query("select * from ".$pref."complaint where `complaintid`='".@$_GET['complaintid']."'");
	if($rs)
	{
		$count=@mysql_num_rows($rs);
		if ($count>0)
		{
			$data=@mysql_fetch_array($rs);
	
	$query="insert into  ".$pref."archive values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]','$dat31')";
	$rs=@mysql_query($query);
	$query1="delete from  ".$pref."complaint where `complaintid`='$complaintid' ";
	$rs=@mysql_query($query1);


	$log="Archived the investigation";
	$action="Archived";
	procLog($pref,$complaintid,$log,$action);
		}
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Investigation archived")
	getPage("investigation.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&complaintid=<?php echo @$complaintid;?>");
</script>
</html>
