<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from files where `meetingsid`='".@$_GET['meetingsid']."' ");
		if($rs)
		{
			$rows=mysql_num_rows($rs);
			if($rows>0)
			{
				for($x=0;$x<$rows;$x++)
				{
					$dataz=mysql_fetch_array($rs);
					$filename="../../".$dataz[3];
					if( is_file($filename)==true)
					{
						chmod($filename,0777);
						unlink($filename);
					}
				}
				$rs=@mysql_query("delete from files where `meetingsid`='".@$_GET['meetingsid']."' and  `filesid`='".@$dataz[0]."' ");
			}
		}
		$rs=@mysql_query("delete from meetings where `meetingsid`='".@$_GET['meetingsid']."'");		
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
<form action="savemeetings.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="32" colspan="2" valign="top">Meetings schedule</td>
    <td width="167" valign="top"><div align="right"><?php
		$script="";
		echo classBTN("btnReturn","Schedule new meeting","editmeetings.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?>
    </div></td>
    </tr>
  
  <tr>
    <td height="11" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="38" colspan="3" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="369" valign="top" style="border-bottom:thin dotted;">Meeting Category </td>
            <td width="130" valign="top" style="border-bottom:thin dotted;">Meeting Date </td>
            <td width="244" valign="top" style="border-bottom:thin dotted;">Action </td>
          </tr>

	    
	    <?php
		$max=5;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="meetings.php";
		$index=0;
		$rs=@mysql_query("select * from meetings  order by `index` desc");
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
					$flink="<a href=\"#\" onclick=\"getPage('fileupload.php','content','meetingsid=$data[0]&index=$start')\">";
					$files=fetchRecordCount("files","meetingsid",$data[0]);
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$flink$data[1]</a></td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$flink$data[4]</a></td><td valign=\"top\" style=\"border-bottom:thin dotted;\">
					$flink Files($files)</a> |
					<a href=\"#\" onclick=\"getPage('editmeetings.php','content','meetingsid=$data[0]&index=$start')\">Edit</a> 
					|  <a href=\"#\" onclick=\"if(confirm('Are you sure you want to delete this meeting schedule?')==true){getPage('schedules.php','content','meetingsid=$data[0]&index=$start&del=99&sessid=smetsysmocmas')}\" >Delete</a>
					</td>
					
					</tr>
					";//
				}
			}
		}
	?>
      </table></td>
    </tr>
  <tr>
    <td width="458" height="27" valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of ".@$counts." records"; ?></div></td>
    <td colspan="2" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td width="159"></td>
    <td></td>
  </tr>
</table>
</form>

