<?php
require_once("conn.php");
if(@$called=="")
{	
	echo "welcome to homepage";exit;
}
//set vc's office deptid
$deptid="";
$rsPost=mysql_query("select * from `faculty` where `level`='2'");
if($rsPost)
{

	$rows=mysql_num_rows($rsPost);
	if($rows>0)
	{
		//for($xp=0;$xp<$rows;$xp++)
		//{
			
			$datap=mysql_fetch_array($rsPost);
					//code here for posts
			$imgSrc="";
			
								if($data[7]!="-")
								{
									$query="select * from staff where `staffid`='$datap[6]'";
									$rsStaff=mysql_query($query);
									if($rsStaff)
									{
										$rowst=mysql_num_rows($rsStaff);
										if($rowst>0)
										{											
											$datas=mysql_fetch_array($rsStaff);
											if($datas[8]!="none" && is_file($datas[8])==true)
											{
												$imgSrc="<div style=\"width:100px; border:thin solid #CCCCCC;float:left; margin:10px; \"><a href=\"staffdetails.php?staffid=$datas[0]\";><img src=\"$mainSiteRoot/$datas[8]\" height=\"". getPicH($datas[8],100)."\" width=\"".getPicW($datas[8],100)."\"/><div style=\"width:100px;\" align=\"center\" class=\"Black_Header_Text\">$datas[3]</div></a></div>";
											}
										}										
									}
								}	
			//}
			$datap[4]=str_replace("<p>","",$datap[4]);
			$datap[4]=str_replace("</p>","",$datap[4]);
			$datap[4]=str_replace("\n","<br />",$datap[4]);
			$strData=$datap[4];
			$strData=strip_tags($strData);	
					//$strData=substr($strData,0,200);		
							
					echo "
					<div style=\"width:565px;margin-bottom:10px;float:left\">
					<div style=\"width:565px;font-size:16px;\"><b><a href=\"$datap[5]?postid=$datap[0]\">$datap[1]</a></b></div>			
					<div style=\"width:565px;vertical-align:top;\">	
						$imgSrc	$strData
					</div>			
					</div>";
			
		//}
			
	}
}
?>
