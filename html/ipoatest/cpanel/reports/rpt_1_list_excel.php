<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$query=@$_POST['query'];
$center=@$_POST['center'];
$date1=@$_POST['date1'];
$date2=@$_POST['date2'];
if($center=="All"){ $center1="All KRA"; }else{$center1="$center KRA ";}
$CSV="\"Vehicle inspected at $center as from $date1 to $date2\",\"\",\"\",\"\",\"\",\"\",\"\"\n";
$CSV=$CSV."\"Index\",\"Number plate\",\"Date booked\",\"Booked by\",\"Date inspected\",\"Inspected by\",\"Inspection sticker\",\"Center\"\n";
$rs=@mysql_query($query);
if($rs)
{
	$counts=@mysql_num_rows($rs);
	if ($counts>0)
	{
		for($x1=0;$x1<$counts;$x1++)
		{
			$data=@mysql_fetch_array($rs);
			$CSV=$CSV."\"".($x1+1)."\",\"".strtoupper( $data[2])."\",\"$data[4]\",\"$data[8]\",\"$data[15]\",\"$data[13]\",\"$data[10]\",\"$data[3]\"\n";
		}				
	}
}
					
//$time=date("YmdHis");
$filename="../rpt/rpt_temp_excel". @$_SESSION["userid"] .".csv";
if(is_file($filename)==true){unlink($filename);}
file_put_contents($filename,$CSV);		

	?>
     
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	window.location="<?php echo $filename;?>";
</script>

