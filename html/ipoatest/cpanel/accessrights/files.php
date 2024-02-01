<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$fid=removeTag(@$_GET['fid']);
$function=removeTag(@$_GET['function']);

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
			files.value=files.value.replace(chkBox.value,"");
			files.value=files.value+"!~!"+chkBox.value+"!~!";
		}else
		{
			files.value=files.value.replace("!~!"+chkBox.value+"!~!","");
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
<form action="savefiles.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="586" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="52" height="325">&nbsp;</td>
    <td colspan="4" valign="top">
      <?php
	
	if(is_dir("../$fid"))
	{
		$d = dir("../$fid");		
		$strFiles="";
		while (($file = $d->read()) !== false)
		{
			if(is_file("../$fid/$file") && strtolower(substr($file,strlen($file)-4,4))==".php")
			{
				//echo strpos("conn globalfunc",strtolower(str_replace(".php","",$file)))."-->".strtolower(str_replace(".php","",$file));
				if(!strpos("!~leadstring~! conn globalfunc ",strtolower(str_replace(".php","",$file))) && !strpos(strtolower("!~leadstring~! ".$file),"save") && !strpos(strtolower("!~leadstring~! ".$file),"edit"))
				{
					$checked="";
					$disabled="";
		  			$strFunction=@fetchValue($pref."accessreg","filename","$fid/$file","1");
					if($strFunction!="")
					{
						$checked=" checked=\"checked\" ";
						$strFiles=$strFiles."!~!$fid/$file!~!";					
					}
					echo "<div style=\"width:700px;\"><input type=\"checkbox\" $checked value=\"$fid/$file\" onClick=\"selectThis(this)\"/>" . $file . "</div>";
										
				}
		  	}
		}
		$d->close();
	}
?>	</td>
    </tr>
  <tr>
    <td colspan="2" rowspan="2" valign="top"><input name="files" id="files" type="hidden" value="<?php echo @$strFiles; ?>" />
      <input name="function" type="hidden" id="function" value="<?php echo @$function; ?>"/>
	  <input name="fid" type="hidden" id="fid" value="<?php echo @$fid; ?>"/>	  </td>
    <td width="145" height="22" valign="top"><?php
	if(@$_GET["function"]!="")
	{
		echo "<input type=\"button\" name=\"add\" value=\"Save selected pages\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td width="127" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('functions.php','content','')"></td>
  <td width="131">&nbsp;</td>
  </tr>
  <tr>
    <td height="13"></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="131"></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>
</body>

