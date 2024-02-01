<?php
	$database=$_GET['database'];
	$id=$_GET['id'];
	$field=$_GET['field'];
	$IDfield=$_GET['idfield'];
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
	$rs=mysql_query("select `$field` from `$database` where `$IDfield`='$id'");
	if($rs)
	{
		$rows=mysql_num_rows($rs);
		if($rows>0)
		{
			$dat=mysql_fetch_array($rs);
			echo $dat[0];
		}		
	}	
?>