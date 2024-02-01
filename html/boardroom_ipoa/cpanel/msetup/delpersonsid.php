<?php
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
	}elseif($field=="3")
	{
		$fld="againist";	
	}elseif($field=="4")
	{
		$fld="witnesses";	
	}
	$value=fetchValue($pref."complaint","complaintid",$complaintid,$field);
	$value=str_replace($personsid."!~!","",$value);
	$rs=@mysql_query("select * from  ".$pref."complaint ");
	if($rs)
	{
		$fldname=@mysql_field_name($rs,$field);
	}
	
	$query="update ".$pref."complaint set `$fldname`='$value' where `complaintid`='$complaintid'";
	
	$rs=@mysql_query($query);
	
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
