<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$OBid=@$_POST["OBid"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]." ".@$_POST["txtDatH"].":".@$_POST["txtDatM"]);
$dat3=removeTag(@$_POST["txtDat3"]);
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7=$_SESSION['names'];
$dat8=date("Y/m/d H:i:s");
$dat9=date("YmdHis");
//include ("globalfunc.php");
if($OBid!="" && $OBid!="undefined" && $OBid!=NULL)
{
	$query="update  ".$pref."OB set 
	`Refference Number`='$dat1',
	`Occurence date`='$dat2',
	`casefile number`='$dat3',
	`Nature of Occurence`='$dat4',
	`Occurence`='$dat5',
	`Remarks`='$dat6'
	where `OBid`='$OBid'";
	$rs=@mysql_query($query);
	procLog($pref,$OBid,"Edited OB and saved the changes","Updated");
}
else
{
	$valDat=fetchValue($pref."tracker","varname","OB",1);
	do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('OB','$valDat')";
				$rs=@mysql_query($query);
			}
			$OBidx="OB0".$valDat;
			$rs1=@mysql_query("select * from  ".$pref."OB where `OBid`='$OBidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);
	
	$query="insert into  ".$pref."OB values('$OBidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','0','')";
	$rs=@mysql_query($query);
	$query="update ".$pref."tracker set value='$valDat' where `varname`='OB'";
	$rs=@mysql_query($query);
	procLog($pref,$OBidx,"New OB added to the system","Added");
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
<?php if($OBid!="" && $OBid!="undefined" && $OBid!=NULL)
{?>
	getPage("obcomplaint.php","content","index=<?php echo (int)@$_POST['index']; ?>");
<?php }else
{?>
	getPage("obcomplaintdetails.php","content","OBid=<?php echo $OBidx;?>&index=<?php echo (int)@$_POST['index']; ?>&url=obcomplaint");
<?php
}
?>
</script>
</html>
