<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$pwardid=@$_POST["pwardid"];
$dat2=removeTag(@$_POST["txtDat2"]);
$dat1=removeTag(@$_POST["txtDat1"]);

//include ("globalfunc.php");


if($pwardid!="" && $pwardid!="undefined" && $pwardid!=NULL)
{
	$query="update  ".$pref."pward set 
	`county`='$dat2',
	`ward`='$dat1'
	where `pwardid`='$pwardid'";
		
	$rs=@mysql_query($query);
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."pward");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$pwardidx="CNT00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."pward where `pwardid`='$pwardidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."pward values('$pwardidx','$dat1','$dat2')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("ward.php","content","");
</script>
</html>
