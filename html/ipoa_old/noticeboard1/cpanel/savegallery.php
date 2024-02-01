<?php
include "conn.php";
$galleryid=$_POST["galleryid"];
$dat1=$_POST["txtDat1"];
$dat2=$_POST["txtDat2"];



include ("globalfunc.php");


if($galleryid!="" && $galleryid!="undefined" && $galleryid!=NULL)
{
	$query="update ".$pref."gallery set 
	`title`='$dat1',
	`details`='$dat2'
	where `galleryid`='$galleryid'";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat3']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat3','galleryid',$galleryid,'gallery/',$pref.'gallery','photo');
		
	}
}
else
{
/*	$rs1=@mysql_query("select * from ".$pref."gallery where `productname`='$dat1'");
	if ($rs1)
	{
		$dupx=@mysql_num_rows($rs1);
		if ($dupx>0)
		{
			header("location:error.php?Desc=Duplicate%20product%20entered");
			exit;
		}
	}*/
	$rs=@mysql_query("select * from ".$pref."gallery");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$galleryidx="GALLR-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."gallery where `galleryid`='$galleryidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."gallery values('$galleryidx','$dat1','$dat2','none')";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat3']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat3','galleryid',$galleryidx,'gallery/',$pref.'gallery','photo');
		
	}
}
?>
<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	getPage("gallery.php","content","");
</script>
</html>
