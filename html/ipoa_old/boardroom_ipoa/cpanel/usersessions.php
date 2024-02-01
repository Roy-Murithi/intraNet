<?php
session_start();
?>
<html>
<?php
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$names=@$_SESSION['names'];
$userid=@$_SESSION['userid'];
$meetingsid=@$_GET['meetingsid'];
$query="select * from `sessions` where `userid`='$userid'";
$rs=mysql_query($query);
//add my session
if($meetingsid!="")
{
if($rs)
{
	$rows=mysql_num_rows($rs);
	if($rows>0)
	{
		//updatemy time
		$timer=date("YmdHis");
		$query="update sessions set timer='$timer' where userid='$userid'";
		$rs=mysql_query($query);
	}else
	{
		//Add me to the list
		$rs=@mysql_query("select * from sessions");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
		}
		do
		{
				$counts=@$counts+1;
				$sessidx="sess-00".$counts;
				$rs1=@mysql_query("select * from sessions where `sessionsid`='$sessidx'");
				if ($rs1)
				{
					$dup=@mysql_num_rows($rs1);
				}else
				{
					$dup=0;
				}
		}while($dup!=0);
		$timer=date("YmdHis");
		$query="insert into sessions values('$sessidx','$meetingsid','$timer','$userid','$names','')";
		$rs=mysql_query($query);
		
	}
}
}
//kill those who are out
if($meetingsid!="")
{
	$query="select * from sessions where meetingsid='$meetingsid'";
}else
{
	$query="select * from sessions";
}
$rs=mysql_query($query);
if($rs)
{	
	$rows=mysql_num_rows($rs);
	if($rows>0)
	{
		for($x=0;$x<$rows;$x++)
		{
			$data=mysql_fetch_array($rs);
			$timer=date("YmdHis");
			$diff=$timer-$data[2];
			if((int)$diff>100) 
			{			
				$query="delete from sessions where sessionsid='$data[0]'";
				$rs2=mysql_query($query);
			}
		}
	}else
	{
		$query="delete from sessions where sessionsid='$userid'";
		$rs2=mysql_query($query);
	}
}


?>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="scripts/academicaffairs.js"></script>
<script language="javascript">
	function reloadPage()
	{
		document.location="usersessions.php?meetingsid=<?php echo $meetingsid; ?>";
	}
	function init()
	{
		setTimeout('reloadPage()',10000);
	}
</script>
</head>
<body onload="init()">
<?php

//list everyone now
echo "
<div style=\"width:200px;\"  class=\"Black_Header_Text\">";
if($meetingsid!="")
{
	$query="select * from sessions where meetingsid='$meetingsid'";
}else
{
	$query="select * from sessions";
}
$rs=mysql_query($query);
if($rs)
{	
	$rows=mysql_num_rows($rs);
	if($rows>0)
	{
		for($x=0;$x<$rows;$x++)
		{
			$data=mysql_fetch_array($rs);
			echo "
<div style=\"width:199px; float:left;\"> $data[4] </div>";			
			
		}
	}
}
echo"
</div>
";
?>
</body>
</html>

