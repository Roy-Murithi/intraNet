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
    <td height="22" colspan="6" valign="top">Investigations summary </td>
    </tr>
  <tr>
    <td height="21" colspan="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td width="29" height="21">&nbsp;</td>
    <td width="160" valign="top"><div align="right">Reffered Complaints </div></td>
    <td width="15">&nbsp;</td>
    <td width="44" valign="top"><?php
		$rs=@mysql_query("select * from ".$pref."complaint where `uneditable`='98' order by `index` desc");
		if($rs)
		{
			$status1=@@mysql_num_rows($rs);
		}
		echo (int)@$status1;
	?></td>
    <td width="240" rowspan="2" valign="top">
      <?php
		$script="getPage('investigation.php','content','sessid=smetsysmocmas&status=4')"; 
		echo classBTN("btnApprove","View Unapproved Complaints","#","","$script"); 
		?></td>
    <td width="296">&nbsp;</td>
    </tr>
  <tr>
    <td height="3"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="3" valign="top">
      <?php
		$script="getPage('investigation.php','content','sessid=smetsysmocmas&status=1')"; 
		echo classBTN("btnApprove","View Attended Investigations","#","","$script"); 
		?></td>
    <td></td>
  </tr>
  <tr>
    <td height="23"></td>
    <td valign="top"><div align="right">Under Investigation </div></td>
    <td></td>
    <td valign="top"><?php
		$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='95')  order by `index` desc");
		if($rs)
		{
			$status1=@@mysql_num_rows($rs);
		}
		echo (int)@$status1;
	?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="2"></td>
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
  </tr>
  
  
  
  
  <tr>
    <td height="22">&nbsp;</td>
    <td valign="top"><div align="right">Unattended Investigations </div></td>
    <td>&nbsp;</td>
    <td valign="top"><?php
		$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='96') order by `index` desc");
		if($rs)
		{
			$status1=@@mysql_num_rows($rs);
		}
		echo (int)@$status1;
	?></td>
    <td rowspan="2" valign="top">
      <?php
		$script="getPage('investigation.php','content','sessid=smetsysmocmas&status=0')"; 
		echo classBTN("btnApprove","View Unattended Investigations","#","","$script"); 
		?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="7"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="7"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="21"></td>
    <td valign="top"><div align="right">Concluded Investigations </div></td>
    <td></td>
    <td valign="top"><?php
		$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='94') order by `index` desc");
		if($rs)
		{
			$status1=@@mysql_num_rows($rs);
		}
		echo (int)@$status1;
	?></td>
    <td rowspan="2" valign="top"><?php
		$script="getPage('investigation.php','content','sessid=smetsysmocmas&status=2')"; 
		echo classBTN("btnApprove","View Concluded Investigations","#","","$script"); 
		?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="7"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="12"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td valign="top"><div align="right">Finalized Investigations </div></td>
    <td></td>
    <td valign="top"><?php
		$rs=@mysql_query("select * from ".$pref."complaint where (`uneditable`='93')  order by `index` desc");
		if($rs)
		{
			$status1=@@mysql_num_rows($rs);
		}
		echo (int)@$status1;
	?></td>
    <td rowspan="2" valign="top"><?php
		$script="getPage('investigation.php','content','sessid=smetsysmocmas&status=3')"; 
		echo classBTN("btnApprove","View finalized Investigations","#","","$script"); 
		?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="7"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="91"></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
  
  
  
  
  <tr>
    <td height="16" colspan="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>

