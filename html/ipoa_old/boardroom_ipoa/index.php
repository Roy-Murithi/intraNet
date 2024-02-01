<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
include "globalfunc.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Digital Boardroom - IPOA</title>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="./images/logo1.png" label="JKUAT">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
.boxed {
     -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    -khtml-border-radius: 8px;
	box-shadow:2px 2px 2px #000000;
    border-radius: 8px;
	background-color:#008B91;
	color:#FFFFFF;
	cursor:pointer;
}
div.boxed:hover{
background-color:#F3AA49;
color:#000000;
}
</style>
</head>

<body>
<center>
<table width="638" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
  <tr>
    <td height="22" colspan="2" valign="top"><a href="../ipoa/paperlesso.php">&lt;&lt;Back</a></td>
    <td width="157">&nbsp;</td>
    <td width="293">&nbsp;</td>
    <td colspan="2" valign="top"><div align="right"><a href="cpanel/controlpanel.php">Admin</a></div></td>
  </tr>
  <tr>
    <td height="250" colspan="6" valign="top"><img src="images/header.png" width="700" height="250" /></td>
    </tr>
  
  <tr>
    <td width="57" height="22">&nbsp;</td>
    <td colspan="2" valign="top">Active meetings </td>
    <td>&nbsp;</td>
    <td width="76">&nbsp;</td>
    <td width="64">&nbsp; </td>
  </tr>
  <tr>
    <td height="180">&nbsp;</td>
    <td colspan="4" valign="top">
	<?php
	$rs=@mysql_query("select * from meetings where `active`='99'  order by `index` desc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=@mysql_fetch_array($rs);
					$files=fetchRecordCount("files","meetingsid",$data[0]);
					echo "<a href=\"cpanel/controlpanel.php?meetingsid=$data[0]&member=99\"><div class=\"boxed\" style=\"padding:10px; margin:10px;\"> 
					<div><span style=\"font-size:34px;\">$data[1] $data[4]</span></div>
					<div><span style=\"font-size:16px;\">Venue: $data[2]</span></div>
					<div><span style=\"font-size:14px;\">Meeting Documents: $files</span></div>
					</div></a>"; 
				}
			}
		}
	?>	</td>
    <td>&nbsp; </td>
  </tr>
  

  <tr>
    <td height="180" colspan="6" valign="top"><img src="images/tail.png" width="700" height="180" /></td>
  </tr>
  <tr>
    <td height="1"></td>
    <td width="53"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</center>
</body>
</html>