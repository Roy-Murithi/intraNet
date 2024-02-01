<?php
session_start();
include "conn.php";
include ("globalfunc.php");
$downloadsid=@$_POST["downloadsid"];
$downloadcatid=@$_POST["downloadcatid"];
$dat1=@str_replace("'","\'",$_POST["txtTitle"]);
$dat2=$downloadcatid;
$dat3=@str_replace("'","\'",$_POST["txtDetails"]);
$dat4="none";
$dat5=date("d/m/y");
$dat6=date("Ymd").date('His');

if($downloadsid!="" && $downloadsid!="undefined" && $downloadsid!=NULL)
{
	$query="update ".$pref."downloads set 
	`name`='$dat1',
	`details`='$dat3',
	`date`='$dat5'
	where `downloadsid`='$downloadsid'";
	
	$rs=@mysql_query($query);
	if (@$_FILES['imggallery']['name']!="")
	{
		//save picture
		$result=saveFileAll('imggallery','downloadsid',$downloadsidx,'downloads/',$pref.'downloads','link');		
		
	}
}
else
{
	$rs=@mysql_query("select * from ".$pref."downloads");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$downloadsidx="DLD-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."downloads where `downloadsid`='$downloadsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);
	$query="insert into ".$pref."downloads values('$downloadsidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6')";
	$rs=@mysql_query($query);
	if (@$_FILES['imggallery']['name']!="")
	{
		//save picture
		$result=saveFileAll('imggallery','downloadsid',$downloadsidx,'downloads/',$pref.'downloads','link');		
		
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("downloads.php","content","downloadcatid=<?php echo $downloadcatid;?>&sessid=smetsysmocmas");
</script>
</html>
