<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

if(@$_GET["OBid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."OB where `OBid`='".@$_GET['OBid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."OB where `OBid`='".@$_GET['OBid']."'");
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
				alert("Enter valid occurence");
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
<form action="saveobcomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="772" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">Add Occurence </td>
    <td width="72">&nbsp;</td>
    </tr>
  <tr>
    <td height="12"></td>
    <td colspan="7" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="25"></td>
    <td width="47"></td>
    <td width="162" valign="top"><div align="right"><strong>Refference No </strong>: </div></td>
    <td width="10"></td>
    <td colspan="4" rowspan="2" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php echo @$datax[1]; ?>">
      <input name="occurenceid" type="hidden" id="occurenceid"  value="<?php echo @$datax[0]; ?>"/></td>
    </tr>
  
  
  <tr>
    <td height="5"></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="28"></td>
    <td></td>
    <td valign="top"><div align="right">Occurence Date &amp; Time:</div></td>
    <td></td>
    <td colspan="4" valign="top"><script language="javascript">
		document.temp=new Array();
		<?php
		$rs=@mysql_query("select * from ".$pref."OBnature order by `natureid` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					
					$datac=mysql_fetch_array($rs);					
					if(@$datax[0]=="" && $x==0){$tempData=$datac[2]; }
					echo "document.temp[$x]=\"$datac[2]\";\n";
				}
			}
		}
		?>
	</script>
	  Date:
	    <input name="txtDat2" type="text" class="STR1" id="txtDat2" value="<?php 
		$strtemp=explode(" ",@$datax[2]); 
		if (strlen(@$strtemp[0])>5)
		{
			echo @$strtemp[0];
		}
		?>">
	  Hour:
	  <input name="txtDatH" type="text" class="STR1" id="txtDatH" size="4" maxlength="2" value="<?php 
		$strtemp=explode(" ",@$datax[2]); 
		if (strpos(@$strtemp[1],":")>0)
		{
			$tempTime=explode(":",@$strtemp[1]);
			echo @$tempTime[0];
		}
		?>"> 
	  Min:
	  <input name="txtDatM" type="text" class="STR1" id="txtDatM" size="4" maxlength="2" value="<?php 
		$strtemp=explode(" ",@$datax[2]); 
		if (strpos(@$strtemp[1],":")>0)
		{
			$tempTime=explode(":",@$strtemp[1]);
			echo @$tempTime[1];
		}
		?>"></td>
    </tr>
  <tr>
    <td height="28"></td>
    <td></td>
    <td valign="top"><div align="right">Casefile No: </div></td>
    <td></td>
    <td colspan="2" valign="top"><input name="txtDat3" type="text" class="STR1" id="txtDat3" value="<?php echo @$datax[3]; ?>"></td>
    <td width="21"></td>
    <td></td>
  </tr>
  
  
  
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Nature of Occurence: </div></td>
    <td></td>
    <td colspan="2" valign="top">
        
		<textarea name="txtDat4" rows="2" class="STR1" id="txtDat4" type="text" style="height:50px;" ><?php echo @$datax[4]; ?></textarea>
      </div></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Occurence desciption:</div></td>
    <td></td>
    <td colspan="2" rowspan="2" valign="top"><textarea name="txtDat5" id="txtDat5"><?php echo @$datax[5]; ?></textarea></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="98"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Remarks: </div></td>
    <td></td>
    <td colspan="2" valign="top">
	<textarea name="txtDat6" rows="2" class="STR1" id="txtDat6" type="text" style="height:50px;" ><?php echo @$datax[6]; ?></textarea>
	</td>
    <td></td>
    <td></td>
    </tr>

  <tr>
    <td height="17"></td>
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
	if( @$_GET["OBid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new occurence\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('obcomplaint.php','content','')"  /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="46"></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>
</body>
