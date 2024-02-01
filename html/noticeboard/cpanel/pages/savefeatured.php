<?php
include "conn.php";
$galleryid=@$_POST["galleryid"];
$pageid=@$_POST["pageid"];
$datH=(int)@$_POST["txtH"];
$datW=(int)@$_POST["txtW"];
$datL=(int)@$_POST["txtL"];
$datT=(int)@$_POST["txtT"];

include ("globalfunc.php");


if($galleryid!="" && $galleryid!="undefined" && $galleryid!=NULL && $pageid!="" && $pageid!="undefined" && $pageid!=NULL )
{
		$imgFile="";
		$rs=@mysql_query("select * from `".$pref."gallery` where `galleryid`='$galleryid'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
				if(is_file("../../$data[1]")!="")
				{
					$imgFile="../../$data[1]";					
				}
			}
		}
		
	if($imgFile!="")
	{
		$rs=@mysql_query("select * from `".$pref."page` where `pageid`='$pageid'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
				if(is_file("../../$data[6]")!="")
				{
					chmod("../../$data[6]",0775);
					unlink("../../$data[6]");
				}
					//generate thumbnail of size 200 by 200
					if((int)$datH>0 && (int)$datW>0 )	
					{
						$dst_img=imagecreate(200,200);
						$src_img="";
						if(strtolower(substr($imgFile,strlen($imgFile)-4,4))==".jpg")
						{							
							$src_img=imagecreatefromjpeg($imgFile);
						}elseif(strtolower(substr($imgFile,strlen($imgFile)-4,4))==".png")
						{
							$src_img=imagecreatefrompng($imgFile);
						}
						imagecopyresampled( $dst_img,$src_img,0,0,$datL,$datT,200,200,$datW,$datH);
						if(is_dir("../../gallery/thumb")=="")
						{
							mkdir("../../gallery/thumb",0775);
						}
						
						if(strtolower(substr($imgFile,strlen($imgFile)-4,4))==".jpg")
						{
							imagejpeg($dst_img, "../../gallery/thumb/$data[0]_thumb.jpg" );
							$query="update `".$pref."page` set `thumbnail`='gallery/thumb/$data[0]_thumb.jpg' where `pageid`='$pageid'";
						}elseif(strtolower(substr($imgFile,strlen($imgFile)-4,4))==".png")
						{
							imagepng($dst_img, "../../gallery/thumb/$data[0]_thumb.png" );
							$query="update `".$pref."page` set `thumbnail`='gallery/thumb/$data[0]_thumb.png' where `pageid`='$pageid'";
						}
						
						mysql_query($query);
						imagedestroy($dst_img);
						imagedestroy($src_img);
						
					}else
					{
						$error="Invalid selection";
					}				
				
			}
		}
	}
}
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
<?
if(@$error!="")
{
	echo "alert(\"$error\");";
}else
{
	echo "alert(\"Thumbnails have been saved\");";
}?>
	window.returnValue ="reload";
    window.close()
</script>
</html>
