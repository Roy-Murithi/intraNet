<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
$pageid=@$_GET["pageid"];
if(@$_GET["galleryid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `".$pref."gallery` where `galleryid`='".@$_GET['galleryid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."gallery` where `galleryid`='".@$_GET["galleryid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>


<script language="javascript1.2">		

		function init()
		{
			var div2= document.getElementById("editor");
			if(typeof div2.style.opacity=="string")
			{
				div2.style.opacity=0.2;
			}else
			{
						
				div2.style.filter ='alpha(opacity=' + 20 + ')';
			}
		}		
		function saveImg()
		{
			document.frmgallery.submit();
		}

		document.clicked=false;
		document.obj="";
		function selectDiv(theObj)
		{
			document.clicked=true;
			theObj.style.cursor="move";
			document.obj= document.getElementById("txt");
		}
		
		function moveIt(e)
		{
			if(document.clicked==true)
			{
				/*if(true)
				{
				
				}else
				{
				
				}*/
				
				var test=getMouseXY(e);
			}
			
			
		}
		
		var IE = document.all?true:false
		if (!IE) document.captureEvents(Event.MOUSEMOVE)
		function getMouseXY(e) 
		{
			if (IE) { // grab the x-y pos.s if browser is IE
			tempX = event.clientX + document.body.scrollLeft
			tempY = event.clientY + document.body.scrollTop
			} else { // grab the x-y pos.s if browser is NS
			tempX = e.pageX
			tempY = e.pageY
			}	
			document.obj.value=tempX
			return true
		}
		function deselectDiv(theObj)
		{
			document.clicked=false;
			theObj.style.cursor="auto";
			document.obj= "";
		}
		
    </script>

<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>
<body onLoad=" init()">
<center>

<table width="518" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="2" valign="top"> Page image to insert </td>
  <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
				   <?php
								   $pic="../../".$data[1];
									$src_img="";
									if(strtolower(substr($pic,strlen($pic)-4,4))==".jpg")
									{							
										$src_img=imagecreatefromjpeg($pic);
									}elseif(strtolower(substr($pic,strlen($pic)-4,4))==".png")
									{
										$src_img=imagecreatefrompng($pic);
									}
				   ?>                  <td height="114" colspan="2" valign="middle" align="center">
				     <form name="frmgallery" action="savefeatured.php" method="post" enctype="multipart/form-data" style="vertical-align:middle;">
				  			  <div style="vertical-align:middle;height:<?php echo  imagesy($src_img); ?>px; width:<?php echo  imagesx($src_img); ?>px;"  align="left"> 

			  <div id="display" style="display:block;position:relative; height:<?php echo  imagesy($src_img); ?>px; width:<?php echo  imagesx($src_img); ?>px;"> 
				
				  <img src="<?php 
				if(is_file("../../".$data[1]))
				{
		  			echo "../../".$data[1];
				}
				else
				{
					echo "";
				}
		  ?>" border="1" style="border-color:B2D1B2"  height="<?php echo  imagesy($src_img); ?>" width="<?php echo  imagesx($src_img); ?>"/>
		  <?php
								if(imagesx($src_img)<imagesy($src_img))
								{
									$size=imagesx($src_img);
									$left=0;
									$top=(imagesy($src_img)-imagesx($src_img))/2;
								}else
								{
									$size=imagesy($src_img);
									$top=0;
									$left=(imagesx($src_img)-imagesy($src_img))/2;
								}
					?>
		  		<div id="editor" style="border:thin solid #FF0000; width:<? echo $size;?>px; height:<? echo $size;?>px; top:<? echo $top;?>px; left:<? echo $left;?>px; position:absolute; z-index:10000; background:#FFFF00;" onMouseDown="selectDiv(this);" onMouseUp="deselectDiv(this)" onMouseMove="moveIt(event)" ></div>
				</div>
				  <div>
				    <div  style="display:block; overflow:auto;">
				    <div  style="float:left; width:490px;">
					
					<input name="txtT" type="hidden" id="txtT" value="<? echo $top; ?>">
				    <input name="txtL" type="hidden" id="txtL" value="<? echo $left; ?>">
					<input name="txtH" type="hidden" id="txtH" value="<? echo $size; ?>">
				    <input name="txtW" type="hidden" id="txtW" value="<? echo $size; ?>">
				    <input name="galleryid" type="hidden" id="galleryid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>">
					<input name="pageid" type="hidden" id="pageid" value="<?php if($pageid!=""){echo $pageid;}?>">
</div>
                    </div>
				  </div>
				     </form></td>
  <tr>
                     <td width="390" height="42" valign="top"><input name="txt" type="text" id="txt"></td>
                     <td width="112" valign="top"><span style="vertical-align:middle">
        <input name="button" type="button" class="BTN" onClick="saveImg()" value="save thumbnail" />
                     </span></td>
    <tr>
    <td height="21" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="24">&nbsp;</td>
    <td valign="top">
		<div align="right">
			<input name="Button" type="button" class="BTN" value="  Cancel  " onClick="document.location='listimages.php?sessid=smetsysmocmas&index=$index;'" />
	  </div></td>
  </table>
</center>
</body>
