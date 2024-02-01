<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$temp1=explode("/",$_GET['date1']);
$temp2=explode("/",$_GET['date2']);
if(sizeof($temp1)==3 && sizeof($temp2)==3 ){
$date1=$temp1[2];
$date2=$temp2[2];
}

?>

<script src="../scripts/counterajax.js" ></script>

<script type="text/javascript" src="js/jquery.min.js"></script>		
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<style type="text/css">
${demo.css}
		</style>
	<script>
	
<?php
 		//$rs=@mysql_query("select natureid,count(complaintid),EXTRACT(YEAR FROM to_date(`incident date`)) as year from ".$pref."complaint where 1 group by EXTRACT(YEAR FROM to_date(`incident date`))");
		if(@$date1=="" || @$date2=="" )
		{
 		$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");
		}else
		{
		$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint where EXTRACT(YEAR FROM `incident date`)>='$date1' and  EXTRACT(YEAR FROM `incident date`)<='$date2' group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");
		
		}
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$legend[0]=fetchValue("sm_main_complaintnature","natureid","NTR001",1);
				$legend[1]=fetchValue("sm_main_complaintnature","natureid","NTR002",1);
				$legend[2]=fetchValue("sm_main_complaintnature","natureid","NTR003",1);
				$legend[3]=fetchValue("sm_main_complaintnature","natureid","NTR004",1);
				$legend[4]=fetchValue("sm_main_complaintnature","natureid","NTR005",1);
				$year="";
				for($x=0;$x<$counts;$x++)
				{
					$datax=mysql_fetch_array($rs);
					$dat[0]=queryRecordCount("select  complaintid  from sm_main_complaint where natureid='NTR001' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat[1]=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR002' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat[2]=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR003' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat[3]=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR004' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat[4]=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR005' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
        			 //$tempData[0]="[$dat1,  $dat2,  $dat3,  $dat4,  $dat5]" ;
					 for($y=0;$y<5;$y++)
					 {
					 	if(@$tempData[$y]=="")
						{ 
							$tempData[$y]=(int)$dat[$y]+1;
						}else{
							$tempData[$y]=$tempData[$y].",".(int)$dat[$y];
						}  
					 }
					 if($year==""){$year="'$datax[0]'";}else{$year=$year.",'$datax[0]'";}    
				}
			}
		}
		
		?>
		
		$(function () {
        $('#containerx').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Complaints summary per Category'
            },
            subtitle: {
                text: 'Date: <?php echo date("d/m/Y"); ?>'
            },
            xAxis: {
                categories: <?php echo "[$year]"; ?>
            },
            yAxis: {
                title: {
                    text: 'Number of Complaints'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '<?php echo $legend[0]; ?>',
                data: <?php echo "[".$tempData[0]."]"; ?>
            }, {
                name: '<?php echo $legend[1]; ?>',
                data: <?php echo "[".$tempData[1]."]"; ?>
            }, {
                name: '<?php echo $legend[2]; ?>',
                data: <?php echo "[".$tempData[2]."]"; ?>
            }, {
                name: '<?php echo $legend[3]; ?>',
                data: <?php echo "[".$tempData[3]."]"; ?>
            }, {
                name: '<?php echo $legend[4]; ?>',
                data: <?php echo "[".$tempData[4]."]"; ?>
            }]
        });
    });
	
	

	</script>

<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style15 {font-size: 18px}
.Shadow {
     -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    -khtml-border-radius: 8px;
    border-radius: 8px;
	box-shadow:2px 2px 2px #000000;
}
-->
</style>
<html>

<center>
<div id="rpt_pdf" style="width: 800px; margin:10px;" align="left" >
<div style=" width:200px;">
  <style>
  	#printer:hover {
	background-image:url(images/printer1.png);
	}
	#printer  {
	background-image:url(images/printer.png);
	}
  </style><div id="printer" style="cursor:pointer; width:36px; height:35px;" onClick="var div=document.getElementById('divBack');div.style.border='none'; var div1=document.getElementById('btnExport'); div1.style.display='none';div.className ='';this.style.display='none'; window.print();this.style.display='block';div1.style.display='block';div.style.border='solid thin';div.className='Shadow'"></div>
</div>
</div>
<div id="divBack" style="display:block; overflow:visible; border:solid thin; width:800px; margin-bottom:50px;" class="Shadow">
<table width="801" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text" style="border-bottom:thin solid ">
  <!--DWLayoutTable-->
  <tr>
    <td height="85" colspan="2" valign="top"><img src="images/letterhead.png" width="400" height="85" /></td>
  </tr>
  <tr>
    <td width="13" height="23"></td>
    <td width="788" valign="top"><span class="style15">Yearly summary report on Nature of complaints <?php if(@$date1!="" && @$date2!=""){echo " as from $date1 to $date2";}?></span> </td>
  </tr>
</table>
<div id="containerx" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

<style>
	rptTable{}
	Table.rptTable td {
	border-bottom:thin dotted;
	border-right:thin dotted;
	padding-left:1px;
	}
</style>
<div id="Title" style="width: 800px;" class="Black_Header_Text" align="left">
Statistical summary on reported complaints<?php if(@$date1!="" && @$date2!="" ){?> from <?php echo $date1; ?> to <?php echo $date2; }?>
<div style=" width:30px;">
<input id="btnExport" type="button" class="BTN" value="Export data to Excel" onclick="getPage('rpt1Excel.php','content','date1=<?php echo $date1;?>&date2=<?php echo $date2;?>')" />
</div>
</div>
<table class="rptTable Black_Header_Text" width="801" border="0" cellpadding="0" cellspacing="0" style="border:thin solid;">

  <!--DWLayoutTable-->
  <?php
 		//$rs=@mysql_query("select natureid,count(complaintid),EXTRACT(YEAR FROM to_date(`incident date`)) as year from ".$pref."complaint where 1 group by EXTRACT(YEAR FROM to_date(`incident date`))");
		if(@$date1=="" || @$date2=="" )
		{
 			$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");
		}else
		{
			$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint where EXTRACT(YEAR FROM `incident date`)>='$date1' and  EXTRACT(YEAR FROM `incident date`)<='$date2' group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");		
		}
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				echo "<tr ><td>Year</td><td>".fetchValue("sm_main_complaintnature","natureid","NTR001",1)."</td><td>".fetchValue("sm_main_complaintnature","natureid","NTR002",1)."</td><td>".fetchValue("sm_main_complaintnature","natureid","NTR003",1)."</td><td>".fetchValue("sm_main_complaintnature","natureid","NTR004",1)."</td><td>".fetchValue("sm_main_complaintnature","natureid","NTR005",1)."</td><td>Total Cases</td></tr>";
				for($x=0;$x<$counts;$x++)
				{
					$datax=mysql_fetch_array($rs);
					$dat1=queryRecordCount("select  complaintid  from sm_main_complaint where natureid='NTR001' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat2=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR002' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat3=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR003' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat4=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR004' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat5=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR005' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat6=(int)$dat1+(int)$dat2+(int)$dat3+(int)$dat4+(int)$dat5;
        			 echo "<tr><td>$datax[0]</td><td>$dat1</td><td>$dat2</td><td>$dat3</td><td>$dat4</td><td>$dat5</td><td>$dat6</td></tr>" ;        
				}
				
			}
		}
		
		?>
</table>
<div id="Title" style="width: 800px;margin-top:50px;" class="Black_Header_Text" align="left">
Generated on <?php echo date("d/m/Y")." by ".$_SESSION['names']; ?>
</div>
</div>
</center>
</html>



