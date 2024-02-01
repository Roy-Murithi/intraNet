<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("../globalfunc.php");
	$txtSearch=str_replace("'","\'",@$_POST['txtSearch']);
$index=@$_GET["index"];
if(@$_GET["downloadcatid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from `downloadcat` where `downloadcatid`='".@$_GET["downloadcatid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
				if(is_file("../../$data[3]")!="")
				{
					chmod("../../$data[3]",0775);
					unlink("../../$data[3]");
				}
			}
		}
		$rs=@mysql_query("delete from `downloadcat` where `downloadcatid`='".@$_GET['downloadcatid']."'");		
	}	
	$flag="0";
	if(@$_GET["activate"]=="99")
	{
		$rs=@mysql_query("select * from `downloadcat` where `downloadcatid`='".@$_GET["downloadcatid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$data=@mysql_fetch_array($rs);
				if($data[4]=="99")
				{
					$flag="0";
				}else
				{
					$flag="99";
				}
			}
		}
		$rs=@mysql_query("update`downloadcat` set `active`='$flag' where `downloadcatid`='".@$_GET['downloadcatid']."'");		
	}
}

?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
function getJob()
	{
		frmUsers.txtDat10.value=frmUsers.txtDat9.options[frmUsers.txtDat9.selectedIndex].text;
	}
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this page?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	
</script>

<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>
<table width="752" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="27" colspan="2" valign="top">Download Category </td>
              <td colspan="2" valign="top"><div align="right"> <form name="frmSearch" enctype="multipart/form-data" method="post" style="width:450px;">Search: <input type="text" class="STR1" name="txtSearch" value="<?php echo @$_POST['txtSearch'];?>" style="width:300px" /><input type="submit" name="btnSearch" class="BTN" value="Search"  /></form>
              </div></td>
              <td width="130" valign="top"><div align="right"><a href="#" onclick="getPage('editcategory.php','content','')">Add new Category </a></div></td>
  <tr>
                <td height="20" colspan="5" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td width="22" height="281">&nbsp;</td>
                  <td colspan="4" valign="top" class="Black_Header_Text">
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
						$where="where `name` like '%".$txtSearch."%'";
					   }else
					   {
						$where="";
					   }
		$rs=@mysql_query("select * from `downloadcat` $where order by `name` ASC");

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
					$First="<a href=\"#\" onclick=\"getPage('category.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('category.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('category.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('category.php','content','index=$nex')\">Next</a>";
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
	
					echo "
					<div style=\"width:742px;float:left;margin-bottom:10px\">
					<div style=\"border-bottom:thin dotted; width:742px;float:left;\">
				  		<div  style=\" width:30px; margin-bottom:10px; float:left\" >
						".($x+1).".</div>
						<div  style=\" width:120px; margin-bottom:10px; float:left\" >
						";
						
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
 echo "
						</div>
						<div  style=\" width:200px; margin-bottom:10px; float:left\" >
						$data[1]
						</div>				  		
						<div  style=\" width:202px; margin-bottom:10px; float:left\" >
						$data[2]
						</div>
				  		
					";
						if($data[4]=="99")
						{
							$status="Deativate";
						}else
						{
							$status="Display";
						}
							
						echo "
						<div  style=\" width:150px;float:left;\"  align=\"right\">	
							<a href=\"#\" onclick=\"getPage('category.php','content','downloadcatid=$data[0]&index=$offset&activate=99')\">$status</a> |											
							<a href=\"#\" onclick=\"getPage('editcategory.php','content','downloadcatid=$data[0]')\">Edit</a> | 							<a href=\"#\" onclick=\"delPage('category.php','content','downloadcatid=$data[0]&del=99&index=$offset')\">Delete</a>
						</div>
					</div>				  
				  	</div>
					";
				}
			}
		}
	?>				  </td>
  <tr>
    <td height="21" colspan="5" valign="top" class="HorizontalRuler" style=""><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="34" colspan="3" valign="top"><div align="right" class="PlainContent_Box">Category <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
    </div></td>
  <td colspan="2" valign="top" class="PlainContent_Box"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="5"></td>
    <td width="115"></td>
    <td width="368"></td>
    <td width="81"></td>
    <td></td>
  </tr>
</table>
