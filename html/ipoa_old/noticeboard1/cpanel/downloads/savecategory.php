<?php
session_start();
include "conn.php";
include ("globalfunc.php");
$downloadcatid=@$_POST["downloadcatid"];
$dat1=@str_replace("'","\'",$_POST["txtTitle"]);
$dat2=@str_replace("'","\'",$_POST["txtDetails"]);
$dat3="none";


if($downloadcatid!="" && $downloadcatid!="undefined" && $downloadcatid!=NULL)
{
	$query="update downloadcat set 
	`name`='$dat1',
	`description`='$dat2'
	where `downloadcatid`='$downloadcatid'";
	
	$rs=@mysql_query($query);
	if (@$_FILES['imggallery']['name']!="")
	{
		//save picture
		$result=saveFile('imggallery','downloadcatid',$downloadcatid,'gallery/','downloadcat','thumbnail');		
	}
}
else
{
	$rs=@mysql_query("select * from downloadcat");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$downloadcatidx="DCAT-00".$counts;
			$rs1=@mysql_query("select * from downloadcat where `downloadcatid`='$downloadcatidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);
	$query="insert into downloadcat values('$downloadcatidx','$dat1','$dat2','$dat3','0')";
	$rs=@mysql_query($query);
	if (@$_FILES['imggallery']['name']!="")
	{
		//save picture
		$result=saveFile('imggallery','downloadcatid',$downloadcatidx,'gallery/','downloadcat','thumbnail');		
		
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("category.php","content","");
</script>
</html>
