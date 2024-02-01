<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$supportid=removeTag(@$_POST["supportid"]);
$resolved=@$_POST['resolved'];
$dat8="99";
$dat9=$_SESSION['userid'];
$dat10=date("Y/m/d h:i:s");

$dat12=$resolved;
if($dat12=="99")
{
	$dat13=date("Y/m/d h:i:s");
}else
{
	$dat13="";
}

if($supportid!="" && $supportid!="undefined" && $supportid!=NULL)
{
	$query="update support set 
	`"._fieldName("support",8)."`='$dat8',
	`"._fieldName("support",9)."`='$dat9',
	`"._fieldName("support",10)."`='$dat10',
	`"._fieldName("support",12)."`='$dat12',
	`"._fieldName("support",13)."`='$dat13'  
	where `supportid`='$supportid'";
		
	$rs=@mysql_query($query);

}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("processrequest.php","content","supportid=<?php echo $supportid;?>");
</script>
</html>
