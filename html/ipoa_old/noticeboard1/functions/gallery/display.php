<?php
	
	$imagesC=date("Ymd").date('His');
	$albumid=@$_GET["albumid"];
	$galleryid=@$_GET["galleryid"];
	$category=@$_GET["category"];
	if($albumid=="")
	{
		$albumid="ALBM-000";
	}
	if($category=="")
	{
		$category="gallery";
	}
	include "conn.php";
	include ("globalfunc.php");
	//$index=@$_GET["index"];
	
	function getImgCount($pref,$album,$category)
	{
						$acount=0;
						$rsg=mysql_query("select * from ".$pref."gallery where album='$album' and category='$category'  order by `index` desc");
						if($rsg)
						{
							$acount=mysql_num_rows($rsg);
						}
						return $acount;
	}
	function getImgs($pref,$album,$category)
	{
						$acount=0;
						$pic="";
						$rsg=mysql_query("select * from ".$pref."gallery where album='$album' and category='$category'  order by `index` desc");
						if($rsg)
						{
							$acount=mysql_num_rows($rsg);
							if($acount>0)
							{
								$idata=mysql_fetch_array($rsg);
								$pic="$idata[1]";
							}
						}
						if($pic!="")
						{
							$divs="
							<div style=\"margin-left:30px;float:left;width:140;height:80px;\"><img src=\"$pic\" style=\"margin:2px;float:left;\" height=\"". getPicH($pic,80)."\" width=\"". getPicW($pic,80)."\"></div>
							";
						}else
						{
							$divs="<div style=\"margin-left:30px;float:left;width:140;height:80px\"></div>";
						}
						return $divs;
	}
	
	$divsAlbum="";
	$rsAlbum=mysql_query("select * from `".$pref."album` order by `index` desc");
	if($rsAlbum)
	{
		$rowsA=mysql_num_rows($rsAlbum);
		if($rowsA>0)
		{
			$widthA=145 * $rowsA;
			for($x=0; $x<$rowsA; $x++)
			{
				$dataA=mysql_fetch_array($rsAlbum);
				
				$imgCounts=getImgCount($pref,$dataA[0],$category);
				$coverimg=getImgs($pref,$dataA[0],$category);
				
				$divsAlbum=$divsAlbum . "
				<a href=\"display.php?albumid=$dataA[0]\">
				<div id=\"alb\" style=\"width:140px;float:left;background-image:url(images/album.png); background-position:top left; background-repeat:no-repeat;position:relative;\">
					<div id=\"alb\" align=\"center\" style=\"width:140px;height:30px;float:left;\"></div>
					
						$coverimg
					
					<div id=\"alb\" align=\"center\" style=\"width:140px;height:30px;float:left;\"></div>
					<div id=\"alb\" align=\"center\" style=\"width:140px;float:left;\">
						$dataA[1] <font style=\"font-size:10px;\"><br />($imgCounts Pictures)</font>
					</div>
				</div>
				</a><div style=\"width:5px;height:30px;float:left;\"></div>";
			}
			$divsAlbum="<div style=\"width:775px;\"><div id=\"alb\" style=\"width:".$widthA."px;\">$divsAlbum</div></div>";
		}
	}
	$rsAlbume=mysql_query("select * from `".$pref."album` where albumid='$albumid'  order by `index` desc");
	if($rsAlbume)
	{
		$rowse=mysql_num_rows($rsAlbume);
		if($rowse>0)
		{
			$datae=mysql_fetch_array($rsAlbume);
		}
	}
