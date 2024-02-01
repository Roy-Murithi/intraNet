<?php
session_start();
include "conn.php";
$pageid=@$_POST["pageid"];
$dat1=@str_replace("'","\'",$_POST["txtTitle"]);
$dat2=@str_replace("'","\'",$_POST["content"]);
$dat3=@$_SESSION['names'];
$dat4=@str_replace("'","\'",$_POST["template"]);
$dat5=date('d/m/y');
$dat6="none";
$dat7=date("Ymd").date('His');


include ("globalfunc.php");


if($pageid!="" && $pageid!="undefined" && $pageid!=NULL)
{
	$query="update ".$pref."page set 
	`title`='$dat1',
	`content`='$dat2',
	`author`='$dat3',
	`template`='$dat4',
	`date`='$dat5',
	`thumbnail`='$dat6',
	`others`='$dat7'
	where `pageid`='$pageid'";
	
	$rs=@mysql_query($query);
}
else
{
	$rs=@mysql_query("select * from ".$pref."page");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$pageidx="PST-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."page where `pageid`='$pageidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);
	$date=date("d/m/y");
	$query="insert into ".$pref."page values('$pageidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("page.php","content","");
</script>
</html>
