<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$invid=@$_GET["invid"];
$apdate=date("Y/m/d H:i:s");
$dat1=$complaintid;
$dat2=$invid;
$dat3=$apdate;
$dat4="-";
$dat5="-";
$dat6="-";
$dat7="-";
$dat8="-";
$dat9="-";
$dat10="-";
$dat11="-";
$txtDat1="-";
$txtDat2="-";

//96 means opened for investigaions

	$counts=0;
	$valDat=fetchValue($pref."tracker","varname","investigation",1);
	do
	{
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('investigation','$valDat')";
				$rs=@mysql_query($query);
			}
			$investigationidx="INV0".$valDat."/$complaintid";
			$rs1=@mysql_query("select * from  ".$pref."investigation where `investigationid`='$investigationidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);

	/*do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('complaint','$valDat')";
				$rs=@mysql_query($query);
			}
			$complaintidx="CMPL0".$valDat;
			$rs1=@mysql_query("select * from  ".$pref."complaint where `complaintid`='$complaintidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);*/

	$query="insert into  ".$pref."investigation values('$investigationidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','-','-','-','')";
	$rs=@mysql_query($query);
		
	$query="update ".$pref."tracker set value='$valDat' where `varname`='investigation'";
	$rs=@mysql_query($query);

	$invnames=fetchValue("staff","staffid",$dat2,3);
	$msg="Lead investigator role assigned to $invnames";
	$log="Lead investigator role assigned to $invnames";
	$action="Assignment";
	procLog($pref,$complaintid,$log,$action);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("<?php echo @$msg;?>")
	getPage("asscomplaintdetails.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas&complaintid=<?php echo @$complaintid;?>");
</script>
</html>
