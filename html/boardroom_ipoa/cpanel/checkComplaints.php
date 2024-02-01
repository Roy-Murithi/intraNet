<?php
include "conn1.php";
function fetchRecordCount1($dbase,$unique,$unique_value)
{
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value'");
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
echo "counter1!~!". fetchRecordCount1($pref."complaint","uneditable",97) . "!~~!";
echo "counter2!~!". fetchRecordCount1($pref."complaint","uneditable",94) . "!~~!";
echo "counter3!~!". fetchRecordCount1($pref."complaint","uneditable",96) . "!~~!";
echo "counter4!~!". fetchRecordCount1($pref."complaint","uneditable",95) . "!~~!";
echo "counter5!~!". fetchRecordCount1($pref."complaint","uneditable",94) . "!~~!";
echo "counter6!~!". fetchRecordCount1($pref."complaint","uneditable",93) . "!~~!";
echo "counter7!~!". fetchRecordCount1($pref."complaint","uneditable",98) . "!~~!";
echo "counter8!~!". fetchRecordCount1($pref."complaint","uneditable",99) . "!~~!";
echo "counter9!~!". fetchRecordCount1($pref."complaint","uneditable",0) . "!~~!";
echo "counter10!~!". fetchRecordCount1($pref."complaint","uneditable",92) . "!~~!";
echo "counter11!~!". fetchRecordCount1($pref."complaint","uneditable",93) . "!~~!";
echo "counter12!~!". fetchRecordCount2($pref."archive") . "!~~!";
}
?>