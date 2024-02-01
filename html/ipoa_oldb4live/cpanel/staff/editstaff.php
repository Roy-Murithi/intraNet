<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
	//include ("../globalfunc.php");
$index=@$_GET["index"];
if(@$_GET["staffid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `staff` where `staffid`='".@$_GET['staffid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `staff` where `staffid`='".@$_GET["staffid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this Investigator?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

			if ( document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid staff information");
			}
			else
			{
				if ( document.frmUsers.txtDat2.value != document.frmUsers.txtConfirm.value)
				{
					alert("Password confirmation did not match, please re-enter password");
					return 0;
				}
				if ( document.frmUsers.txtDat2.value.length<6)
				{
					alert("Enter password with atleast 6 characters");
					return 0;
				}				
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(staffid)
	{
			if(staffid!="")
		{		if (document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value=="" |  document.frmUsers.txtDat5.value=="" )
			{
				alert("Enter valid staff information");
			}
			else
			{
				if ( document.frmUsers.txtDat2.value != document.frmUsers.txtConfirm.value)
				{
					alert("Password confirmation did not match, please re-enter password");
					return 0;
				}
				if ( document.frmUsers.txtDat2.value.length<6)
				{
					alert("Enter password with atleast 6 characters");
					return 0;
				}				
				//save user
				document.frmUsers.submit()				
			}
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
<table width="646" class="Black_Header_Text">
	      <!--DWLayoutTable-->
	      <tr>
	        <td width="2" height="25" >&nbsp;</td>
            <td width="628" valign="top" ><strong>Edit Staff </strong></td>
  <tr>
              <td height="21">&nbsp;</td>
              <td valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  <tr>
    <td height="392" colspan="2" valign="top">
	<form name="frmUsers" method="post" action="savestaff.php" enctype="multipart/form-data">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
      <!--DWLayoutTable-->
      <tr>
        <td width="9" height="22">&nbsp;</td>
        <td colspan="2" rowspan="5" valign="top">
		  <div align="center"><img src="
		  <?php if(@$_GET["staffid"]!="")
		  	{
				if(is_file("../../".$datax[6]))
				{
		  			echo "../../".$datax[6];
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../../".$datax[6];
		  	}
		  else
		  	{
		  		echo "../../staff/photo/avator.png";
				$pic="../../staff/photo/avator.png";
			}
		  ?>
		  " border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,124); ?>" width="<?php echo getPicW($pic,124); ?>"  />		</div></td>
        <td width="116" valign="top" class="Black_Header_Text"><div align="right">Username</div></td>
        <td width="14">&nbsp;</td>
        <td colspan="4" valign="top"><input name="txtDat1" type="text"  class="STR" id="txtDat1" value="<?php if(@$_GET["staffid"]!=""){echo $datax[1];}?>" />
          <span class="style15">        *</span><input type="hidden" name="staffid" value="<?php if(@$_GET["staffid"]!=""){echo @$_GET["staffid"];}?>" /></td>
      </tr>
      <tr>
        <td height="22"></td>
        <td valign="top" class="Black_Header_Text"><div align="right">Password</div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtDat2" type="password" value="<?php if(@$_GET["staffid"]!=""){echo $datax[2];}?>"  class="STR" id="txtDat2"/>
          <span class="style15">*</span></td>
        </tr>
      <tr>
        <td height="22"></td>
        <td valign="top" class="Black_Header_Text"><div align="right">Confirm Password </div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtConfirm" value="<?php if(@$_GET["staffid"]!=""){echo $datax[2];}?>" type="password"  class="STR" id="txtConfirm" />
          <span class="style15">*</span></td>
        </tr>
      
      <tr>
        <td height="22"></td>
        <td valign="top" class="Black_Header_Text"><div align="right">Full Names </div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtDat3" value="<?php if(@$_GET["staffid"]!=""){echo $datax[3];}?>" type="text"  class="STR" id="txtDat3" />
          <span class="style15">*</span></td>
        </tr>
      

      
      
      <tr>
        <td height="22"></td>
        <td valign="top" class="Black_Header_Text"><div align="right">Contacts</div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtDat4" value="<?php if(@$_GET["staffid"]!=""){echo $datax[4];}?>" type="text"  class="STR" id="txtDat4" /></td>
        </tr>
      <tr>
        <td height="22"></td>
        <td width="13"></td>
        <td colspan="2" valign="top" class="Black_Header_Text"><div align="right">Office</div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtDat5" value="<?php if(@$_GET["staffid"]!=""){echo $datax[5];}?>" type="text"  class="STR" id="txtDat5" />
          <span class="style15">*</span></td>
        </tr>
      <tr>
        <td height="21"></td>
        <td></td>
        <td colspan="2" valign="top" class="Black_Header_Text"><div align="right">Photo</div></td>
        <td></td>
        <td colspan="4" valign="top"><input name="txtDat6" type="file"   id="txtDat6" /></td>
        </tr>
      <tr>
        <td height="25"></td>
        <td></td>
        <td colspan="2" rowspan="2" valign="top" class="Black_Header_Text"><div align="right">Level</div></td>
        <td></td>
        <td colspan="3" valign="top"><select name="txtDat7" class="STR" id="txtDat7"  onchange="getJob()">
          <option value="99" <?php if(@$datax[9]=="99"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(99); ?></option>
		  <option value="0" <?php if(@$datax[9]=="0"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(0); ?></option>
		  <option value="1" <?php if(@$datax[9]=="1"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(1); ?></option>
		  <option value="2" <?php if(@$datax[9]=="2"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(2); ?></option>
		  <option value="3" <?php if(@$datax[9]=="3"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(3); ?></option>
		  <option value="4" <?php if(@$datax[9]=="4"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(4); ?></option>
          <option value="5" <?php if(@$datax[9]=="5"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(5); ?></option>
		  <option value="6" <?php if(@$datax[9]=="6"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(6); ?></option>
		  <option value="7" <?php if(@$datax[9]=="7"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(7); ?></option>
		  <option value="8" <?php if(@$datax[9]=="8"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(8); ?></option>	
		  <option value="9" <?php if(@$datax[9]=="9"){echo " selected=\"selected\"";}?>><?php echo fetchLevelName(9); ?></option>
		  		  
        </select>
          </td>
        <td width="183">&nbsp;</td>
      </tr>
      <tr>
        <td height="1"></td>
        <td></td>
        <td colspan="5" rowspan="2" valign="top" class="PlainContent_Box">Fields with an asteric <span class="style15">*</span> must be entered before submitting </td>
        </tr>
      <tr>
        <td height="45"></td>
        <td></td>
        <td width="97">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="22" colspan="6" valign="top"><div align="right">
          <?php
	if( @$_GET["staffid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new Staff\"  class=\"BTN\" onclick=\"addUser()\">";
	}
	?>
        </div></td>
        <td width="8">&nbsp;</td>
        <td width="187" valign="top"><div align="left">
          <input type="reset" name="Submit2" value="Clear Fields" class="BTN" />
        </div></td>
      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="1"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td width="11"></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>   
	</form>	 </td>
  </table>
