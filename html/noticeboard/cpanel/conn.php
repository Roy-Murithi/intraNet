<?	
include "../config.php";
$con=NULL;

$con=@mysql_connect("",$username,$password);
if ($con)
{
	//$conn=mysql_select_db("foscience");
	$conn=@mysql_select_db($db);
	if(!$conn)
	{
		echo "<b>Error Connecting To The Database</b><br />Email: <b>njeru.mwaniki@gmail.com or raphael.njeru@ipoa.go.ke</b> for assistance";
		exit;
	}
}
?>