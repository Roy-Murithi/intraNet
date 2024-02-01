<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
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


<script type="text/javascript">		
		function uploadImg()
		{
			document.frmgallery.action="savegallery.php";
			document.frmgallery.submit();
		}
		function saveImg()
		{
			document.frmgallery.action="saveimg.php";
			document.frmgallery.submit();
		}
		document.dragging="0";
		function prepEditor()
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
		function getValfromPX(str)
		{
			return str.replace("px","")
		}
		function startSelect()
		{
			var div2= document.getElementById("editor");
			document.dragging=1;
			document.frmgallery.h1.value=getValfromPX(div2.style.left);
			document.frmgallery.w1.value=getValfromPX(div2.style.top);
		}
		function drag()
		{
			if(document.dragging==1)
			{
				ev = window.event || event;
				document.frmgallery.h2.value=ev.pageX;
				document.frmgallery.w2.value=ev.pageY;
			}
		}
		function stopSelect()
		{
			document.dragging="";
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
<body onLoad="prepEditor()">
<center>

<table width="659" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="2" valign="top"> <?php 
				  if(@$_GET['galleryid']!="")
				  {
				   ?> Page image Editor 
				  <?php 
				  }else{
				  ?>
				  Page image uploader 
				  <? 
				  }
				  ?></td>
  <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td height="189" colspan="2" valign="middle" align="center">
				  <form name="frmgallery" action="" method="post" enctype="multipart/form-data" style="width:310px;; vertical-align:middle;">
				  <input type="hidden" name="index" value="<?php echo @$index;?>" />
				  <div style="vertical-align:middle; width:500px;" align="left"> 
<?php 
	if(@$_GET['galleryid']!="")
	{
				  $pic="../../".$data[1];
				   ?>
				   
				  <div style="display:block; overflow:auto;position:relative;height:114.6px; width:310px;"> 
				<div id="editor" style="position:absolute;cursor:move;height:104.6px; width:300px; background:#000000; top:0px; left:0px; display:none" onMouseDown="startSelect()" onMouseUp="stopSelect()"  onmouseout="stopSelect()" onMouseMove="drag()"></div>
				  <img src="<?php 
				if(is_file("../../".$data[1]))
				{
		  			echo "../../".$data[1];
				}
				else
				{
					echo "";
				}
				
		  ?>" border="1" style="border-color:B2D1B2"  height="104.6" width="300"/>
				  </div>
				  <div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Alt text</div> <div  style="float:left; width:220px;"><input type="text" name="txtAlt" value="<?php if(@$data[2]!=""){echo @$data[2];}?>" />
				    <input name="galleryid" type="hidden" id="galleryid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>">
				  </div></div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Description</div> <div  style="float:left; width:220px;"><textarea name="txtDesc" style="width:220px;; height:50px;"><?php if(@$data[3]!=""){echo @$data[3];}?></textarea></div></div>
				  <br />
				  <br /> 
				  <div style="vertical-align:middle" align="right">
				  <input type="button" value="Save" class="BTN" onClick="saveImg()" />
				  </div>
				  </div>
				  <?php 
	}else{
				  ?>
				  
				  <div style="vertical-align:middle; width:310px;" align="left">
				  <div style="display:block; overflow:auto;"> <div style="float:left; width:80px;">page Image</div> 
				    <div  style="float:right; width:220px;"><input name="imggallery" type="file" id="imggallery" /> 
				    </div> </div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Alt text</div> <div  style="float:right; width:220px;"><input type="text" name="txtAlt" /></div></div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Description</div> <div  style="float:right; width:220px;"><textarea name="txtDesc" style="width:220px;; height:50px;"></textarea></div></div>
				  <br /><br />
				 
				  <div style="vertical-align:middle" align="right">
				  <input type="button" value="Upload" class="BTN" onClick="uploadImg()" />
				  </div>
				  <?php 
	}
				  ?>
				  </div>
				  </form>
				  </td>
  <tr>
    <td height="21" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td width="524" height="24">&nbsp;</td>
    <td width="119" valign="top">
		<div align="right">
			<input name="Button" type="button" class="BTN" value="  Cancel  " onClick="document.location='listimages.php?sessid=smetsysmocmas&index=$index;'" />
		</div>
	</td>
  </table>
</center>
</body>
