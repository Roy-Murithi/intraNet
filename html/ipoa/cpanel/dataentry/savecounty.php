<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$countyid=@$_POST["countyid"];
$dat1=removeTag(@$_POST["txtDat1"]);


//include ("globalfunc.php");


if($countyid!="" && $countyid!="undefined" && $countyid!=NULL)
{
	$query="update  ".$pref."county set 
	`county`='$dat1'
	where `countyid`='$countyid'";
		
	$rs=@mysql_query($query);
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."county");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$countyidx="CNT00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."county where `countyid`='$countyidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."county values('$countyidx','$dat1')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("county.php","content","");
</script>
</html>
