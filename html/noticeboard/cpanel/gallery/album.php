<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	$imagesC=date("Ymd").date('His');
	$album=@$_GET["album"];
	if($album=="")
	{
		$album="default";
	}
	include "conn.php";
	include ("globalfunc.php");
$index=@$_GET["index"];
$pageid=@$_GET["pageid"];
if(@$_GET["albumid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from `".$pref."gallery` where `album`='".@$_GET["albumid"]."'");		
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{ 
					$data=mysql_fetch_array($rs);
					if(is_file("../../".$data[1])!="")
					{
						
						chmod("../../".$data[1],0777);
						if(unlink("../../".$data[1]))
						{
							$rsd=@mysql_query("delete from `".$pref."gallery` where `galleryid`='$data[0]' order by `index` desc");
							
						}
												
					}	
					
				}	
						
				
			}
		}
		$rs=@mysql_query("delete from `".$pref."album` where `albumid`='".@$_GET['albumid']."'  order by `index` desc");
		
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
					retVal="<?php echo "<img src=\'../../".@$data[1]."\' height=\'document.frmalbum.txtH.value\' width=\'document.frmalbum.txtW.value\' alt=\'".@$data[2]."\'/>";?>";
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

<table width="755" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="20" colspan="2" valign="top"> Album </td>
              <td valign="top"><div align="right"><a href="addalbum.php?sessid=smetsysmocmas&album=<?php echo $album; ?>">Add new album </a></div></td>
    <tr>
                <td height="20" colspan="3" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <tr>
                  <td height="182" colspan="3" align="left" valign="top">

		            <?php
					function getImgCount($pref,$album)
					{
						$acount=0;
						$rsg=mysql_query("select * from ".$pref."gallery where album='$album' and category='gallery'  order by `index` desc");
						if($rsg)
						{
							$acount=mysql_num_rows($rsg);
						}
						return $acount;
					}
					function getImgs($pref,$album)
					{
						$acount=0;
						$pic="";
						$rsg=mysql_query("select * from ".$pref."gallery where album='$album' and category='gallery'  order by `index` desc");
						if($rsg)
						{
							$acount=mysql_num_rows($rsg);
							if($acount>0)
							{
								$idata=mysql_fetch_array($rsg);
								$pic="../../$idata[1]";
							}
						}
						if($pic!="")
						{
							$divs="
							<div style=\"\"><img src=\"$pic\" style=\"margin:2px;float:left;\" height=\"". getPicH($pic,80)."\" width=\"". getPicW($pic,80)."\"></div>
							";
						}else
						{
							$divs="";
						}
						return $divs;
					}
					/*$imgCounts=getImgCount($pref,"default");
					$coverimg=getImgs($pref,"default");
					
					$pic="../../images/album.png";
					//$coverimg="<img src=\"../../images/album.png\" height=\"". getPicH($pic,140)."\" width=\"". getPicW($pic,140)."\">";
					echo "
					
					<div class=\"loader\" align=\"left\" style=\"width:142px;height:175px;float:left;display:block;\" onClick=\"getPage('gallery.php','','albumid=default')\">
						<div style=\"width:140px; height:140px;float:left; vertical-align:middle;background-image:url(../../images/album.png); background-position:top left; background-repeat:no-repeat;position:relative;\" align=\"center\" >
							<div style=\"width:80px; height:80px;position:absolute;top:30px;left:20px;\" align=\"center\" >
							$coverimg
							</div>
						</div>
						<div style=\"width:140px;float:left;\" align=\"center\">
							<font style=\"font-size:10px;\">Default album <br/ >$imgCounts Pictures</font>						
						</div>
					</div><div style=\"width:5px;height:160px;float:left;display:block;\"></div>
					
					";*/
					
				   $where="";
				   $First="First";
				   $Previous="Previous";
				   $Next="Next";
				   $Last="Last";
				   $limit="";
				   $counts="0";
				  

		$rs=@mysql_query("select * from `".$pref."album`  order by `index` desc, `title` asc");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=14;
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
					$First="<a href=\"#\" onclick=\"getPage('album.php','content','index=0&pageid=$pageid')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('album.php','content','index=$prev&pageid=$pageid')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('album.php','content','index=$Las&staffids='+document.staffids)\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('album.php','content','index=$nex&pageid=$pageid')\">Next</a>";
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
					if($data[0]!="ALBM-000")
					{
					$pic="../../$data[1]";
					$editors="[<a href=\"addalbum.php?albumid=$data[0]&index=$index&sessid=smetsysmocmas\">Edit</a> | <a href=\"#\" onClick=\"if(confirm('This action will delete all pictures in the album, do you want to continue?')==true){document.location='album.php?albumid=$data[0]&index=$index&del=99&sessid=smetsysmocmas';}\">Delete</a>]";
					}else
					{
						$editors="";
					}
					$imgCounts=getImgCount($pref,$data[0]);
					$coverimg=getImgs($pref,$data[0]);
					echo "
					
					<div class=\"loader\" align=\"left\" style=\"width:142px;height:175px;float:left;display:block;\">
						<div onClick=\"getPage('gallery.php','','albumid=$data[0]') \" style=\"width:140px; height:140px;float:left; vertical-align:middle;background-image:url(../../images/album.png); background-position:top left; background-repeat:no-repeat;position:relative;\" align=\"center\" >
							<div style=\"width:80px; height:80px;position:absolute;top:30px;left:20px;\" align=\"center\" >
							$coverimg 
							</div>
						</div>
						<div style=\"width:140px;float:left;\" align=\"center\">
							<font style=\"font-size:10px;\">$data[1] <br/ >$imgCounts Pictures $editors</font>
						</div>
					</div><div style=\"width:5px;height:160px;float:left;display:block;\"></div>
					
					";
					
				}
			}
		}
	?>				  </td> 
    <tr>
                      <td width="400" height="28" valign="top" style=""><div align="right">Albums <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
                      </div>                        
                        </div></td>
                      <td colspan="2" valign="top"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
    <tr>
    <td height="1" style=""></td>
    <td width="15"></td>
    <td width="318"></td>
    </table>
</center>
</body>
