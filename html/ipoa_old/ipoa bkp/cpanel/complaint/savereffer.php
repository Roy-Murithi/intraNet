<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$pid=@$_POST["pid"];
$uneditableVal=@$_POST["uneditableVal"];
$pid1=@$_POST["pid1"];
$dat3=date("Y/m/d H:i:s");

	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."reffer");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$refferidx="RFR00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."reffer where `refferid`='$refferidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);
	$date=date("Y/m/d H:i:s");
	$query="insert into  ".$pref."reffer values('$refferidx','$complaintid','$dat1','$dat2','". $_SESSION['userid'] ."','$date')";
	$rs=@mysql_query($query);

$query="update ".$pref."complaint set `uneditable`='$uneditableVal',`approved for investigation`='0',`approval date`='-'  where `complaintid`='$complaintid'";
$rs=@mysql_query($query);
	$query="update ".$pref."complaint set `uneditable`='98' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Reffered complaint for investigation to ".$dat2,"Reffered");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("The action completed successfully")
	getPage("<?php echo $pid; ?>.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
