<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
//$date1=@$_GET['date1'];
//$date2=@$_GET['date2'];

$temp1=explode("/",@$_GET['date1']);
$temp2=explode("/",@$_GET['date2']);
if(sizeof($temp1)==3 && sizeof($temp2)==3 ){
//$date1="$temp1[2]/$temp1[1]/$temp1[0]";
//$date2="$temp2[2]/$temp2[1]/$temp2[0]";
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
		
 				
				$legend[0]="Male";
				$legend[1]="Female";


				if(@$date1!="" && @$date2!="" )
				{
					$dat[0]=queryRecordCount("select * from sm_main_persons where gender='$legend[0]' and personsid in (select  complaintid  from sm_main_complaint where (STR_TO_DATE(`incident date`,'%Y/%m/%d')>=STR_TO_DATE('$date1','%Y/%m/%d') and STR_TO_DATE(`incident date`,'%Y/%m/%d')<=STR_TO_DATE('$date2','%Y/%m/%d') ))"); 
					$dat[1]=queryRecordCount("select * from sm_main_persons where gender='$legend[1]' and personsid in (select  complaintid  from sm_main_complaint where (STR_TO_DATE(`incident date`,'%Y/%m/%d')>=STR_TO_DATE('$date1','%Y/%m/%d') and STR_TO_DATE(`incident date`,'%Y/%m/%d')<=STR_TO_DATE('$date2','%Y/%m/%d') ))");				
				}else
				{
					$dat[0]=queryRecordCount("select *  from sm_main_persons  where gender='$legend[0]'");
					$dat[1]=queryRecordCount("select *  from sm_main_persons  where gender='$legend[1]'");
					
				}
        			 //$tempData[0]="[$dat1,  $dat2,  $dat3,  $dat4,  $dat5]" ;
					 for($y=0;$y<=1;$y++)
					 {
					 	if(@$tempData[$y]=="")
						{ 
							$tempData[$y]=(int)$dat[$y];
						}else{
							$tempData[$y]=$tempData[$y].",".(int)$dat[$y];
						}  
					 }
					   

		?>
		
		$(function () {
        $('#containerx').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Summary report on Gender'
            },
            subtitle: {
                text: 'Date: <?php echo date("d/m/Y"); ?>'
            },
            xAxis: {
                
				categories:  <?php echo "['Gender']"; ?>
            },
            yAxis: {
                title: {
                    text: 'Number of Complaints'
                },
				min:0
            },
            plotOptions: {
                column: {
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
            }, ]
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
    <td height="85" colspan="2" valign="top"><img src="images/letterhead.png" width="400" height="85" /> </td>
  </tr>
  <tr>
    <td width="13" height="23"></td>
    <td width="788" valign="top"><span class="style15">Summary report on Gender </span> </td>
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
<input  id="btnExport"  style="visibility:hidden;" type="button" class="BTN" value="Export data to Excel" onclick="getPage('rpt1Excel.php','content','date1=<?php echo $date1;?>&date2=<?php echo $date2;?>')" />
</div>
</div>
<table class="rptTable Black_Header_Text" width="801" border="0" cellpadding="0" cellspacing="0" style="border:thin solid;">

  <!--DWLayoutTable-->
  <?php
 		//$rs=@mysql_query("select natureid,count(complaintid),EXTRACT(YEAR FROM to_date(`incident date`)) as year from ".$pref."complaint where 1 group by EXTRACT(YEAR FROM to_date(`incident date`))");
		echo "<tr ><td>$legend[0]</td><td>$legend[1]</td><td>Total</td></tr>";				
        echo "<tr><td>$dat[0]</td><td>$dat[1]</td><td>".((int)$dat[0]+(int)$dat[1])."</td></tr>" ;        

		
		?>
</table>
<div id="Title" style="width: 800px; margin-top:50px;" class="Black_Header_Text" align="left">
Generated on <?php echo date("d/m/Y")." by ".$_SESSION['names']; ?>
</div>
</div>
</center>
</html>



