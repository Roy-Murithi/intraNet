<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
if(@$_GET["sliderid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `".$pref."slider` where `sliderid`='".@$_GET['sliderid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."slider` where `sliderid`='".@$_GET["sliderid"]."'");
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
        function CloseDialog(flag) {
			if(flag==1)
			{
				retVal="ok";
			}else
			{
				retVal="cancel";
			}
            window.returnValue =retVal;
            window.close()
        }
		function uploadImg()
		{
			document.frmSlider.action="saveslider.php";
			document.frmSlider.submit();
		}
		function saveImg()
		{
			document.frmSlider.action="saveimg.php";
			document.frmSlider.submit();
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
			document.frmSlider.h1.value=getValfromPX(div2.style.left);
			document.frmSlider.w1.value=getValfromPX(div2.style.top);
		}
		function drag()
		{
			if(document.dragging==1)
			{
				ev = window.event || event;
				document.frmSlider.h2.value=ev.pageX;
				document.frmSlider.w2.value=ev.pageY;
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
				  if(@$_GET['sliderid']!="")
				  {
				   ?>
				  Slider image Editor 
				  <?php 
				  }else{
				  ?>
				  Slider image uploader (<font color="#FF0000">Image recomended dimensions Height=248, Width=711</font>)
				  <? 
				  }
				  ?></td>
  <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td height="189" colspan="2" valign="middle" align="center">
				  <form name="frmSlider" action="" method="post" enctype="multipart/form-data" style="width:310px;; vertical-align:middle;">
				  <div style="vertical-align:middle; width:500px;" align="left"> 
<?php 
	if(@$_GET['sliderid']!="")
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
				    <input name="sliderid" type="hidden" id="sliderid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>">
				  </div></div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Description</div> <div  style="float:left; width:220px;"><textarea name="txtDesc" style="width:220px;; height:50px;"><?php if(@$data[3]!=""){echo @$data[3];}?></textarea></div></div>
				  <br /><br />
				   
				  <div style="vertical-align:middle" align="right">
				  <input type="button" value="Save" class="BTN" onClick="saveImg()" />
				  </div>
				  </div>
				  <?php 
	}else{
				  ?>
				  
				  <div style="vertical-align:middle; width:310px;" align="left">
				  <div style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Slider Image</div> <div  style="float:right; width:220px;"><input type="file" name="imgSlider" /> </div> </div>
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
	<?php 
				  if(@$_GET['sliderid']!="")
				  {
				   ?>
				  <div align="right">
					<input name="Button" type="button" class="BTN" value="    Ok    " onClick="CloseDialog(1)" />
				</div>
				  <?php 
				  }else{
				  ?>
				  <div align="right">
					<input name="Button" type="button" class="BTN" value="  Cancel  " onClick="CloseDialog(0)" />
				</div>
				  <? 
				  }
				  ?>
	</td>
  </table>
</center>
</body>
