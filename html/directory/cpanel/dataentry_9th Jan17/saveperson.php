<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$personid=@$_POST["personid"];
$dat1=removeTag(@$_POST["txtDat1"]); //name
$dat2=removeTag(@$_POST["txtDat2"]); //email
$dat3=removeTag(@$_POST["txtDat3"]); //post
$dat4=removeTag(@$_POST["txtDat4"]); //extension
$dat5=removeTag(@$_POST["txtDat5"]); //office
//$dat5=removeTag(@$_POST["txtDat5"]); //photo
$dat7=removeTag(@$_POST["txtDat7"]); // department
$dat8=removeTag(@$_POST["txtDat8"]); //password
//include ("globalfunc.php");
$dat9=@$_POST["txtDat9"]; //macaddress

$dat10="";
if($personid!="" && $personid!="undefined" && $personid!=NULL)
{
	if($dat9!="")
	{
		$strDat9=", `password`='$dat9'";
	}else
	{
		$strDat9="";
	}
	$query="update person set 
	`names`='$dat1',
	`email`='$dat2',
	`post`='$dat3',
	`extension`='$dat4',
	`office`='$dat5',
	`department`='$dat7',
	`type`='$dat8'
	$strDat9	
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
	$query="insert into person values('$personidx','$dat1','$dat2','$dat3','$dat4','none','$dat6','$dat7','$dat8','$dat9','$dat10')";
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
