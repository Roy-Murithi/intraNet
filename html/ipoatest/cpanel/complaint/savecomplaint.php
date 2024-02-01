<?php
ob_start(); 
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$complaintid=@$_POST["complaintid"];
$zindex=@$_POST["zindex"];
$dat0=removeTag(@$_POST["txtDat0"]);
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2="-";
$dat3="-";
$dat4="-";
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7=removeTag(@$_POST["txtDat7"]);
$dat8=date("Y/m/d H:i:s");
$dat9="0";
$dat10="-";
$dat11="0";
$dat12="-";
$dat13="0";
$dat14="-";
$dat15="0";
$dat16="-";
$dat19="-";
$dat20="-";
$dat21="-";
$dat22="-";
$dat23="-";
$dat24="-";
$dat25=@$_POST['status'];
$dat26=removeTag(@$_POST['txtDat26']);
$dat27=date("YmdHis");
$dat28="-";

$datx1=removeTag(@$_POST["txtDatx1"]); // Complaint Description Field
$datx2=removeTag(@$_POST["txtDatx2"]);
$datx3=removeTag(@$_POST["txtDatx3"]);
$datx4=removeTag(@$_POST["txtDatx4"]);
$datx5=removeTag(@$_POST["txtDatx5"]);
$datx6="-";


//include ("globalfunc.php");
if(($complaintid!="" && $complaintid!="undefined"  && $complaintid!=NULL ) or ( $zindex!="" && $zindex!="undefined"  && $complaintid!=NULL))
{
	$query="update  ".$pref."complaint set 
	`complaintid`='$dat0',
	`complaint`='$dat1',
	`natureid`='$dat5',
	`incident location`='$dat6',
	`incident date`='$dat7',
	`agegroup`='$datx1',
	`lodgemode`='$datx2',
	`county`='$datx3',
	`complainant nature`='$datx4',
	`station`='$datx5',
	`status`='$dat25',
	`anonymous`='$dat26',
	`index`='$dat27'
	where `complaintid`='$complaintid' and  `index`='$zindex' ";
		
	$rs=@mysql_query($query);
	
	if(fetchRecordCount_query("select complaintid from sm_main_complaintdetails where `complaintid`='$complaintid'",0)>0){
	
		$query="update  sm_main_complaintdetails set 
		`"._fieldName("sm_main_complaintdetails",1)."`='$datx1',
		`"._fieldName("sm_main_complaintdetails",2)."`='$datx2',
		`"._fieldName("sm_main_complaintdetails",3)."`='$datx3',
		`"._fieldName("sm_main_complaintdetails",4)."`='$datx4',
		`"._fieldName("sm_main_complaintdetails",5)."`='$datx5',
		`"._fieldName("sm_main_complaintdetails",6)."`='$datx6'
		where `complaintid`='$complaintid'";
		$rs=@mysql_query($query);
	}else
	{
		$query="insert into  sm_main_complaintdetails values('$complaintid','$datx1','$datx2','$datx3','$datx4','$datx5','$datx6')";
		$rs=@mysql_query($query);
	}
		
	procLog($pref,$complaintid,"Edited complaint and saved the changes","Updated");
	
}
else
{
	$valDat=fetchValue($pref."tracker","varname","complaint",1);
	do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('complaint','$valDat')";
				$rs=@mysql_query($query);
			}
			$complaintidx="CMPL0".$valDat;
			$rs1=@mysql_query("select * from  ".$pref."complaint where `complaintid`='$complaintidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);
	if($dat0=="")
	{
		$complaintidx=get_uniq_complaintno("COMP/","complaint","complaint","complaintid",$db,$pref);
	}else
	{
		$dup=fetchRecordCount($pref."complaint","complaintid",$dat0);
		if($dup>0)
		{
			?>
			<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("You entered dupicate complaint number, the server has dropped the information. To auto allocate the number leave the complaints number textbox empty");
	getPage("editcomplaint.php","content","index=<?php echo (int)@$_POST['index']; ?>");
</script>
</html>

<?php
		}else
		{
			$complaintidx=$dat0;
		}
	}
	$query="insert into  ".$pref."complaint values('$complaintidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','$dat12','$dat13','$dat14','$dat15','$dat16','0','-','$dat19','$dat20','$dat21','$dat22','$dat23','$dat24','$dat25','$dat26','$dat27','-','-','-','-','$datx1','$datx2','$datx3','$datx4','$datx5')";
	$rs=@mysql_query($query);
	
	$query="insert into  sm_main_complaintdetails values('$complaintidx','$datx1','$datx2','$datx3','$datx4','$datx5','$datx6')";
	$rs=@mysql_query($query);
	
	$query="update ".$pref."tracker set value='$valDat' where `varname`='complaint'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintidx,"New complaint added to the system","Added");
}

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
<?php if($complaintid!="" && $complaintid!="undefined" && $complaintid!=NULL)
{?>
	getPage("complaint.php","content","index=<?php echo (int)@$_POST['index']; ?>");
<?php }else
{?>
	getPage("complaintdetails.php","content","complaintid=<?php echo $complaintidx;?>&index=<?php echo (int)@$_POST['index']; ?>");
<?php
}
?>
</script>
</html>
