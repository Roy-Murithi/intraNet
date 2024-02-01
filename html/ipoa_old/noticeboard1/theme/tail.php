<style>
.linksto{
list-style:none;
text-decoration:none;
margin-left:10px;
width:212px;
font-size:10px;
color:#000000;
background-image:url(theme/images/sep.png);
background-repeat:no-repeat;
background-position:bottom left;
}
div#btm a{
color:#000000;
}
</style>
<link href="theme/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<div id="btm" style="right:0px; left:0px;bottom:0px; background-image:url(theme/images/bottombg.png); background-repeat:repeat-x; background-position:top;">
<table width="1024" height="200px" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text" style="color:#999999">
  <!--DWLayoutTable-->
  <tr>
    <td height="50" colspan="7" valign="top" bgcolor="#FFFFFF"><img src="theme/images/tailImage.png" width="1024" height="50" /></td>
  </tr>
  <tr>
    <td width="223" height="19" valign="top" class="titlebg"><div align="left" class="style1">Find Us On </div></td>
    <td width="38">&nbsp;</td>
    <td width="245" rowspan="2" valign="top"><div align="left"  class="titlebg style1">Community</div></td>
    <td width="58">&nbsp;</td>
    <td width="212" valign="top"  class="titlebg"><div align="left" class="style1">Links To </div></td>
    <td width="36">&nbsp;</td>
    <td width="212" valign="top"  class="titlebg"><div align="left" class="style1">Legal Note </div></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top">
	  <div align="left"><a href="http://www.ipoa.go.ke">
	    <img src="theme/socialnetworks/facebook.png" alt="Facebook" border="0">	</a>
	        <a href="http://www.ipoa.go.ke">
            <img src="theme/socialnetworks/twitter.png" alt="Twitter" border="0">	</a>
	        <a href="http://www.ipoa.go.ke" >
            <img src="theme/socialnetworks/youtube.jpg" alt="YouTube" border="0"></a>
	        <a href="http://www.ipoa.go.ke" >
        <img src="theme/socialnetworks/rss.png" alt="RSS" border="0">	</a></div></td>
    <td height="1"></td>
    <td></td>
    <td rowspan="3" align="left" valign="top">
	  <div align="left">
	    <?php
$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='5'  order by zorder ASC");
$strMNU="";
if($rsTopmnu)
{
	$rowsmnu=mysql_num_rows($rsTopmnu);
	if($rowsmnu>0)
	{
		for($x=0;$x<$rowsmnu;$x++)
		{
			$data=mysql_fetch_array($rsTopmnu);
			$strMNU=$strMNU . "<li id=\"menu-item-1659\" class=\"linksto\"><a href=\"$data[3]\" >$data[1]</a></li>\n";	
		}
	}
}
echo $strMNU;
?>	
      </div></td>
    <td></td>
    <td rowspan="3" valign="top">
	  <div align="left">
	    <?php
$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='6' order by zorder ASC");
$strMNU="";
if($rsTopmnu)
{
	$rowsmnu=mysql_num_rows($rsTopmnu);
	if($rowsmnu>0)
	{
		for($x=0;$x<$rowsmnu;$x++)
		{
			$data=mysql_fetch_array($rsTopmnu);
			$strMNU=$strMNU . "<li id=\"menu-item-1659\" class=\"linksto\"><a href=\"$data[3]\" >$data[1]</a></li>\n";	
		}
	}
}
echo $strMNU;
?>	
      </div></td>
  </tr>
  <tr>
    <td height="35"></td>
    <td rowspan="2" valign="top">
	  <div align="left">
	    <?php
$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='4'  order by zorder ASC");
$strMNU="";
if($rsTopmnu)
{
	$rowsmnu=mysql_num_rows($rsTopmnu);
	if($rowsmnu>0)
	{
		for($x=0;$x<$rowsmnu;$x++)
		{
			$data=mysql_fetch_array($rsTopmnu);
			$strMNU=$strMNU . "<li id=\"menu-item-1659\" class=\"linksto\"><a href=\"$data[3]\" >$data[1]</a></li>\n";	
		}
	}
}
echo $strMNU;
?>	
      </div></td>
    <td></td>
    <td></td>
  </tr>
  
  <tr>
    <td height="98"></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
</div>

