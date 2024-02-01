<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$supportid=removeTag(@$_POST["supportid"]);
$dat1=removeTag(@@$_SESSION['userid']);
$dat2=removeTag(@$_POST["request"]);
$dat3=removeTag(@$_POST["requesttype"]);
$dat4=date("Y/m/d h:i:s");
$dat5="";
$dat6="";
$dat7="";
$dat8="";
$dat9="";
$dat10="";
$dat11=date("YmdHis");
$dat12="";
$dat13="";
//include ("globalfunc.php");


if($supportid!="" && $supportid!="undefined" && $supportid!=NULL)
{
	$query="update support set 
	`"._fieldName("support",2)."`='$dat2',
	`"._fieldName("support",3)."`='$dat3'
	where `supportid`='$supportid'";
		
	$rs=@mysql_query($query);

}
else
{
	
	$supportidx=get_uniq_idno("SPT-00","support","support","supportid",$db,$pref);
	$query="insert into support values('$supportidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','$dat12','$dat13')";
	$rs=@mysql_query($query);

}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	 getPage("request.php","content","");
</script>
</html>
