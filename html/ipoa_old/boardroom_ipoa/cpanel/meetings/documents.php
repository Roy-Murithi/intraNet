<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from meetings where `meetingsid`='".@$_GET['meetingsid']."'");
		
	}
	$meetingsid=@$_GET['meetingsid'];
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="savemeetings.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="784" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="784" height="32" valign="top" style="">Meeting Documents for 
      <?php
	$dbase="meetings";
	$unique="meetingsid";
	$unique_value=$meetingsid;
	$field="name";
	echo fetchValue($dbase,$unique,$unique_value,$field);
	?></td>
    </tr>
  
  <tr>
    <td height="11" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="38" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="57" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="724" valign="top" style=""><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>

	    
	    <?php
		$rs=@mysql_query("select * from files where `meetingsid`='$meetingsid' order by `zorder` desc");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				
				for($x=0;$x<$counts;$x++)
				{
					
					$data=@mysql_fetch_array($rs);
					
					$file=$data[3];
					//$file=str_replace($data[0],"",$file);
					echo "
					<div style=\"width:742px;float:left;margin-top:10px;border-bottom:thin dotted;\" class=\"blk\">
					<div style=\"width:742px;\">
						<div  style=\" width:20px; margin-bottom:10px; float:left\" >".($x+1).".</div>
						<div  style=\" width:120px; margin-bottom:10px; float:left\" >
						";
						if(strtolower(substr($data[3],strlen($data[3])-4,4))==".xls" || strtolower(substr($data[3],strlen($data[3])-5,5))==".xlsx")
						{
							$pic="images/xls.png";
						}elseif(strtolower(substr($data[3],strlen($data[3])-4,4))==".doc" || strtolower(substr($data[3],strlen($data[3])-5,5))==".docx" )
						{
							$pic="images/docx.png";
						}elseif(strtolower(substr($data[3],strlen($data[3])-4,4))==".pub" || strtolower(substr($data[3],strlen($data[3])-5,5))==".pubx" )
						{
							$pic="images/pub.png";
						}elseif(strtolower(substr($data[3],strlen($data[3])-4,4))==".ppt" || strtolower(substr($data[3],strlen($data[3])-5,5))==".pptx" )
						{
							$pic="images/ppt.png";
						}elseif(strtolower(substr($data[3],strlen($data[3])-4,4))==".pdf")
						{
							$pic="images/pdf.png";
						}else
						{
							$pic="images/others.png";
						}
						$pic="../../".$pic;
						if(is_file($pic)!="")
						{
						?>
							<?php echo "<a href=\"../../$data[3]\" target=\"_blank\">";?><img src="<?php echo $pic;?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,100); ?>" width="<?php echo  getPicW($pic,100); ?>"/>	<?php echo "</a>";?>					
	<?
						}
 echo "
						</div>
						<div style=\" width:542px;float:left;\">				  		
							<div  style=\" width:542px; margin-bottom:3px; float:left\" ><span style=\"font-size:20px; color:#FF0000\">Reference Number: $data[2]</span></div>
							<div  style=\" width:542px; margin-bottom:3px; float:left\" >Details: $data[4]</div>				  		
							<div  style=\" width:542px; margin-bottom:3px; float:left\" >Upload date: $data[7]</div>
							<div  style=\" width:542px;height:10px; margin-bottom:3px; float:left\" > </div>
							<div  style=\" width:542px; margin-bottom:3px; float:left\" ><a href=\"../../$data[3]\" target=\"_blank\">Click here to Download</a></div>
							
						</div>	
					</div>			  
				  	</div>
					";
				}
			}
		}
		
	?>
      </table></td>
    </tr>
  <tr>
    <td height="27" valign="top"></td>
    </tr>
</table>
</form>

