<?php
include "conn.php";
?>
<style>
	.headerTable{ background-image:url(theme/images/headimage.png); background-position:left top; background-repeat:no-repeat}
	
	#menu #subMenu{
	display:none;
	}
	
	#menu{
	float:left;
	color:#FFFFFF;
	cursor:pointer;
	font-weight:bold;
	}
	
	#menu #menuTitle{
	padding-left:10px;
	padding-right:10px;
	}
	
	#menu:hover {
	background-color:#004400;
	}
	
	#menu #subMenu #sub_subMenu{
	padding-left:10px;
	padding-right:10px;
	height:33px;
	vertical-align:middle;
	}
	#menu #subMenu #sub_subMenu:hover{
	background:#005500;	
	}
	
	#menu #subMenu a{
	text-decoration:none; 
	color:#FFFFFF;
	}
	
	#menu a{
	text-decoration:none; 
	color:#FFFFFF;
	}
	
	#menu:hover #subMenu{
	position:absolute;
	display:block;
	background:#004400;
	width:200px;	
	}
	
	#menu #subMenu li{
	list-style:none;
	}
	
	.titlebg
	{
	background-image:url(theme/images/Titlebg.png);
	background-position:left top;
	background-repeat:no-repeat;
	height:31px;
	padding-left:2px;
	padding-top:2px;
	}
	
</style>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<table width="1018"  class="headerTable" style=" width:1024px; height:200px;">
<!--DWLayoutTable-->
<tr><td width="17" height="21">&nbsp;</td>
  <td colspan="2" valign="top" class="Black_Header_Text"><div align="right">
    <?php
$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='1'");
$strMNU="";
if($rsTopmnu)
{
	$rowsmnu=mysql_num_rows($rsTopmnu);
	if($rowsmnu>0)
	{
		for($x=0;$x<$rowsmnu;$x++)
		{
			$data=mysql_fetch_array($rsTopmnu);
			if($strMNU!="")
			{
				$strMNU=$strMNU . " | <a href=\"$data[3]\">$data[1]</a>";
			}else
			{
				$strMNU="<a href=\"$data[3]\">$data[1]</a>";
			}
		}
	}
}
echo $strMNU;
?>
  </div></td>
<td width="18">&nbsp;</td>
</tr>
<tr>
  <td height="109">&nbsp;</td>
  <td width="88">&nbsp;</td>
  <td width="873">&nbsp;</td>
  <td>&nbsp;</td>
</tr>





<tr>
  <td height="33">&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2" valign="top">
    <?php
  	$htmlData="";
	$rsMenu=mysql_query("select * from `".$pref."menu` where `type`='0' and `parentmenu`='' order by `ZOrder` ASC");
	if($rsMenu)
	{
		$rows=mysql_num_rows($rsMenu);
		if($rows>0)
		{
			for($x=0;$x<$rows;$x++)
			{
					$data=mysql_fetch_array($rsMenu);
					$htmlData=$htmlData."<div id=\"menu\" style\"height:33px\">
					<a href=\"$data[3]\"><div id=\"menuTitle\" style=\"height:33px;\">$data[1]</div></a>
					<div id=\"subMenu\" align=\"left\">";
					$rsMenu1=mysql_query("select * from `".$pref."menu` where `parentmenu`='$data[0]' order by `ZOrder` ASC");
					if($rsMenu1)
					{
						$rows1=mysql_num_rows($rsMenu1);
						if($rows1>0)
						{
				
							for($x1=0;$x1<$rows1;$x1++)
							{
								$data1=mysql_fetch_array($rsMenu1);
								$htmlData=$htmlData."<a href=\"$data1[3]\"><div id=\"sub_subMenu\">$data1[1]</div></a>";
							}														
						}
					}
					$htmlData=$htmlData."</div></div>\n";
				
			}	
		}
	}
	echo $htmlData;
  ?> </td>
  </tr>
<tr>
  <td height="25">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>