$divsGallery="";
$galleryIndex=0;
	
	$rsGallery=mysql_query("select * from `".$pref."gallery` where  album='$albumid' and category='$category'  order by `index` desc");
	if($rsGallery)
	{
		$rowsG=mysql_num_rows($rsGallery);
		if($rowsG>0)
		{
			$widthG=0;
			$left=0;
			echo "<input type=\"hidden\" value=\"$rowsG\" id=\"maxImg\" />";
			for($x=0; $x<$rowsG; $x++)
			{
				$dataG=mysql_fetch_array($rsGallery);
				$pic="$dataG[1]";		
				$xed=$x+1;		
				$divsGallery=$divsGallery . "
				<div class=\"displayer\" onMousemove=\"displayText()\" onClick=\"document.location='$dataG[1]';\"  id=\"canvas$x\" style=\"width:". ((int)getPicW($pic,80) + 5) ."px;position:absolute;top:190px;left:". $left ."px;\" >
					<img alt=\"$dataG[2]\" id=\"img$x\" src=\"$dataG[1]\" height=\"". getPicH($pic,80)."\" width=\"". getPicW($pic,80)."\">
					<input type=\"hidden\" value=\"". getPicW($pic,600).":". getPicH($pic,600)."\" id=\"size$x\" />
					<input type=\"hidden\" value=\"". getPicW($pic,80).":". getPicH($pic,80)."\" id=\"sizeo$x\" />
					<input type=\"hidden\" value=\"<b>About this picture</b> <br />$dataG[3] <font style=&quot;font-size:10px;&quot;>(uploaded on $dataG[7]) by $dataG[6])</font><br /><br /><b>About the album</b> <br />$datae[3] <font style=&quot;font-size:10px;&quot;>(created on $datae[2]) by $datae[4])</font><br /><br /><b>Picture $xed out of $rowsG</b>\" id=\"text$x\" />
				</div>";
				$widthG=(int)$widthG +((int)getPicW($pic,80) + 5);
				$left=(int)$left+((int)getPicW($pic,80) + 5);
				if($galleryid==$dataG[0])
				{
					$galleryIndex=$x;				
				}
			}
			$divsGallery="
			<div style=\"width:775px;overflow:hidden;vertical-align:middle\">
				<div id=\"alb\" style=\"width:".$widthG."px;\">
					$divsGallery
				</div>
			</div>";
		}
	}
?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>


<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
.loader{
background:#FFFFFF;
}
div.loader:hover{
background:#EDF8ED;
cursor:pointer;
}

.displayer{
background:#FFFFFF;
}

-->
</style>

<link href="../../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<center>
</center>
<a name="display"></a>
<table width="1024" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text" style=" ">
  <!--DWLayoutTable-->
  <tr>
    <td width="1024" height="560" valign="middle">
	  <div style="width:1024px; height:600px; position:relative; border:thin dotted; overflow:hidden"> 
	  <div style="width:1026px;  position:absolute; left:-1px; top:250px; height:100px; z-index:0; background:#000000; background-image:url(images/film.png); background-repeat:repeat-x; background-position:top;"> </div>
	  
	  <?php echo "$divsGallery"; ?>
	  <div style="width:400px; height:600px; position:absolute; left:0px;  overflow:hidden;cursor:pointer;z-index:10000;" onClick="prevPicture()" >
	  <img src="images/lgallery.png" />
	  </div>
	  <div style="width:400px; height:600px; position:absolute; left:624px;  overflow:hidden;cursor:pointer; z-index:10000;" onClick="nextPicture()" >
	  <img src="images/rgallery.png" />
	  </div>
	  <!--<div id="leftText" style="width:200px;  position:absolute; left:0px; top:10px;  overflow:hidden; z-index:100000; background:#FFFFFF; padding:10px;"   > </div>-->
	  <div id="rightText" style="width:200px;  position:absolute; left:824px; top:10px;   overflow:hidden;  z-index:100000; background:#FFFFFF;  padding:10px;"> </div>
	  </div></td>
  </tr>
  
  <tr>
    <td height="40" valign="top"  style="border-bottom:thin dotted;"><?php echo "$divsAlbum"; ?></td>
  </tr>
</table>

