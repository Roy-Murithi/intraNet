<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$staffid=@$_POST["staffid"];
$files=@$_POST["files"];
$query="delete from ".$pref."access where `userid`='$staffid'";
$rs=@mysql_query($query);
if($staffid!="")
{
	if($files!="")
	{
		$temp=explode("!~!!~!",$files);
		//include ("globalfunc.php");
		foreach($temp as $fname)
		{
			$fname=str_replace("!~!","",$fname);
			$tempfname=explode("!#!",$fname);
			$strFunction=@fetchValue($pref."accessreg","filename","$tempfname[0]","1");
			$query="insert into ".$pref."access values('$staffid','$strFunction','$tempfname[0]','$tempfname[1]')";
			$rs=@mysql_query($query);
		}
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("accessrights.php","content","staffid=<?php echo $staffid;?>");
</script>
</html>
