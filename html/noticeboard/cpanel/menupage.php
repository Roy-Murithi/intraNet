<?php
include "conn.php";
$txtSearch=str_replace("'","\'",@$_POST['txtSearch']);
if($txtSearch=="")
{
	$txtSearch=str_replace("'","\'",@$_GET['txtSearch']);
}
$index=@$_GET["index"];
if($_GET['validauth']!="99")
{
	header("location:nopage.php",false);
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Page</title>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	function addMenu(id)
	{
		if(window.parent)
		{	
			var strData=window.parent.document.frmMenu.txtDat1a.value;
			var chkbx=document.getElementById(id);
			if(chkbx.checked==true)
			{	
				if(strData.indexOf("!~~!"+ id +"!~~!")>=0 )	
				{
					
				}else{
				strData=strData+"!~~!"+ id +"!~~!";
				}		
			}else
			{
				if(strData.indexOf("!~~!"+ id +"!~~!")>=0 )	
				{
					strData=strData.replace("!~~!"+ id +"!~~!","");
				}
			}
			window.parent.document.frmMenu.txtDat1a.value=strData;
			strData="";
		}
	}
</script>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style15 {font-size: 9px}
-->
</style>
</head>

<body style="" class="Black_Header_Text">
<br  />
Pages
<br  /><br  />
<?php
/*	$rs=@mysql_query("select * from `".$pref."page` order by `others` desc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=@mysql_fetch_array($rs);
					echo "<div style=\"width:260px; float:left;background-color:#DDDDFF; border:#FFFFFF thin solid; \"><input type=\"checkbox\" name=\"$data[0]\" id=\"$data[0]\" value=\"$data[0]\" onclick=\"addMenu('$data[0]')\" />$data[1]</div>";
				}
			}
		}*/
	?>
	
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
						$where="where `title` like '%".$txtSearch."%'";
					   }else
					   {
						$where="";
					   }
		$rs=@mysql_query("select * from `".$pref."page` $where order by `others` desc");

		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=7;
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
					$First="<a href=\"#\" onclick=\"getPage('menupage.php','content','index=0&txtSearch=$txtSearch&validauth=99')\"><<</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('menupage.php','content','index=$prev&txtSearch=$txtSearch&validauth=99')\"><</a>";
				}else
				{
					$First="<<";
					$Previous="<";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('menupage.php','content','index=$Las&txtSearch=$txtSearch&validauth=99')\">>></a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('menupage.php','content','index=$nex&txtSearch=$txtSearch&validauth=99')\">></a>";
				}else
				{
					$Last=">>";
					$Next=">";
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
					echo "<div style=\"width:260px; float:left;background-color:#DDDDFF; border:#FFFFFF thin solid; \"><input type=\"checkbox\" name=\"$data[0]\" id=\"$data[0]\" value=\"$data[0]\" onclick=\"addMenu('$data[0]')\" />$data[1]</div>";
				}
			}
		}
	?>	
	
&nbsp;
<div></div>
<table width="275" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->
  <tr>
    <td width="98" height="20" valign="top"><div align="right" class="style15">pages
        <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
    </div></td>
    <td width="177" valign="top"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  </tr>
</table>
</body>
</html>
