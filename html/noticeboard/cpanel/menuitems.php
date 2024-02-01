<?php
include "conn.php";
$category=@$_GET['category'];
$lvl=@$_GET['level'];
$parentm=@$_GET['parentm'];
$parent=@$_GET['parent'];
$menuid=@$_GET['menuid'];
$del=@$_GET['del'];
$mnuid=@$_GET['mnuid'];
if($del=='99')
{
	$query="delete from ".$pref."menu where `mnuid`='$mnuid'";
	$rsMenu=mysql_query($query);
}
if($parentm!="")
{
	$query="select * from ".$pref."menu where `mnuid`='$parentm'";
	$rsMenu=mysql_query($query);
	if($rsMenu)
	{
		$mrows=mysql_num_rows($rsMenu);
		if($mrows>0)
		{
			$mdata=mysql_fetch_array($rsMenu);
			$parent=$mdata[1];
		}
	}
}
if((int)$category==0)
{
	$menuType="Main menu";
}elseif((int)$category==1)
{
	$menuType="Top menu";
}elseif((int)$category==2)
{
	$menuType="Highlights";
}elseif((int)$category==3)
{
	$menuType="Quick Links";
}elseif((int)$category==4)
{
	$menuType="Community";
}elseif((int)$category==5)
{
	$menuType="Links To";
}elseif((int)$category==6)
{
	$menuType="Legal Note";
}else
{
	$menuType="Other";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="scripts/counterajax.js"></script>
<script language="javascript">
	function loadMenuID()
	{
		window.parent.document.frmMenu.menuid.value="<?php echo $parentm;?>";
		window.parent.document.frmMenu.parent.value="<?php echo $parent;?>";
		window.parent.document.frmMenu.level.value="<?php echo $lvl;?>";
	}
	
	function moveOrder(menuid,index,flag)
	{
		var order=Number(index)
		var orderID=document.getElementById("txtZOrder").value;
		var temp=new Array();
		temp=orderID.split("!~~!");
			var temp1=new Array();
			var temp2=new Array();
			temp1=temp[order].split("=");
			//alert(temp[Number(order) -1])
			if(flag=="0")
			{
				temp2=temp[order -1].split("=");
			}else
			{
				temp2=temp[order +1].split("=");
			}
			temp[order]=temp1[0]+"="+temp2[1];
			//alert(temp[order])
			if(flag=="0")
			{
				temp[order-1]=temp2[0]+"="+temp1[1];
			}else
			{
				temp[order+1]=temp2[0]+"="+temp1[1];
			}
			//alert(temp[order-1])
		document.getElementById("txtZOrder").value=temp.join("!~~!");
		document.frmOrder.submit();
		
	}
	
	function expandMenu(index,rows)
	{
		var closeit=false;
		for(x=0;x<Number(rows);x++)
		{
			
			var mnuDiv=document.getElementById("mnu"+x);
			if(x==index && mnuDiv.style.height=="130px")
			{
				closeit=true;
			}
			mnuDiv.style.height="30px";
			var mnuDiv=document.getElementById("mnuedit"+x);
			mnuDiv.style.display="none";
		}
		if(closeit==false)
		{
			var mnuDiv=document.getElementById("mnu"+Number(index));
			mnuDiv.style.height="130px";
			var mnuDiv=document.getElementById("mnuedit"+Number(index));
			mnuDiv.style.display="block";
		}
	}
</script>
</head>

<style>
	.bg{
	border:thin dotted #006600;
	width:400px;
	height:30px;
	font:Verdana, Arial, Helvetica, sans-serif;
	padding-left:10px;
	font-weight:bold;
	clip:rect(auto, auto, auto, auto);
	}
	.subbg{
	background:#FFFFCC;
	width:180px;
	height:25px;
	font:Verdana, Arial, Helvetica, sans-serif;
	padding-left:10px;
	font-size:12px;
	float:right;
	display:none;
	}
	.editbg{
	background:#FFFFCC;
	border:thin solid #CCCCCC;
	width:380px;
	font:Verdana, Arial, Helvetica, sans-serif;
	padding-left:10px;
	font-size:12px;
	display:none;
	}
	.editbg1{
	background:#FFFFCC;
	border:thin solid #CCCCCC;
	width:380px;
	font:Verdana, Arial, Helvetica, sans-serif;
	padding-left:10px;
	font-size:12px;
	display:block;
	}
	.menubg{
	width:200px;
	height:25px;
	font:Verdana, Arial, Helvetica, sans-serif;
	float:left;
	}
	div.bg:hover div.subbg{
	display:block;
	visibility:visible;
	cursor:default;
	}
	div.bg:hover, div.dg:active{
	cursor:pointer;
	}

</style>
<body onload="loadMenuID();">
<table width="502" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td height="19" valign="top"><strong><?php echo" Editing: $menuType";?></strong> <?php if($parentm!=""){echo "[$parent]";}?></td>
          </tr>
          <tr>
            <td width="502" height="6"></td>
          </tr>
</table>
		<?php

$query="select * from ".$pref."menu where `type`='$category' and `parentmenu`='$parentm' order by `ZOrder` ASC";
$ZOrder="";
$rsMenu=mysql_query($query);
if($rsMenu)
{
	$rows=mysql_num_rows($rsMenu);
	for($x=0;$x<$rows;$x++)
	{
		$data=mysql_fetch_array($rsMenu);
		?>
			<div class="bg" id="<?php echo "mnu$x"; ?>">
			<div  class="bg1">
				<div class="menubg"><?php echo $data[1];
					if($ZOrder=="")
					{
						$ZOrder="$data[0]=$x";
					}else
					{
						$ZOrder=$ZOrder."!~~!$data[0]=$x";
					}
					?></div>
				
				<div class="subbg"><? if($lvl<=1 && $category=="0"){?><a href="menuitems.php?level=<? echo (int)@$lvl+1;?>&category=<? echo "$category";?>&parentm=<? echo "$data[0]"; ?>&parent=<? echo "$data[1]";?>">Submenus</a> |<? }?><a href="#"  onclick="expandMenu('<?php echo $x;?>','<?php echo $rows;?>')"> Edit</a> | <a href="menuitems.php?category=<? echo "$category";?>&parentm=<? echo "$parentm";?>&parent=<? echo "$parent";?>&del=99&mnuid=<?php echo $data[0];?>&level=<?php echo $lvl;?>">Delete</a>
				<?php
				if($x>0)
				{
				?>
				<a href="#" onclick="moveOrder('<?php echo "$data[0]";?>','<?php echo "$x";?>','0')"><img src="images/move_up.png" /></a>
				<?php
				}else
				{
				?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?
				}
				if($x<$rows-1)	
				{
				?>
				<a href="#" onclick="moveOrder('<?php echo "$data[0]";?>','<?php echo "$x";?>','99')"><img src="images/move_down.png" /></a>
				<?php
				}else
				{
					?>
					
					<?
				}
				?>
				</div> <br /><br />
				<div style="width:380px; height:70px; background-color:#CCCCCC; padding:5px;" class="editbg"  id="<?php echo "mnuedit$x"; ?>" >
		<form name="frm<? echo $x;?>" method="post" action="saveeditmenu.php" enctype="multipart/form-data" style="width:500px; float:left;">
		<table width="335" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="45" height="19" valign="top"><div align="right">Title:</div></td>
			<td width="290" valign="top"><input name="txtDat1" type="text" id="txtDat1" value="<?php echo @$data[1];?>" />
			<input name="txtDat0" type="hidden" id="txtDat0" value="<?php echo @$data[0];?>" />
			<input name="parentm" type="hidden" id="parentm" value="<?php echo $parentm;?>" />
			<input name="parent" type="hidden" id="parent" value="<?php echo $parent;?>" />
			<input name="level" type="hidden" id="level" value="<?php echo @$lvl;?>" />
			<input name="category" type="hidden" id="category" value="<?php echo $category;?>" />			
			
			</td>
		  </tr>
		  <tr>
			<td height="19" valign="top"><div align="right">Url:</div></td>
			<td valign="top"><input name="txtDat2" type="text" id="txtDat2" style="width:280px;" value="<?php echo @$data[3];?>"  /></td>
		  </tr>
		  <tr>
			<td height="19">&nbsp;</td>
			<td valign="top"><input type="submit" name="Submit" value="Submit" /></td>
		  </tr>
		</table>
		</form>
				</div>
			
			</div>
			<div style="width:500px; height:5px;"></div>
			</div>
		<?
	}
}
?>
        <form name="frmOrder"  action="savemenuorder.php" method="post" enctype="multipart/form-data">
        	<input name="txtZOrder" type="hidden" id="txtZOrder" value="<?php echo $ZOrder;?>"   />
			<input name="parentm" type="hidden" id="parentm" value="<?php echo $parentm;?>" />
			<input name="parent" type="hidden" id="parent" value="<?php echo $parent;?>" />
			<input name="level" type="hidden" id="level" value="<?php echo @$lvl;?>" />
			<input name="category" type="hidden" id="category" value="<?php echo $category;?>" />
		</form>
</body>
</html>
