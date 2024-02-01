<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

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
    <td height="22" colspan="2" valign="top">Approved complaint (Investigation is unopened) </td>
    </tr>
  <tr>
    <td height="21" colspan="2" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="27" colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="29" height="22" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="111" valign="top" style="border-bottom:thin dotted;">Complaint file N<u>o</u> </td>
            <td width="127" valign="top" style="border-bottom:thin dotted;">Investigation file N<u>o</u> </td>
		    <td width="300" valign="top" style="border-bottom:thin dotted;">Status</td>
            <td width="112" valign="top" style="border-bottom:thin dotted;">Date</td>
            <td width="103" valign="top" style="border-bottom:thin dotted;">Action</td>
          </tr>
	    <tr>
	      <td height="2"></td>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td></td>
	      </tr>
	    
	    
	    <?php
		$max=10;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="apcomplaint.php";
		$index=0;
		$rs=@mysql_query("select * from ".$pref."complaint where `uneditable`='97' or `uneditable`='96' or `uneditable`='95' or `uneditable`='94' or `uneditable`='93'  order by `index` desc");
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
					$strStatus= getUrgent($pref,$data[0],25,40);
					if($data[17]=="0")
					{
						$status="Unsubmitted to head of complaints";
					}else if($data[17]=="99")
					{
						$status="submitted to head of complaints";
					}else if($data[17]=="98")
					{
						$status="Reffered";
					}else if($data[17]=="97")
					{
						$status="Approved but not assigned to investigator";
					}else if($data[17]=="96")
					{
						$status="Assigned to Investigators";
					}else if($data[17]=="95")
					{
						$status="Under investigation";
					}else if($data[17]=="94")
					{
						$status="Concluded";
					}else if($data[17]=="93")
					{
						$status="Closed";
					}
					$invid=fetchValue($pref."investigation","complaintid",$data[0],0);
					if($invid=="")
					{
						$invid="&nbsp;";
					}
					
					
					if($data[17]=="98")
					{
						$strRefDate=fetchValue($pref."reffer","complaintid",$data[0],5);
						$strReffered_to=fetchValue($pref."reffer","complaintid",$data[0],3);
						$strMsg="since complaint was reffered to $strReffered_to";
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
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$data[0]</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$invid</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\">$status$strDur</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\">$data[8]</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('apcomplaintdetails.php','content','complaintid=$data[0]&index=$start')\">Details</a>$strStatus
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
    <td width="458" height="18"></td>
    <td width="326"></td>
  </tr>
  <tr>
    <td height="27"  valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td></td>
    </tr>
</table>
</form>

