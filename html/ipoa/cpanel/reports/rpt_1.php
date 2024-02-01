<?php
session_start();
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$date1=@$_POST['txtDate'];
$date2=@$_POST['txtDate2'];
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
$vehicleid=@$_GET["vehicleid"];
 $dt=@$_GET['dt'];
	
?>
<link rel="stylesheet" type="text/css" media="all" href="../datepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../datepick/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"txtDate",
			dateFormat:"%m/%Y"
		});
		
	};
	function IsNumeric(input)
	{
		return (input - 0) == input && (''+input).replace(/^\s+|\s+$/g, "").length > 0;
	}
</script>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
 
	
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" type="text/css" media="all" href="../datepick/jsDatePick_ltr.min.css" />

<style type="text/css">
<!--
.style19 {font-size: 24px}
.divBG{background-color:#003300;}
-->
</style>
<script language="javascript">

</script>
<body >
<form name="frmUsers">
<table width="765" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="33" height="40" valign="top"><style>
  	#printer:hover {
	background-image:url(../images/printer1.png);
	}
	#printer  {
	background-image:url(../images/printer.png);
	}
  </style><div id="printer" style="cursor:pointer; width:36px; height:35px;" onClick="this.style.display='none'; window.print();this.style.display='block';"></div></td>
    <td colspan="6" rowspan="2" valign="top"><div align="center"><img src="../images/rptLogo.png" width="700" height="100"></div></td>
    <td width="32">&nbsp;</td>
    </tr>
  <tr>
    <td height="62">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="58"></td>
    <td colspan="6" valign="top"><div align="center" class="style19">
      Report on advance tax collected  
      <br />
      from <?php echo $date1; ?> to <?php echo $date2; ?> 
    </div></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="33"></td>
    <td width="85"></td>
    <td width="7"></td>
    <td width="340"></td>
    <td width="86">&nbsp;</td>
    <td width="5"></td>
    <td width="177"></td>
    <td></td>
    </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><div align="right">Date : </div></td>
    <td></td>
    <td rowspan="2" valign="top"  style="border-bottom:thin dotted;"><?php echo date("d/m/Y");?></td>
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
    </tr>
  <tr>
    <td height="9"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  <tr>
    <td height="24"></td>
    <td colspan="6" valign="top" style="font-size:1px; border-bottom:thick solid"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td></td>
    </tr>
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="433"></td>
    <td colspan="6" valign="top">
	
	  <table  height="200" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="53" height="22" valign="top" style="padding-left:10px; border-bottom:thin solid; border-left:thin solid; border-top:thin solid; font-size:14px;">Index</td>
            <td width="239" valign="top" style="padding-left:10px;border-bottom:thin solid; border-left:thin solid;  border-top:thin solid;font-size:14px;">Center</td>
            <td width="215" valign="top" style="padding-left:10px;border-bottom:thin solid; border-left:thin solid; border-top:thin solid;font-size:14px;">Number of Vehicle </td>
            <td width="193" valign="top" style="padding-left:10px;border-bottom:thin solid; border-left:thin solid;border-right:thin solid; border-top:thin solid;font-size:14px;">Advance tax(Ksh.) </td>
          </tr>
 
		  
		 <?php
		 	$totalR1="0";
			$countV1="0";
		 	$rs=@mysql_query("select * from  centre order by `centre` asc");
			if($rs)
			{
				$rows=@mysql_num_rows($rs);
				if ($rows>0)
				{
					for($x=1;$x<=$rows;$x++)
					{
						$datac=@mysql_fetch_array($rs);
						$center=@$datac[1];
						$totalR="0";
						$countV="0";
						$rs1=@mysql_query("select count(`regno`),sum(`tax`) from  bookings where `center`='$center' and (`index`>='$dated1' and `index`<='$dated2' )");
						if($rs1)
						{
							$rows1=@mysql_num_rows($rs1);
							if ($rows1>0)
							{
								$datat=@mysql_fetch_array($rs1);
								$totalR=(int)$datat[1];
								$countV=(int)$datat[0];
							}				
						}
						$rs2=@mysql_query("select count(`regno`),sum(`tax`) from  inspected where `center`='$center' and (`index`>='$dated1' and `index`<='$dated2' )");
						if($rs2)
						{
							$rows2=@mysql_num_rows($rs2);
							if ($rows2>0)
							{
								$datat2=@mysql_fetch_array($rs2);
								$totalR=$totalR+(int)$datat2[1];
								$countV=$countV+(int)$datat2[0];
								
							}				
						}
						$rs1=@mysql_query("select count(`regno`),sum(`tax`) from  bookings where `center`='$center' and (`index`>='$dated1' and `index`<='$dated2' )");
						if($rs1)
						{
							$rows1=@mysql_num_rows($rs1);
							if ($rows1>0)
							{
								$datat3=@mysql_fetch_array($rs1);
								$totalR=$totalR+(int)$datat3[1];
								$countV=$countV+(int)$datat3[0];
							}				
						}
						$totalR1=$totalR1+$totalR;
						$countV1=$countV1+$countV;
						echo " <tr>
						  <td height=\"20\"  style=\"padding-left:10px; border-bottom:thin solid; border-left:thin solid;\">$x</td>
							<td style=\"padding-left:20px;border-bottom:thin solid; border-left:thin solid;\">$center&nbsp;</td>
							<td style=\"padding-left:20px;border-bottom:thin solid; border-left:thin solid;\">$countV&nbsp;</td>
							<td style=\"padding-left:20px;border-bottom:thin solid; border-left:thin solid;border-right:thin solid;\">$totalR.00&nbsp;</td>
						  </tr>";
		  			}
		  		}
			}
			
			
			
			echo " <tr>
						  <td height=\"20\"  style=\"padding-left:10px; border-bottom:thin solid; border-left:thin solid; border-top:thin solid;\"></td>
							<td style=\"padding-left:20px;border-bottom:thin solid; border-left:thin solid; border-top:thin solid;font-size:14px;\">Total</td>
							<td style=\"padding-left:20px;border-bottom:thin solid;  border-left:thin solid;   border-top:thin solid;\">$countV1&nbsp;</td>
							<td style=\"padding-left:20px;border-bottom:thin solid; border-left:thin solid;border-right:thin solid; border-top:thin solid;font-size:14px;\">$totalR1.00&nbsp;</td>
						  </tr>";
		  ?>
        </table></td>
    <td></td>
    </tr>
  
  
  
  
  
  
  
  
  <tr>
    <td height="24"></td>
    <td colspan="6" valign="top"  style="font-size:1px; border-bottom:thick solid"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td></td>
    </tr>
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="20"></td>
    <td valign="top"><div align="right">Generated by: </div></td>
    <td>&nbsp;</td>
    <td valign="top" style="border-bottom:thin dotted;"><?php echo $_SESSION['names'];?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="9"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="40"></td>
    <td colspan="6" valign="top"><img src="../images/rptLogob.png" width="700" height="40"></td>
    <td></td>
    </tr>
</table>
</form>
</body>
