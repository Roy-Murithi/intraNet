<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		echo "here";exit;
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
	//include ("../globalfunc.php");
	$txtSearch=str_replace("'","\'",@$_GET['txtSearch']);
	$index=@$_GET["index"];
	$complaintid=@$_GET['complaintid'];
?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">

</script>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>
<table width="794" class="Black_Header_Text" style="margin-left:5px;">
	      <!--DWLayoutTable-->
            <tr>
              <td width="353" height="31" valign="top">Investigators</td>
              <td colspan="4" valign="top"><div align="right"> <form name="frmSearch" enctype="multipart/form-data" method="get" style="width:300px;"  action="attachinv1.php">Search: <input type="text" class="STR1" name="txtSearch" value="<?php echo @$_GET['txtSearch'];?>" /><input type="submit" name="btnSearch" class="BTN" value="Search" />
			  <input type="hidden" name="sessid" value="smetsysmocmas" />
			  </form>
              </div></td>
              <td width="119" valign="top"><div align="right"><a href="#" onclick="getPage('editattachinv.php','content','')">Add Investigator </a></div></td>
  <tr>
              <td height="20" colspan="6" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  <tr>
                  <td height="258" colspan="6" valign="top" class="Black_Header_Text">
				  
		            <?php
				   
				   $where="";
				   $First="First";
				   $Previous="Previous";
				   $Next="Next";
				   $Last="Last";
				   $limit="0";
				   $counts="0";
				   $ids=str_replace("!~!","','",fetchValue($pref."investigation","complaintid",$complaintid,13))."','".fetchValue($pref."investigation","complaintid",$complaintid,2);
				   if($txtSearch!="")
				   {
				   	$where="where `names` like '%".$txtSearch."%' and `staffid` not in ('$ids')";
				   }else
				   {
				   	$where="where `staffid` not in ('$ids')";
				   }
				 // echo "select * from staff $where order by `names` ASC";exit;
		$rs=@mysql_query("select * from staff $where order by `names` ASC");

		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=12;
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
					$First="<a href=\"#\" onclick=\"getPage('attachinv.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('attachinv.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('attachinv.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('attachinv.php','content','index=$nex')\">Next</a>";
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
					<div style=\"width:600px; height:86px;float:left\">
					<div style=\"border:thin dotted; background:#BFE5BF;  width:600px; height:80px;float:left;\">
				  		<div  style=\" width:80px; height:80px;margin:5px;float:left;\" align=\"center\">";
							?>
							<img src="<?php 
				if(is_file("../../".$data[6]))
				{
		  			echo "../../".$data[6];
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../../".$data[6];
				if(@$_GET['leadinv']==99)
				{
					$btnVal="";
					$url="";
					if(@$_GET['swap']=="99")
					{
						$btnVal="swap lead investigator";
						$url="saveattachinv1.php";
					}else
					{
						$btnVal="Add as lead Investigator";
						$url="saveassign2.php";
					}
					$btn="<input id=\"btn$x\"  type=\"button\" onclick=\"getPage('$url','content','invid=$data[0]&index=$index&complaintid=$complaintid&leadinv=99')\"  value=\"$btnVal\" class=\"BTN\">";
				}else
				{
					$btn="<input id=\"btn$x\"  type=\"button\" onclick=\"getPage('saveattachinv1.php','content','invid=$data[0]&index=$index&complaintid=$complaintid')\" value=\"Attach support investigator\" class=\"BTN\">";
				}
		  ?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,65); ?>" width="<?php echo getPicW($pic,65); ?>"  />	
				  <?php
							echo "
						</div>
						<div  style=\" width:300px; height:80px;float:left;\"  align=\"left\">
							$data[9]<br/>
							$data[3]<br/>
							$data[5]<br/>
						</div>
						<div  style=\" width:100px; height:80px;float:left;\">
							$btn
						</div>
					</div>				  
				  	</div>
					";
				}
			}
		}
	?>				  </td>
  <tr>
                    <td height="21">&nbsp;</td>
                    <td width="14">&nbsp;</td>
                    <td width="154">&nbsp;</td>
                    <td width="32">&nbsp;</td>
                    <td colspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="21" colspan="6" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="34" colspan="2" valign="top"><div align="right" class="PlainContent_Box">attachinv <?php 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?></div></td>
  <td>&nbsp;</td>
    <td colspan="3" valign="top" class="PlainContent_Box"><div align="center"><?php echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="5"></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="81"></td>
    <td></td>
  </tr>
</table>
