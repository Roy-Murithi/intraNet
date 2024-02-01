<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$personsid=@$_GET["personsid"];
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$field=@$_GET["fld"];


	if($field=="2")
	{
		$fld="complainant";
		$psn="complainant";
	}elseif($field=="3")
	{
		$fld="againist";
		$psn="defedant";	
	}elseif($field=="4")
	{
		$fld="witnesses";
		$psn="witness";
	}
	$value=fetchValue($pref."complaint","complaintid",$complaintid,$field);
	if($value=="-" ){$value="";}
	$value=$value.$personsid."!~!";
	$rs=@mysql_query("select * from  ".$pref."complaint ");
	if($rs)
	{
		$fldname=@mysql_field_name($rs,$field);
	}
	$query="update ".$pref."complaint set `$fldname`='$value' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	$dat2=fetchValue($pref."persons","personsid",$personsid,2); 
	$dat3=fetchValue($pref."persons","personsid",$personsid,3); 
	$dat4=fetchValue($pref."persons","personsid",$personsid,4); 
	$dat5=fetchValue($pref."persons","personsid",$personsid,5);
	procLog($pref,$complaintid,"Linked ($dat2. $dat3 $dat4 $dat5)  with the complaint as a $psn","Linked");
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo @$index;?>&complaintid=<?php echo @$complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
