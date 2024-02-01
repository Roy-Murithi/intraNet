<?php
	include "conn.php";
	include ("globalfunc.php");
	$txtSearch=str_replace("'","\'",@$_POST['txtSearch']);
$index=@$_GET["index"];
$downloadcatid=@$_GET["downloadcatid"];
		$rs=@mysql_query("select * from `downloadcat` where downloadcatid='$downloadcatid' order by `name` ASC");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datac=mysql_fetch_array($rs);
			}
		}

?>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="scripts/counterajax.js"></script>

<link href="css/newstyle.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>
<style>
.blk{
background:#FFFFFF;
}
div.blk:hover {
background:#EEFFEE;
}
</style>
<table width="752" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="23" colspan="2" valign="top"><a href="downloads.php">All downloads </a></td>
              <td width="1">&nbsp;</td>
              <td colspan="3" valign="top"><? if($datac[1]!=""){echo"About $datac[1] downloads";}else{echo "No category selected";} ?> </td>
  <tr>
                <td height="88" colspan="2" valign="top">
				<?
				if(is_file("".@$datac[3])!="")
	{
	?>
	            <img src="<?php 
				if(is_file("".$datac[3]))
				{
		  			echo "".$datac[3];
				}
				else
				{
					echo "";
				}
				$pic="".$datac[3];
		  ?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,88); ?>" width="<?php echo  getPicW($pic,88); ?>"/>
	
	            <?
	}
				
				?>				</td>
                <td>&nbsp;</td>
                <td colspan="3" valign="top"><? if($datac[2]!=""){echo"$datac[2] ";}else{echo "No category selected";} ?></td>
  <tr>
    <td height="20" colspan="6" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td width="1" height="27"></td>
    <td width="79"></td>
    <td></td>
    <td colspan="3" valign="top"><div align="right"> <form name="frmSearch" enctype="multipart/form-data" method="post" style="width:450px;">Search: <input type="text" class="STR1" name="txtSearch" value="<?php echo @$_POST['txtSearch'];?>" style="width:300px" /><input type="submit" name="btnSearch" class="BTN" value="Search"  /></form>
    </div></td>
  <tr>
    <td height="20" colspan="6" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="149">&nbsp;</td>
    <td colspan="5" valign="top" class="Black_Header_Text">
      <?php
				   $where="";
				   $First="";
				   $Previous="";
				   $Next="";
				   $Last="";
				   $limit="0";
				   $counts="0";
	
					   if($txtSearch!="")
					   {
						$where=" and `name` like '%".$txtSearch."%'";
					   }else
					   {
						$where="";
					   }
		$rs=@mysql_query("select * from `".$pref."downloads` where `category`='$downloadcatid'  $where order by `order` DESC");

		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=5;
				$max=$maxi;
				if($index>$counts)
				{
					$offset=0;
				}
				else
				{
					$offset=$index;
				}
				if($offset+$max>$counts-1)
				{
					$max=($counts)-$offset;
				}
				if($offset>0)
				{
					$First="<a href=\"#\" onclick=\"getPage('spec_downloads.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('spec_downloads.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('spec_downloads.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('spec_downloads.php','content','index=$nex')\">Next</a>";
				}else
				{
					$Last="Last";
					$Next="Next";
				}
				if($offset+$max>$counts)
				{
					$limit=$counts-1;
				}else
				{
					$limit=$offset+$max;
				}
				
				for($x=$offset;$x<$limit;$x++)
				{	@mysql_data_seek($rs,$x);
					$data=@mysql_fetch_array($rs);
					
					$file=str_replace("downloads/","",$data[4]);
					$file=str_replace($data[0],"",$file);
					echo "
					<div style=\"width:742px;float:left;margin-top:10px;border-bottom:thin dotted;\" class=\"blk\">
					<div style=\"width:742px;\">
						<div  style=\" width:20px; margin-bottom:10px; float:left\" >".($x+1).".</div>
						<div  style=\" width:120px; margin-bottom:10px; float:left\" >
						";
						if(strtolower(substr($data[4],strlen($data[4])-4,4))==".xls" || strtolower(substr($data[4],strlen($data[4])-5,5))==".xlsx")
						{
							$pic="images/xls.png";
						}elseif(strtolower(substr($data[4],strlen($data[4])-4,4))==".doc" || strtolower(substr($data[4],strlen($data[4])-5,5))==".docx" )
						{
							$pic="images/docx.png";
						}elseif(strtolower(substr($data[4],strlen($data[4])-4,4))==".pub" || strtolower(substr($data[4],strlen($data[4])-5,5))==".pubx" )
						{
							$pic="images/pub.png";
						}elseif(strtolower(substr($data[4],strlen($data[4])-4,4))==".ppt" || strtolower(substr($data[4],strlen($data[4])-5,5))==".pptx" )
						{
							$pic="images/ppt.png";
						}elseif(strtolower(substr($data[4],strlen($data[4])-4,4))==".pdf")
						{
							$pic="images/pdf.png";
						}else
						{
							$pic="images/others.png";
						}
						
						if(is_file($pic)!="")
						{
						?>
							<img src="<?php echo $pic;?>" border="1" style="border-color:B2D1B2"  height="<?php echo  getPicH($pic,100); ?>" width="<?php echo  getPicW($pic,100); ?>"/>						
	<?
						}
 echo "
						</div>
						<div style=\" width:542px;float:left;\">				  		
							<div  style=\" width:542px; margin-bottom:3px; float:left\" >Title: $data[1]</div>
							<div  style=\" width:542px; margin-bottom:3px; float:left\" >Details: $data[3]</div>				  		
							<div  style=\" width:542px; margin-bottom:3px; float:left\" >Upload date: $data[5]</div>
							<div  style=\" width:542px;height:10px; margin-bottom:3px; float:left\" > </div>
							<div  style=\" width:542px; margin-bottom:3px; float:left\" ><a href=\"$data[4]\" target=\"_blank\">Click here to Download</a></div>
						</div>	
					</div>			  
				  	</div>
					";
				}
			}
		}
	?>				  </td>
  <tr>
    <td height="28" colspan="4" valign="top"><a href="downloads.php">Back to all download </a></td>
    <td width="246" valign="top"><div align="right" >Downloads <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
    </div></td>
  <td width="319" valign="top" ><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td width="70"></td>
    <td></td>
    <td ></td>
  </table>
