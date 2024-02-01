<?php
include "conn.php";
$downloadsid=$_POST["downloadsid"];
$dat1=$_POST["txtDat1"];
$dat2=$_POST["txtDat2"];
$dat4=date("d/m/y");


include ("globalfunc.php");


if($downloadsid!="" && $downloadsid!="undefined" && $downloadsid!=NULL)
{
	$query="update ".$pref."downloads set 
	`title`='$dat1',
	`details`='$dat2'
	`date`='$dat4'
	where `downloadsid`='$downloadsid'";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat3']['name']!="")
	{
		//save picture
		$result=saveFileAll('txtDat3','downloadsid',$downloadsid,'downloads/','downloads','link');
		
	}
}
else
{
/*	$rs1=@mysql_query("select * from ".$pref."downloads where `productname`='$dat1'");
	if ($rs1)
	{
		$dupx=@mysql_num_rows($rs1);
		if ($dupx>0)
		{
			header("location:error.php?Desc=Duplicate%20product%20entered");
			exit;
		}
	}*/
	$rs=@mysql_query("select * from ".$pref."downloads");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$downloadsidx="GALLR-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."downloads where `downloadsid`='$downloadsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."downloads values('$downloadsidx','$dat1','$dat2','none',$dat4)";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat3']['name']!="")
	{
		//save picture
		$result=saveFileAll('txtDat3','downloadsid',$downloadsidx,'downloads/','downloads','link');
		
	}
}
?>
<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	getPage("downloads.php","content","");
</script>
</html>
