<?php
session_start();
include "conn1.php";
function fetchRecordCountx($dbase,$unique,$unique_value)
{
	if(@$_SESSION['member']=="99")
	{
		$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value' and personid='". $_SESSION['userid']."'");
	}else
	{
		$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value'");
	}
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
function fetchRecordCount2($dbase)
{
	$rs1=@mysql_query("select * from  $dbase");
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
if(@$_GET['sessid']=='smetsysmocmas')
{	
echo "counter1!~!". fetchRecordCountx("support","resolved","") . "!~~!";
echo "counter2!~!". fetchRecordCountx("support","resolved","99") . "!~~!";
echo "counter3!~!". fetchRecordCountx("support","resolved","") . "!~~!";
echo "counter4!~!". fetchRecordCountx("support","resolved","99") . "!~~!";
}
?>