<?php	
include "../../config.php";

$con=NULL;

$con=@mysql_connect("",$username,$password);
if ($con)
{
	//$conn=mysql_select_db("foscience");
	$conn=@mysql_select_db($db);
	if(!$conn)
	{
		echo "<b>Error connecting database</b><br />Contact the administrator";
		exit;
	}
}include "../../globalfunc.php";
?>