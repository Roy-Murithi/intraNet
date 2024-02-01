<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$facultyid=@$_GET['personid'];
if(@$_GET["supportid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from  support where `supportid`='".@$_GET['supportid']."'");
	}
	
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this request?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="2" valign="top">Help request to ICT </td>
    </tr>
  <tr>
    <td height="21" colspan="2" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td width="696" height="35" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  style="border:thin dotted">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="93" valign="top">Help on </td>
            <td width="161" valign="top">Request by </td>
            <td width="84" valign="top">Viewed</td>
            <td width="112" valign="top">Attended</td>
            <td width="84" valign="top">Resolved</td>
            <td width="114" valign="top">Action</td>
          </tr>
	    
	    <?php

		$rs=@mysql_query("select * from support where  resolved ='99' order by `index` desc");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$color="#FFFFFF";
				for($x=0;$x<$counts;$x++)
				{
					if($color=="#FFFFFF")
					{
						$color="#ABD8DA";
					}else
					{
						$color="#FFFFFF";
					}
					$data=@mysql_fetch_array($rs);
					
					$edit="<a href=\"#\" onclick=\"getPage('requestview.php','content','supportid=$data[0]')\">View</a>";					
			
					if($data[8]=="")
					{
						$att="<font color=\"Red\">No</font>";
					}else
					{
						$att="<font color=\"Green\">Yes</font>";
					}
					if($data[5]=="")
					{
						$vwd="<font color=\"Red\">No</font>";
					}else
					{
						$vwd="<font color=\"Green\">Yes</font>";
					}
					if($data[12]=="")
					{
						$rslvd="<font color=\"Red\">No</font>";
					}else
					{
						$rslvd="<font color=\"Green\">Yes</font>";
					}
					$str=str_replace(" ","&nbsp;",$data[2]);
					$str=str_replace("\n","<br />",$str);
					
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td  valign=\"top\">".($x+1)."</td><td valign=\"top\">$data[3]</td><td valign=\"top\">".  _getDirectoryUsername(@$data[1]) ."</td><td valign=\"top\">$vwd</td><td valign=\"top\">$att</td><td valign=\"top\">$rslvd</td>
					<td valign=\"top\">$edit</td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    <td width="4"></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td></td>
  </tr>
</table>
</form>

