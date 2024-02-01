<?php 
function saveFile($postinfor,$uniquefield,$uniqueID,$dpath,$table,$field)
{
	
	$ID=$uniqueID;
	
	$fileName = $_FILES[$postinfor]['name'];
	$tmpName = $_FILES[$postinfor]['tmp_name'];
	$fileSize = $_FILES[$postinfor]['size'];
	$fileType = $_FILES[$postinfor]['type'];
	
	$uploadDir="../".$dpath;
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = "../".$dpath.$ID.$fileName;	
	chmod($uploadDir,0777);
	$filePath1 = $dpath.$ID.$fileName;				
	$dat2=$filePath;
			
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);
	} 
			
	$fileP=strtoupper($filePath);
	if (strpos($fileP,".GIF")==strlen($fileP)-4 || strpos($fileP,".JPG")==strlen($fileP)-4 || strpos($fileP,".PNG")==strlen($fileP)-4 || strpos($fileP,".TFF")==strlen($fileP)-4)
	{
		if(file_exists($filePath)==TRUE)
		{
			//unlink($filepath);
		}				
		$result = move_uploaded_file($tmpName, $filePath);

			//echo "update $table set `$field`='$filePath1' where `$uniquefield`='$ID'";exit;
			if ($uniquefield !="")
			{		
				$rs=@mysql_query("update `$table` set `$field`='$filePath1' where `$uniquefield`='$ID'");
			}
		return "successfull";
	}	
	else
	{
		return "Invalid Image file";		
	}
}
function saveFileAll($postinfor,$uniquefield,$uniqueID,$dpath,$table,$field)
{
	
	$ID=$uniqueID;
	
	$fileName = $_FILES[$postinfor]['name'];
	$tmpName = $_FILES[$postinfor]['tmp_name'];
	$fileSize = $_FILES[$postinfor]['size'];
	$fileType = $_FILES[$postinfor]['type'];
	
	$uploadDir="../".$dpath;
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = "../".$dpath.$ID.$fileName;	
	chmod($uploadDir,0777);
	$filePath1 = $dpath.$ID.$fileName;				
	$dat2=$filePath;
			
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);
	} 
			
	$fileP=strtoupper($filePath);
		if(file_exists($filePath)==TRUE)
		{
			//unlink($filepath);
		}				
		$result = move_uploaded_file($tmpName, $filePath);
		

			//echo "update $table set `$field`='$filePath1' where `$uniquefield`='$ID'";exit;
			if ($uniquefield !="")
			{		
				$rs=@mysql_query("update `$table` set `$field`='$filePath1' where `$uniquefield`='$ID'");
			}
		return "successfull";
}

