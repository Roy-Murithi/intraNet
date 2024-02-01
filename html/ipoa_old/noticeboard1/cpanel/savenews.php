<?php
include "conn.php";
$newsid=$_POST["newsid"];
$dat1=$_POST["txtDat1"];
$dat2=$_POST["txtDat2"];
$dat3=$_POST["txtDat3"];
$dat4=date("d/m/y");
$dat5=$_POST["txtDat4"];

include ("globalfunc.php");


if($newsid!="" && $newsid!="undefined" && $newsid!=NULL)
{
	$query="update ".$pref."news set 
	`title`='$dat1',
	`details`='$dat2',
	`source`='$dat3',
	`dateposted`='$dat4',
	`dated`='$dat5'
	where `newsid`='$newsid'";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat6']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat6','newsid',$newsid,'news/',$pref.'news','photos');
		
	}
}
else
{
/*	$rs1=@mysql_query("select * from ".$pref."news where `productname`='$dat1'");
	if ($rs1)
	{
		$dupx=@mysql_num_rows($rs1);
		if ($dupx>0)
		{
			header("location:error.php?Desc=Duplicate%20product%20entered");
			exit;
		}
	}*/
	$rs=@mysql_query("select * from ".$pref."news");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$newsidx="NEWS-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."news where `newsid`='$newsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."news values('$newsidx','$dat1','$dat2','$dat3','$dat4','$dat5','none')";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat6']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat6','newsid',$newsidx,'news/',$pref.'news','photos');
		
	}
}
?>
<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	getPage("news.php","content","");
</script>
</html>
