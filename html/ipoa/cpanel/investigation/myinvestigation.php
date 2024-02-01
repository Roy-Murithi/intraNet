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
    <td width="376" height="22" valign="top">All my Investigations </td>
    <td colspan="2" valign="top"><div style="float:left">Search by Case Number:
      <input name="txtSearch" type="text" id="txtSearch" value="<?php  $search=@$_GET['search'];echo @$search; ?>" />
    </div>      <div style="float:left">
        <?php 
	  $script="getPage('myinvestigation.php','content','sessid=smetsysmocmas&index=".(int)@$_GET['index']."&search=' +document.frmUsers.txtSearch.value)";
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
	      <td width="36" height="24" valign="top" style="border-bottom:thin dotted;">Index</td>
            <td width="90" valign="top" style="border-bottom:thin dotted;">Investigation file N<u>o</u> </td>
            <td width="441" valign="top" style="border-bottom:thin dotted;">Complaint</td>
            <td width="113" valign="top" style="border-bottom:thin dotted;">Investigator</td>
            <td width="100" valign="top" style="border-bottom:thin dotted;">Action</td>
          </tr>

	    
	    <?php
		$max=5;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="myinvestigation.php";
		$index=0;
		$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='96' or  `uneditable`='95') and `case no` like '%$search%' order by `index` desc");
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
					$unique_value=fetchValue($pref."investigation","complaintid",$data[0],2);
					$inv=fetchValue("staff","staffid",$unique_value,3);
					$status="";
					if($data[17]==96)
					{
						$status="Unattended to";
					}
					if($data[17]==95)
					{
						$status="Under investigation";
					}
					if($data[17]==94)
					{
						$status="Concluded";
					}
					if($data[17]==93)
					{
						$status="Closed";
					}
					if($inv==""){$inv="Unassigned";}
					if($data[24]!="" && $data[24]!="-")
					{
						$valDat=fetchValue($pref."explanation","explanationid",$data[24],2);
						$returned="<div style=\"border:thin dotted #FF0000\"><font color=\"red\">Re-opened investigation<br />Reasons: $valDat</font></div> ";
					}else
					{
						$returned="";
					}
					$assignment=fetchValue($pref."investigation","complaintid",$data[0],14);
					if($assignment!="" && $assignment!="-")
					{
			
						$assgnmt="<div style=\"border:thin dotted #008800\"><font color=\"#008800\">Investiogation assignment instruction<br />Instruction: $assignment</font></div> ";
					}else
					{
						$assgnmt="";
					}
					$invno=fetchValue($pref."investigation","complaintid",$data[0],0);
					$strDur="<div style=\"border:thin dotted; background:#FCFFBC;\">it has been ".getDuration(@$data[12],"since investigation was opened") ."</div>";
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$invno</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$assgnmt$returned$data[1]$strDur</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$inv<br /><font color=\"#FF0000\">$status</font></td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('myinvestigationdetails.php','content','complaintid=$data[0]&index=$start')\">Details</a>
					</td>
					
					</tr>";
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
    <td width="82"></td>
    <td></td>
    </tr>
</table>
</form>

