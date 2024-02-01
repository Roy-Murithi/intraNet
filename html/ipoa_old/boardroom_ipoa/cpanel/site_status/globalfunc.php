<?php 
function format_bytes($bytes) {
   if ($bytes < 1024) return $bytes.' B';
   elseif ($bytes < 1048576) return round($bytes / 1024, 2).' KB';
   elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).' MB';
   elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).' GB';
   else return round($bytes / 1099511627776, 2).' TB';
}
function dirSize($directory) { 
		$size = 0; 
	if (is_dir($directory)!="")
	{
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){ 
			$size+=$file->getSize(); 
		} 
	} 
		return (int)$size;
} 
function saveFile($pageinfor,$uniquefield,$uniqueID,$dpath,$table,$field)
{
	
	$ID=$uniqueID;
	
	$fileName = $_FILES[$pageinfor]['name'];
	$tmpName = $_FILES[$pageinfor]['tmp_name'];
	$fileSize = $_FILES[$pageinfor]['size'];
	$fileType = $_FILES[$pageinfor]['type'];
	
	$uploadDir="../../".$dpath;
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = $uploadDir.$ID.$fileName;	
		
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

function saveCV($pageinfor,$uniquefield,$uniqueID,$dpath,$table,$field)
{
	
	$ID=$uniqueID;
	
	$fileName = $_FILES[$pageinfor]['name'];
	$tmpName = $_FILES[$pageinfor]['tmp_name'];
	$fileSize = $_FILES[$pageinfor]['size'];
	$fileType = $_FILES[$pageinfor]['type'];
	
	$uploadDir="../../".$dpath;
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = $uploadDir.$ID.$fileName;	
		
	$filePath1 = $dpath.$ID.$fileName;				
	$dat2=$filePath;
			
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);
	} 
			
	$fileP=strtoupper($filePath);
	if (strpos($fileP,".PDF")==strlen($fileP)-4 || strpos($fileP,".DOC")==strlen($fileP)-4 || strpos($fileP,".DOCX")==strlen($fileP)-5)
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
		return "Invalid CV file, Please use PDF or Word document";		
	}
}

function saveFileAll($pageinfor,$uniquefield,$uniqueID,$dpath,$table,$field)
{
	
	$ID=$uniqueID;
	
	$fileName = $_FILES[$pageinfor]['name'];
	$tmpName = $_FILES[$pageinfor]['tmp_name'];
	$fileSize = $_FILES[$pageinfor]['size'];
	$fileType = $_FILES[$pageinfor]['type'];
	
	$uploadDir="../../".$dpath;
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = $uploadDir.$ID.$fileName;		
		
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
?>