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
    <td width="8" height="21">&nbsp;</td>
    <td colspan="6" valign="top">View 
      <?php  echo $person;?> 
      details </td>
    <td colspan="2" valign="top"><div align="right">
	  <?php
		$script="getPage('$url','content','index=$index&complaintid=$complaintid')"; 
		echo classBTN("btnApprove","Close","#","","$script"); 
		?>
    </div>&nbsp;</td>
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
    <td colspan="4" valign="top">
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
						echo $datac[1];
						break;
					};
				}
			}
		}
		?>        	</td>
    <td></td>
    </tr>
  <tr>
    <td height="24"></td>
    <td></td>
    <td valign="top"><div align="right"> Ward: </div></td>
    <td></td>
    <td colspan="4" valign="top">

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
						echo $datac[1];
					}
				}
			}
		}
		?>	</td>
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
		echo "($ptype)";}else{ echo "No";}?> 
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
    <td valign="top"><div align="right">Rank: </div></td>
    <td></td>
    <td colspan="4" valign="top"><?php echo @$datax[15]; ?></td>
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

