<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$status=@$_GET['status'];
					if($status==0)
					{
						$statusv=96;
						$status1="Date Assigned";
					}
					if($status==1)
					{
						$statusv=95;
						$status1="Date Assigned";
					}
					if($status==2)
					{
						$statusv=94;
						$status1="Date Conluded";
					}
					if($status==3)
					{
						$statusv=93;
						$status1="Date Closed";
					}
					if($status==4)
					{
						$statusv=98;
						$status1="Date reported";
					}
?>
<script src="../scripts/counterajax.js" ></script>
<link rel="stylesheet" type="text/css" media="all" href="../datepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../datepick/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"date1",
			dateFormat:"%d/%m/%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"date2",
			dateFormat:"%d/%m/%Y"
		});
		
	};
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
    <td width="16" height="23">&nbsp;</td>
    <td colspan="4" valign="top">Summary report </td>
    </tr>
  <tr>
    <td height="5" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="6"></td>
    <td width="116"></td>
    <td width="232"></td>
    <td width="204"></td>
    <td width="216"></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">From : </div></td>
    <td colspan="2" valign="top"><input name="date1" type="text" id="date1" readonly="1" /></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="3"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">To : </div></td>
    <td colspan="2" valign="top"><input name="date2" type="text" id="date2" readonly="1" /></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="31"></td>
    <td></td>
    <td valign="top"><input name="button2" type="button" class="BTN" id="button2" value="Yearly complaint nature report"  onclick="window.open('report1.php?date1='+document.frmUsers.date1.value+'&amp;date2='+document.frmUsers.date2.value)"/></td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  
  
  
  <tr>
    <td height="32"></td>
    <td></td>
    <td valign="top"><input name="button" type="button" class="BTN" id="button" value="Lodging mode report"  onclick="window.open('report2.php?date1='+document.frmUsers.date1.value+'&date2='+document.frmUsers.date2.value)"/></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="31"></td>
    <td></td>
    <td valign="top"><input name="button3" type="button" class="BTN" id="button3" value="Complaints per age group report"  onclick="window.open('report3.php?date1='+document.frmUsers.date1.value+'&amp;date2='+document.frmUsers.date2.value)"/></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="34"></td>
    <td></td>
    <td valign="top"><input name="button4"   type="button" class="BTN" id="button4" value="Gender report"  onclick="window.open('report4.php?date1='+document.frmUsers.date1.value+'&amp;date2='+document.frmUsers.date2.value)"/></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="244"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

