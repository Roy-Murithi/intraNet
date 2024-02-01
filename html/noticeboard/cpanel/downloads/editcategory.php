<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("../globalfunc.php");
$index=@$_GET["index"];

if(@$_GET["downloadcatid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `downloadcat` where `downloadcatid`='".@$_GET['downloadcatid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `downloadcat` where `downloadcatid`='".@$_GET["downloadcatid"]."'");
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
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&downloadcatid=<? echo @$_GET["downloadcatid"]; ?>","","dialogHeight:600;dialogWidth:750;center:yes");
			if(rtvalue!="cancel" && rtvalue!="" && rtvalue!="null" && rtvalue!="reload")
			{
            	tinyMCE.activeEditor.execCommand('mceInsertContent', false, rtvalue);
			}else if(rtvalue=="reload")
			{
            	document.location="editpage.php?sessid=smetsysmocmas&downloadcatid=<? echo @$_GET["downloadcatid"];?>&index=<? echo @$_GET["index"];?>";
			}
        }
		function ShowDialog1() {
            var rtvalue = window.showModalDialog("listimages.php?sessid=smetsysmocmas&downloadcatid=<? echo @$_GET["downloadcatid"]; ?>&actions=featured","","dialogHeight:600;dialogWidth:750;center:yes");
			document.location="editpage.php?sessid=smetsysmocmas&downloadcatid=<? echo @$_GET["downloadcatid"];?>&index=<? echo @$_GET["index"];?>";
        }
    </script>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<table width="754" class="Black_Header_Text">
	      <!--DWLayoutTable-->
	      <tr>
	        <td width="1" height="3" ></td>
            <td colspan="2" rowspan="2" valign="top" ><strong>Edit Page </strong></td>
            <td width="1" rowspan="5" valign="top" class="VerticalRuler" ><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td width="108" ></td>
  <td width="1"></td>
          <tr>
            <td height="20" ></td>
            <td valign="top" >Featured Image </td>
            <td></td>
  <tr>
              <td height="21"></td>
              <td colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
              <td rowspan="2" align="center" valign="middle"  style="border:thin solid #AAAAAA; height:104px; width:104px;" >
		<?php
	if(is_file("../../".@$data[3])!="")
	{
	?>
	    <img src="<?php 
				if(is_file("../../".$data[3]))
				{
		  			echo "../../".$data[3];
				}
				else
				{
					echo "";
				}
				$pic="../../".$data[3];
		  ?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,100); ?>" width="<?php echo  getPicW($pic,100); ?>"/>
	
	    <?
	}
	?>	</td>
  <td></td>
  <tr>
    <td   colspan="3" rowspan="2" valign="top">
	  <form name="frmpage" method="post" action="savecategory.php" enctype="multipart/form-data">
	  	<table class="Black_Header_Text">
	  	  <!--DWLayoutTable-->
		<tr><td width="90">Category Name</td><td><input name="txtTitle" type="text" style="width:500px;" value="<?php if(@$data[1]!=""){echo @$data[1];}?>" /><input type="hidden" name="downloadcatid" value="<?php if(@$data[0]!=""){echo @$data[0];}?>" /></td><td width="4"></td></tr>
		  <tr><td>Featured image </td><td>
		    <input name="imggallery" type="file" id="imggallery" />
		  </td><td></td></tr>
		  <tr><td height="20" valign="top">Details </td>
		  <td rowspan="2"><textarea name="txtDetails"><?php if(@$data[2]!=""){echo @$data[2];}?></textarea></td><td></td></tr>
		  <tr>
		    <td height="102">&nbsp;</td>
		    <td></td>
	      </tr>
		</table>

		<input name="downloadcatid" type="hidden" value="<?php if(@$data[0]!=""){echo @$data[0];}?>" />
        </form></td>
    <td height="81"></td>
  <tr>
	                <td height="126" >&nbsp;</td>
	                <td></td>
  <tr>
    <td height="25"></td>
    <td width="506"></td>
    <td width="102" valign="top"><input name="Submit" type="submit" class="BTN" value="<?php if(@$data[1]!=""){echo "Update category";}else{echo "Save category";}?>" onclick="document.frmpage.submit();" style="width:100px;" />      &nbsp;</td>
    <td ></td>
    <td ></td>
    <td></td>
  </table>
