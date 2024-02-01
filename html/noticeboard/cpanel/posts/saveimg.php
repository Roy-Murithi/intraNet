<?php
include "conn.php";
$galleryid=@$_POST["galleryid"];
//$dat1=@$_POST["imggallery"];
$dat2=str_replace("'","\'",@$_POST["txtAlt"]);
$dat3=str_replace("'","\'",@$_POST["txtDesc"]);
$dat4=(int)@$_POST["txtH"];
$dat5=(int)@$_POST["txtW"];
$datT4=(int)@$_POST["txtTH"];
$datT5=(int)@$_POST["txtTW"];
$index=(int)@$_POST["index"];
include ("globalfunc.php");


if($galleryid!="" && $galleryid!="undefined" && $galleryid!=NULL)
{
	$query="update ".$pref."gallery set 
	`alttext`='$dat2',
	`description`='$dat3'
	where `galleryid`='$galleryid'";
	mysql_query($query);
}
//imagecopy(
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Changes to image details has been saved")
	//window.returnValue ="";
	<?php 
			$rs1=@mysql_query("select * from ".$pref."gallery where `galleryid`='$galleryid'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
				if($dup>0)
				{
					$data=mysql_fetch_array($rs1);
					//echo "<img src=\'../../$data[1]\' height=\'$dat4\' width=\'$dat5\' alt=\'$data[2]\'/>";
				}
			}
	?>
    //window.close()
	document.location="listimages.php?sessid=smetsysmocmas&index=$index;";
</script>
</html>
