<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$dat1=@$_POST["txtDat1"];
$filecheckid=removeTag(@$_POST["filecheckid"]);
$index=@$_POST["index"];
$dat2=removeTag(@$_POST["mand"]);
if($filecheckid!="" && $filecheckid!="undefined" && $filecheckid!=NULL)
{
	$query="update  ".$pref."filecheck set 
	`check`='$dat1',
	`mandatory`='$dat2'
	where `filecheckid`='$filecheckid'";
		
	$rs=@mysql_query($query);
	procLog($pref,$filecheckid,"Edited filecheck and saved the changes","Updated");
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."filecheck ");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$filecheckidx="CHK00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."filecheck where `filecheckid`='$filecheckidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."filecheck values('$filecheckidx','$dat1','$dat2')";
	$rs=@mysql_query($query);
procLog($pref,$filecheckidx,"Edited filecheck and saved the changes","Updated");
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("filecheck.php","content","index=<?php echo @$index;?>&sessid=smetsysmocmas");
</script>
</html>
