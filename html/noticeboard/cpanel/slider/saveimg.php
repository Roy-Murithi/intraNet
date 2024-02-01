<?php
include "conn.php";
$sliderid=@$_POST["sliderid"];
//$dat1=@$_POST["imgSlider"];
$dat2=@$_POST["txtAlt"];
$dat3=@$_POST["txtDesc"];

include ("globalfunc.php");


if($sliderid!="" && $sliderid!="undefined" && $sliderid!=NULL)
{
	$query="update ".$pref."slider set 
	`alttext`='$dat2',
	`description`='$dat3'
	where `sliderid`='$sliderid'";
	mysql_query($query);
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Changes to image details has been saved")
	window.returnValue ="ok";
    window.close()
</script>
</html>
