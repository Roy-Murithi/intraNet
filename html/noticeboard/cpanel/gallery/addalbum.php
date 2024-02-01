<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	$albumid=@$_GET["albumid"];
	if($albumid=="")
	{
		$albumid="default";
	}
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
if(@$_GET["albumid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `".$pref."album` where `albumid`='".@$_GET['albumid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."album` where `albumid`='".@$_GET["albumid"]."'");
		
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
			document.frmalbum.action="savealbum.php";
			document.frmalbum.submit();
		}
		function saveImg()
		{
			document.frmalbum.action="savealbum.php";
			document.frmalbum.submit();
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
<body >
<center>

<table width="659" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="2" valign="top"> <?php 
				  if(@$_GET['albumid']!="")
				  {
				   ?>Album editor 
				  <?php 
				  }else{
				  ?>
				  Add album
				  <? 
				  }
				  ?></td>
  <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td height="189" colspan="2" valign="middle" align="center">
				  <form name="frmalbum" action="" method="post" enctype="multipart/form-data" style="width:310px;; vertical-align:middle;">
				  <div style="vertical-align:middle; width:500px;" align="left"> 
<?php 
	if(@$_GET['albumid']!="")
	{
				  $pic="../../".$data[1];
				   ?>
				   
				  <input name="albumid" type="hidden" id="albumid" value="<?php echo $albumid; ?>">
				  <input name="index" type="hidden" id="index" value="<?php echo $index; ?>">
				  <div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Album name </div> 
				    <div  style="float:left; width:220px;">
				      <div align="left">
				        <input type="text" name="txtAlt" value="<?php if(@$data[1]!=""){echo @$data[1];}?>" />
			            </div>
				    </div>
				  </div>
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
				    <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Album name</div> 
				  <div  style="float:right; width:220px;"><input type="text" name="txtAlt" /></div></div>
				  <div  style="display:block; overflow:auto;"> <div style="float:left; width:80px;">Description</div> <div  style="float:right; width:220px;"><textarea name="txtDesc" style="width:220px;; height:50px;"></textarea></div></div>
				  <br /><br />
				 
				  <div style="vertical-align:middle" align="right">
				  <input type="button" value="Save" class="BTN" onClick="uploadImg()" />
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
			<input name="Button" type="button" class="BTN" value="  Cancel  " onClick="document.location='album.php?sessid=smetsysmocmas&index=$index;'" />
		</div>
	</td>
  </table>
</center>
</body>
