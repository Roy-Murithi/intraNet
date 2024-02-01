<?php
session_start();
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:index.php?pid=0");
	}
include "conn.php";
include "globalfunc.php";
if($_GET["downloadsid"]!="")
{
	if($_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."downloads where `downloadsid`='".$_GET['downloadsid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from ".$pref."downloads where `downloadsid`='".$_GET["downloadsid"]."'");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<script src="scripts/counterajax.js" ></script>
<script language="javascript">
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this picture?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

			if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="")
			{
				alert("Enter valid picture information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(downloadsid)
	{
			if(downloadsid!="")
		{		if (document.frmUsers.txtDat1.value=="" |  document.frmUsers.txtDat2.value=="")
			{
				alert("Enter valid picture information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
		}
	}
</script>
<link href="css/newstyle.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="savedownloads.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="604" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->
  <tr>
    <td height="25" colspan="8" valign="top" class="BorderlessContent_Box">downloads</td>
  </tr>
  <tr>
    <td height="25" colspan="8" valign="top" class="PlainContent_Box">
	  <?php
		echo "Enter new <b>downloads </b> details";
	?>	</td>
    </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><div align="right">Title : </div></td>
    <td width="10">&nbsp;</td>
    <td colspan="3" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php if($_GET["downloadsid"]!=""){echo "$datax[1]";}?>" />
      <input type="hidden" name="downloadsid" value="<?php if($_GET["downloadsid"]!=""){echo "$datax[0]";}?>" /></td>
    <td width="6">&nbsp;</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Details : </div></td>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" valign="top"><textarea name="txtDat2" rows="3" id="txtDat2"><?php if($_GET["downloadsid"]!=""){echo "$datax[2]";}?></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="60" height="98">&nbsp;</td>
    <td width="152">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="28" colspan="2" valign="top"><div align="right">File : </div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><input class="STR1" name="txtDat3" type="file" id="txtDat3" value="<?php if($_GET["downloadsid"]!=""){echo "$datax[2]";}?>" /></td>
    <td width="122">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top">Upload files for downloading. please scan the file before uploading. </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td colspan="3" valign="top"><div align="right">
		  <?php
	if( $_GET["downloadsid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add downloads\"  class=\"BTN\" onclick=\"addUser()\">";
	}
	?>
      
      
    </div></td>
    <td width="81">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="8" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="44" colspan="7" valign="top">
	  <table width="100%" id="downloads" border="0" >
	    <!--DWLayoutTable-->
	    <tr><td width="35" height="25" valign="top" class="BorderlessContent_Box">index</td>
  	        <td width="374" valign="top" class="BorderlessContent_Box">Title</td>
  	        <td width="167" valign="top" class="BorderlessContent_Box">Action</td>
  	      </tr>
	    <tr>
	      <td height="15"></td>
	        <td></td>
	        <td></td>
          </tr>
	    <!--DWLayoutTable-->
	    <?php
		$rs=@mysql_query("select * from ".$pref."downloads");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=@mysql_fetch_array($rs);
					echo "<tr  class=\"PlainContent_Box1\"><td width=20>".((int)$x+1)."</td><td width=100  align=\"center\" valign=\"middle\"><a href=\"../$data[3]\" >$data[1]</a></td><td align=\"left\"><a href=\"#\" onclick=\"getPage('downloads.php','content','downloadsid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"delPage('downloads.php','content','downloadsid=$data[0]&del=99')\">Delete</a>	</td></tr>";
				}
			}
		}
	?>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="3"></td>
    <td></td>
    <td></td>
    <td width="169"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

