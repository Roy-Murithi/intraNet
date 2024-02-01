<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="./images/linklogo.bmp" label="IPOA">
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<center>
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="200" height="100" valign="top"><img src="images/chat.png" width="200" height="100" /></td>
  </tr>
  <tr>
    <td height="358" valign="top" style="font-size:9px;" align="left">
	<?php
require_once("conn.php");
$viewable=2;
$listable=$viewable+4;
$rsPost=mysql_query("select * from ".$pref."post order by `others` desc");
if($rsPost)
{

	$rows=mysql_num_rows($rsPost);
	if($rows>0)
	{
		for($xp=0;$xp<$rows;$xp++)
		{
			
			$datap=mysql_fetch_array($rsPost);
				if($xp<$viewable)
				{
					//code here for posts
					$imgDiv="";
					if($datap[6]!="none" && is_file($datap[6])==true)
					{
						$imgDiv="<div style=\"width:80px;height:80px;float:left;margin-right:5px;margin-bottom:5px;\"><img src=\"$datap[6]\" width=\"80\" height=\"80\" /></div>";
					}
					$datap[2]=str_replace("<p>","",$datap[2]);
					$datap[2]=str_replace("</p>","",$datap[2]);
					$datap[2]=str_replace("\n","<br />",$datap[2]);
					$strData=$datap[2];
					$strData=strip_tags($strData);	
					//$strData=substr($strData,0,200);
					if(strlen($strData)>200)
					{
						$strPos=strpos($strData,".",100);
						if($strPos>100 && $strPos<250)
						{
							$strData=substr($strData,0,$strPos+1);
						}else
						{
							$strPos=strpos($strData,",",150);						
							if($strPos>100 && $strPos<250)
							{
								$strData=substr($strData,0,$strPos+1);
							}else
							{
								$strPos=strpos($strData,".",150);
								$strData=substr($strData,0,$strPos);
							}
						}
					}	
				
							
					echo "
					<div style=\"width:200px;margin-bottom:10px;float:left\">
					<div style=\"width:200px;font-size:16px;\"><b><a href=\"$datap[4]?postid=$datap[0]\"  target=\"_blank\">$datap[1]</a></b></div>
					<div style=\"font-size:10px;\">(Posted on $datap[5], by $datap[3])</div>			
					<div style=\"width:200px;vertical-align:top;\">	
						$imgDiv	
						<div style=\"width:100%;\" align=\"justify\">$strData <a href=\"$datap[4]?postid=$datap[0]\"  target=\"_blank\"> read more...</a></div>	
					</div>			
					</div>";
					
				}elseif($xp<$listable)
				{
					//code here for listing of posts
					echo "
					<div style=\"width:200px;float:left\">
						<div style=\"width:30px;float:left;margin-top:4px;\"><img src=\"images/pointer.gif\"/></div>
						<div style=\"width:150px;float:left;font-size:12px;\"><b><a href=\"$datap[4]?postid=$datap[0]\"  target=\"_blank\">$datap[1]</a></b><font style=\"font-size:10px;\"> - Posted on $datap[5]</font></div>				
					</div>";
				}
			
		}
			echo "<div style=\"width:200px; height:10px;float:left\">
										
					</div>
					<div style=\"width:200px;float:left\">
						
						<div style=\"width:150px;float:left;font-size:12px;\"><b><a href=\"posts.php\" target=\"_blank\">View all posts</a></b><font style=\"font-size:10px;\"> - $rows posts</font></div>				
					</div>";
	}
}
?>
	</td>
  </tr>
</table>
</center>
</body>
</html>


