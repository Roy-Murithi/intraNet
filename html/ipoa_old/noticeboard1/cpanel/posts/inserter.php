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

		function saveImg()
		{
			window.returnValue ="";
			<?php 
				
			$str="";
				if(is_file("../../".@$data[1])!="")
				{
					$str="<img src='../../$data[1]' height='\"+document.frmgallery.txtH.value+\"' width='\"+document.frmgallery.txtW.value+\"' alt='$data[2]'/>";
					
				}

			?>
			var strFloat="none";
			var strDiv="";
			var strDiv1="";
			if(document.frmgallery.chkWrap.checked==true)
			{
				if(document.frmgallery.opt[0].checked==true)
				{
					strFloat="float:left";
				}else if(document.frmgallery.opt[1].checked==true)
				{
					strFloat="";
				}else
				{
					strFloat="float:right";
				}
			}else
			{
				if(document.frmgallery.opt[0].checked==true)
				{
					strFloat="";
					strDiv="<div style=\"width:100%\" align=\"left\">";
					strDiv1="</div>";
				}else if(document.frmgallery.opt[1].checked==true)
				{
					strFloat="";
					strDiv="<div style=\"width:100%\" align=\"center\">";
					strDiv1="</div>";
				}else if(document.frmgallery.opt[2].checked==true)
				{
					strFloat="";
					strDiv="<div style=\"width:100%\" align=\"right\">";
					strDiv1="</div>";
				}else
				{
					strFloat="";
					strDiv="";
					strDiv1="";
				}
			}
			if(document.frmgallery.chkInclude.checked==true)
			{
				<?
				if($data[3]=="")
					{
						echo "window.returnValue=\"\"";
					}else
					{
						echo "window.returnValue=strDiv+\"<div style=\\\"width:\"+document.frmgallery.txtW.value+\"; border:thin solid #CCCCCC;\"+strFloat+\"; margin-left:10px;  margin-right:10px;\\\"><div>$str</div><div style=\\\"width:\"+document.frmgallery.txtW.value+\"; background: #CCCCCC; border:thin solid #CCCCCC;\\\" align=\\\"center\\\">$data[3]</div></div>\"+strDiv1";
					}
				?>
			}else
			{
				<?
					echo "window.returnValue=strDiv+\"$str\"+strDiv1";
				?>
			}
			window.close();
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
<body>
<center>

<table width="524" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="2" valign="top"> Post image to insert </td>
  <td width="1">&nbsp;</td>
    <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td>&nbsp;</td>
    <tr>
                  <td height="200" colspan="2" valign="middle" >
				    <form name="frmgallery" action="" method="post" enctype="multipart/form-data" style="width:210px;; vertical-align:middle;">
				  <input type="hidden" name="index" value="<?php echo @$index;?>" />
				  <div style="vertical-align:middle; width:500px;" align="left"> 
				   
				  <div style="display:block; overflow:auto;position:relative;width:310px;"> 
				<div id="editor"></div>
				  <img src="<?php 
				if(is_file("../../".$data[1]))
				{
		  			echo "../../".$data[1];
				}
				else
				{
					echo "";
				}
				$pic="../../".$data[1];
		  ?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,300); ?>" width="<?php echo  getPicW($pic,300); ?>"/>				  </div>
				  <div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px; margin-right:5px;">
				    <div align="right">Alt text:</div>
				  </div> <div  style="float:left; width:220px;"><input type="text" name="txtAlt" value="<?php if(@$data[2]!=""){echo @$data[2];}?>" />
				    <input name="galleryid" type="hidden" id="galleryid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>">
				  </div></div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px; margin-right:5px;">
				    <div align="right">Description: </div>
				  </div> <div  style="float:left; width:220px;"><textarea name="txtDesc" style="width:220px;; height:50px;"><?php if(@$data[3]!=""){echo @$data[3];}?></textarea></div></div>
				  <div  style="display:block; overflow:auto;">
				    <div  style="float:left; width:490px;"><input name="txtH" type="hidden" id="txtH" value="<? $pic="../../".@$data[1]; echo getPicH($pic,300); ?>">
				    <input name="txtW" type="hidden" id="txtW" value="<? echo getPicW($pic,300); ?>"> 
				    Include Caption 
				    <input name="chkInclude" type="checkbox" id="chkInclude" value="checkbox">
</div>



                    <div  style="float:left; width:490px;">
                      <input name="opt" type="radio" value="l">
                      Position left			        
                      <input name="opt" type="radio" value="m" checked>
Position middle 
<input name="opt" type="radio" value="r"> 
Position right
<input name="chkWrap" type="checkbox" id="chkWrap" value="checkbox">
                    Allow text to wrap </div>
				  </div>

				  <br /> 
				  <div style="vertical-align:middle" align="right">
				  <input type="button" value="Insert" class="BTN" onClick="saveImg()" />
				  </div>
				  </div>
				  </div>
				    </form></td>
  <td >&nbsp;</td>
    <tr>
    <td height="21" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td>&nbsp;</td>
    <tr>
    <td width="386" height="24">&nbsp;</td>
    <td width="118" valign="top">
		<div align="right">
			<input name="Button" type="button" class="BTN" value="  Cancel  " onClick="document.location='listimages.php?sessid=smetsysmocmas&index=$index;'" />
	  </div></td>
  <td>&nbsp;</td>
  </table>
</center>
</body>
