<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("../globalfunc.php");
$index=@$_GET["index"];
$downloadcatid=@$_GET["downloadcatid"];
if(@$_GET["downloadsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `".$pref."downloads` where `downloadsid`='".@$_GET['downloadsid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."downloads` where `downloadsid`='".@$_GET["downloadsid"]."'");
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
        function ShowDialog() {
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&downloadsid=<? echo @$_GET["downloadsid"]; ?>","","dialogHeight:600;dialogWidth:750;center:yes");
			if(rtvalue!="cancel" && rtvalue!="" && rtvalue!="null" && rtvalue!="reload")
			{
            	tinyMCE.activeEditor.execCommand('mceInsertContent', false, rtvalue);
			}else if(rtvalue=="reload")
			{
            	document.location="editpage.php?sessid=smetsysmocmas&downloadsid=<? echo @$_GET["downloadsid"];?>&index=<? echo @$_GET["index"];?>";
			}
        }
		function ShowDialog1() {
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&downloadsid=<? echo @$_GET["downloadsid"]; ?>&actions=featured","","dialogHeight:600;dialogWidth:750;center:yes");
			document.location="editpage.php?sessid=smetsysmocmas&downloadsid=<? echo @$_GET["downloadsid"];?>&index=<? echo @$_GET["index"];?>";
        }
    </script>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<table width="645" class="Black_Header_Text">
	      <!--DWLayoutTable-->
	      <tr>
	        <td width="1" height="25" ></td>
            <td colspan="3" valign="top" ><strong>Edit upload </strong></td>
            <td width="5" >&nbsp;</td>
  <tr>
              <td height="21"></td>
              <td colspan="3" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
              <td >&nbsp;</td>
  <tr>
    <td height="232"   colspan="4" valign="top">
	  <form name="frmpage" method="post" action="savedownloads.php" enctype="multipart/form-data">
	  	<table class="Black_Header_Text" style="width:500px;">
	  	  <!--DWLayoutTable-->
		<tr>
		  <td width="80" height="25" valign="top">Upload Name</td>
		  <td colspan="2" valign="top"><input name="txtTitle" type="text" style="width:300px;" value="<?php if(@$data[1]!=""){echo @$data[1];}?>" />		    <input type="hidden" name="downloadsid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>" /></td>
		  </tr>
		<tr>
		  <td height="26" valign="top">File</td>
		    <td width="227" valign="top">
		      <input name="imggallery" type="file" id="imggallery" /></td>
		    <td width="171" valign="top"><?php 
			if(@$data[4] !="")
			{
				$file=str_replace("downloads/","",$data[4]);
				$file=str_replace($data[0],"",$file);
				echo $file;
			}					
			?></td>
	      </tr>
		  
		  <tr>
		    <td height="20" valign="top">Details </td>
		  <td colspan="2" rowspan="2" valign="top"><textarea name="txtDetails"><?php if(@$data[2]!=""){echo @$data[2];}?>
		    </textarea>
		      <input name="downloadcatid" type="hidden" id="downloadcatid" value="<?php if(@$downloadcatid!=""){echo @$downloadcatid;}?>" /></td>
	      </tr>
		  <tr>
		    <td height="103"></td>
          </tr>
		  <tr>
		    <td height="17"></td>
		    <td></td>
		    <td></td>
	      </tr>
		</table>

		<input name="downloadsid" type="hidden" value="<?php if(@$data[0]!=""){echo @$data[0];}?>" />
      </form></td>
    <td >&nbsp;</td>
  <tr>
    <td height="42"></td>
    <td width="352">&nbsp;</td>
    <td width="138" valign="top"><input name="Submit" type="submit" class="BTN" value="<?php if(@$data[1]!=""){echo "Update upload";}else{echo "Upload file";}?>" onclick="document.frmpage.submit();" style="width:100px;" />      &nbsp;</td>
    <td width="118">&nbsp;</td>
    <td ></td>
  </table>