<script language="javascript">
window.currentIndex=<? echo $galleryIndex; ?>;
function nextPicture()
{
	var maxImg=document.getElementById("maxImg");	
	if(window.currentIndex<Number(maxImg.value)-1)
	{
		loadPicture(window.currentIndex+1);
		window.currentIndex=window.currentIndex+1;
	}
}
function prevPicture()
{
	if(window.currentIndex>0)
	{
		loadPicture(window.currentIndex-1);
		window.currentIndex=window.currentIndex-1;
	}
}
function displayText()
{
	var rightText=document.getElementById("rightText");
	var leftText=document.getElementById("leftText");
	rightText.style.visibility="visible";
	//leftText.style.visibility="visible";
}
function hideText()
{
	var rightText=document.getElementById("rightText");
	var leftText=document.getElementById("leftText");
	rightText.style.visibility="hidden";
	//leftText.style.visibility="visible";
}
function loadPicture(imgIndex)
{
	
	var display=document.getElementById("img"+imgIndex);
	var displayc=document.getElementById("canvas"+imgIndex);
	var size=document.getElementById("size"+imgIndex);
	var maxImg=document.getElementById("maxImg");
	var text=document.getElementById("text"+imgIndex);
	var rightText=document.getElementById("rightText");
	var leftText=document.getElementById("leftText");
	rightText.innerHTML=text.value;
	
	var temp=Array();
	var dwidth=1024;
	var imgtop=260;
	temp=size.value.split(":");
	display.style.width=temp[0]+"px";
	display.style.height=temp[1]+"px";
	var left=(dwidth-Number(temp[0]))/2;
	if(600-Number(temp[1])>0)
	{
		displayc.style.top=((600-Number(temp[1]))/2)+"px";
	}else
	{
		displayc.style.top="0px";
	}
	displayc.style.left=left+"px";
	displayc.style.zIndex="1000000";
	display.style.border="thin solid";
	var sleft=(dwidth-Number(temp[0]))/2;
	sleft=sleft+Number(temp[0])+5;
	rightText.style.left=sleft+"px";
	rightText.style.width=(1024 -Number(sleft)-25)+"px"
	for(x=Number(imgIndex)+1; x<Number(maxImg.value);x++)
	{
		var display=document.getElementById("img"+x);
		var displayc=document.getElementById("canvas"+x);
		var sizeo=document.getElementById("sizeo"+x);
		var tempx=Array();
		tempx=sizeo.value.split(":");
		display.style.width=tempx[0]+"px";
		display.style.height=tempx[1]+"px";
		displayc.style.top=imgtop+"px";
		displayc.style.zIndex="0";
		displayc.style.left=sleft+"px";
		display.style.border="none";
		sleft=Number(sleft)+Number(tempx[0])+5;
	}
	var sleft=(dwidth-Number(temp[0]))/2;
	for(x=Number(imgIndex)-1; x>=0;x--)
	{
		var display=document.getElementById("img"+x);
		var displayc=document.getElementById("canvas"+x);
		var sizeo=document.getElementById("sizeo"+x);
		var tempx=Array();
		tempx=sizeo.value.split(":");
		display.style.width=tempx[0]+"px";
		display.style.height=tempx[1]+"px";
		displayc.style.top=imgtop+"px";
		displayc.style.zIndex="0";
		display.style.border="none";
		sleft=Number(sleft)-Number(tempx[0])-5;
		displayc.style.left=sleft+"px";		
	}
}
function loadAnchor()
{
	document.location='#display';
}

if (window.addEventListener)
window.addEventListener("load", loadAnchor(), false)
else if (window.attachEvent)
window.attachEvent("onload", loadAnchor())
else
window.onload=loadAnchor(); 

if (window.addEventListener)
window.addEventListener("load", loadPicture('<? echo $galleryIndex; ?>'), false)
else if (window.attachEvent)
window.attachEvent("onload", loadPicture('<? echo $galleryIndex; ?>'))
else
window.onload=loadPicture('<? echo $galleryIndex; ?>')


</script>
