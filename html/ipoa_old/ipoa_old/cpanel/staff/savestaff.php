<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$staffid=@$_POST["staffid"];
$dat1=@$_POST["txtDat1"];
$dat2=@$_POST["txtDat2"];
$dat3=@$_POST["txtDat3"];
$dat4=@$_POST["txtDat4"];
$dat5=@$_POST["txtDat5"];
$dat7=@$_POST["txtDat7"];

//include ("globalfunc.php");


if($staffid!="" && $staffid!="undefined" && $staffid!=NULL)
{
	$query="update staff set 
	`username`='$dat1',
	`password`='$dat2',
	`names`='$dat3',
	`contacts`='$dat4',
	`office`='$dat5',
	`level`='$dat7'
	where `staffid`='$staffid'";
		
	$rs=@mysql_query($query);
	if ($_FILES['txtDat6']['name']!="")
	{
		//save picture		
		$result=saveFile('txtDat6','staffid',$staffid,'staff/photo/','staff','photo');	
	}
}
else
{
	$rs=@mysql_query("select * from staff");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$staffidx="INV00".$counts;
			$rs1=@mysql_query("select * from staff where `staffid`='$staffidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into staff values('$staffidx','$dat1','$dat2','$dat3','$dat4','$dat5','none','-','-','$dat7')";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat6']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat6','staffid',$staffidx,'staff/photo/','staff','photo');		
		
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("staff.php","content","");
</script>
</html>
