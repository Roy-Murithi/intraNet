<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("../globalfunc.php");
	$txtSearch=str_replace("'","\'",@$_POST['txtSearch']);
$index=@$_GET["index"];
if(@$_GET["pageid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from `".$pref."page` where `pageid`='".@$_GET["pageid"]."'");
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
			}
		}
		$rs=@mysql_query("delete from `".$pref."page` where `pageid`='".@$_GET['pageid']."'");
		
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
              <td height="27" colspan="2" valign="top">Pages</td>
              <td colspan="2" valign="top"><div align="right"> <form name="frmSearch" enctype="multipart/form-data" method="post" style="width:450px;">Search: <input type="text" class="STR1" name="txtSearch" value="<?php echo @$_POST['txtSearch'];?>" style="width:300px" /><input type="submit" name="btnSearch" class="BTN" value="Search"  /></form>
              </div></td>
              <td width="209" valign="top"><div align="right"><a href="#" onclick="getPage('editpage.php','content','')">Add new page </a></div></td>
  <tr>
                <td height="20" colspan="5" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td width="24" height="281">&nbsp;</td>
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
						$where="where `title` like '%".$txtSearch."%'";
					   }else
					   {
						$where="";
					   }
		$rs=@mysql_query("select * from ".$pref."page $where order by `others` DESC");

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
					$First="<a href=\"#\" onclick=\"getPage('page.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('page.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('page.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('page.php','content','index=$nex')\">Next</a>";
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
					$template=str_replace("t_","",$data[4]);
					$template=str_replace(".php","",$template);
					echo "
					<div style=\"width:742px;float:left;margin-bottom:10px\">
					<div style=\"border-bottom:thin dotted; width:742px;float:left;\">
				  		<div  style=\" width:30px; margin-bottom:10px; float:left\" >
						".($x+1).".</div>
						<div  style=\" width:452px; margin-bottom:10px; float:left\" >
						$data[1]
						</div>
				  		<div  style=\" width:90px; margin-bottom:10px; float:left\" >
						$data[5]
						</div>
				  		<div  style=\" width:170px; margin-bottom:10px; float:left\" >
						$template
						</div>
					";

							
						echo "
						<div  style=\" width:742px;float:left;\"  align=\"right\">												
							<a href=\"#\" onclick=\"getPage('editpage.php','content','pageid=$data[0]')\">Edit</a> | 							<a href=\"#\" onclick=\"delPage('page.php','content','pageid=$data[0]&del=99&index=$offset')\">Delete</a>
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
    <td height="34" colspan="3" valign="top"><div align="right" class="PlainContent_Box">page <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
    </div></td>
  <td colspan="2" valign="top" class="PlainContent_Box"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="5"></td>
    <td width="37"></td>
    <td width="439"></td>
    <td width="9"></td>
    <td></td>
  </tr>
</table>
