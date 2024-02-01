<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		 header("location:../index.php?pid=0");
	}

include "conn.php";
$search=@$_GET['txtSearch'];
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
function procLog1($pref,$complaintid,$log,$action,$date)
{
	
	if(@$_SESSION['names']!="")
	{
		$rs=@mysql_query("select * from ".$pref."user");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
		}
		do
		{
				$counts=@$counts+1;
				$proclogidx="LOG-00".$counts;
				$rs1=@mysql_query("select * from ".$pref."proclog where `proclogid`='$proclogidx'");
				if ($rs1)
				{
					$dup=@mysql_num_rows($rs1);
				}else
				{
					$dup=0;
				}
		}while($dup!=0);
		date_default_timezone_set("Africa/Nairobi");
		//$date=date("Y/m/d H:i:s");
		$names=@$_SESSION['names'];
		$userid=@$_SESSION['userid'];
		
		$query="insert into ".$pref."proclog values('$proclogidx','$complaintid','$date','$log','$names','$userid','$action')";	
		$rs=@mysql_query($query);
	}else
	{
		
	}
}

if(@$_GET['cown']=="99")
{
	$complaintid=$_GET['complaintid'];
	$date=$_GET['d'];
	procLog1($pref,$complaintid,"New complaint added to the system","Added",$date);
	
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
<form action="complaint.php" method="get" enctype="multipart/form-data" name="frmUsers">

<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="24" colspan="2" valign="top">Edit complaint by Complaints officers</td>
    <td width="118" valign="top"><div align="right">Search Complaint </div></td>
    <td colspan="2" valign="top"><input name="txtSearch" type="text" id="txtSearch" value="<?php echo "$search"; ?>" />
      <input name="Search" type="submit" id="Search" value="Search" /></td>
    <td width="167" valign="top"><div align="right">
      <input name="sessid" type="hidden" id="sessid" value="smetsysmocmas" />
      <?php
		$script="";
		if(@$user_clearance!="2"){$script="document.location='/ipoa/noclearance.php'";}
		echo classBTN("btnReturn","Add new complaint","editcomplaint.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
    </tr>
  <tr>
    <td height="21" colspan="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="45" colspan="6" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top" style="border-bottom:thin dotted;">Index</td>
            <td width="90" valign="top" style="border-bottom:thin dotted;">Complaint file N<u>o</u> </td>
            <td width="407" valign="top" style="border-bottom:thin dotted;">Complaint</td>
            <td width="90" valign="top" style="border-bottom:thin dotted;">Date reported </td>
            <td width="164" valign="top" style="border-bottom:thin dotted;">Action </td>
          </tr>

	    
	    <?php
		$max=5;
		$start=(int)@$_GET['index'];
		//$prevIndex=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="complaint.php";
		$index=0;
		$where="";
		if($search!="")
		{
			$temp=array();
			$temp=explode(" ",$search);
			$where1="";$where2="";
			for($i=0;$i<sizeof($temp);$i++)
			{
				
				if($where1=="")
				{
					$where1="`complaint` like '%$temp[$i]%'";
				}else
				{
					$where1=$where1." and `complaint` like '%$temp[$i]%'";
				}
				if($where2=="")
				{
					$where2="`complaintid` like '%$temp[$i]%'";
				}else
				{
					$where2=$where2." and `complaintid` like '%$temp[$i]%'";
				}
				
			}
			//$tempSearch=str_replace(" ","%",$search);
			//$where1="`complaint` like '%$tempSearch%'";
			//$where2="`complaintid` like '%$tempSearch%'";
			
			$where=" ($where1) or ($where2) ";
		}else
		{
			$where="`complaint` like '%$search%'";
		}
		
		$rs=@mysql_query("select * from ".$pref."complaint where ($where) and `uneditable`='0' order by`index` desc , `status` desc");
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
					$complaintid=$data[0];
					if($data[21]!="" && $data[21]!="-")
					{
						$valDat=fetchValue($pref."explanation","explanationid",$data[21],2);
						$returned="<div style=\"border:thin dotted #FF0000\"><font color=\"red\">Returned complaint<br />Reasons: $valDat</font></div> ";
					}else
					{
						$returned="";
					}
					$urgentCount=  fetchRecordCount1($pref."complaint","status",99,"uneditable",0);
					$urgentCount1=  fetchRecordCount1($pref."complaint","status",98,"uneditable",0);
					if($data[25]!="99" && $urgentCount>0)
					{
						$func="alert('System cannot continue with this complaint, You must clear complaint marked high prority first')";
					}elseif($data[25]!="98" && $data[25]!="99" && $urgentCount1>0)
					{
						$func="alert('System cannot continue with this complaint, You must clear complaint marked medium prority first')";
					}
					else
					{
						$func="getPage('complaintdetails.php','content','complaintid=$data[0]&index=$start')";
					}
					$strDur="<div style=\"border:thin dotted; background:#FCFFBC;\">it has been ".getDuration(@$data[8],"since complaint was reported") ."</div>";
					$strStatus= getUrgent($pref,$data[0],25,40);
					if($search!="")
					{
						$temp=explode(" ",$search);
						for($i=0;$i<sizeof($temp);$i++)
						{
							$complaintid=str_replace("$temp[$i]","<mark>$temp[$i]</mark>",$data[0]);
							$data[1]=str_replace("$temp[$i]","<mark>$temp[$i]</mark>",$data[1]);
						}
					}
					$editor="";	
					$btnOwn="";
					if($data[0]!="")
					{
						$user=  fetchValue1("sm_main_proclog","complaintid","$data[0]","log","New complaint added to the system",4);	
						if($user!="")
						{	
							$editor="<div style=\"border:thin dotted; background:#FFAABC;\">Captured by: $user</div>";
						}else
						{
							$user= fetchValue1("sm_main_proclog","complaintid","$data[0]","log","Edited complaint and saved the changes",4);
							if($user!="")
							{
								$editor="<div style=\"border:thin dotted; background:#FFAABC;\">Edited by: $user</div>";
							}/*
							{
								$editor="<div style=\"border:thin dotted; background:#FFAABC;\">Error while fetching user</div>";
								if(@$_SESSION['level']=="9" && $_SESSION['userid']!="" && $_SESSION['names']!="")
								{
									$script="getPage('complaint.php','content','complaintid=$data[0]&sessid=smetsysmocmas&index=$start&cown=99&d=$data[8]')"; 
			 						$btnOwn=classBTN1("btnReturn","Own this complaint","#","","$script","#FF0000"); 
								}
							}*/
						}
					}else
					{
						
								$rs1e=@mysql_query("select distinct(user) from  sm_main_proclog where `complaintid`='' and `log`='New complaint added to the system'");
								if ($rs1e)
								{
									$rowse=@mysql_num_rows($rs1e);
									if($rowse>0)
									{
										for($e=0;$e<$rowse;$e++)
										{
											$datae=mysql_fetch_array($rs1e);
											if($editor=="")
											{
												$editor= $datae[0];
											}else
											{
												$editor=$editor.", ".$datae[0];
											}
											break;
										}
										if($editor!="")
										{
											//$editor="Possibly captured by: ".$editor;
											$editor="Captured by: ".$editor;
											$editor="<div style=\"border:thin dotted; background:#FFAABC;\">$editor</div>";
											/*if(@$_SESSION['level']=="9" && $_SESSION['userid']!="" && $_SESSION['names']!="")
											{
												$script="getPage('complaint.php','content','complaintid=$data[0]&sessid=smetsysmocmas&index=$start&cown=99&d=$data[8]')"; 
												$btnOwn=classBTN1("btnReturn","Own this complaint","#","","$script","#FF0000"); 
											}*/
										}
									}
								}
						
					}		
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$complaintid</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$returned$data[1]$strDur$editor$btnOwn</td>
					
					<td valign=\"top\" style=\"border-bottom:thin dotted;\">$data[8]</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('editcomplaint.php','content','complaintid=$data[0]&index=$start&zindex=$data[27]')\">Edit</a> 
					| <a href=\"#\" onclick=\"$func\">Persons Involved</a>$strStatus
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
    <td height="27" colspan="4" valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td colspan="2" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="20" colspan="6" valign="top" style="border-bottom:thin dotted #000000"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  <tr>
    <td width="37" height="7"></td>
    <td width="245"></td>
    <td></td>
    <td width="58"></td>
    <td width="159"></td>
    <td></td>
  </tr>
 
</table>
</form>

