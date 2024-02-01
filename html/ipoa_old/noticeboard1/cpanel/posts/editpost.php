<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("../globalfunc.php");
$index=@$_GET["index"];

if(@$_GET["postid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `".$pref."post` where `postid`='".@$_GET['postid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."post` where `postid`='".@$_GET["postid"]."'");
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
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bold,italic,underline,strikethrough,|,tablecontrols,|,hr,removeformat,visualaid",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",

        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>
<script type="text/javascript">
        function ShowDialog() {
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&postid=<? echo @$_GET["postid"]; ?>","","dialogHeight:600;dialogWidth:750;center:yes");
			if(rtvalue!="cancel" && rtvalue!="" && rtvalue!="null" && rtvalue!="reload")
			{
            	tinyMCE.activeEditor.execCommand('mceInsertContent', false, rtvalue);
			}else if(rtvalue=="reload")
			{
            	document.location="editpost.php?sessid=smetsysmocmas&postid=<? echo @$_GET["postid"];?>&index=<? echo @$_GET["index"];?>";
			}
        }
		function ShowDialog1() {
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&postid=<? echo @$_GET["postid"]; ?>&actions=featured","","dialogHeight:600;dialogWidth:750;center:yes");
			document.location="editpost.php?sessid=smetsysmocmas&postid=<? echo @$_GET["postid"];?>&index=<? echo @$_GET["index"];?>";
        }
    </script>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<table width="758" class="Black_Header_Text">
	      <!--DWLayoutTable-->
	      <tr>
	        <td width="1" height="2" ></td>
            <td width="629" rowspan="2" valign="top" ><strong>Edit Post </strong></td>
  <td width="1" rowspan="12" valign="top" class="VerticalRuler" ><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td width="94" ></td>
  <td width="1"></td>
          <tr>
            <td height="21" ></td>
            <td valign="top" >Post options </td>
            <td></td>
  <tr>
              <td height="15"></td>
              <td rowspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
              <td ></td>
              <td></td>
  <tr>
    <td height="4"></td>
    <td rowspan="2" valign="top" ><input name="Submit" type="submit" class="BTN" value="<?php if(@$data[1]!=""){echo "Update post";}else{echo "Publish post";}?>" onclick="document.frmPost.submit();" style="width:80px;" /></td>
              <td></td>
  <tr>
    <td   colspan="2" rowspan="8" valign="top">
	  <form name="frmPost" method="post" action="savepost.php" enctype="multipart/form-data" style="height:457px;">
	  	<table><tr><td>Title</td>
	  	<td><input name="txtTitle" type="text" style="width:500px;" value="<?php if(@$data[1]!=""){echo @$data[1];}?>" /></td><td></td></tr>
		  <td>Image Library </td>
	  	    <td><input name="Button" type="button" class="BTN" value="Open" onClick="ShowDialog()" /></td><td></td></tr>
		</table>
	    <textarea name="content" style="width:591px; height:100%"><?php if(@$data[2]!=""){echo @$data[2];}?></textarea>
		<input name="template" type="hidden" value="<?php if(@$data[4]==""){echo "pt_template1.php";}else{echo @$data[4];}?>" />
		<input name="postid" type="hidden" value="<?php if(@$data[0]!=""){echo @$data[0];}?>" />
    </form></td>
    <td height="18"></td>
  <tr>
    <td height="15" ></td>
    <td></td>
  <tr>
    <td height="19" valign="top" >Featured Image </td>
    <td></td>
  <tr>
    <td height="104"  style="border:thin solid #AAAAAA; height:104px; width:104px;" align="center" valign="middle">
		<?php
	if(is_file("../../".@$data[6])!="")
	{
	?>
	<img src="<?php 
				if(is_file("../../".$data[6]))
				{
		  			echo "../../".$data[6];
				}
				else
				{
					echo "";
				}
				$pic="../../".$data[6];
		  ?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,100); ?>" width="<?php echo  getPicW($pic,100); ?>"/>
	
	<?
	}else
	{
		if(@$data[0]!="")
		{
			echo "<input type=\"button\" value=\"Set featured image\" class=\"BTN\" onClick=\"ShowDialog1()\">";
		}else
		{
			echo "<div style=\"width:1px;height:1px;\"></div>";
		}
	}
	?>	</td>
    <td></td>
  <tr>
    <td height="1" ></td>
    <td></td>
  <tr>
    <td height="20" valign="top" >Template</td>
    <td></td>
  <tr>
    <td height="88" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td></td>
  <tr>
    <td height="238" >&nbsp;</td>
    <td></td>
</table>
