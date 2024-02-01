<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$staffid=@$_GET["staffid"];
if(@$_GET["staffid"]!="")
{
		$rs=@mysql_query("select * from staff where `staffid`='".@$_GET['staffid']."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datas=@mysql_fetch_array($rs);
			}
		}
}
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
		document.frmUsers.submit()		
	}
	function selectThis(chkBox,value)
	{
		var files=document.getElementById("files");
		
		
		
		if(chkBox.checked==true)
		{
			if(value=="1")
			{
				var chk=document.getElementById(chkBox.value+"2");
			}else
			{
				var chk=document.getElementById(chkBox.value+"1");
			}
			chk.checked=false;
			files.value=files.value.replace("!~!"+chkBox.value+"!#!1!~!","");
			files.value=files.value.replace("!~!"+chkBox.value+"!#!2!~!","");			
			files.value=files.value+"!~!"+chkBox.value+"!#!"+value+"!~!";
		}else
		{
			files.value=files.value.replace("!~!"+chkBox.value+"!#!1!~!","");
			files.value=files.value.replace("!~!"+chkBox.value+"!#!2!~!","");
		}
	}
	function selectThis1(chkBox)
	{
		var files=document.getElementById("files");
		
		if(chkBox.checked==true)
		{
			var chk=document.getElementById(chkBox.value);
			files.value=files.value.replace("!~!"+chkBox.value+"!#!1!~!","");		
			files.value=files.value+"!~!"+chkBox.value+"!#!1!~!";
		}else
		{
			files.value=files.value.replace("!~!"+chkBox.value+"!#!1!~!","");
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
<body onLoad="window.parent.dyniframesize();">
<form action="saveRights.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="586" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="20" colspan="5" valign="top">Set Access rights for <?php echo $datas[3];?></td>
    </tr>
  <tr>
    <td width="27" height="13"></td>
    <td width="156"></td>
    <td width="145"></td>
    <td width="127"></td>
    <td width="131"></td>
  </tr>
  <tr>
    <td height="293"></td>
    <td colspan="4" valign="top">
      <?php
		echo exceutableFunc($pref,$staffid);
		echo "<br /><br />";
		$rs=@mysql_query("select distinct(`function`) from ".$pref."accessreg");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$datax=@mysql_fetch_array($rs);
					echo functionOptions($datax[0],$pref,$staffid);
				}
			}
		}
		global $strFiles;
		
		function functionOptions($function,$pref,$staffid)
		{global $strFiles;
			$strHTML="";
			$rs=@mysql_query("select * from ".$pref."accessreg where `function`='$function'");
			if($rs)
			{
				$counts=@mysql_num_rows($rs);
				if ($counts>0)
				{
					$strHTML="<div style=\"width:600px;font-size:14px;\">$function</div>
					<div style=\"border:thin dotted;width:600px;float:left;\">";
					for($x=0;$x<$counts;$x++)
					{
						$datax=@mysql_fetch_array($rs);
						if(is_file("../$datax[0]"))
						{
							//echo strpos("conn globalfunc",strtolower(str_replace(".php","",$file)))."-->".strtolower(str_replace(".php","",$file));
							$checked1="";
							$checked2="";
							$disabled="";
							
							$strFunction=@fetchValue1($pref."access","filename","$datax[0]","userid","$staffid","3");
							
							if($strFunction=="1")
							{
								$checked1=" checked=\"checked\" ";
								$strFiles=$strFiles."!~!$datax[0]!#!1!~!";					
							}elseif($strFunction=="2")
							{
								$checked2=" checked=\"checked\" ";
								$strFiles=$strFiles."!~!$datax[0]!#!2!~!";
							}
							$temp=explode("/",$datax[0]);
							$file=$temp[sizeof($temp)-1];
							$strHTML=$strHTML."
							<div style=\"width:600px;border-bottom:thin dotted;float:left;\">
							<div style=\"width:390px;float:left;padding-left:10px;\">" . $file . "</div>
							<div style=\"width:200px;float:left;\">
							<input type=\"checkbox\" $checked1 id=\"$datax[0]1\" value=\"$datax[0]\" onClick=\"selectThis(this,'1')\"/>Read only
							<input type=\"checkbox\" $checked2 id=\"$datax[0]2\"  value=\"$datax[0]\" onClick=\"selectThis(this,'2')\"/>Read/Write
							</div>
							</div>";
						}
					}
					$strHTML=$strHTML."</div><div style=\"width:600px;height:3px;float:left;\"></div>";
				}
			}
			return $strHTML;
		}
		function exceutableFunc($pref,$staffid)
		{global $strFiles;
			$strHTML="";
			$fPath= explode("/",$_SERVER['SCRIPT_FILENAME']);
			$fPath[sizeof($fPath)-1]="func.txt";
			$newPath=join($fPath,"/");
			$strData=file_get_contents($newPath);
			$temp=explode("\n",$strData);
			$counts=sizeof($temp);
					$strHTML="<div style=\"width:600px;font-size:14px;\">Executable Functions</div>
					<div style=\"border:thin dotted;width:600px;float:left;\">";
					for($x=0;$x<$counts;$x++)
					{
						$datax=explode("!~!",$temp[$x]);
						if( function_exists($datax[0])==1)
						{
							//echo strpos("conn globalfunc",strtolower(str_replace(".php","",$file)))."-->".strtolower(str_replace(".php","",$file));
							$checked1="";
							$checked2="";
							$disabled="";
							
							$strFunction=@fetchValue1($pref."access","filename","$datax[0]","userid","$staffid","3");
							if($strFunction=="1")
							{
								$checked1=" checked=\"checked\" ";
								$strFiles=$strFiles."!~!$datax[0]!#!1!~!";					
							}
							
							$strHTML=$strHTML."
							<div style=\"width:600px;border-bottom:thin dotted;float:left;\">
							<div style=\"width:390px;float:left;padding-left:10px;\">" .  @$datax[1] . "</div>
							<div style=\"width:200px;float:left;\">
							<input type=\"checkbox\" $checked1 id=\"$datax[0]\" value=\"$datax[0]\" onClick=\"selectThis1(this)\"/>Allow Execute
							</div>
							</div>";
						}
					}
					$strHTML=$strHTML."</div><div style=\"width:600px;height:3px;float:left;\"></div>";

			return $strHTML;
		}

?>	</td>
    </tr>
  
  
  <tr>
    <td colspan="2" rowspan="2" valign="top"><input name="files" id="files" type="hidden" value="<?php echo @$strFiles; ?>" />
	  <input name="staffid" type="hidden" id="staffid" value="<?php echo @$datas[0]; ?>"/>	    </td>
    <td height="22" valign="top"><?php
	if(@$_GET["staffid"]!="")
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add access rights\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('functions.php','content','')"></td>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21"></td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>
</body>

