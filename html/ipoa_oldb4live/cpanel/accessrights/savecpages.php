<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$functionsid=@$_POST["functionsid"];
$dat1=removeTag(@$_POST["txtDat1"]);


//include ("globalfunc.php");


if($functionsid!="" && $functionsid!="undefined" && $functionsid!=NULL)
{
	$query="update  ".$pref."functions set 
	`functions`='$dat1'
	where `functionsid`='$functionsid'";
		
	$rs=@mysql_query($query);
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."functions");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$functionsidx="FN00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."functions where `functionsid`='$functionsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."functions values('$functionsidx','$dat1')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("functions.php","content","");
</script>
</html>
