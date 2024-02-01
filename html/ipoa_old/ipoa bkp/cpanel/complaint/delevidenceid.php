<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");

$evidenceid=@$_GET["evidenceid"];

$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$field=18;

	$value=fetchValue($pref."complaint","complaintid",$complaintid,$field);
	$value=str_replace("!~!".$evidenceid,"",$value);
	$value=str_replace($evidenceid,"",$value);
	$rs=@mysql_query("select * from  ".$pref."evidence where evidenceid='$evidenceid' ");
	if($rs)
	{
		$rows=mysql_num_rows($rs);
		if($rows>0)
		{
			$datae=mysql_fetch_array($rs);
			if(is_file("../$datae[2]")==true)
			{
				chmod("../$datae[2]",0777);
				unlink("../$datae[2]");
			}
			$rs=@mysql_query("delete from  ".$pref."evidence where evidenceid='$evidenceid' ");
		}
	}
	
	$query="update ".$pref."complaint set `evidence`='$value' where `complaintid`='$complaintid'";	
	$rs=@mysql_query($query);
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
