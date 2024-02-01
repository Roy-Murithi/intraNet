<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
	include ("globalfunc.php");
$index=$_GET["index"];
if($_GET["fundingid"]!="")
{
	if($_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `funding` where `fundingid`='".$_GET['fundingid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `funding` where `fundingid`='".$_GET["fundingid"]."'");
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
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this funding member?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addQ()
	{ 

			if ( document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="" )
			{
				alert("Enter valid funding information");
			}
			else
			{		
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveQ(funding)
	{
			if(funding!="")
		{		if (document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="")
			{
				alert("Enter valid funding information");
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
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>

<table width="646">
	      <!--DWLayoutTable-->
	      <tr>
	        <td height="25" colspan="2" valign="top" class="titletext"><strong>Edit Funding  </strong></td>
  <tr>
              <td height="21" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <tr>
    <td height="242" colspan="2" valign="top">
	<form name="frmUsers" method="post" action="savefunding.php" enctype="multipart/form-data">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="155" height="20" valign="top" class="Black_Header_Text"><div align="right">Funding :</div></td>
        <td colspan="4" rowspan="2" valign="top"><div align="left">
          <textarea name="txtDat1" id="txtDat1"><?php if($_GET["fundingid"]!=""){echo $datax[1];}?></textarea>
          <span class="style15">*
            <input name="fundingid" type="hidden" id="fundingid" value="<?php if($_GET["fundingid"]!=""){echo $_GET["fundingid"];}?>" />
          </span></div></td>
        </tr>
      <tr>
        <td height="102">&nbsp;</td>
        </tr>
      <tr>
        <td height="22" valign="top" class="Black_Header_Text"><div align="right">Details : </div></td>
        <td colspan="4" rowspan="2" valign="top"><div align="left">
          <textarea name="txtDat2" class="STR" id="txtDat2"><?php if($_GET["fundingid"]!=""){echo $datax[2];}?></textarea>
          <span class="style15">*</span></div></td>
        </tr>
      <tr>
        <td height="70">&nbsp;</td>
        </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td colspan="4" valign="top" class="PlainContent_Box">Fields with an asteric <span class="style15">*</span> must be entered before submitting </td>
        </tr>
      <tr>
        <td height="22" colspan="2" valign="top"><div align="right">
          <?php
	if( $_GET["fundingid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveQ()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new Funding\"  class=\"BTN\" onclick=\"addQ()\">";
	}
	?>
        </div></td>
        <td width="9">&nbsp;</td>
        <td width="177" valign="top"><div align="left">
          <input type="reset" name="Submit2" value="Clear Fields" class="BTN" />
        </div></td>
      <td width="168">&nbsp;</td>
      </tr>
      <tr>
        <td height="1"></td>
        <td width="139"></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>   
	</form>	 </td>
      <tr>
      <td height="22" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <tr>
            <td height="21" colspan="2" valign="top" class="titletext"><strong>Existing funding</strong></td>
          <tr>
            <td height="37" colspan="2" valign="top">
			  <table width="640" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
			  <!--DWLayoutTable-->
              <tr bgcolor="#cfcfff">
				  <td width="33" height="21" valign="top"><span class="style14">Index</span></td>
				  <td width="23" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
				  <td width="479" valign="top"><span class="style14">Funding</span></td>
				  <td width="104" valign="top"><span class="style14">Actions</span></td>
			  </tr>
			  <?php
		$rs=@mysql_query("select * from funding");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=10;
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
					$First="<a href=\"#\" onclick=\"getPage('funding.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('funding.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('funding.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('funding.php','content','index=$nex')\">Next</a>";
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
					<tr><td rowspan=2 valign=\"top\">".($x+1)."</td><td width=20>Funding :</td><td width=479 align=\"left\"><font  color=\"green\">$data[1]</font></td>
					<td rowspan=2  valign=\"top\"><a href=\"#\" onclick=\"getPage('funding.php','content','fundingid=$data[0]&index=$offset')\">Edit</a> | <a href=\"#\" onclick=\"delPage('funding.php','content','fundingid=$data[0]&del=99&index=$offset')\"  >Delete</a></td>
					</tr>
					<tr><td width=20>Details :</td><td align=\"left\"><font  color=\"red\">$data[2]</font></td></tr>
					";
				}
			}
		}
	?>
                </table></td>
  <tr>
              <td width="354" rowspan="2" valign="top"><div align="right" class="PlainContent_Box">funding <? echo ((int)$offset+1)." to $limit of $counts"; ?></div></td>
  <td width="276" height="25" valign="top" class="PlainContent_Box"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="7"></td>
  <tr>
    <td height="2"></td>
    <td></td>
  </table>
