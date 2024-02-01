<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$personsid=@$_POST["personsid"];
$complaintid=@$_POST["complaintid"];
$index=@$_POST["index"];
$field=@$_POST["fld"];
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3=removeTag(@$_POST["txtDat3"]);
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);
$dat6=removeTag(@$_POST["txtDat6"]);
$dat7=removeTag(@$_POST["txtDat7"]);
$dat8=removeTag(@$_POST["txtDat8"]);
$dat9=removeTag(@$_POST["txtDat9"]);
$dat10=removeTag(@$_POST["txtDat10"]);
$dat11=removeTag(@$_POST["txtDat11"]);
$dat12=removeTag(@$_POST["txtDat12"]);
$dat13=removeTag(@$_POST["txtDat13"]);
$dat14=removeTag(@$_POST["txtDat14"]);
$dat15=removeTag(@$_POST["txtDat15"]);
$dat16=removeTag(@$_POST["txtDat16"]);
$dat17=removeTag(@$_POST["txtDat17"]);
$dat18=removeTag(@$_POST["txtDat18"]);
$dat21=removeTag(@$_POST["txtDat21"]);
//$dat19="";
//$dat20="0";

//include ("globalfunc.php");
if($personsid!="" && $personsid!="undefined" && $personsid!=NULL)
{
	//code to add witness, defedant or complainant
	$query="update  ".$pref."persons set 
  `ID No`='$dat1',
  `title`='$dat2',
  `surname`='$dat3',
  `firstname`='$dat4',
  `lastname`='$dat5',
  `address`='$dat6',
  `mobile`='$dat7',
  `email`='$dat8',
  `county`='$dat9',
  `ward`='$dat10',
  `gender`='$dat11',
  `officer`='$dat12',
  `job details`='$dat13',
  `station`='$dat14',
  `rank`='$dat15',
  `pf no`='$dat16',
  `incustody`='$dat17',
  `custodystation`='$dat18',
  `police_type`='$dat21'
	
	where `personsid`='$personsid'";
		
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Updated information about ($dat2. $dat3 $dat4 $dat5) for the complaint","Updated");
	if ($_FILES['txtDat19']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat19','personsid',$personsid,'persons/photo/',$pref.'persons','photo');
	}
}
else
{
	$counts=0;
	$rs=@mysql_query("select * from  ".$pref."persons ");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=$counts+1;
			$personsidx="CMPL00".$counts;
			$rs1=@mysql_query("select * from  ".$pref."persons where `personsid`='$personsidx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into  ".$pref."persons values('$personsidx','$dat1','$dat2','$dat3','$dat4','$dat5','$dat6','$dat7','$dat8','$dat9','$dat10','$dat11','$dat12','$dat13','$dat14','$dat15','$dat16','$dat17','$dat18','none','0','$dat21')";
	$rs=@mysql_query($query);
	if ($_FILES['txtDat19']['name']!="")
	{
		//save picture
		$result=saveFile('txtDat19','personsid',$personsidx,'persons/photo/',$pref.'persons','photo');
	}
	if($field=="2")
	{
		$fld="complainant";
	}elseif($field=="3")
	{
		$fld="againist";	
	}elseif($field=="4")
	{
		$fld="witnesses";	
	}
	$value=fetchValue($pref."complaint","complaintid",$complaintid,$field);
	if($value=="-" ){$value="";}
	$value=$value.$personsidx."!~!";
	$query="update ".$pref."complaint set `$fld`='$value' where `complaintid`='$complaintid'";
	$rs=@mysql_query($query);
	procLog($pref,$complaintid,"Added information about ($dat2. $dat3 $dat4 $dat5) to the complaint","Added");
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	
	getPage("complaintdetails.php","content","index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
