<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
if(@$_GET["pwardid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."pward where `pwardid`='".@$_GET['pwardid']."'");
	}
}

?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function setF(obj)
	{
		var facultyid="<?php echo $facultyid; ?>";
		if(obj.options[obj.options.selectedIndex].value!="none")
		{
			if(facultyid!="")
			{
				if(obj.options[obj.options.selectedIndex].value!=facultyid)
				{
					getPage('county.php','content','facultyid='+obj.options[obj.options.selectedIndex].value);
					return 0;
				}
			}else
			{
				getPage('county.php','content','facultyid='+obj.options[obj.options.selectedIndex].value);
				return 0;
			}
		}
	
	}
	function setHOD(obj)
	{
		if(obj.options[obj.options.selectedIndex].value!="none")
		{
			frmUsers.txtDat3.value=obj.options[obj.options.selectedIndex].text;
			frmUsers.txtDat7.value=obj.options[obj.options.selectedIndex].value;		
			//getValue("txtDat4","staffid",obj.options[obj.options.selectedIndex].value,"stafflinks","link",1);
		}
	
	}
	function clearHOD()
	{
		if(frmUsers.hods.options.selectedIndex!=0)
		{			
			frmUsers.hods.options.selectedIndex=0;
		}
	
	}
	
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this county?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

		if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid county information");
			}
			else
			{		
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(countyid)
	{
			if(countyid!="")
		{		if (document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid ward information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
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
<form action="saveward.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="529" height="22" valign="top">Ward </td>
    <td width="167" valign="top"><div align="right"><?php
		$script="";
		echo classBTN("btnReturn","Add new Ward","editward.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td height="27" colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  style="border:thin dotted">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="24" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="492" valign="top">County</td>
			<td width="492" valign="top">Ward</td>
            <td width="160" valign="top">Action</td>
          </tr>
	    
	    <?php

		$rs=@mysql_query("select * from ".$pref."pward order by `county`,`ward` asc");
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
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td>".($x+1)."</td><td>$data[2]</td><td>$data[1]</td>
					<td><a href=\"#\" onclick=\"getPage('editward.php','content','pwardid=$data[0]')\">Edit</a> | <a href=\"#\"  onclick=\"getPage('ward.php','content','pwardid=$data[0]&del=99')\">Delete</a></td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

