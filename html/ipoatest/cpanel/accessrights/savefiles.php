<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$fid=@$_POST["fid"];
$function=@$_POST["function"];
$files=@$_POST["files"];
$query="delete from ".$pref."accessreg where `function`='$function' and `pagegroup`='$fid'";
$rs=@mysql_query($query);
if($function!="")
{
	if($files!="")
	{
		$temp=explode("!~!!~!",$files);
		//include ("globalfunc.php");
		
		foreach($temp as $fname)
		{
			$fname=str_replace("!~!","",$fname);
	
			$query="insert into  ".$pref."accessreg values('$fname','$function','$fid')";
			$rs=@mysql_query($query);
		}
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("cpages.php","content","");
</script>
</html>
