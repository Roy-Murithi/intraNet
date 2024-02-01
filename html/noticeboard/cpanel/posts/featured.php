<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
$postid=@$_GET["postid"];
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
			document.editor=document.getElementById("editor");
			document.imge=document.getElementById("imge");
			if(typeof document.editor.style.opacity=="string")
			{
				document.editor.style.opacity=0.2;
			}else
			{
						
				document.editor.style.filter ='alpha(opacity=' + 20 + ')';
			}
		}		
		function saveImg()
		{
			document.frmgallery.submit();
		}

		document.clicked=false;
		document.obj="";
		
		document.currentX=0;
		document.currentY=0;
		function selectDiv(theObj,e)
		{
			document.clicked=true;
			theObj.style.cursor="move";
			document.obj= document.getElementById("txt");
			var test=getMouseXY(e,false);
		}
		
		function moveIt(e)
		{
			if(document.clicked==true)
			{
				var test=getMouseXY(e,true);
			}			
		}
		
		function moveDiv(x,y)
		{
			var diffX=tempX-document.currentX;
			var diffY=tempY-document.currentY;
			var tempxw=document.editor.style.width.replace("px","")
			var tempyw=document.editor.style.height.replace("px","")		
			var tempx=document.editor.style.left.replace("px","")
			var tempy=document.editor.style.top.replace("px","")
			var newx=(Number(tempx)+Number(diffX))
			var newy=(Number(tempy)+Number(diffY))
			if(newx>=0 && Number(newx)+Number(tempxw)<=Number(document.imge.width) )
			{
				document.editor.style.left=newx+"px";
				var txtT=document.getElementById("txtT");
				txtT.value=newx;				
			}
			
			if(newy>=0 && Number(newy)+Number(tempyw)<=Number(document.imge.height) )
			{
				document.editor.style.top=newy+"px";	
				var txtL=document.getElementById("txtL");
				txtL.value=newy;
			}
			
			//var txt=document.getElementById("txt");
			//alert((Number(tempx)+Number(diffX))+"px")
			return true;
		}
		
		var IE = document.all?true:false
		if (!IE) document.captureEvents(Event.MOUSEMOVE)
		function getMouseXY(e, flag) 
		{
			if (IE) { // grab the x-y pos.s if browser is IE
			tempX = event.clientX + document.body.scrollLeft
			tempY = event.clientY + document.body.scrollTop
			} else { // grab the x-y pos.s if browser is NS
			tempX = e.pageX
			tempY = e.pageY
			}	
			if(flag==true)
			{
				var val=moveDiv(tempX,tempY)
				document.currentX=tempX;
				document.currentY=tempY;
			}else
			{
				document.currentX=tempX;
				document.currentY=tempY;
			}
			return true
		}
		function deselectDiv(theObj)
		{
			document.clicked=false;
			theObj.style.cursor="auto";
			document.obj= "";
			document.currentX=0;
			document.currentY=0;
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
              <td height="20" colspan="2" valign="top"> Post image to insert </td>
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
				
				  <img id="imge" src="<?php 
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
		  		<div id="editor"  style="border:thin solid #FF0000; width:<? echo $size;?>px; height:<? echo $size;?>px; top:<? echo $top;?>px; left:<? echo $left;?>px; position:absolute; z-index:10000; background:#FFFF00; display:none;" onMouseDown="selectDiv(this,event);" onMouseUp="deselectDiv(this)" onMouseMove="moveIt(event)" ></div>
				</div>
				  <div>
				    <div  style="display:block; overflow:auto;">
				    <div  style="float:left; width:490px;">
					
					<input name="txtT" type="text" id="txtT" value="<? echo $top; ?>" />
				    <input name="txtL" type="text" id="txtL" value="<? echo $left; ?>" />
					<input name="txtH" type="text" id="txtH" value="<? echo $size; ?>" />
				    <input name="txtW" type="text" id="txtW" value="<? echo $size; ?>" />
				    <input name="galleryid" type="hidden" id="galleryid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>">
					<input name="postid" type="hidden" id="postid" value="<?php if($postid!=""){echo $postid;}?>">
</div>
                    </div>
				  </div>
				     </form></td>
  <tr>
                     <td width="390" height="42" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
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
