<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$personid=@$_POST["personid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3=removeTag(@$_POST["txtDat3"]);
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);
//$dat5=removeTag(@$_POST["txtDat5"]);
$dat7=removeTag(@$_POST["txtDat7"]);
$dat8=removeTag(@$_POST["txtDat8"]);
//include ("globalfunc.php");


if($personid!="" && $personid!="undefined" && $personid!=NULL)
{
	$query="update person set 
	`names`='$dat1',
	`email`='$dat2',
	`post`='$dat3',
	`extension`='$dat4',
	`office`='$dat5',
	`department`='$dat7',
	`type`='$dat8'
	where `personid`='$personid'";
		
	$rs=@mysql_query($query);
	
	if ($_FILES['file']['name']!="")
	{
		//save picture
		$result=saveFile('file','personid',$personid,'photo/','person','photo');
	}
}
else
{
	
	$personidx=get_uniq_idno("PSN-00","person","person","personid",$db,$pref);
	$query="insert into person values('$personidx','$dat1','$dat2','$dat3','$dat4','$dat5','none','$dat7','$dat8')";
	$rs=@mysql_query($query);
	if ($_FILES['file']['name']!="")
	{
		//save picture
		$result=saveFile('file','personid',$personidx,'person/photo/','person','photo');
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("person.php","content","");
</script>
</html>
