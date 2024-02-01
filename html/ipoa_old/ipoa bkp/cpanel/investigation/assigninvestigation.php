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
    <td height="22" colspan="2" valign="top">List of complaints for Review and assignment to investigators by head/deputy director of investigations</td>
    </tr>

  
	
  <tr>
    <td height="21" colspan="2" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="38" colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="90" valign="top" style="border-bottom:thin dotted;">Complaint file N<u>o</u> </td>
            <td width="437" valign="top" style="border-bottom:thin dotted;">Complaint</td>
            <td width="113" valign="top" style="border-bottom:thin dotted;">Date</td>
            <td width="100" valign="top" style="border-bottom:thin dotted;">Action</td>
          </tr>

	    
	    <?php
		$max=5;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="assigninvestigation.php"; 
		$index=0;
		$rs=@mysql_query("select * from ".$pref."complaint where `uneditable`='97'  order by `status` desc,`index` desc");
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
					if($data[24]!="" && $data[24]!="-")
					{
						$valDat=fetchValue($pref."explanation","explanationid",$data[24],2);
						$returned="<div style=\"border:thin dotted #FF0000\"><font color=\"red\">Re-opened Investigation<br />Reasons: $valDat</font></div> ";
					}else
					{
						$returned="";
					}
					$urgentCount=  fetchRecordCount1($pref."complaint","status",99,"uneditable",97);
					if($data[25]!="99" && $urgentCount>0)
					{
						$func="alert('System cannot continue, You must clear complaint marked urgent first')";
					}else
					{
						$func="getPage('asscomplaintdetails.php','content','complaintid=$data[0]&index=$start')";
					}
					
					$strStatus= getUrgent($pref,$data[0],25,40);
					$strDur="<div style=\"border:thin dotted; background:#FCFFBC;\">it has been ".getDuration(@$data[10],"since complaint was approved for investigation") ."</div>";
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$data[0]</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$returned$data[1]$strDur</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$data[8]</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"$func\">Details</a>$strStatus
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
    <td width="457" height="27"  valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td width="327" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td></td>
    </tr>
</table>
</form>

