<?php
session_start();
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
include "globalfunc.php";
if($_GET["galleryid"]!="")
{
	if($_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."gallery where `galleryid`='".$_GET['galleryid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from ".$pref."gallery where `galleryid`='".$_GET["galleryid"]."'");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<script src="scripts/counterajax.js" ></script>
<script language="javascript">
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this picture?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

			if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="")
			{
				alert("Enter valid picture information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(galleryid)
	{
			if(galleryid!="")
		{		if (document.frmUsers.txtDat1.value=="" |  document.frmUsers.txtDat2.value=="")
			{
				alert("Enter valid picture information");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
		}
	}
</script>
<link href="css/newstyle.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<form action="savegallery.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="604" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->
  <tr>
    <td height="25" colspan="8" valign="top" class="BorderlessContent_Box">gallery</td>
  </tr>
  <tr>
    <td height="25" colspan="8" valign="top" class="PlainContent_Box">
	  <?php
		echo "Enter new <b>gallery </b> details";
	?>	</td>
    </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Title : </div></td>
    <td width="10">&nbsp;</td>
    <td colspan="3" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php if($_GET["galleryid"]!=""){echo "$datax[1]";}?>" />
      <input type="hidden" name="galleryid" value="<?php if($_GET["galleryid"]!=""){echo "$datax[0]";}?>" /></td>
    <td width="6">&nbsp;</td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Details : </div></td>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" valign="top"><textarea name="txtDat2" rows="3" id="txtDat2"><?php if($_GET["galleryid"]!=""){echo "$datax[2]";}?></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="60" height="98">&nbsp;</td>
    <td width="152">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="28" colspan="2" valign="top"><div align="right">Pictures : </div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><input class="STR1" name="txtDat3" type="file" id="txtDat3" value="<?php if($_GET["galleryid"]!=""){echo "$datax[2]";}?>" /></td>
    <td colspan="3" rowspan="4" valign="top"><img  src="<?php if($_GET["galleryid"]!=""){echo "../$datax[3]";}?>"  height="<?php echo getPicH("../$datax[3]",130)?>" width="<?php echo getPicW("../$datax[3]",130)?>" name="imgLogo" border="1"></td>
    </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top">Acceptable photos are: JPG, GIF, PNG, TFF only </td>
    </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="169">&nbsp;</td>
    <td width="81">&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td colspan="3" valign="top"><div align="right">
		  <?php
	if( $_GET["galleryid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add gallery\"  class=\"BTN\" onclick=\"addUser()\">";
	}
	?>
      
      
    </div></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="21" colspan="8" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="48" colspan="7" valign="top">
	  <table width="100%" id="gallash" >
	    <!--DWLayoutTable-->
	    <?php
		$rs=@mysql_query("select * from ".$pref."gallery");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$counter=0;
				$row1="";
				$row2="";
				$row3="";
				for($x=0;$x<$counts;$x++)
				{
					if($counter<=0)
					{
						$row1="<tr>";
						$row2="<tr  class=\"PlainContent_Box\" >";
						$row3="<tr  class=\"HorizontalRuler\" >";
					}
					$counter=$counter+1;
					$data=@mysql_fetch_array($rs);
					$row1=$row1."<td width=100 height=100 align=\"center\" valign=\"middle\" class=\"BorderlessContent_Box\"><a href=\"#\" onclick=\"getPage('gallery.php','content','galleryid=$data[0]')\"><img src=\"../$data[3]\" width=".getPicW("../$data[3]",100)." height=". getPicH("../$data[3]",100)." border=1></a></td>";
					$row2=$row2."<td align=\"left\"><a href=\"#\" onclick=\"getPage('gallery.php','content','galleryid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"delPage('gallery.php','content','galleryid=$data[0]&del=99')\">Delete</a>	</td>";
					$row3=$row3."<td>&nbsp;</td>";
					if ($counter>=5 | $x>=$counts-1)
					{
						$counter=0;	
						echo $row1."</tr>";
						echo $row2."</tr>";	
						echo $row3."</tr>";					
					}
				}
			}
		}
	?>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="122"></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

