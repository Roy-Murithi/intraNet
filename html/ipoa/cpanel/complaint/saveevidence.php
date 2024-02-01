<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat3="-";
$dat4=date("Y/m/d H:i:s");
$dat5=$_SESSION['names'];
//include ("globalfunc.php");

	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."evidence ");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$evidenceidx="EVD00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."evidence where `evidenceid`='$evidenceidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."evidence values('$evidenceidx','$dat1','none','$dat3','$dat4','$dat5')";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat2']['name']!="")
	{
		//save picture
		$result=saveFileAll('txtDat2','evidenceid',$evidenceidx,'evidence/files/',$pref.'evidence','path');
	}
	$value=fetchValue($pref."complaint","complaintid",$complaintid,18);
	if($value=="" || $value=="-" ){$value=$evidenceidx;}else{$value=$value."!~!".$evidenceidx;}
	$query="update ".$pref."complaint set `evidence`='$value' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Uploaded evidence during the addition of complaint","Uploaded");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
