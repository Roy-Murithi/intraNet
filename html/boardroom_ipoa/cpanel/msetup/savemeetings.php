<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$msetupid=@$_POST["msetupid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);

//include ("globalfunc.php");
if($msetupid!="" && $msetupid!="undefined" && $msetupid!=NULL)
{
	$query="update   msetup set 
	`name`='$dat1',
	`details`='$dat2'
	where `msetupid`='$msetupid'";
		
	$rs=@mysql_query($query);
	procLog($pref,$msetupid,"Edited meeting and saved the changes","Updated");
}
else
{
	 $counts=0;
	$rs=@mysql_query("select * from  msetup");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			//strDat=(string)$valDat;
			$msetupidx="MTNG0".$counts;
			$rs1=@mysql_query("select * from msetup where `msetupid`='$msetupidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$counts=$counts+1;
			
	}while($dup!=0);
	
	$query="insert into msetup values('$msetupidx','$dat1','$dat2')";
	$rs=@mysql_query($query);
	procLog($pref,$msetupidx,"New meeting name added to the system","Added");
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("meetings.php","content","index=<?php echo (int)@$_POST['index']; ?>");
</script>
</html>
