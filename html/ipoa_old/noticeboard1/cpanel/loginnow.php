<?php
session_start();
include "conn.php";
include "globalfunc.php";
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



$query="select * from ".$pref."user where username='$username'";
$rs=@mysql_query($query);
if($rs)
{
	$row=@mysql_num_rows($rs);
	if($row>0)
	{
		$data=@mysql_fetch_array($rs);
		
		if($data[2]==crypt($password,"samcom"))
		{	
			
			if($data[4]!="99")
			{
				if($data[8]!="" && $data[9]=="99")
				{
					//fetch macc address from remote computer
					$remoteMacAddr=getMac();
					
					//compare the macc
					if(strtolower($remoteMacAddr)!=strtolower($data[8]))
					{
						echo "
<script language=\"javascript\">
	alert(\"This computer is not authorized to connect to this website\");
	document.location=\"../index.php\";
</script>
";exit;
					}
				}
				if($data[7]=="0")
					{
						echo "
<script language=\"javascript\">
	alert(\"This account is disabled, please contact the system administrator\");
	document.location=\"../index.php\";
</script>
";exit;
					}
			}	
			$_SESSION['loggedIn']='99';
			$_SESSION['user']=$username;
			$_SESSION['userid']=$data[0];
			$_SESSION['level']=$data[4];
			$_SESSION['scope']=$data[5];
			$_SESSION['faculty']=$data[6];
			$_SESSION['names']=$data[3];
			header("location:mainpage.php");			
			exit;
			
		}
	}
}
echo "
<script language=\"javascript\">
	alert(\"Invalid username or password\");
</script>
";
include"controlpanel.php";
?>
