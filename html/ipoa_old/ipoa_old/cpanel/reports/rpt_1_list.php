<?php
session_start();
	include "conn.php"; 
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
if(@$_POST['center']!=""){$_SESSION["centers"]=@$_POST['center'];}
$center=@$_SESSION["centers"];

if(@$_POST['txtDate']!=""){$_SESSION["date1"]=@$_POST['txtDate'];}
$date1=@$_SESSION["date1"];

if(@$_POST['txtDate2']!=""){$_SESSION["date2"]=@$_POST['txtDate2'];}
$date2=@$_SESSION["date2"];


$temp1=explode("/",$date1);
$temp2=explode("/",$date2);
$dated1=$temp1[2].$temp1[1].$temp1[0];
$dated2=$temp2[2].$temp2[1].$temp2[0];
if((int)$dated1>(int)$dated2){$tempd=$dated1;$dated1=$dated2;$dated2=$tempd; $tempd=$date1;$date1=$date2;$date2=$tempd;}
if((int)$dated2>(int)date("Ymd")){$dated2=date("Ymd"); $date2=date("d/m/Y");$tran=true;}	
if((int)$dated1>(int)date("Ymd")){$dated1=date("Ymd"); $date1=date("d/m/Y");$tran=true;}

if(@$tran==true)
{
	?>
<script language="javascript">
	alert("One or both provided dates is beyond current date, system will alter \"to date\" to <?php echo date("d/m/Y");?>")
</script>
<?php
}		

$search=@$_GET["search"];
 $dt=@$_GET['dt'];
	
?>
<script src="../scripts/counterajax.js" ></script>

<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style15 {font-size: 24}
-->
</style>
<form action="rpt_inspections_list_excel.php" method="POST" enctype="multipart/form-data" name="frmUsers">

<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="2" valign="top"><input type="button" name="Button" value="Back"  class="BTN" onclick="getPage('export_inspections_excel.php','content','')"/></td>
    <td width="114">&nbsp;</td>
    <td colspan="4" rowspan="2" valign="top"><div align="center" class="style19" style="font-size:36px;"><?php echo $center; ?> </div><div align="center"></div></td>
    <td width="113">&nbsp;</td>
    <td colspan="2" valign="top"><input type="button" name="Button2" value="Export to excel"  class="BTN" onclick="document.frmUsers.submit();"/></td>
  </tr>
  
  
  <tr>
    <td width="12" height="13"></td>
    <td width="63"></td>
    <td></td>
    <td></td>
    <td width="37"></td>
    <td width="76"></td>
  </tr>
  <tr>
    <td height="33"></td>
    <td colspan="9" valign="top"><div align="center" class="style19" style="font-size:24px;">vehicles Inspection as 
      from <?php echo $date1; ?> to <?php echo $date2; ?> </div></td>
  </tr>
  
  
  
  
  
  <tr>
    <td height="5"></td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td width="175"></td>
    <td width="35"></td>
    <td width="106"></td>
    <td width="53"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="2" valign="top"><input name="search" type="button" class="BTN" id="search" value="Search" onclick="getPage('inspections.php','content','search='+document.frmUsers.txtsearch.value)" /></td>
    </tr>
  <tr>
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><div align="right">Search :</div></td>
    <td colspan="3" valign="top"><input name="txtsearch" type="text" class="STR" id="txtsearch" value="<?php echo @$search; ?>" /></td>
    </tr>

  
  
  <tr>
    <td height="38" colspan="10" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="125" valign="top" style="border-bottom:thin dotted;">Number plate </td>
            <td width="89" valign="top" style="border-bottom:thin dotted;">Date booked </td>
            <td width="140" valign="top" style="border-bottom:thin dotted;">Booked by </td>
            <td width="91" valign="top" style="border-bottom:thin dotted;">Date inspected </td>
            <td width="126" valign="top" style="border-bottom:thin dotted;">Inspected by </td>
            <td width="108" valign="top" style="border-bottom:thin dotted;">Inspection Sticker </td>
          <td width="60" valign="top" style="border-bottom:thin dotted;">Center</td>
	    </tr>

	    
	    <?php
		$max=200;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="rpt_inspections_list.php";
		$index=0;
		$counts=0;
		$search=str_replace(" ","%",$search);
		$where="";
		$where=" `"._fieldName("inspected",1)."` like '%$search%' ";
		
		/*$query="select * from inspected";		
		$rs=@mysql_query($query); 
		$the_list="";
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				
				for($x=0;$x<$counts;$x++)
				{
					
					$data=@mysql_fetch_array($rs);
					$the_date=str_replace("-","/",$data[15]);
					$temp_date=explode("/",$the_date);
					$num=(int)($temp_date[2].$temp_date[1].$temp_date[0]);echo  $the_date; 
					if($num>=$dated1 &&$num <=$dated2 )
					{
						if($the_list==""){$the_list="'$data[0]'";}else{$the_list="$the_list,'$data[0]'";}
					}
				}
			}
		}
		STR_TO_DATE('01/01/2015','%m/%d/%Y')*/
		
		
		for($x=2;$x<=10;$x++)
		{
			$where=$where." or `"._fieldName("inspected",$x)."` like '%$search%' ";
		}
		if($center=="All")
		{
			$query="select * from inspected where ($where) and (STR_TO_DATE(`inspection date`,'%d/%m/%Y')>=STR_TO_DATE('$date1','%d/%m/%Y') and STR_TO_DATE(`inspection date`,'%d/%m/%Y')<=STR_TO_DATE('$date2','%d/%m/%Y') )   and `booked by`<>'-'  order by `inspection date` asc";  
		}else
		{
			$query="select * from inspected where `center` = '$center' and ($where) and (STR_TO_DATE(`inspection date`,'%d/%m/%Y')>=STR_TO_DATE('$date1','%d/%m/%Y') and STR_TO_DATE(`inspection date`,'%d/%m/%Y')<=STR_TO_DATE('$date2','%d/%m/%Y') )   and  `booked by`<>'-' and `center`='$center'  order by  `center` asc, `inspection date` asc";
		}
	 
		$rs=@mysql_query($query); 
		
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

						
						echo "
						<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('inspecteddetails.php','content','bookingsid=$data[0]&index=$start')\">$data[2]</a> </td>
						<td  valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[4]</td>					
						<td valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[8] </td>
						<td valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[15] </td>
						<td valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[13] </td>
						<td valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[10] </td>
						<td valign=\"top\" style=\"border-bottom:thin dotted;\"> $data[3] </td>
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
    <td height="27" colspan="5" valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td colspan="5" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
<input type="hidden" value="<?php echo @$query;?>" name="query" id="query"  />
<input type="hidden" value="<?php echo @$center;?>" name="center" id="center"  />
<input type="hidden" value="<?php echo @$date1;?>" name="date1" id="date1"  />
<input type="hidden" value="<?php echo @$date2;?>" name="date2" id="date2"  />

</form>

