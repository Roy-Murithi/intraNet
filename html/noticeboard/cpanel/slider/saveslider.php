<?php
include "conn.php";
//$dat1=@$_POST["imgSlider"];
$dat2=@$_POST["txtAlt"];
$dat3=@$_POST["txtDesc"];

include ("globalfunc.php");

$imagesC="";
	$rs=@mysql_query("select * from ".$pref."slider");
	if($rs)
	{
		$counts=@mysql_num_rows($rs);
		$imagesC=$counts;
	}
	do
	{
			$counts=$counts+1;
			$slideridx="SLDR-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."slider where `sliderid`='$slideridx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."slider values('$slideridx','none','$dat2','$dat3','$imagesC')";
	$rs=@mysql_query($query);
	if ($_FILES['imgSlider']['name']!="")
	{
		//save picture
		$result=saveFile('imgSlider','sliderid',$slideridx,'slider/',$pref.'slider','image');		
		
	}

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Image has been uploaded");
	<?php 
		$rs1=@mysql_query("select * from ".$pref."slider where `sliderid`='$slideridx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
				if($dup>0)
				{
					$data=mysql_fetch_array($rs1);
				}
			}
		$pic="../../".$data[1];
		$temp=getimagesize($pic);
	 	 $w=$temp[0];$h=$temp[1];
		 if($h/$w!=248/711)
		 {
		 	?>
		 	alert("Picture uploaded will leave blank space in the slider, please upload picture with dimensions Height=248, Width=711");
			<?
		 }
	?>
	getPage("uploader.php","content","sliderid=<?php echo $slideridx;?>");
</script>
</html>
