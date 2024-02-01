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
function fetchRecordCount($dbase,$unique,$unique_value)
{
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value'");
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
function classBTN($id,$value,$url,$param,$onclick)
{
	if($param!="")
	{
		$url="$url?$param";
	}
	$div="<a class=\"flink\" href=\"$url\" onClick=\"$onclick\"><div id=\"persons\" class=\"persons Black_Header_TextBTN\" style=\" border: thin solid #7Ba89A; margin:2px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\">$value</div></a>";
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
	$div="<a class=\"flink\" href=\"$url\" onClick=\"$onclick\"><div id=\"persons\" class=\"persons Black_Header_TextBTN\" style=\" border: thin solid $bordercolor; margin:2px; float:left; padding-top:3px; padding-bottom:3px; padding-left:5px; padding-right:5px;\">$value</div></a>";
	return $div;
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