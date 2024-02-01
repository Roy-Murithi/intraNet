<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$ptownid=@$_POST["ptownid"];
$dat1=removeTag(@$_POST["txtDat1"]);


//include ("globalfunc.php");


if($ptownid!="" && $ptownid!="undefined" && $ptownid!=NULL)
{
	$query="update  ".$pref."ptown set 
	`town`='$dat1'
	where `ptownid`='$ptownid'";
		
	$rs=@mysql_query($query);
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."ptown");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$ptownidx="CNT00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."ptown where `ptownid`='$ptownidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."ptown values('$ptownidx','$dat1')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("town.php","content","");
</script>
</html>
