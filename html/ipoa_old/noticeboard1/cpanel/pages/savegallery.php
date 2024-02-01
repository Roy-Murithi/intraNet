<?php session_start();
include "conn.php";
//$dat1=@$_POST["imggallery"];
$dat2=@$_POST["txtAlt"];
$dat3=@$_POST["txtDesc"];
$dat6=@$_SESSION['names'];
$dat7=date('d/m/y');
include ("globalfunc.php");

$imagesC=date("Ymd").date('His');
	$rs=@mysql_query("select * from ".$pref."gallery");
$counts=0;
	if($rs)
	{
		$counts=mysql_num_rows($rs);
	}
	

	do
	{
			$counts=$counts+1;
			$galleryidx="GLRY-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."gallery where `galleryid`='$galleryidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."gallery values('$galleryidx','none','$dat2','$dat3','$imagesC','page','$dat6','$dat7','default')";
	$rs=@mysql_query($query);
	if (@$_FILES['imggallery']['name']!="")
	{
		//save picture
		$result=saveFile('imggallery','galleryid',$galleryidx,'gallery/',$pref.'gallery','image');		
		
	}

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Image has been uploaded");
	<?php 
		$rs1=@mysql_query("select * from ".$pref."gallery where `galleryid`='$galleryidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
				if($dup>0)
				{
					$data=mysql_fetch_array($rs1);
				}
			}
	?>
	getPage("listimages.php","content","");
</script>
</html>
