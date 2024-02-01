<?php
session_start();
include "conn.php";
$postid=@$_POST["postid"];
$dat1=@str_replace("'","\'",$_POST["txtTitle"]);
$dat2=@str_replace("'","\'",$_POST["content"]);
$dat3=@$_SESSION['names'];
$dat4=@str_replace("'","\'",$_POST["template"]);
$dat5=date('d/m/y');
$dat6="none";
$dat7=date("Ymd").date('His');


include ("globalfunc.php");


if($postid!="" && $postid!="undefined" && $postid!=NULL)
{
	$query="update ".$pref."post set 
	`title`='$dat1',
	`content`='$dat2',
	`author`='$dat3',
	`template`='$dat4',
	`date`='$dat5',
	`thumbnail`='$dat6',
	`others`='$dat7'
	where `postid`='$postid'";
	
	$rs=@mysql_query($query);
}
else
{
	$rs=@mysql_query("select * from ".$pref."post");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$postidx="PST-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."post where `postid`='$postidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);
	$date=date("d/m/y");
	$query="insert into ".$pref."post values('$postidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7')";
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("posts.php","content","");
</script>
</html>
