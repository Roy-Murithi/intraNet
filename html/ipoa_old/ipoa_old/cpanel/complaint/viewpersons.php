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
$represented=@$_GET["represented"];
$index=@$_GET["index"];
$field=@$_GET["fld"];
if(@$_GET['url']!="")
{
$url=@$_GET['url'] . ".php";
}
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
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="savepersons.php" method="post" enctype="multipart/form-data" name="frmUsers">
<input type="hidden" name="index" value="<?php echo @$_GET['index'];?>" />
<table width="739" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="8" height="20"></td>
    <td colspan="6" valign="top">View 
      <?php  echo $person;?> 
      details (Editing by Complaints officers) </td>
    <td colspan="2" rowspan="2" valign="top"><div align="right">
	  <?php
		$script="getPage('$url','content','index=$index&complaintid=$complaintid')"; 
		echo classBTN("btnApprove","Close","#","","$script"); 
		?>
    </div> </td>
    </tr>
  <tr>
    <td height="16"></td>
    <td colspan="6" valign="top"><?php 
		if($represented=="")
		{
			if(@$datax[22]!="")
			{
				$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='$datax[22]'");
				if($rs1)
				{
					$counts1=@mysql_num_rows($rs1);
					if ($counts1>0)
					{
						$dataz=@mysql_fetch_array($rs1);
						$onbehalfname="<a  href=\"viewpersons.php?personsid=$dataz[0]&complaintid=$complaintid&sessid=smetsysmocmas&index=$index&url=". @$_GET['url'] ."&represented=$datax[0]\">$dataz[2]. $dataz[3] $dataz[4] $dataz[5]</a>" ;
						echo "This is a complainant on behalf of ($onbehalfname)";
					}
				}
			}
		}else
		{
			
			$rs1=@mysql_query("select * from ".$pref."persons where `personsid`='$represented'");
			if($rs1)
			{
				$counts1=@mysql_num_rows($rs1);
				if ($counts1>0)
				{
					$dataz=@mysql_fetch_array($rs1);
					$onbehalfname="<a  href=\"viewpersons.php?personsid=$dataz[0]&complaintid=$complaintid&sessid=smetsysmocmas&index=$index&url=". @$_GET['url'] ."\">$dataz[2]. $dataz[3] $dataz[4] $dataz[5]</a>" ;
					echo "This complainant is represented by ($onbehalfname)";
				}
			}
		}
	  ?></td>
    </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="8" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="1"></td>
    <td width="47"></td>
    <td width="166"></td>
    <td width="10"></td>
    <td width="137"></td>
    <td width="178"></td>
    <td width="14"></td>
    <td width="135"></td>
    <td width="44"></td>
    </tr>
  <tr>
    <td height="25"></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right">National ID Number  :</div></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><?php if(@$datax[1]!=""){echo @$datax[1];}else{echo @$nationalID;} ?>      </td>
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
    <td colspan="2" valign="top"><?php echo @$datax[2]; ?></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Surname:</div></td>
    <td></td>
    <td colspan="2" valign="top"><?php echo @$datax[3]; ?></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Firstname: </div></td>
    <td></td>
    <td colspan="2" valign="top"><?php echo @$datax[4]; ?></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Lastname: </div></td>
    <td></td>
    <td colspan="2" valign="top"><?php echo @$datax[5]; ?></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Address: </div></td>
    <td></td>
    <td colspan="2" valign="top"><?php echo @$datax[6]; ?></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Mobile: </div></td>
    <td></td>
    <td colspan="2" valign="top"><?php echo @$datax[7]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Email: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[8]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">County: </div></td>
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
    </select></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Gender: </div></td>
    <td></td>
    <td colspan="4" valign="top">
	  <?php echo @$datax[11];?>        	  </td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Officer: </div></td>
    <td></td>
    <td colspan="4" valign="top">      
	  <div align="left">
	    <?php if(@$datax[12]=="Yes"){ echo "Yes";if(@$datax[21]=="AP" ){ $ptype="Administration Police";}elseif(@$datax[21]=="KP"){  $ptype="Kenya Police";}else{$ptype="unkown";}
		echo "($ptype)";}else{ echo "No";}
		
		?> 
      </div></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Job details: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[13]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Station: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[14]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">County/Division/Post: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[10]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Rank: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[15]; ?></td>
    <td></td>
    </tr>
<tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Administrative Office: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[24]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Personal No: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[16]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Held in custody: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[17]; ?></td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right">Custody station: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[18]; ?></td>
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
    </tr>
    
  
  <tr>
    <td height="22"></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td colspan="3" valign="top">
	<div align="right">
	  <?php
		$script="getPage('$url','content','index=$index&complaintid=$complaintid')"; 
		echo classBTN("btnApprove","Close","#","","$script"); 
		?>
    </div>	</td>
    <td></td>
    </tr>
</table>
</form>

