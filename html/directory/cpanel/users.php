<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$userid=@$_GET['userid'];
if(@$_SESSION['level']!="99" && @$_SESSION['level']!="98" )
  {
		$userid=@$_SESSION['userid'];
  }
if($userid!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."user where `userid`='".@$_GET['userid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from ".$pref."user where `userid`='".$userid."'");
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
<script src="scripts/counterajax.js" ></script>
<script language="javascript">
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this User?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	
	function getMac()
	{
		var ipadd=prompt("Enter IP Address");
		//check valid IP address
		if(ipadd!="")
		{
			var ajaxDisplay = document.getElementById("txtMacAddress");
			ajaxDisplay.value ="";
			ajaxGetMac("getMac.php","txtMacAddress","ipadd="+ipadd);
		}
	}
	function ajaxGetMac(url,container,param)
	{
		var loadDisplay1 = document.getElementById("txtMacAddress");	
		loadDisplay1.style.visibility="hidden";		
		var loadDisplay = document.getElementById("loadingMac");	
		loadDisplay.style.visibility="visible";
		var ajaxRequest;  // The variable that makes Ajax possible!
		var ajaxDisplay = document.getElementById(container);
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser cannot support this functionality!");
					return false;
				}
			}
		}
		
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				var loadDisplay = document.getElementById("loadingMac");
				var ajaxDisplay = document.getElementById(container);
				ajaxDisplay.value = ajaxRequest.responseText;	
				loadDisplay.style.visibility="hidden";
				ajaxDisplay.style.visibility="visible";
			}
			
		}
		
		ajaxRequest.open("POST", url, true);
		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxRequest.send("brwsd=yes&"+param);
		
	}
	function addUser()
	{ 
			if(document.frmusers.txtPassword.value != document.frmusers.txtConfirm.value)
			{
				alert("\"Password\" and \"password confirmation\" did't match");
				return 0;
			}
			if (document.frmusers.txtUsername.value=="" | document.frmusers.txtPassword.value=="" |  document.frmusers.txtConfirm.value=="" | document.frmusers.txtNames.value=="" | document.frmusers.txtLevel.options[document.frmusers.txtLevel.selectedIndex].value=="none" |  document.frmusers.txtLevel.options[document.frmusers.txtLevel.selectedIndex].value==""  )
			{
				alert("Enter valid account information");
			}
			else
			{
				//save user
				document.frmusers.submit()				
			}
	}
	function saveUser(userID)
	{
				if(document.frmusers.txtPassword.value != document.frmusers.txtConfirm.value)
			{
				alert("Password and password confirmation did not match");
				return 0;
			}
			if(userID!="")
		{		if (document.frmusers.txtUsername.value=="" | document.frmusers.txtNames.value=="" | document.frmusers.txtLevel.options[document.frmusers.txtLevel.selectedIndex].value=="none" |  document.frmusers.txtLevel.options[document.frmusers.txtLevel.selectedIndex].value=="" )
			{
				alert("Enter valid account information");
			}
			else
			{
				//save user
				document.frmusers.submit()				
			}
		}
	}
	function getFaculty(acc)
	{
		var txtScope=document.getElementById("txtScope")
		if (acc=="92")
		{
			txtScope.disabled="";
		}else
		{
			txtScope.disabled="disabled";
			txtScope.options[0].selected="selected";
		}
	}
