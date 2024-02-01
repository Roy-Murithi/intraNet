<?php
include "conn.php";
$dat0=@$_POST['txtDat0'];
$dat1=@$_POST['txtDat1'];
$dat3=@$_POST['txtDat2'];
$category=@$_POST['category'];
$level=@$_POST['level'];
$parentm=@$_POST['parentm'];
$parent=@$_POST['parent'];
$urlparam=@$_POST['$urlparam'];
$urlparam="level=$level&parent=$parent&category=$category&parentm=$parentm";
$query="update `".$pref."menu` set `menu`='$dat1', `link`='$dat3',`level`='$level' where `mnuID`='$dat0'";
$rsMenu=mysql_query($query);
header("location:menuitems.php?$urlparam");
?>