function getPicH($pic,$def)
{
	if(is_file($pic))
	{
		$temp=getimagesize($pic);
		if((int)$temp[1]==0)
		{
			return $def;
		}else
		{	if($temp[1]<$temp[0]){$s=($temp[1]/$temp[0])*$def;}else{$s=1*$def;}			
			return($s);
		}
	}
	else
	{
		return $def;
	}
}
function getPicW($pic,$def)
{
	if(is_file($pic))
	{
		$temp=getimagesize($pic);
		if((int)$temp[0]==0)
		{
			return $def;
		}else
		{
			if($temp[0]<$temp[1]){$s=($temp[0]/$temp[1])*$def;}else{$s=1*$def;}
			return($s);
		}
	}
	else
	{
		return $def;
	}
}
function fetchValue($dbase,$unique,$unique_value,$field)
{
	$value="";
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value'");
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
				if($rows>0)
				{
					$data=mysql_fetch_array($rs1);
					$value=$data[$field];
				}
			}
	return $value;
}
function classBTN($id,$value,$url,$param,$onclick)
{
	if($param!="")
	{
		$url="$url?$param";
	}
	$div="<a class=\"flink\" href=\"$url\" onClick=\"$onclick\"><div id=\"persons\" class=\"persons Black_Header_TextBTN\" style=\" border: thin solid #7Ba89A; margin:2px; float:left; padding-top:1px; padding-bottom:1px; padding-left:5px; padding-right:5px;\">$value</div></a>";
	return $div;
}
function classBTN1($id,$value,$url,$param,$onclick,$bordercolor)
{
	if($bordercolor=="")
	{
		$bordercolor="#7Ba89A";
	}
	if($param!="")
	{
		$url="$url?$param";
	}
	$div="<a class=\"flink\" href=\"$url\" onClick=\"$onclick\"><div id=\"persons\" class=\"persons Black_Header_TextBTN\" style=\" border: thin solid $bordercolor; margin:2px; float:left; padding-top:1px; padding-bottom:1px; padding-left:5px; padding-right:5px;\">$value</div></a>";
	return $div;
}
function fetchRecordCount($dbase,$unique,$unique_value)
{
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value'");
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
function fetchRecordCount1($dbase,$unique,$unique_value,$unique1,$unique_value1)
{
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value' and `$unique1`='$unique_value1' ");
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
function procLog($pref,$complaintid,$log,$action)
{
	
	if(@$_SESSION['names']!="")
	{
		$rs=@mysql_query("select * from ".$pref."user");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
		}
		do
		{
				$counts=@$counts+1;
				$proclogidx="LOG-00".$counts;
				$rs1=@mysql_query("select * from ".$pref."proclog where `proclogid`='$proclogidx'");
				if ($rs1)
				{
					$dup=@mysql_num_rows($rs1);
				}else
				{
					$dup=0;
				}
		}while($dup!=0);
		$date=date("d/m/Y H:i:s");
		$names=@$_SESSION['names'];
		$userid=@$_SESSION['userid'];
		
		$query="insert into ".$pref."proclog values('$proclogidx','$complaintid','$date','$log','$names','$userid','$action')";		
		$rs=@mysql_query($query);
	}else
	{
		
	}
}
function diff($start,$end = false) {
    // Checks $start and $end format (timestamp only for more simplicity and portability)
    if(!$end) { $end = time(); }
    if(!is_numeric($start) || !is_numeric($end)) { return false; }
    // Convert $start and $end into EN format (ISO 8601)
    $start  = date('Y-m-d H:i:s',$start);
    $end    = date('Y-m-d H:i:s',$end);
    $d_start    = new DateTime($start);
    $d_end      = new DateTime($end);
    $diff = $d_start->diff($d_end);
    // return all data
	$dur1="";
	$dur2="";
	$dur3="";
	$dur4="";
	$dur5="";
	$dur6="";
    $year    = $diff->format('%y');
	if((int)$year>0)
	{
		$dur1="Years:$year";
	}
    $month    = $diff->format('%m');
	if((int)$month>0)
	{
		$dur2="Months:$month";
	}
    $day      = $diff->format('%d');
	if((int)$day>0)
	{
		$dur3="Days:$day";
	}
    $hour     = $diff->format('%h');
	if((int)$hour>0)
	{
		$dur4="Hours:$hour";
	}
    $min      = $diff->format('%i');
	if((int)$min>0)
	{
		$dur5="Minutes:$min";
	}
    $sec      = $diff->format('%s');
	if((int)$sec>0)
	{
		$dur6="Seconds:$sec";
	}
    return "$dur1 $dur2 $dur3 $dur4 $dur5 $dur6";
} 
function getDuration($date,$date1,$flag)
{
 	$start  = strtotime($date);
	$end    = strtotime($date1);
	$durInfor=Diff($start,$end);
	return $durInfor;
}
function getUrgent($pref,$complaintid,$field,$dimensions)
{
		$isurgent=fetchValue($pref."complaint","complaintid",$complaintid,(int)$field);
		$data="";
		if((int)$isurgent==99)
		{
			$pic="../images/urgent.png";
			if(is_file($pic))
			{
				if((int)$dimensions==0){$dimensions=20;}
				$data= "<div><img src=\"../images/urgent.png\"  height=".getPicH($pic,$dimensions)." width=". getPicW($pic,$dimensions)."  /></div>";
				
			}
		}
		return $data;
}
?>
<style type="text/css">
<!--
.Black_Header_TextBTN{
	font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size: 12px;
	color: #000;
	margin-bottom:5px;
}
.persons {
     -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    -khtml-border-radius: 8px;
    border-radius: 8px;
	background-color:#FBF8FA;
	box-shadow:2px 2px 2px #000000;
}
a.flink {
	color: #000000;
	text-decoration:none
}
A.flink.link{
	color:#000000;	text-decoration:none;
	}	
A.flink:visited{
	color: #000000; text-decoration:none;
	}	
A.flink:hover{
	color: #000000;text-decoration:none;
	}
	
div.persons:hover{
background-color:#ABD8DA
}
div.persons a.flink div.persons{
visibility:hidden;
}
div.persons:hover a.flink div.persons{
visibility:visible;
}
.flink{

}
-->
</style>
