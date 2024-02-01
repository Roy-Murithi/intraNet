<?php
include "conn.php";
?>

<style>
	.headerTable{ background-image:url(theme/images/headimage.png); background-position:left top; background-repeat:no-repeat}
		
	#menu{
	float:left;
	color:#FFFFFF;
	cursor:pointer;
	font-weight:bold;
	border-left:thin solid #FFFFFF;
	}
	
	#menu #subMenu{
	display:none;	
	}
	
	#menu #subMenu #subsubMenu{
	display:none;
	}
	
	#menu #menuTitle{
	padding-left:10px;
	padding-right:10px;
	}
	
	#menu #subMenu #sub_Menu_Title{
	padding-left:10px;
	padding-right:10px;
	height:33px;
	vertical-align:middle;
	}
	
	#menu #subMenu #sub_MenuCanvas #sub_sub_Menu_Title{
	height:33px;
	width:180px;
	padding-left:10px;
	padding-right:10px;
	vertical-align:middle;
	}
	
	#menu #subMenu #sub_MenuCanvas{
	position:relative;
	}
	
	#menu #subMenu  #sub_MenuCanvas #subsubMenu{
	background:#005500;
	position:absolute;
	top:0px;
	left:200px;
	width:220px;	
	}	
	
	#menu:hover {
	background-color:#004400;
	}	
	
	#menu:hover #subMenu{
	position:absolute;
	display:block;
	background:#004400;
	width:200px;
	z-index:2000;	
	}
	
	#menu #subMenu #sub_Menu_Title:hover{
	background:#005500;	
	}
	
	#menu #subMenu #sub_MenuCanvas:hover, #menu #subMenu #sub_sub_Menu_Title:hover{
	background:#005500;	
	}
	
	#menu #subMenu #sub_MenuCanvas:hover #subsubMenu{
	position:absolute;
	display:block;
	background:#005500;
	width:200px;	
	}
	
	#menu #subMenu #sub_sub_Menu_Title:hover{
	background:#006600;	
	}	
	
	
	
	
	
	#menu a{
	text-decoration:none; 
	color:#FFFFFF;
	}
	
	#menu #subMenu a{
	text-decoration:none; 
	color:#FFFFFF;
	}
	
	#menu #subMenu #subsubMenu a{
	text-decoration:none; 
	color:#FFFFFF;
	}

	.titlebg
	{
	/*background-image:url(theme/images/Titlebg.png);
	background-position:left top;
	background-repeat:no-repeat;*/
	height:21px;
	padding-left:2px;
	padding-top:2px;
	}
	
</style>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<table width="1018"  class="headerTable" style=" width:1024px; height:202px;">
<!--DWLayoutTable-->
<tr><td width="1" height="21">&nbsp;</td>
  <td colspan="3" valign="top" class="Black_Header_Text"><div align="right">
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
<td width="6">&nbsp;</td>
</tr>
<tr>
  <td height="26"></td>
  <td width="201"></td>
  <td width="469"></td>
  <td width="315" align="right" valign="top">
     <form name="frmMainSearch" method="post" action="search.php" enctype="multipart/form-data" style="width:250px;float:right; margin:0px;">
        <input type="text" class="STR1" name="txtMainSearch" />
		<input type="submit" value="Search" class="BTN" />
    </form></td>
  <td></td>
</tr>
<tr>
  <td height="15"></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td height="37"></td>
  <td></td>
  <td></td>
  <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td></td>
</tr>
<tr>
  <td height="14"></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td height="27"></td>
  <td></td>
  <td colspan="3" valign="top">
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
					$ldiv="";
					if($x==$rows-1)
					{
						$ldiv="border-right:thin solid #FFFFFF;";
					}
					$htmlData=$htmlData."<div id=\"menu\" style=\"height:33px;$ldiv\">
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
								
								//sub sub menu declaration
								$rsMenu2=mysql_query("select * from `".$pref."menu` where `parentmenu`='$data1[0]' order by `ZOrder` ASC");
								//rearranged to create submenu presence indicator
									$rows2=mysql_num_rows($rsMenu2);
									if($rows2>0)
									{
										$more="...";
									}else
									{
										$more="";
									}
								$htmlData=$htmlData."<div  id=\"sub_MenuCanvas\"><a href=\"$data1[3]\"><div id=\"sub_Menu_Title\">$data1[1] $more</div></a>";
								if($rsMenu2)
								{
									$rows2=mysql_num_rows($rsMenu2);
									if($rows2>0)
									{
										$htmlData=$htmlData."<div id=\"subsubMenu\" align=\"left\">";							
										for($x2=0;$x2<$rows2;$x2++)
										{
											$data2=mysql_fetch_array($rsMenu2);
											$htmlData=$htmlData."<a href=\"$data2[3]\"><div id=\"sub_sub_Menu_Title\">$data2[1]</div></a>";
										}
										$htmlData=$htmlData."</div>\n";														
									}
								}								
								//end of sub sub menu declaration	
								$htmlData=$htmlData."</div>\n";				
								
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
  <td height="44"></td>
  <td></td>
  <td>&nbsp;</td>
  <td></td>
  <td></td>
</tr>
</table>

