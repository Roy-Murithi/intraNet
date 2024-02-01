<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
	//include ("globalfunc.php");

	$source="../../";
	
	$folders=array();
	$files=array();
	
	$d = dir($source);
	$x=0;
	$x1=0;
	$size=0;
	while (false !== ($entry = $d->read()))
	{
		if($entry !="." && $entry !="..")
		{
			if(is_dir($d->path."/$entry")==true)
			{
				$folders[$x]=$d->path."/$entry";
				$x=$x+1;
			}
			else
			{
				$files[$x1]=$d->path."/$entry";
				$x1=$x1+1;
			}
		}
		
	}
	
	$d->close();
	
	$i=0;
	if(sizeof($folders)>0)
	{
		do
		{		
			$d = dir($folders[$i]);
			while (false !== ($entry = $d->read())) 
			{
				if($entry !="." && $entry !="..")
				{
					if(is_dir($d->path."/$entry")==true)
					{
						$folders[$x]=$d->path."/$entry";
						$x=$x+1;
					}
					else
					{
						$files[$x1]=$d->path."/$entry";
						$x1=$x1+1;
					}
				}
			}
			$d->close();	
			$i=$i+1;
		}while($i<sizeof($folders) && sizeof($folders)!=0);
	}
	
	$curSize=dirSize($source);
	
?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
function getJob()
	{
		frmUsers.txtDat10.value=frmUsers.txtDat9.options[frmUsers.txtDat9.selectedIndex].text;
	}
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this page?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	
</script>

<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
div#section {
width:720px;
float:left;
background:#EEFFEE;
border:thin dotted #999999;

}
div#sep {
width:720px;
float:left;
height:5px;
}
div#dept {
width:700px;
float:right;
background:#EEEEFF;
border:thin dotted #aaaaaa;

}
div#dsep {
width:700px;
float:left;
height:5px;
-->
</style>
<table width="752" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="8" valign="top">www.jkuat.ac.ke</td>
            <tr>
              <td height="20" colspan="8" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                <td width="99" height="20" valign="top"><div align="right">Site total size: </div></td>
                <td width="1">&nbsp;</td>
                <td colspan="4" valign="top"><?php echo format_bytes($curSize);?>&nbsp;</td>
                <td width="204">&nbsp;</td>
                <td width="183">&nbsp;</td>
  <tr>
    <td height="20" valign="top"><div align="right">Site total files:</div></td>
    <td></td>
    <td width="113" valign="top"><?php echo sizeof($files);?>&nbsp;</td>
    <td width="74" valign="top"><div align="right">Folders:</div></td>
    <td width="1">&nbsp;</td>
    <td colspan="2" valign="top"><?php echo sizeof($folders);?></td>
    <td>&nbsp;</td>
  <tr>
    <td height="303">&nbsp;</td>
    <td></td>  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td></td>
    <td></td>
</table>
