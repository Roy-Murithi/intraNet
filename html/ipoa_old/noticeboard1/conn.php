<?	
include "config.php";
$con=NULL;

$con=@mysql_connect("",$username,$password);
if ($con)
{
	//$conn=mysql_select_db("foscience");
	$conn=@mysql_select_db($db);
	if(!$conn)
	{
		echo "<b>Error connecting database</b><br />Email: <b>sam2002com@gmail.com, sam2002com@yahoo.com, samuel.muturi@ipoa.go.ke</b> for assistance";
		exit;
	}
}
?>