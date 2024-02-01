<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
$complaintid=@$_GET["complaintid"];
$nationalID=@$_GET["nationalID"];
$index=@$_GET["index"];
$field=@$_GET["fld"];
$datax21=@$_GET["txtDat21"];echo $datax21;
if(@$_GET["personsid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from ".$pref."persons where `personsid`='".@$_GET['personsid']."'");
	}else
	{
		$rs=@mysql_query("select * from ".$pref."persons where `personsid`='".@$_GET['personsid']."'");
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
$person="Complainant";
 if(@$_GET['fld']=="2"){$person="Complainant";}elseif(@$_GET['fld']=="3"){$person="Defedant";}elseif(@$_GET['fld']=="4"){$person="Witness";}
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	function saveUser()
	{	
			if (document.frmUsers.txtDat1.value=="" )
			{
				alert("Enter valid persons");
			}
			else
			{
				//save user
				document.frmUsers.submit()				
			}
	}
	
		function isPolice(value)
		{
			var txt13=document.getElementById("txtDat13");
			var txt14=document.getElementById("txtDat14");
			var txt15=document.getElementById("txtDat15");
			var txt16=document.getElementById("txtDat16");
			var txt1=document.getElementById("txtDat1");
			if(value=='Yes')
			{
				txt13.readOnly=true;
				txt13.style.backgroundColor='#CCCCCC';
				txt13.value="-";
				txt1.readOnly=true;
				txt1.style.backgroundColor='#CCCCCC';
				txt1.value="-";
								
				txt14.readOnly=false;
				txt14.style.backgroundColor='#FFFFFF';
				//txt14.value="";
				txt15.readOnly=false;
				txt15.style.backgroundColor='#FFFFFF';
				//txt15.value="";
				txt16.readOnly=false;
				txt16.style.backgroundColor='#FFFFFF';
				//txt16.value="";
				
			}else
			{
				txt13.readOnly=false;
				txt13.style.backgroundColor='#FFFFFF';
				txt13.value="";
				txt1.readOnly=false;
				txt1.style.backgroundColor='#FFFFFF';
				//txt1.value="";
								
				txt14.readOnly=true;
				txt14.style.backgroundColor='#CCCCCC';
				txt14.value="-";
				txt15.readOnly=true;
				txt15.style.backgroundColor='#CCCCCC';
				txt15.value="-";
				txt16.readOnly=true;
				txt16.style.backgroundColor='#CCCCCC';
				txt16.value="-";
			}
			
		}
		function dispPType(flag)
		{
			var trPT1=document.getElementById("trPType1");
			var trPT2=document.getElementById("trPType2");
			if(Number(flag)==0)
			{
				trPT1.style.display="none";
				trPT2.style.display="none";
			}else
			{
				trPT1.style.display="block";
				trPT2.style.display="block";
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
<body onLoad="<?php if((int)$field==3){echo "isPolice('Yes');dispPType(1)";}else{echo "isPolice('No');dispPType(0)";}?>">
<form action="savepersons.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="8" valign="top">Add <?php  echo $person;?></td>
    <td width="23">&nbsp;</td>
    </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="47"></td>
    <td width="166"></td>
    <td width="10"></td>
    <td width="83"></td>
    <td width="54"></td>
    <td width="178"></td>
    <td width="149"></td>
    <td width="21"></td>
    <td></td>
    </tr>
  <tr>
    <td height="25"></td>
    <td colspan="2" valign="top"><div align="right">National ID N<u>o</u> / Passport N<u>o</u> :</div></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top"><input name="txtDat1" type="text" class="STR1" id="txtDat1" value="<?php if(@$datax[1]!=""){echo @$datax[1];}else{ if($field!=3){echo @$nationalID;}}?>"  />
      <input name="personsid" type="hidden" id="personsid"  value="<?php echo @$datax[0]; ?>"/>
      <input name="fld" type="hidden" id="fld"  value="<?php echo @$field; ?>"/>
      <input name="index" type="hidden" id="index"  value="<?php echo @$index; ?>"/>
      <input name="complaintid" type="hidden" id="complaintid"  value="<?php echo @$complaintid; ?>"/></td>
    <td colspan="3" rowspan="6" valign="middle">
	<div align="center"><img src="<?php if(@$datax[0]!="")
		  	{
				if(is_file("../".$datax[19]))
				{
		  			echo "../".$datax[19];
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../".$datax[19];
		  	}
		  else
		  	{
		  		echo "../../staff/photo/avator.png";
				$pic="../../staff/photo/avator.png";
			}
		  ?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,124); ?>" width="<?php echo getPicW($pic,124); ?>"  />		</div>	</td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Title</div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat2" type="text" class="STR1" id="txtDat2" style="width:300px;" value="<?php echo @$datax[2]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Surname:</div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat3" type="text" class="STR1" id="txtDat3" style="width:300px;" value="<?php echo @$datax[3]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Firstname: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat4" type="text" class="STR1" id="txtDat4" style="width:300px;" value="<?php echo @$datax[4]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Lastname: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat5" type="text" class="STR1" id="txtDat5" style="width:300px;" value="<?php echo @$datax[5]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Address: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat6" type="text" class="STR1" id="txtDat6" style="width:200px;" value="<?php echo @$datax[6]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Mobile: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat7" type="text" class="STR1" id="txtDat7" style="width:300px;" value="<?php echo @$datax[7]; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Email: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat8" type="text" class="STR1" id="txtDat8" style="width:300px;" value="<?php echo @$datax[8]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">County: </div></td>
    <td></td>
    <td colspan="4" valign="top">
	  <select name="txtDat9" id="txtDat9">
	    <?php
		$rs=@mysql_query("select * from ".$pref."county order by `county` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$datac=mysql_fetch_array($rs);
					if($datac[1]==@$datax[9])
					{
						$selected="selected=\"selected\"";
					}else
					{
						$selected="";
					}
					echo "<option value=\"$datac[1]\" $selected >$datac[1]</option>\n";
				}
			}
		}
		?>
        </select>	</td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right"> Ward: </div></td>
    <td></td>
    <td colspan="4" valign="top">
	  <select name="txtDat10" id="txtDat10">
	    <?php
		$rs=@mysql_query("select * from ".$pref."pward order by `ward` asc");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				for($x=0;$x<$counts;$x++)
				{
					$datac=mysql_fetch_array($rs);
					if($datac[1]==@$datax[10])
					{
						$selected="selected=\"selected\"";
					}else
					{
						$selected="";
					}
					echo "<option value=\"$datac[1]\" $selected >$datac[1]</option>\n";
				}
			}
		}
		?>
        </select>	</td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Gender: </div></td>
    <td></td>
    <td colspan="4" valign="top">
	  <select name="txtDat11" id="txtDat11">
	    <option value="Male" <?php if(@$datax[11]=="Male"){	echo "selected=\"selected\"";}?>>Male</option>
	    <option value="Female" <?php if(@$datax[11]=="Female"){	echo "selected=\"selected\"";}?>>Female</option>
        </select>	  </td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td valign="top"><div align="right">In Police service? : </div></td>
    <td></td>
    <td valign="top">
	  <div align="left">
	    <script language="javascript">
	  
	  </script>
	    <?php if((int)$field!=3){?>
	    <input name="txtDat12" type="radio" class="STR1" id="txtDat12" value="No" <?php if((int)$field!=3){echo "checked=\"checked\"";}?>   <?php if(@$datax[12]=="No"){	echo "checked=\"checked\"";}?> onClick="isPolice('No');dispPType(0)" /> 
	    No	<?php }?>
      </div></td>
    <td colspan="3" valign="top"><div align="left">
          <input name="txtDat12" type="radio" class="STR1" id="txtDat11" <?php if((int)$field==3){echo "checked=\"checked\"";}?>  value="Yes"  <?php if(@$datax[12]=="Yes"){	echo "checked=\"checked\"";}?>  onclick="isPolice('Yes');dispPType(1)" /> 
      Yes
      </div></td>
    <td></td>
    <td></td>
    </tr>
  <tr  >
    <td height="23"></td>
    <td></td>
    <td valign="top"><div align="right" id="trPType1">Police category: </div></td>
    <td></td>
    <td colspan="4" valign="top">
        
        <div align="left" id="trPType2">
          <input name="txtDat21" type="radio" value="AP" <?php if(@$datax21!=""){$datax[21]=$datax21;} if(@$datax[21]=="AP"){echo "checked=\"checked\"";}?>>
          Administration Police 
          <input name="txtDat21" type="radio" value="KP" <?php if(@$datax[21]=="KP"){echo "checked=\"checked\"";}?>>
          Kenya Police
          <input name="txtDat21" type="radio" value="unkown" <?php if(@$datax[21]=="" || @$datax[21]=="unkown" ){echo "checked=\"checked\"";}?>>
      Unknown</div></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Job details: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat13" type="text" class="STR1" id="txtDat13" style="width:300px;" value="<?php echo @$datax[13]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Station: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat14" type="text" class="STR1" id="txtDat14" style="width:300px;" value="<?php echo @$datax[14]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Rank: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat15" type="text" class="STR1" id="txtDat15" style="width:300px;" value="<?php echo @$datax[15]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Police force number : </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat16" type="text" class="STR1" id="txtDat16" style="width:300px;" value="<?php if(@$datax[16]!=""){echo @$datax[16];}else{if($field==3){echo @$nationalID;}} ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Held in custody: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat17" type="text" class="STR1" id="txtDat17" style="width:300px;" value="<?php echo @$datax[17]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Custody station: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat18" type="text" class="STR1" id="txtDat18" style="width:300px;" value="<?php echo @$datax[18]; ?>" /></td>
    <td></td>
    <td></td>
    </tr>
    <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Photo</div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat19" type="file" id="txtDat19" /></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="11"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><?php
	if( @$_GET["personsid"]!="")
	{
		echo "<input type=\"button\" name=\"edit\" value=\"Save Changes\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	else
	{
		echo "<input type=\"button\" name=\"add\" value=\"Add new $person\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td colspan="2" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('contact.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
</body>

