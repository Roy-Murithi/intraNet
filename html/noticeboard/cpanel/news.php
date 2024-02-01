<?php
session_start();
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
include "globalfunc.php";
if($_GET["newsid"]!="")
{
	if($_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."news where `newsid`='".$_GET['newsid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from ".$pref."news where `newsid`='".$_GET["newsid"]."'");
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
function getCYear(yrz)
	{
		yr=String(yrz);
		if (yr.length==1)
		{
			yr="200"+yr;
		}
		else if (yr.length==2)
		{
			yr="20"+yr;
		}
		else if (yr.length==3)
		{
			yr="2"+yr;
		}
		
		if (yr.length==4)
		{
			return yr;
		}	
		else
		{
			return "-";
		}		
		
	}
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this news?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

			if ( document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value==""  )
			{
				alert("Enter valid news information");
			}
			else
			{
		if(document.frmUsers.txtDat4.value!="")
		{
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/,/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/-/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/\\/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/ /g,"");
			
			
			var temp=document.frmUsers.txtDat4.value.split("/");
			if(temp.length!=3)
			{
				alert("Enter valid date");
				return 0;
			}
			else
			{
				var currentTime = new Date();
				var month = currentTime.getMonth() + 1;
				var day = currentTime.getDate();
				var year = currentTime.getFullYear();
				temp[2]=getCYear(temp[2]);
				year=getCYear(year);
				if(temp[2]=="-")
				{
					alert("Invalid date entered");
					return 0;
				}			
				yd=Number(temp[2])-Number(year);
				md=Number(temp[1])-Number(month);
				dd=Number(temp[0])-Number(day);
				if (Number(temp[1])>12) 
				{
					alert("Incorrect month entered");
					return 0;
				}
				if (Number(temp[0])>31) 
				{
					alert("Incorrect date entered");
					return 0;
				}				
				
			}
		}
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(newsid)
	{
			if(newsid!="")
		{		if (document.frmUsers.txtDat1.value==""  |  document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value=="" )
			{
				alert("Enter valid news information");
			}
			else
			{
		if(document.frmUsers.txtDat4.value!="")
		{
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/,/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/-/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/\\/g,"/");
			document.frmUsers.txtDat4.value=document.frmUsers.txtDat4.value.replace(/ /g,"");
			
			
			var temp=document.frmUsers.txtDat4.value.split("/");
			if(temp.length!=3)
			{
				alert("Enter valid date");
				return 0;
			}
			else
			{
				var currentTime = new Date();
				var month = currentTime.getMonth() + 1;
				var day = currentTime.getDate();
				var year = currentTime.getFullYear();
				temp[2]=getCYear(temp[2]);
				year=getCYear(year);
				if(temp[2]=="-")
				{
					alert("Invalid date entered");
					return 0;
				}			
				yd=Number(temp[2])-Number(year);
				md=Number(temp[1])-Number(month);
				dd=Number(temp[0])-Number(day);
				if (Number(temp[1])>12) 
				{
					alert("Incorrect month entered");
					return 0;
				}
				if (Number(temp[0])>31) 
				{
					alert("Incorrect date entered");
					return 0;
				}				
				
			}
		}
				//save user
				document.frmUsers.submit()				
			}
		}
	}
</script>
<link href="css/newstyle.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<form action="savenews.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="604" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->
  <tr>
    <td height="25" colspan="7" valign="top" class="BorderlessContent_Box">You are here&gt;&gt;Admin/news</td>
  </tr>
  <tr>
    <td height="25" colspan="7" valign="top" class="PlainContent_Box">
	  <?php
	if($_GET["newsid"]!="" && $_GET["del"]!="99")
	{
		echo "Edit <b>$datax[1]</b>";
	}
	else
	{
		echo "Enter new <b>news </b>";
	}
	?>	</td>
    </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><div align="right">Title  :</div></td>
    <td width="9">&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtDat1" type="text" id="txtDat1"
	 value="<?php if($_GET["newsid"]!=""){echo "$datax[1]";}?>"  class="STR1"><input type="hidden" name="newsid" value="<?php if($_GET["newsid"]!=""){echo "$datax[0]";}?>" /></td>
    </tr>
  
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">News Update  :</div></td>
    <td></td>
    <td colspan="4" rowspan="2" valign="top"><textarea name="txtDat2" id="txtDat2"><?php if($_GET["newsid"]!=""){echo "$datax[2]";}?></textarea></td>
    </tr>
  
  <tr>
    <td width="53" height="98">&nbsp;</td>
    <td width="136">&nbsp;</td>
    <td></td>
    </tr>
  
  
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Source : </div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtDat3" type="text" class="STR1" id="txtDat3" value="<?php if($_GET["newsid"]!=""){echo "$datax[3]";}?>" />	</td>
    </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><div align="right">Dated : </div></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><input name="txtDat4" type="text" class="STR1" id="txtDat4" value="<?php if($_GET["newsid"]!=""){echo "$datax[4]";}?>" />
Format &quot;d/m/y&quot; </td>
    <td width="34">&nbsp;</td>
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><div align="right">Picture : </div></td>
    <td></td>
    <td colspan="2" valign="top"><input class="STR1" name="txtDat6" type="file" id="txtDat6" value="<?php if($_GET["newsid"]!=""){echo "$datax[4]";}?>" /></td>
    <td width="102" rowspan="3" valign="top"><img  src="<?php if($_GET["newsid"]!=""){echo "../$datax[6]";}?>"  height="<?php echo getPicH("../$datax[6]",130)?>" width="<?php echo getPicW("../$datax[6]",130)?>" name="imgLogo" border="1"></td>
    <td></td>
  </tr>
  <tr>
    <td height="50"></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top">Acceptable photo are: JPG, GIF, PNG, TFF only </td>
    <td></td>
  </tr>
  
  
  
  <tr>
    <td height="26"></td>
    <td colspan="3" rowspan="2" valign="top"><div align="right">
		  <?php
	if( $_GET["newsid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add news\"  class=\"BTN\" onclick=\"addUser()\">";
	}
	?>
      
      
    </div></td>
    <td width="76"></td>
    <td></td>
  </tr>
  <tr>
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="21" colspan="7" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="42" colspan="7" valign="top">
	  <table width="604" class="PlainContent_Box">
	    <!--DWLayoutTable-->
	    <tr><td width="31" height="25" class="BorderlessContent_Box">Index</td>
            <td width="245" valign="top" class="BorderlessContent_Box">News Update </td>
            <td width="147" valign="top" class="BorderlessContent_Box">Date</td>
            <td width="125" valign="top" class="BorderlessContent_Box">Actions</td>
          </tr>
	    <tr>
	      <td height="2"></td>
            <td></td>
            <td></td>
            <td></td>
	      </tr>
	    
	    
	    
	    <?php
		$rs=@mysql_query("select * from ".$pref."news");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=@mysql_fetch_array($rs);
					echo "
					<tr><td>".($x+1)."</td><td>$data[1]</td><td>$data[4]</td>
					<td><a href=\"#\" onclick=\"getPage('news.php','content','newsid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"delPage('news.php','content','newsid=$data[0]&del=99')\">Delete</a></td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td width="194"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

