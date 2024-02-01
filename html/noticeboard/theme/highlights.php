<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
	.pinned{
	 background-repeat:no-repeat;background-image:url(images/pin2.gif);background-position:left;padding-left:12px;	
	}
	li.pinned:hover{
	background-image:url(images/pin1.gif);
	}
</style>
<table border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text" style=" width:209px;">
  <!--DWLayoutTable-->
  <tr>
    <td width="10" height="24">&nbsp;</td>
    <td colspan="2" valign="top">HIGHLIGHTS</td>
  </tr>
  <tr>
    <td height="133">&nbsp;</td>
    <td width="4">&nbsp;</td>
    <td width="195" valign="top" style="">
	  <?php
	$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='2' order by zorder asc");
	$strMNU="";
	if($rsTopmnu)
	{
		$rowsmnu=mysql_num_rows($rsTopmnu);
		if($rowsmnu>0)
		{
			$strMNU="<ul style=\"list-style:none;margin:0px; padding:0px;; font-size:10px\">\n";
			for($x=0;$x<$rowsmnu;$x++)
			{
				$data=mysql_fetch_array($rsTopmnu);
				$strMNU=$strMNU . "<li class=\"pinned\"> <a href=\"$data[3]\" >$data[1]</a></li>\n";	
			}
			$strMNU=$strMNU . "</ul>\n";
		}
	}
	echo $strMNU;
	?>	</td>
  </tr>
</table>

