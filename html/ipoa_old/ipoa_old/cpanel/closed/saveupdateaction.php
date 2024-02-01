<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");

//include ("globalfunc.php");
$dat1=removeTag(@$_POST["txtDat1"]);
$complaintid=removeTag(@$_POST["complaintid"]);
$index=removeTag(@$_POST["index"]);
$dat2=date("Y/m/d H:i:s");


	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."explanation");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$explanationidx="EXPL00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."explanation where `explanationid`='$explanationidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."explanation values('$explanationidx','$complaintid','$dat1','$dat2')";
	$rs=@mysql_query($query);
/*	$query="update ".$pref."investigation set `complaintid`='".$complaintid."#old'  where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);*/
$value=fetchValue($pref."complaint","complaintid",$complaintid,15);
if($value=="-" || $value=="99" || $value=="0" ){$value="";}
$value=$value.$explanationidx."!~!";
	
$query="update ".$pref."complaint set `closed`='$value' where `complaintid`='$complaintid'";
$rs=@mysql_query($query);

	$log="Added new action to finalized investigation";
	$action="Action added";
	procLog($pref,$complaintid,$log,$action);


?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("New action saved")
	getPage("investigationdetails.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&complaintid=<?php echo @$complaintid;?>");
</script>
</html>
