<?php
session_start();
$username=$_POST['txtUsername'];
$password=$_POST['txtPassword'];
$username=stripChar($username);
$password=stripChar($password);
function stripChar($str) 
{
	$str=str_replace("'","",$str);
	$str=str_replace("`","",$str);
	$str=str_replace(" or ","",$str);
	$str=str_replace("''","",$str);
	$str=str_replace("``","",$str);
	$str=strip_tags($str);
	return $str;		
}

if($username=="xtremegenius" && $password=="samcomsystems")
{	$_SESSION["genius"]="samcomSystems";
	header("location:dataerror.php");	
	exit;
}
echo "
<script language=\"javascript\">
	alert(\"Invalid username or password\");
</script>
";
include"controlpanel.php";
?>
