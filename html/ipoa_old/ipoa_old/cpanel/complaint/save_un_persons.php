<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$personsid=@$_POST["personsid"];
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$field=@$_POST["fld"];
$dat1="";
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3=removeTag(@$_POST["txtDat3"]);
$dat4="";
$dat5="";
$dat6="";
$dat7="";
$dat8="";
$dat9="";
$dat10="";
$dat11="";
$dat12="";
$dat13="";
$dat14="";
$dat15="";
$dat16="";
$dat17="";
$dat18="";

//include ("globalfunc.php");

	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."persons ");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$personsidx="CMPL00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."persons where `personsid`='$personsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."persons values('$personsidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','$dat12','$dat13','$dat14','$dat15','$dat16','$dat17','$dat18','none','99','')";
	
	$rs=@mysql_query($query);
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
	if($value=="-" ){$value="";}
	$value=$value.$personsidx."!~!";
	$query="update ".$pref."complaint set `$fld`='$value' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Added own motion details to the complaint","Added");
	
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
