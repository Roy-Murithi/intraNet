<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$status=@$_GET['status'];
					if($status==0)
					{
						$statusv=96;
						$status1="Date Assigned";
					}
					if($status==1)
					{
						$statusv=95;
						$status1="Date Assigned";
					}
					if($status==2)
					{
						$statusv=94;
						$status1="Date Conluded";
					}
					if($status==3)
					{
						$statusv=93;
						$status1="Date Closed";
					}
					if($status==4)
					{
						$statusv=98;
						$status1="Date reported";
					}
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="savecomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="398" height="22" valign="top">All Investigations </td>
    <td colspan="2" valign="top"><div style="float:left">Search by Case Number:
      <input name="txtSearch" type="text" id="txtSearch" value="<?php $search=@$_GET['search'];echo @$search; ?>" />
    </div>      <div style="float:left">
        <?php 
	  $script="getPage('investigation.php','content','sessid=smetsysmocmas&index=".(int)@$_GET['index']."&search=' +document.frmUsers.txtSearch.value)";
	  echo classBTN("btnApprove","Search","#","","$script"); ?>
      </div></td>
    </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="38" colspan="3" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="20" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="131" valign="top" style="border-bottom:thin dotted;">Investigation file N<u>o</u> </td>
            <td width="396" valign="top" style="border-bottom:thin dotted;">Complaint</td>
            <td width="113" valign="top" style="border-bottom:thin dotted;"><?php echo $status1; ?></td>
            <td width="101" valign="top" style="border-bottom:thin dotted;">Action</td>
          </tr>
	    

	    
	    <?php
		$max=5;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="investigation.php";
		$index=0;
		
					
		
		
		if($statusv=="98")
		{	
			$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='$statusv') order by `index` desc");
		}else
		{
			$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='$statusv') and `complaintid` like '%$search%' order by `index` desc");
		}
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				if($start>0)
				{	
					$index=0;			
					$first="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">First</a>";
					$index=$start-$max;
					if($index<0){$index=0;}			
					$prev="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Previous</a>";
				}				
				if($counts>$start+$max)
				{	
					$index=$counts-$max;			
					$last="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Last</a>";
					$index=$start+$max;			
					$next="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Next</a>";
				}else
				{
					$max=$counts-$start;
				}

				$color="#FFFFFF";
				$end=$start+$max;
				for($x=$start;$x<$end;$x++)
				{
					mysql_data_seek($rs,$x);
					if($color=="#FFFFFF")
					{
						$color="#ABD8DA";
					}else
					{
						$color="#FFFFFF";
					}
					$data=@mysql_fetch_array($rs);
					if($status==0)
					{
						$sfld=3;
						$invstatus=fetchValue($pref."investigation","complaintid",$data[0],(int)@$sfld);
					}
					if($status==1)
					{
						$sfld=3;
						$invstatus=fetchValue($pref."investigation","complaintid",$data[0],(int)@$sfld);
					}
					if($status==2)
					{
						$sfld=8;
						$invstatus=fetchValue($pref."investigation","complaintid",$data[0],(int)@$sfld);
					}
					if($status==3)
					{
						$sfld=10;
						$invstatus=fetchValue($pref."investigation","complaintid",$data[0],(int)@$sfld);
					}
					
					if($status==4)
					{
						$sfld=8;
						$invstatus=fetchValue($pref."complaint","complaintid",$data[0],(int)@$sfld);
					}
					$invno=fetchValue($pref."investigation","complaintid",$data[0],0);
					if($data[17]=="98")
					{
						$strRefDate=fetchValue($pref."reffer","complaintid",$data[0],5);
						$strReffered_to=fetchValue($pref."reffer","complaintid",$data[0],3);
						$strMsg="since complaint was Refered to $strReffered_to";
						$strDate=@$data[$strRefDate];
					}
					elseif($data[17]=="97")
					{
						$strMsg="since complaint was approved";
						$strDate=@$data[10];
					}
					elseif($data[17]=="96")
					{
						$strMsg="since investigation was opened";
						$strDate=@$data[12];
					}
					elseif($data[17]=="95")
					{
						$strMsg="since investigation was opened";
						$strDate=@$data[12];
					}
					elseif($data[17]=="94")
					{
						$strMsg="since investigation was concluded";
						$strDate=@$data[14];
					}
					elseif($data[17]=="93")
					{
						$strMsg="since investigation was finalized";
						$strDate=@$data[16];
					}
					else
					{
						$strMsg="since complaint was reported";
						$strDate=@$data[8];
					}	
					$strDur="<div style=\"border:thin dotted; background:#FCFFBC;\">it has been ".getDuration($strDate,"$strMsg") ."</div>";
					
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$invno</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$data[1]$strDur</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$invstatus</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('investigationdetails.php','content','complaintid=$data[0]&index=$start&status=$status')\">Details</a>
					</td>
					
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    </tr>
  <tr>
    <td height="27" colspan="2"  valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td width="326" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td width="60"></td>
    <td></td>
    </tr>
</table>
</form>

