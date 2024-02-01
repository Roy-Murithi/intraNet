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
function fetchRecordCount2($dbase)
{
	$rs1=@mysql_query("select * from  $dbase");
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
		date_default_timezone_set("Africa/Nairobi");
		$date=date("Y/m/d H:i:s");
		$names=@$_SESSION['names'];
		$userid=@$_SESSION['userid'];
		
		$query="insert into ".$pref."proclog values('$proclogidx','$complaintid','$date','$log','$names','$userid','$action')";		
		$rs=@mysql_query($query);
	}else
	{
		
	}
}


function getDuration($end,$str){
		date_default_timezone_set("Africa/Nairobi");
		$date1=new DateTime();
		$strOut="";
		if(strpos($end,"/"))
		{
		$dtemp=explode("/",$end);
		
		if((int)@$dtemp[1]<=12 && (int)@$dtemp[2]<=31 )
		{
        $intervalo = @date_diff(date_create(), date_create($end));
		$out="";
        //$out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
		if(@(int)$intervalo->format("%Y")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%Y</font> Years");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%Y</font> Years");}}
		if(@(int)$intervalo->format("%M")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%m</font> Months");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%m</font> Months");}}
		if(@(int)$intervalo->format("%d")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%d</font> Days");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%d</font> Days");}}
		if(@(int)$intervalo->format("%H")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%h</font> Hours");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%h</font> Hours");}}
		if(@(int)$intervalo->format("%i")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%i</font> Minutes");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%i</font> Minutes");}}
		if(@(int)$intervalo->format("%s")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%s</font> Seconds");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%s</font> Seconds");}}
		$temp=explode(",",$out);
		
		if(sizeof($temp)>1)
		{
			for($x=0;$x<sizeof($temp)-1;$x++)
			{
				if($strOut=="")
				{
					$strOut=$temp[$x];
				}else
				{
					$strOut=$strOut.",".$temp[$x];
				}
			}			
		}
				if($strOut=="")
				{
					$strOut=$temp[sizeof($temp)-1];
				}else
				{
					$strOut=$strOut." and ".$temp[sizeof($temp)-1];
				}
		}
		if($strOut=="")
		{
			$strOut="unknown duration";
		}
		}else
		{
			$strOut="unknown duration";
		}
        return " ".$strOut . " $str";
		      
}

function getDuration1($end,$end1,$str){
		date_default_timezone_set("Africa/Nairobi");
		$date1=new DateTime();
		$strOut="";
		if(strpos($end,"/") && strpos($end1,"/") )
		{
		$dtemp=explode("/",$end);
		$dtemp1=explode("/",$end1);
		if((int)@$dtemp[1]<=12 && (int)@$dtemp[2]<=31 && (int)@$dtemp1[1]<=12 && (int)@$dtemp1[2]<=31 )
		{
        $intervalo = @date_diff(date_create($end1), date_create($end));
		$out="";
        //$out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
		if(@(int)$intervalo->format("%Y")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%Y</font> Years");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%Y</font> Years");}}
		if(@(int)$intervalo->format("%M")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%m</font> Months");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%m</font> Months");}}
		if(@(int)$intervalo->format("%d")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%d</font> Days");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%d</font> Days");}}
		if(@(int)$intervalo->format("%H")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%h</font> Hours");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%h</font> Hours");}}
		if(@(int)$intervalo->format("%i")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%i</font> Minutes");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%i</font> Minutes");}}
		if(@(int)$intervalo->format("%s")>0){if($out==""){$out=$intervalo->format("<font color=\"red\">%s</font> Seconds");}else{$out=$out.",".$intervalo->format("<font color=\"red\">%s</font> Seconds");}}
		$temp=explode(",",$out);
		
		if(sizeof($temp)>1)
		{
			for($x=0;$x<sizeof($temp)-1;$x++)
			{
				if($strOut=="")
				{
					$strOut=$temp[$x];
				}else
				{
					$strOut=$strOut.",".$temp[$x];
				}
			}			
		}
				if($strOut=="")
				{
					$strOut=$temp[sizeof($temp)-1];
				}else
				{
					$strOut=$strOut." and ".$temp[sizeof($temp)-1];
				}
		}
		if($strOut=="")
		{
			$strOut="unknown duration";
		}
		}else
		{
			$strOut="unknown duration";
		}
        return " ".$strOut . " $str";
		      
}

function getUrgent($pref,$complaintid,$field,$dimensions)
{
		$isurgent=fetchValue($pref."complaint","complaintid",$complaintid,(int)$field);
		$data="";
		if((int)$isurgent==99 || (int)$isurgent==98 )
		{
			if((int)$isurgent==99)
			{
				$pic="../images/urgent.png";
			}elseif((int)$isurgent==98)
			{
				$pic="../images/urgent1.png";
			}
			if(is_file($pic))
			{
				if((int)$dimensions==0){$dimensions=20;}
				
				$data= "<div><img src=\"$pic\"  height=".getPicH($pic,$dimensions)." width=". getPicW($pic,$dimensions)."  /></div>";
				
			}
		}
		return $data;
}
function removeTag($strData)
{
	$strTemp=str_replace("'","\'",$strData);
	return $strTemp;
}
function addTrag($strData)
{
	$strTemp=str_replace("\n","<br />",$strData);
	return $strTemp;
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
