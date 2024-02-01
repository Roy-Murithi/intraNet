<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$username=removeTag(@$_POST["txtUsername"]);
$password=crypt(@$_POST["txtPassword"],"samcom");
$names=removeTag(@$_POST["txtNames"]);
$userid=@$_POST["txtUserid"];
$level=@$_POST["txtLevel"];
$Scope=@$_POST["txtScope"];
$status=@$_POST["txtStatus"];
$mac=@$_POST["txtMacAddress"];
$option=@$_POST["chkMac"];

$Faculty="All";
if ($Scope=="" || $Scope=="")
{
	$Scope="Global";
	$Faculty="All";
}else
{

}
$newPass="";
if(@$_POST["txtPassword"]!="")
{
	$newPass="`password`='$password',";
}
if($userid!="" && $userid!="undefined" && $userid!=NULL)
{
	$query="update ".$pref."user set 
	`username`='$username',
	$newPass
	`names`='$names',
	`level`='$level',
	`scope`='$Scope',
	`faculty`='$Faculty',
	`status`='$status',
	`MacAddress`='$mac',
	`MacOptions`='$option'
	where `userid`='$userid'";
	$rs=@mysql_query($query);
}
else
{
					if($level=='98')
					{
						$rsdup=mysql_query("select * from ".$pref."user where `level`='98'");
						if($rsdup)
						{
							$numdup=mysql_num_rows($rsdup);
							if($numdup>0)
							{
								?>
			<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	alert("System cannot add new 'Senate root' account, it must be one account at all times");
	getPage("users.php","content","");
</script>
</html>
			<?php
			exit;
							}
						}
}
	$rs1=@mysql_query("select * from ".$pref."user where `username`='$username'");
	if ($rs1)
	{
		$dupx=@mysql_num_rows($rs1);
		if ($dupx>0)
		{
			?>
			<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	alert("Duplicate Username, please user another username");
	getPage("users.php","content","");
</script>
</html>
			<?php
			exit;
		}
	}
	$rs=@mysql_query("select * from ".$pref."user");
	if($rs)
	{
		$counts=@@mysql_num_rows($rs);
	}
	do
	{
			$counts=@$counts+1;
			$useridx="USR-00".$counts;
			$rs1=@mysql_query("select * from ".$pref."user where `userid`='$useridx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
	}while($dup!=0);

	$query="insert into ".$pref."user values('$useridx','$username','$password','$names','$level','$Scope','$Faculty','$status','$mac','$option')";
	
	$rs=@mysql_query($query);
}
?>
<html>
<script language="javascript" src="scripts/counterajax.js"></script>
<script language="javascript">
	getPage("users.php","content","");
</script>
</html>
