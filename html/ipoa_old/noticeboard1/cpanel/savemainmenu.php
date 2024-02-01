<?php
	include "conn.php";

	$dat1=@$_POST['txtDat1'];
	$dat1a=@$_POST['txtDat1a'];
	$dat2=@$_POST['txtDat2'];
	$category=@$_POST['category'];
	$menuid=@$_POST['menuid'];
	$parent=@$_POST['parent'];
	$level=@$_POST['level'];
	if($dat1a!="")
	{
		
		$temp= array();
		$dat1a=str_replace("!~~!!~~!","!~~!",$dat1a);
		$temp=explode("!~~!",$dat1a);
		for($x=0;$x<sizeof($temp);$x++)
		{
			
			if(trim($temp[$x])!="")
			{
				$pageid=trim($temp[$x]);
				$query="select * from ".$pref."page where `pageid`='$pageid'";
				
				$rsPage=mysql_query($query);
				if($rsPage)
				{
					$rpage=mysql_num_rows($rsPage);
					if($rpage>0)
					{
						$pdata=mysql_fetch_array($rsPage);
						$dat1=$pdata[1];
						if($pdata[4]=="")
						{
							$dat2="pg_template1.php?pageid=$pageid";
						}else
						{
							$dat2="$pdata[4]?pageid=$pageid";
						}
						saveNewMenu($dat1,$dat1,$dat2,$menuid,$category,$pref);		
								
					}
				}
				
			}
		}

	}elseif($dat1!="")
	{
		saveNewMenu($dat1,$dat1,$dat2,$menuid,$category,$pref);
	}
	
	header("location:menu.php?category=$category&menuid=$menuid&sessid=smetsysmocmas&level=$level&parent=$parent");
	
	function saveNewMenu($dat1,$dat1,$dat2,$menuid,$category,$pref)
	{	
		$rs=@mysql_query("select * from ".$pref."menu");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
		}
		do
		{
				$counts=$counts+1;
				$menuidx="MNU-00".$counts;
				$rs1=@mysql_query("select * from ".$pref."menu where `mnuid`='$menuidx'");
				if ($rs1)
				{
					$dup=@mysql_num_rows($rs1);
				}else
				{
					$dup=0;
				}
		}while($dup!=0);
		$rs1=@mysql_query("select * from ".$pref."menu where `parentmenu`='$menuid'");
		if ($rs1)
		{
			$order=(int)mysql_num_rows($rs1)+1;
		}
		$query="insert into ".$pref."menu values ('$menuidx','$dat1','$dat1','$dat2','$menuid','$category','$order','0')";
		$rsMenu=mysql_query($query);
	}
?>