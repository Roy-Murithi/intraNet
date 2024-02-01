<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
$pageid=@$_GET["pageid"];
if(@$_GET["galleryid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from `".$pref."gallery` where `galleryid`='".@$_GET["galleryid"]."'");
		
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
				if(is_file("../../".$data[1])!="")
				{
					chmod("../../".$data[1],0777);
					@unlink("../../".$data[1]);
				}	
				$rs=@mysql_query("delete from `".$pref."gallery` where `galleryid`='".@$_GET['galleryid']."'");
				
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
				if(@$data[1]!="")
				{
					retVal="<?php echo "<img src=\'../../".@$data[1]."\' height=\'document.frmgallery.txtH.value\' width=\'document.frmgallery.txtW.value\' alt=\'".@$data[2]."\'/>";?>";
				}
			}else
			{
				retVal="cancel";
			}
            window.returnValue =retVal;
            window.close()
        }
		
    </script>

<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
.loader{
background:#FFFFFF;
}
div.loader:hover{
background:#EDF8ED;
cursor:pointer;
}
-->
</style>
<body onLoad="">
<center>

<table width="659" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="3" valign="top"> Page images </td>
              <td colspan="2" valign="top"><div align="right"><a href="uploader.php?sessid=smetsysmocmas">Upload new image </a></div></td>
    <tr>
                <td height="20" colspan="5" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td height="182" colspan="5" align="left" valign="top">

			       <?php
				   $where="";
				   $First="First";
				   $Previous="Previous";
				   $Next="Next";
				   $Last="Last";
				   $limit="";
				   $counts="0";
				  

		$rs=@mysql_query("select * from `".$pref."gallery` where `category`='page'");
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
					$First="<a href=\"#\" onclick=\"getPage('listimages.php','content','index=0&pageid=$pageid')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('listimages.php','content','index=$prev&pageid=$pageid')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('listimages.php','content','index=$Las&staffids='+document.staffids)\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('listimages.php','content','index=$nex&pageid=$pageid')\">Next</a>";
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
				
				
				
				for($x=(int)$offset;$x<$limit;$x++)
				{	@mysql_data_seek($rs,$x);
					$data=@mysql_fetch_array($rs);
					$pic="../../$data[1]";
					if(@$_GET['actions']!="featured")
					{
						$editors=" <a href=\"inserter.php?galleryid=$data[0]&pageid=$pageid&sessid=smetsysmocmas\">Insert into page</a> | <a href=\"uploader.php?galleryid=$data[0]&pageid=$pageid&sessid=smetsysmocmas\">Edit</a> | ";
					}else
					{
						$editors="";
					}
					if($pageid!="")
				{
					$fimage="<a href=\"featured.php?galleryid=$data[0]&sessid=smetsysmocmas&pageid=$pageid\">Use as featured image</a> | ";
				}else
				{
					$fimage="";
				}
					echo "
					<div align=\"left\" style=\"width:653px;height:10px;float:left;display:block;\"></div>
					<div class=\"loader\" align=\"left\" style=\"width:653px;height:70px;float:left;display:block;border-bottom:thin dotted;\" onClick=\"getPage('uploader.php','','galleryid=$data[0]')\">
						<div style=\"width:30px; float:left;\">
							".($x+1)."
						</div>
						<div style=\"width:60px; height:60px;float:left;\">
							<img src=\"../../$data[1]\" height=\"". getPicH($pic,50)."\" width=\"". getPicW($pic,50)."\">
						</div>
						<div style=\"width:200px;float:left;\">
							".str_replace("gallery/","",$data[1]) ."
						</div>
						<div style=\"width:350px;float:left;\" align=\"right\">
							$fimage $editors<a href=\"listimages.php?del=99&galleryid=$data[0]&pageid=$pageid&sessid=smetsysmocmas\">Delete</a>
						</div>
					</div>
					
					";
					
				}
			}
		}
	?>				  </td>
  <tr>
                      <td width="313" height="28" valign="top"><div align="right">Staff 
                        <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
                        </div>
      </div></td>
                      <td width="50">&nbsp;</td>
                      <td colspan="3" valign="top"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="61">&nbsp;</td>
    <td width="77">&nbsp;</td>
    <td width="125" valign="top">

				  <div align="right">
					<input name="Button" type="button" class="BTN" value="   Close   " onClick="CloseDialog(0)" />
				</div>	</td>
  </table>
</center>
</body>
