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
$represented=@$_GET["represented"];
$nationalID=@$_GET["nationalID"];
$index=@$_GET["index"];
$field=@$_GET["fld"];
$datax21=@$_GET["txtDat21"];
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
				if($datax[23]!="")
				{
					$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='".@$datax[0]."'");
					if($rs1)
					{
						$counts1=@mysql_num_rows($rs1);
						if ($counts1>0)
						{
							$dataz=@mysql_fetch_array($rs1);
							$represented=$dataz[0];						
						}
					}
				}			

			}
		}
	}
}
$represented_names="";
if($represented!="")
{
	if(@$datax[22]!="")
	{
		$rs1=@mysql_query("select * from ".$pref."persons where `onbehalfof`='$represented'");
	}else
	{
		$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='$represented'");
	}
	if($rs1)
	{
		$counts1=@mysql_num_rows($rs1);
		if ($counts1>0)
		{
			$dataz=@mysql_fetch_array($rs1);
			$represented_names="<a  href=\"persons.php?personsid=$dataz[0]&complaintid=$complaintid&sessid=smetsysmocmas&index=$index&fld=$field\">$dataz[2]. $dataz[9] $dataz[4] $dataz[5]</a>" ;
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
			if (document.frmUsers.txtDat3.value==""  && document.frmUsers.txtDat4.value=="" && document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid person details, you must provide atleast one name");
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
			var txt24=document.getElementById("txtDat24");
			var txt10=document.getElementById("txtDat10");
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
				
				txt24.readOnly=false;
				txt24.style.backgroundColor='#FFFFFF';
				//txt40.value="";
				
				txt10.readOnly=false;
				txt10.style.backgroundColor='#FFFFFF';
				//txt10.value="";
				
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
				
				txt24.readOnly=true;
				txt24.style.backgroundColor='#CCCCCC';
				txt24.value="-";
				
				txt10.readOnly=true;
				txt10.style.backgroundColor='#CCCCCC';
				txt10.value="-";
				
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
		function onBehalf(flag)
		{
			
			var txtDat17=document.getElementById("txtDat17");
			var txtDat18=document.getElementById("txtDat18");
			if(flag=="1")
			{
				txtDat17.value="No";
				txtDat18.value="N/A";
				txtDat17.readOnly=true;
				txtDat18.readOnly=true;
			}else
			{
				txtDat17.value="";
				txtDat18.value="";
				txtDat17.readOnly=false;
				txtDat18.readOnly=false;
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
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>"  />
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="21">&nbsp;</td>
    <td colspan="8" valign="top">Add <?php if(@$represented!=""){echo " represented ";}  echo $person; if(@$represented!=""){echo " (Represented by $represented_names) ";} ?></td>
    <td width="23">&nbsp;</td>
    </tr>
  <tr>
    <td height="5"></td>
    <td colspan="9" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="19"></td>
    <td width="47">&nbsp;</td>
    <td width="166">&nbsp;</td>
    <td width="10"></td>
    <td colspan="2" valign="top">
	<?php

	if($person=="Complainant" && $represented=="")
	{	
	?>
	<input name="onbehalf" type="radio" value="0" <?php if(@$datax[22]==""){echo "checked";}?> onClick="onBehalf(0)">
      Complainant
	  <?php
	 }
	  ?>	  </td>
    <td colspan="4" valign="top"><?php
	if($person=="Complainant" && $represented=="")
	{
	?><input name="onbehalf" type="radio" value="99" <?php if(@$datax[22]!=""){echo "checked";}?> onClick="onBehalf(1)">
      On behalf of <?php 
	  	if(@$datax[22]!="")
		{
			$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='$datax[22]'");
			if($rs1)
			{
				$counts1=@mysql_num_rows($rs1);
				if ($counts1>0)
				{
					$dataz=@mysql_fetch_array($rs1);
					$onbehalfname="<a  href=\"persons.php?personsid=$dataz[0]&complaintid=$complaintid&sessid=smetsysmocmas&index=$index&fld=$field\">$dataz[2]. $datax[9] $dataz[4] $dataz[5]</a>" ;
					echo "($onbehalfname)";
				}
			}
		}
	  
	  }
	  ?>
      <input name="represented" type="hidden" id="represented" value="<?php echo $represented; ?>"></td>
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
    <td valign="top"><div align="right">Surname/Entity Name:</div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat3" type="text" class="STR1" id="txtDat3" style="width:300px;" value="<?php echo @$datax[3]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">First Name: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat4" type="text" class="STR1" id="txtDat4" style="width:300px;" value="<?php echo @$datax[4]; ?>" /></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Middle Name: </div></td>
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
    <td valign="top"><div align="right">Mobile/Landline/Ext: </div></td>
    <td></td>
    <td colspan="3" valign="top"><input name="txtDat7" type="text" class="STR1" id="txtDat7" style="width:300px;" value="<?php echo @$datax[7]; ?>" /></td>
    <td width="149">&nbsp;</td>
    <td width="21">&nbsp;</td>
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
    <td valign="top"><div align="right">County Of Residence: </div></td>
    <td></td>
	  <td><select name="txtDat9" id="txtDat9">
      <option value="Baringo" <?php if(@$datax[9]=="Baringo"){echo "selected=\"selected\"";} ?>>Baringo</option>
      <option value="Bomet" <?php if(@$datax[9]=="Bomet"){echo "selected=\"selected\"";} ?>>Bomet</option>
      <option value="Bungoma" <?php if(@$datax[9]=="Bungoma"){echo "selected=\"selected\"";} ?>>Bungoma</option>
      <option value="Busia" <?php if(@$datax[9]=="Busia"){echo "selected=\"selected\"";} ?>>Busia</option>
	  <option value="Elgeyo Marakwet" <?php if(@$datax[9]=="Elgeyo Marakwet"){echo "selected=\"selected\"";} ?>>Elgeyo Marakwet</option>
	  <option value="Embu" <?php if(@$datax[9]=="Embu"){echo "selected=\"selected\"";} ?>>Embu</option>
	  <option value="Garissa" <?php if(@$datax[9]=="Garissa"){echo "selected=\"selected\"";} ?>>Garissa</option>
	  <option value="Homa Bay" <?php if(@$datax[9]=="Homa Bay"){echo "selected=\"selected\"";} ?>>Homa Bay</option>
	  <option value="Isiolo" <?php if(@$datax[9]=="Isiolo"){echo "selected=\"selected\"";} ?>>Isiolo</option>
	  <option value="Kajiado" <?php if(@$datax[9]=="Kajiado"){echo "selected=\"selected\"";} ?>>Kajiado</option>
	  <option value="Kakamega" <?php if(@$datax[9]=="Kakamega"){echo "selected=\"selected\"";} ?>>Kakamega</option>
	  <option value="Kericho" <?php if(@$datax[9]=="Kericho"){echo "selected=\"selected\"";} ?>>Kericho</option>
	  <option value="Kiambu" <?php if(@$datax[9]=="Kiambu"){echo "selected=\"selected\"";} ?>>Kiambu</option>
	  <option value="Kilifi" <?php if(@$datax[9]=="Kilifi"){echo "selected=\"selected\"";} ?>>Kilifi</option>
	  <option value="Kirinyaga" <?php if(@$datax[9]=="Kirinyaga"){echo "selected=\"selected\"";} ?>>Kirinyaga</option>
	  <option value="Kisii" <?php if(@$datax[9]=="Kisii"){echo "selected=\"selected\"";} ?>>Kisii</option>
	  <option value="Kisumu" <?php if(@$datax[9]=="Kisumu"){echo "selected=\"selected\"";} ?>>Kisumu</option>
	  <option value="Kitui" <?php if(@$datax[9]=="Kitui"){echo "selected=\"selected\"";} ?>>Kitui</option>
	  <option value="Kwale" <?php if(@$datax[9]=="Kwale"){echo "selected=\"selected\"";} ?>>Kwale</option>
	  <option value="Laikipia" <?php if(@$datax[9]=="Laikipia"){echo "selected=\"selected\"";} ?>>Laikipia</option>
	  <option value="Lamu" <?php if(@$datax[9]=="Lamu"){echo "selected=\"selected\"";} ?>>Lamu</option>
	  <option value="Machakos" <?php if(@$datax[9]=="Machakos"){echo "selected=\"selected\"";} ?>>Machakos</option>
	  <option value="Makueni" <?php if(@$datax[9]=="Makueni"){echo "selected=\"selected\"";} ?>>Makueni</option>
	  <option value="Mandera" <?php if(@$datax[9]=="Mandera"){echo "selected=\"selected\"";} ?>>Mandera</option>
	  <option value="Marsabit" <?php if(@$datax[9]=="Marsabit"){echo "selected=\"selected\"";} ?>>Marsabit</option>
	  <option value="Meru" <?php if(@$datax[9]=="Meru"){echo "selected=\"selected\"";} ?>>Meru</option>
	  <option value="Migori" <?php if(@$datax[9]=="Migori"){echo "selected=\"selected\"";} ?>>Migori</option>
	  <option value="Mombasa" <?php if(@$datax[9]=="Mombasa"){echo "selected=\"selected\"";} ?>>Mombasa</option>
	  <option value="Muranga" <?php if(@$datax[9]=="Muranga"){echo "selected=\"selected\"";} ?>>Muranga</option>
	  <option value="Nairobi City" <?php if(@$datax[9]=="Nairobi City"){echo "selected=\"selected\"";} ?>>Nairobi City</option>
	  <option value="Nakuru" <?php if(@$datax[9]=="Nakuru"){echo "selected=\"selected\"";} ?>>Nakuru</option>
	  <option value="Nandi" <?php if(@$datax[9]=="Nandi"){echo "selected=\"selected\"";} ?>>Nandi</option>
	  <option value="Narok" <?php if(@$datax[9]=="Narok"){echo "selected=\"selected\"";} ?>>Narok</option>
	  <option value="Nyamira" <?php if(@$datax[9]=="Nyamira"){echo "selected=\"selected\"";} ?>>Nyamira</option>
	  <option value="Nyandarua" <?php if(@$datax[9]=="Nyandarua"){echo "selected=\"selected\"";} ?>>Nyandarua</option>
	  <option value="Nyeri" <?php if(@$datax[9]=="Nyeri"){echo "selected=\"selected\"";} ?>>Nyeri</option>
	  <option value="Samburu" <?php if(@$datax[9]=="Samburu"){echo "selected=\"selected\"";} ?>>Samburu</option>
	  <option value="Siaya" <?php if(@$datax[9]=="Siaya"){echo "selected=\"selected\"";} ?>>Siaya</option>
	  <option value="Taita Taveta" <?php if(@$datax[9]=="Taita Taveta"){echo "selected=\"selected\"";} ?>>Taita Taveta</option>
	  <option value="Tana River" <?php if(@$datax[9]=="Tana River"){echo "selected=\"selected\"";} ?>>Tana River</option>
	  <option value="Tharaka-Nithi" <?php if(@$datax[9]=="Tharaka-Nithi"){echo "selected=\"selected\"";} ?>>Tharaka-Nithi</option>
	  <option value="Trans Nzioa" <?php if(@$datax[9]=="Trans Nzioa"){echo "selected=\"selected\"";} ?>>Trans Nzioa</option>
	  <option value="Turkana" <?php if(@$datax[9]=="Turkana"){echo "selected=\"selected\"";} ?>>Turkana</option>
	  <option value="Uasin Gishu" <?php if(@$datax[9]=="Uasin Gishu"){echo "selected=\"selected\"";} ?>>Uasin Gishu</option>
	  <option value="Unknown" <?php if(@$datax[9]=="Unknown"){echo "selected=\"selected\"";} ?>>Unknown</option>
	  <option value="Vihiga" <?php if(@$datax[9]=="Vihiga" || @$datax[9]==""){echo "selected=\"selected\"";} ?>>Vihiga</option>
	  <option value="Wajir" <?php if(@$datax[9]=="Wajir"){echo "selected=\"selected\"";} ?>>Wajir</option>
	  <option value="West Pokot" <?php if(@$dataz[3]=="West Pokot"){echo "selected=\"selected\"";} ?>>West Pokot</option>
    </select></td>
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
	    <option value="N/A" <?php if(@$datax[11]=="N/A"){ echo "selected=\"selected\"";}?>>N/A</option>
		<option value="Unknown" <?php if(@$datax[11]=="Unknown"){ echo "selected=\"selected\"";}?>>Unknown</option>
        </select>	  </td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="23"></td>
    <td></td>
    <td valign="top"><div align="right">In Police service? : </div></td>
    <td></td>
    <td width="83" valign="top">
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
	<input name="txtDat21" type="radio" value="DCI" <?php if(@$datax[21]=="DCI"){echo "checked=\"checked\"";}?>>
          DCI
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
    <td valign="top"><div align="right">County/Division/Post: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat10" type="text" class="STR1" id="txtDat10" style="width:300px;" value="<?php echo @$datax[10]; ?>" /></td>
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
    <td valign="top"><div align="right">Administrative Office: </div></td>
    <td></td>
    <td colspan="4" valign="top"><input name="txtDat24" type="text" class="STR1" id="txtDat24" style="width:300px;" value="<?php echo @$datax[24]; ?>" /></td>
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
    <td valign="top"><div align="right">Custody station/Post/Camp: </div></td>
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
    <td height="18"></td>
    <td></td>
    <td valign="top"><?php  if($represented!=""){?><div align="right">Reason for Representation </div><?php }?></td>
    <td></td>
    <td colspan="6" valign="top"><?php  if($represented!=""){?><input name="txtDat23" type="text" class="STR1" id="txtDat23" style="width:300px;" value="<?php echo @$datax[23]; ?>">
      <?php }?></td>
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
		echo "<input type=\"button\" name=\"add\" value=\"Save $person\"  class=\"BTN\" onclick=\"saveUser()\">";
	}
	?></td>
    <td colspan="2" valign="top"><input name="Button2" type="button" class="BTN" value="Cancel" style="width:100px;" onClick="getPage('complaintdetails.php','content','index=<?php echo $index;?>&complaintid=<?php echo $complaintid;?>')"  /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="1"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td width="54"></td>
    <td width="178"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
</body>