</script>
<link href="css/newstyle.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
<body onLoad="getFaculty(<?php echo @$datax[4];?>)">
<form name="frmusers" action="saveuser.php" method="post">
<table width="675" border="0" cellpadding="0" cellspacing="0" class="PlainContent_Box">
  <!--DWLayoutTable-->
  <tr>
    <td height="25" colspan="9" valign="top" class="BorderlessContent_Box">You are here&gt;&gt;Admin/Users </td>
    </tr>
  <tr>
    <td height="13" colspan="9" valign="top"><img src="images/phead.png" width="700" height="5"></td>
    </tr>

  <tr>
    <td height="25" colspan="7" valign="top" class="PlainContent_Box">
	  <?php
	if($userid!="" && @$_GET["del"]!="99")
	{
		echo "Edit <b>$datax[3]</b>'s details";
	}
	else
	{
		echo "Enter new <b>user's</b> details";
	}
	?>	</td>
    <td width="76"></td>
    <td width="155" rowspan="6" valign="top" ><img src="images/users.png" width="149" height="149"></td>
    </tr>
  
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Username:</div></td>
    <td width="4">&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtUsername" type="text" id="txtUsername"
	value="<?php if($userid!=""){echo @$datax[1];}?>" class="STR1"></td>
    <td >&nbsp;</td>
    </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Password:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtPassword" type="password" id="txtPassword"  class="STR1"></td>
    <td >&nbsp;</td>
    </tr>
  <tr>
    <td height="25" colspan="2" valign="top"><div align="right">Confirm Password: </div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtConfirm" type="password" id="txtConfirm"  class="STR1">
	  <input name="txtUserid" type="hidden" id="txtUserid"
	 value="<?php if( $userid!=""){echo @$datax[0];}?>">	 </td>
    <td >&nbsp;</td>
    </tr>
  <tr>
    <td height="24" colspan="2" valign="top"><div align="right">Names:</div></td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><input name="txtNames" type="text" id="txtNames"
	 value="<?php if( $userid!=""){echo @$datax[3];}?>"  class="STR1" style="width:200px;"></td>
    <td >&nbsp;</td>
    </tr>
  <tr>
    <td height="27" colspan="2" valign="top"><div align="right" style="width:199px">Access Level: </div></td>
    <td></td>
    <td colspan="5" valign="top">
	<?php
	if(@$_SESSION['level']=="99")
  {?>
		
	<select name="txtLevel" onChange="getFaculty(this.value)">
	  <option value="none" <?php if( @$datax[4]==""){echo "selected=\"selected\"";}?>>--select--</option>
	  <!--<option value="0">User</option> -->	
	  <option value="99" <?php if( @$datax[4]=="99"){echo "selected=\"selected\"";}?>>Root</option>
	  <option value="98" <?php if( @$datax[4]=="98"){echo "selected=\"selected\"";}?>>Administrator</option>
	  <option value="97" <?php if( @$datax[4]=="97"){echo "selected=\"selected\"";}?>>Investigator</option>
	  <option value="96" <?php if( @$datax[4]=="96"){echo "selected=\"selected\"";}?>>Data Entry</option>
	  <option value="95" <?php if( @$datax[4]=="95"){echo "selected=\"selected\"";}?>>Guest</option>
	  </select>
	<?php
  }else
  {
  	 if( @$datax[4]=="98")
	 {
	 	$level="Administrator";
	 }else if( @$datax[4]=="97")
	 {
	 	$level="Administrator";
	 }else if( @$datax[4]=="96")
	 {
	 	$level="User";
	 }else if( @$datax[4]=="95")
	 {
	 	$level="Guest";
	 }
	 
  ?>
		
	<select name="txtLevel" >		
	  <option value="<?php echo @$datax[4]; ?>" selected="selected"><?php echo @$level;?></option>		
	  </select>
	<?php
  }
	?>		</td>
    </tr>
  
  
  
  
  <tr>
    <td height="22" colspan="2" valign="top"><div align="right">Scope:</div></td>
    <td></td>
    <td colspan="6" valign="top"> 
	  <select id="txtScope" name="txtScope" disabled="disabled">
	  	<?php 
			if($_SESSION['level']=="99")
			{
				echo "<option value=\"global\">Global</option>";	   
				$rsFaculty=mysql_query("select * from faculty");
				if($rsFaculty)
				{
					$rows=mysql_num_rows($rsFaculty);
					if($rows>0)
					{
						for($x=0;$x<$rows;$x++)
						{
							$data=mysql_fetch_array($rsFaculty);
							if(@$datax[5]==$data[0])
							{
								$sel="Selected=\"Selected\"";
							}else
							{
								$sel="";
							}
							echo "<option value=\"$data[0]\" $sel>$data[1]</option>\n";
						}
					}
				}
			}else
			{	   
				$rsFaculty=mysql_query("select * from faculty where facultyid='". $_SESSION['scope'] ."'");
				if($rsFaculty)
				{
					$rows=mysql_num_rows($rsFaculty);
					if($rows>0)
					{
						for($x=0;$x<$rows;$x++)
						{
							$data=mysql_fetch_array($rsFaculty);
							if(@$datax[5]==$data[0])
							{
								$sel="Selected=\"Selected\"";
							}else
							{
								$sel="";
							}
							echo "<option value=\"$data[0]\" $sel>$data[1]</option>\n";
						}
					}
				}

			}
		?>
      </select>	</td>
    </tr>
  
  
  <tr>
    <td height="23" colspan="2" valign="top"><div align="right">Status:</div></td>
    <td></td>
    <td colspan="6" valign="top"><input name="txtStatus" type="radio" value="99" checked="checked" <?php if(@$datax[7]=="99" || @$datax[4]=="99"){echo "checked=\"checked\"";} ?> />
      Enabled 
	    <?php if(@$datax[4]!="99"){ ?>
        <input name="txtStatus" type="radio" value="0" <?php if(@$datax[7]=="0"){echo "checked=\"checked\"";}?>/>
      Disabled
	  <?php }?>	  </td>
    </tr>
  
  <tr>
    <td colspan="2" rowspan="2" valign="top"><div align="right">Mac Address: </div></td>
    <td height="1"></td>
    <td colspan="2" rowspan="2" valign="top" style="width:150px"><input name="txtMacAddress" type="text" id="txtMacAddress"  class="STR1" style="width:150px" value="<?php if( $userid!=""){echo @$datax[8];}?>" /><div id="loadingMac" style="width:26px; height:18px; position:absolute; left: 243px; top: 227px; border:hidden; visibility:hidden" ><img src="images/loading.gif" style="height:18px; width:18px" /></div></td>
	
    <td width="83" rowspan="2" valign="top"><input name="button" type="button" class="BTN" value="Fetch Mac" onClick="getMac()" /></td>
    <td width="18"></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td colspan="3" valign="top"><input name="chkMac" type="checkbox" id="chkMac" value="99" <?php if( $userid!="" && @$datax[9]==99){echo "checked=\"checked\"";}?>
	 />
      <span class="style5">      Restrict Login to this Mac Address      </span></td>
    </tr>
  
  
  
  
  <tr>
    <td width="122" height="15"></td>
    <td width="84"></td>
    <td></td>
    <td width="139"></td>
    <td width="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  <tr>
    <td height="24"></td>
    <td colspan="3" valign="top"><div align="right">
		  <?php
	if( $userid!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add user\"  class=\"BTN\" onclick=\"addUser()\">";
	}
	?>
      
      
    </div></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
   
  
  <?php 
  if($_SESSION['level']!="99" && $_SESSION['level']!="98" )
  {
  echo "</table>
</form>";
exit;
  }
  ?>
  <tr>
    <td height="21" colspan="9" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  
  <tr>
    <td height="46" colspan="9" valign="top">
	  <table width="100%" class="Black_Header_Text" border="0" cellspacing="0">
	    <!--DWLayoutTable-->
	    <tr><td width="31" height="23"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="78" valign="top">LOGIN ID</td>
            <td width="177" valign="top">USERNAME</td>
            <td width="202" valign="top">ACCOUNT TYPE</td>
            <td width="120" valign="top">ACTION</td>
          </tr>
	    <tr>
	      <td height="2"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
	    </tr>
	    
	    
	    
	    <?php
		if($_SESSION['level']=="98")
		{
			$rs=@mysql_query("select * from ".$pref."user where `level`='98' or `level`='97' ");
		}else if($_SESSION['level']=="99")
		{
			$rs=@mysql_query("select * from ".$pref."user");
		}
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$data=@mysql_fetch_array($rs);
					if($data[4]=='99')
					{
						$rsdup=mysql_query("select * from ".$pref."user where `level`='99'");
						if($rsdup)
						{
							$numdup=mysql_num_rows($rsdup);
							if($numdup>1)
							{
								$del="<a href=\"#\" onclick=\"delPage('users.php','content','userid=$data[0]&del=99')\">Delete</a>";
							}else
							{
								$del="Delete";
	
							}
						}
					}else
					{
						$del="<a href=\"#\" onclick=\"delPage('users.php','content','userid=$data[0]&del=99')\">Delete</a>";
					}
					
						if($data[4]=='99')
						{
							$acctype="Root";
						}
						else if( @$data[4]=="98")
						{
							$acctype="Administrator";
						}else if( @$data[4]=="97")
						{
							$acctype="Administrator";
						}else if( @$data[4]=="96")
						{
							$acctype="User";
						}else if( @$data[4]=="95")
						{
							$acctype="Guest";
						}
					
					if(@$color=="#ABD8DA")
					{
						$color="#FFFFFF";
						$fcolor="#000000";
					}else
					{
						$color="#ABD8DA";
						$fcolor="#000000";
					}	
					if(@$data[7]=="0")	
					{
						$color="#FF0000";
					}		
					echo "
					<tr bgcolor=\"$color\"><td>".($x+1)."</td><td><font color=\"$fcolor\">$data[1]</font></td><td><font color=\"$fcolor\">$data[3]</a></td>
					<td><font color=\"$fcolor\">$acctype</a></td>
					<td><a href=\"#\" onclick=\"getPage('users.php','content','userid=$data[0]')\">Edit</a> | $del</td>
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    </tr>
</table>
</form>
</body>

