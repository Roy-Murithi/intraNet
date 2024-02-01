<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$natureid=@$_POST["natureid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);

//include ("globalfunc.php");


if($natureid!="" && $natureid!="undefined" && $natureid!=NULL)
{
	$query="update  ".$pref."complaintnature set 
	`naturetype`='$dat1',
	`description`='$dat2'
	where `natureid`='$natureid'";
		
	$rs=@mysql_query($query);
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."complaintnature ");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$natureidx="NTR00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."complaintnature where `natureid`='$natureidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."complaintnature values('$natureidx','$dat1','$dat2')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("nature.php","content","");
</script>
</html>
