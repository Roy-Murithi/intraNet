<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["meetingsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  meetings where `meetingsid`='".@$_GET["meetingsid"]."'");
	}else
	{
		$rs=@mysql_query("select * from meetings where `meetingsid`='".@$_GET["meetingsid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid msetup");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
	}
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<body onLoad="">
<form action="savemeetings.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Schedule meeting </td>
    <td width="72">&nbsp;</td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td width="47"></td>
    <td width="162" valign="top"><div align="right"><strong>Meeting Category </strong>: </div></td>
    <td width="10"></td>
    <td colspan="4" valign="top">
	<?php
		$rs=@mysql_query("select * from msetup order by `name` desc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{?>
			<select name="txtDat1" onChange="if(this.options[this.selectedIndex].value!='none'){document.frmUsers.txtDat2.value=this.options[this.selectedIndex].label}else{document.frmUsers.txtDat2.value='';}">
				<option id="none" value="none" label=""  >Select meeting to Schedule</option>
			<?php
				for($x=0;$x<$counts;$x++)
				{
					$data=mysql_fetch_array($rs);
					?>
					<option id="<?php echo @$data[1];?>" value="<?php echo @$data[1];?>" label="<?php echo @$data[2];?>" <?php if(@$data[1]==@$datax[1]){echo "selected=\"selected\"";}?>><?php echo @$data[1];?></option>
			<?php
				}
				?>
			</select>
			<?php
			}
			
		}
	?>
	
      <input name="meetingsid" type="hidden" id="meetingsid" value="<?php echo @$datax[0];?>"></td>
  </tr>
  
  
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">Venue:</div></td>
    <td>&nbsp;</td>
    <td colspan="2" rowspan="2" valign="top"><textarea name="txtDat2" id="txtDat2" ><?php echo @$datax[2]; ?></textarea></td>
    <td width="21">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="98">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  

  <tr>
    <td height="22"></td>
    <td></td>
    <td valign="top"><div align="right">Meeting Date:</div></td>
    <td></td>
    <td colspan="2" rowspan="2" valign="top"><input name="txtDat4" type="text" id="txtDat4" value="<?php echo @$datax[4];?>"></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="93"></td>
    <td></td>
    <td colspan="6" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#D3E9B3" class="Black_Header_Text" style="border:thin dotted #96CB49">
      <!--DWLayoutTable-->
      <tr>
        <td width="55" height="4"></td>
            <td width="105"></td>
            <td width="9"></td>
            <td width="438"></td>
            <td width="11"></td>
            <td width="95"></td>
          </tr>
      <tr>
        <td height="18" colspan="2" valign="top"><div align="right">Meeting Access rights </div></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      <tr>
        <td height="22">&nbsp;</td>
            <td valign="top"><div align="right">Username:</div></td>
            <td>&nbsp;</td>
            <td colspan="2" valign="top"><input name="txtDat5" type="text" id="txtDat5" value="<?php echo @$datax[5];?>"></td>
            <td>&nbsp;</td>
          </tr>
      <tr>
        <td height="22">&nbsp;</td>
            <td valign="top"><div align="right">Password:</div></td>
            <td>&nbsp;</td>
            <td valign="top"><input name="txtDat6" type="password" id="txtDat6" value="<?php echo @$datax[6];?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      <tr>
        <td height="23"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      
    </table></td>
    </tr>
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="135"></td>
    <td width="317"></td>
    <td></td>
    <td></td>
  </tr>
  
  
  
  
  
  
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td valign="top"><?php
	if( @$_GET["msetupid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Schedule meeting\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('schedules.php','content','')"  /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
</body>
