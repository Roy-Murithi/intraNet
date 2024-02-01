<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include ("globalfunc.php");
$complaintid=@$_GET["complaintid"];
$index=@$_GET["index"];
$invid=@$_GET["invid"];
$apdate=date("Y/m/d H:i:s");
if(@$_GET["del"]=="99")
{
	if(@$_GET["leadinv"]=="99")
	{
		$query="update ".$pref."investigation set `investigator`='' where `complaintid`='$complaintid'";
		$rs=@mysql_query($query);
		$msgbox="Lead investigator removed";
	}else
	{
		$rs=@mysql_query("select * from  ".$pref."investigation where  `complaintid`='$complaintid'");
		if ($rs)
		{
			$dup=@mysql_num_rows($rs);
			if($dup>0)
			{
				$datai=mysql_fetch_array($rs);
				$strInv=$datai[13];
				if($strInv!="")
				{
					$strInv=str_replace($invid,"",$strInv);
					$strInv=str_replace("!~!!~!","!~!",$strInv);
					$query="update ".$pref."investigation set `support_investigators`='$strInv' where `complaintid`='$complaintid'";
					$rs=@mysql_query($query);
				}
			}
		}
	}
	$invnames=fetchValue("staff","staffid",$invid,3);	
	$log="Removed $invnames from investigation";
	$action="Removed";
	procLog($pref,$complaintid,$log,$action);
	$msgbox="Support investigator removed";
}else
{
	if(@$_GET["leadinv"]=="99")
	{
		$query="update ".$pref."investigation set `investigator`='$invid' where `complaintid`='$complaintid'";
		$rs=@mysql_query($query);
		$invnames=fetchValue("staff","staffid",$invid,3);	
		$log="reassigned investigation to $invnames as a lead investigator";
		$action="Re-assignment";
		procLog($pref,$complaintid,$log,$action);
		$msgbox="Lead investigator reassigned";
	}else
	{
		$rs=@mysql_query("select * from  ".$pref."investigation where  `complaintid`='$complaintid'");
		if ($rs)
		{
			$dup=@mysql_num_rows($rs);
			if($dup>0)
			{
				$datai=mysql_fetch_array($rs);
				$strInv=$datai[13];
					if($strInv=="-"){$strInv="";}
					$strInv=str_replace($invid,"",$strInv);
					$strInv=str_replace("!~!!~!","!~!",$strInv);
					if(strpos($strInv,$invid)<=0)
					{				
						$strInv=$strInv."!~!".$invid;
						$query="update ".$pref."investigation set `support_investigators`='$strInv' where `complaintid`='$complaintid'";
						$rs=@mysql_query($query);
						
						$invnames=fetchValue("staff","staffid",$invid,3);	
						$log="Attached $invnames as a support investigator";
						$action="Assignment";
						procLog($pref,$complaintid,$log,$action);
						$msgbox="Support investigator attached";
					}
			}
		}
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("<?php echo @$msgbox;?>")
	getPage("investigationdetails.php","content","index=<?php echo @$index;?>&complaintid=<?php echo @$complaintid;?>&sessid=smetsysmocmas");
</script>
</html>
