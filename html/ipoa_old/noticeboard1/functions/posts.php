<?php
require_once("conn.php");
if(@$called=="")
{	
	header("location:../");
}

$viewable=2;
$listable=$viewable+4;

$rsPost=mysql_query("select * from ".$pref."post order by `others` desc");
if($rsPost)
{

	$rows=mysql_num_rows($rsPost);
	if($rows>0)
	{
		if($rows<$viewable)
		{
			$viewable=$rows;
			$listable=0;
		}
		if($rows<$listable)
		{
			$listable=$rows;
		}
		for($xp=0;$xp<$rows;$xp++)
		{
			
			$datap=mysql_fetch_array($rsPost);
				if($xp<$viewable)
				{
					//code here for posts
					$imgDiv="";
					if($datap[6]!="none" && is_file($datap[6])==true)
					{
						$pic=$datap[6];
						$imgDiv="<div style=\"width:". getPicW($pic,80) ."px;height:". getPicH($pic,80) ."px;float:left;margin-right:5px;margin-bottom:5px;\"><img src=\"$datap[6]\" width=\"". getPicW($pic,80) ."\" height=\"". getPicH($pic,80) ."\" /></div>";
					}
					$datap[2]=str_replace("<p>","",$datap[2]);
					$datap[2]=str_replace("</p>","",$datap[2]);
					$datap[2]=str_replace("\n","<br />",$datap[2]);
					$strData=$datap[2];
					$strData=strip_tags($strData);	
					//$strData=substr($strData,0,200);
					if(strlen($strData)>200)
					{
						$strPos=strpos($strData,".",300);
						if($strPos>300 && $strPos<450)
						{
							$strData=substr($strData,0,$strPos+1);
						}else
						{
							$strPos=strpos($strData,",",350);						
							if($strPos>300 && $strPos<450)
							{
								$strData=substr($strData,0,$strPos+1);
							}else
							{
								$strPos=strpos($strData,".",350);
								$strData=substr($strData,0,$strPos);
							}
						}
					}	
				
							
					echo "
					<div style=\"width:565px;margin-bottom:10px;float:left\">
					<div style=\"width:565px;font-size:16px;\"><b><a href=\"$datap[4]?postid=$datap[0]\">$datap[1]</a></b></div>
					<div style=\"font-size:10px;\">(Posted on $datap[5], by $datap[3])</div>			
					<div style=\"width:565px;vertical-align:top;\">	
						$imgDiv	
						<div style=\"width:100%;\" align=\"justify\">$strData <a href=\"$datap[4]?postid=$datap[0]\"> read more...</a></div>	
					</div>			
					</div>";
					
				}elseif($xp<$listable)
				{
					//code here for listing of posts
					echo "
					<div style=\"width:565px;float:left\">
						<div style=\"width:30px;float:left;margin-top:4px;\"><img src=\"images/pointer.gif\"/></div>
						<div style=\"width:505px;float:left;font-size:12px;\"><b><a href=\"$datap[4]?postid=$datap[0]\">$datap[1]</a></b><font style=\"font-size:10px;\"> - Posted on $datap[5]</font></div>				
					</div>";
				}
			
		}
			echo "<div style=\"width:565px; height:10px;float:left\">
										
					</div>
					<div style=\"width:565px;float:left\">
						
						<div style=\"width:505px;float:left;font-size:12px;\"><b><a href=\"posts.php\">View all posts</a></b><font style=\"font-size:10px;\"> - $rows posts</font></div>				
					</div>";
	}
}
?>
