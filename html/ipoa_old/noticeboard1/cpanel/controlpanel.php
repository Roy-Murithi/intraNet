<?php
@session_start();
if(@$_SESSION['loggedIn']==99)
	{
		header("location:mainpage.php");
		exit;
	}
$_SESSION["genius"]="";
include "conn.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA | Login page</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="/stacs/css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
	function redirectMe()
	{
		document.frmLogin.action="loginerror.php";
		document.frmLogin.submit();
	}
</script>
<center><form name="frmLogin" method="post" action="loginnow.php">
<table width="507" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
    <tr>
      <td width="140" height="106">&nbsp;</td>
      <td width="50">&nbsp;</td>
      <td width="6">&nbsp;</td>
      <td width="64">&nbsp;</td>
      <td width="122">&nbsp;</td>
      <td width="125">&nbsp;</td>
      </tr>
  <tr>
    <td height="106" colspan="6" valign="top"><div align="center"><img src="images/login.png" width="300" height="94" /></div></td>
    </tr>
  
  <tr>
    <td height="2" colspan="6" valign="top"><hr /></td>
  </tr>
  <tr>
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  <tr>
    <td height="23" colspan="2" valign="top" class="Black_Header_Text"><div align="right">Username</div></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><div align="left">
      <input name="txtUsername" type="text" id="txtUsername" size="30" class="STR"/>
    </div></td>
    </tr>
  <tr>
    <td height="22" colspan="2" valign="top" class="Black_Header_Text"><div align="right">Password</div></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><div align="left">
      <input name="txtPassword" type="password" id="txtPassword" size="30" class="STR" />
    </div></td>
    </tr>
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="3" valign="top"><div align="right">
      <input type="submit" name="Submit" value="    Login    "  class="BTN"/>
    </div></td>
    <td valign="top"><input type="reset" name="Submit2" value="    Reset    "  class="BTN"/></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="84">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</center>
</body>
</html>
