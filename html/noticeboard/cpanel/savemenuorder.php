<?php
	include "conn.php";	
	$ZOrder=@$_POST['txtZOrder'];
	$category=@$_POST['category'];
	$level=@$_POST['level'];
	$parentm=@$_POST['parentm'];
	$parent=@$_POST['parent'];
	$menuid=@$_POST['menuid'];
	$mnuid=@$_POST['mnuid'];	
	
	if($ZOrder!="")
	{
		
		$temp= array();
		$ZOrder=str_replace("!~~!!~~!","!~~!",$ZOrder);
		$temp=explode("!~~!",$ZOrder);
		for($x=0;$x<sizeof($temp);$x++)
		{
			if(trim($temp[$x])!="")
			{
				$temp[$x]=trim($temp[$x]);
				$temp1= array();
				$temp1=explode("=",$temp[$x]);
				$query="update ".$pref."menu set ZOrder='$temp1[1]' where `mnuid`='$temp1[0]'";
				mysql_query($query);			
			}
		}

	}
	
	header("location:menuitems.php?category=$category&menuid=$menuid&sessid=smetsysmocmas&level=$level&parent=$parent&parentm=$parentm&level=$level");	
?>