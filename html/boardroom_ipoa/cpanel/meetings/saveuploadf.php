<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$meetingsid=@$_POST["meetingsid"];
$dat1=removeTag($meetingsid);
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3="none";
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7=date("d/m/Y");
$dat8=date("YmdHis");


//include ("globalfunc.php");

	 $counts=0;
	$rs=@mysql_query("select * from  files");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
	}
	do
	{
			//strDat=(string)$valDat;
			$filesidx="SCH0".$counts;
			$rs1=@mysql_query("select * from files where `filesid`='$filesidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$counts=$counts+1;
			
	}while($dup!=0);
	
	$query="insert into files values('$filesidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8')";
	$rs=@mysql_query($query);
	procLog($pref,$filesidx,"New meeting  scheduled to the system","Scheduled");
	
	if ($_FILES['file']['name']!="")
	{
		//save picture
		$result=saveFileAll('file','filesid',$filesidx,'m_documents/','files','path');
	}

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("fileupload.php","content","meetingsid=<?php echo $meetingsid; ?>");
</script>
</html>
