<?php
@session_start();
if(@$_SESSION['loggedIn']!=99)
	{
		header("location:controlpanel.php");
		exit;
	}
include_once "conn.php";
//include_once"globalfunc.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA - Splash</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="/stacs/css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
	function init()
	{
		document.loading=document.getElementById("loading");
		document.status=document.getElementById("status");
		document.loadingp=document.getElementById("loadingp");
		document.maxstep=5;
		loading(0);
	}
	
	function loading(value)
	{
		value=Number(value)+1;
		pvalue=document.maxstep*value;
		document.loading.style.width=pvalue+"px";
		document.loadingp.innerHTML=value+"%";
		if(value<10)
		{
			document.status.innerHTML="Checking clearance";
		}else if(value<20)
		{
			document.status.innerHTML="Checking user access level";
		}else if(value<40)
		{
			document.status.innerHTML="Denying clearance to levels";
		}else if(value<60)
		{
			document.status.innerHTML="Configuring database";
		}else if(value<80)
		{
			document.status.innerHTML="Intergrating database";
		}else if(value<95)
		{
			document.status.innerHTML="Loading system";
		}
		if(value>99)
		{
			document.location="mainpage.php";
			return 0;
		}
		
		
		setTimeout("loading('"+value+"')",100);
	}
</script>
<center><form name="frmLogin" method="post" action="loginnow.php">
<body onload="init()">
<table width="702" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
    <tr>
      <td width="22" height="31">&nbsp;</td>
      <td width="192">&nbsp;</td>
      <td width="57">&nbsp;</td>
      <td width="6">&nbsp;</td>
      <td width="50">&nbsp;</td>
      <td width="46">&nbsp;</td>
      <td width="277">&nbsp;</td>
      <td width="52">&nbsp;</td>
    </tr>
    <tr>
      <td height="90" colspan="5" valign="top"><img src="images/splashlogo.png" width="327" height="90" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td height="5" colspan="8" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
    </tr>
    <tr>
      <td height="22">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="165">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4" valign="top"><img src="images/anim.gif" width="159" height="163" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr>
      <td height="63">&nbsp;</td>
      <td colspan="2" valign="top"  style="font-size:50px;"><div align="right">Complete:</div></td>
      <td>&nbsp;</td>
      <td colspan="3" valign="top"><div id="loadingp" style="font-size:50px; width:20px;" align="left"></div></td>
      <td>&nbsp;</td>
    </tr>
    

    <tr>
      <td height="36">&nbsp;</td>
      <td colspan="6" valign="top" style="width:501px;"><div id="loadingb" style="width:500px; height:32px; position:relative; border:thin solid #00878D; overflow:hidden;"><div style="width:1px; height:32px; position:absolute; left:0px; background:#ABD8DA" id="loading"></div></div></td>
      <td valign="top"></td>
    </tr>
    <tr>
      <td height="8"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="44"></td>
      <td colspan="7" valign="top"><div id="status" style="font-size:36px;"></div></td>
    </tr>
    
    <tr>
      <td height="5" colspan="8" valign="top"><img src="images/phead.png" width="700" height="5" /></td>
    </tr>
</table>
</form>
</body></center>

</html>
