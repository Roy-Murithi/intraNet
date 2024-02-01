<?php session_start();
include "conn.php";
//$dat1=@$_POST["imgalbum"];
$dat1=@$_POST["txtAlt"];
$dat2=date('d/m/y');
$dat3=@$_POST["txtDesc"];
$dat4=@$_SESSION['names'];
$albumid=@$_POST["albumid"];
$index=@$_POST["index"];
$dat5=date("Ymd").date('His');
include ("globalfunc.php");


if($albumid!="" && $albumid!="undefined" && $albumid!=NULL)
{
	$query="update ".$pref."album set 
	`title`='$dat1',
	`details`='$dat3'
	where `albumid`='$albumid'";
	mysql_query($query);
}else
{
	$rs=@mysql_query("select * from ".$pref."album");
	$counts=0;
	if($rs)
	{
		$counts=mysql_num_rows($rs);
	}
	

	do
	{
			$counts=$counts+1;
			$albumidx="ALBM-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."album where `albumid`='$albumidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."album values('$albumidx','$dat1','$dat2','$dat3','$dat4','$dat5')";
	$rs=@mysql_query($query);
	
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	<?php if($albumid!=""){ ?>
	alert("Album has been updated");
	<?php }else{ ?>
	alert("Album has been created");
	<?php }?>
	getPage("album.php","content","index=<?php echo $index; ?>");
</script>
</html>
