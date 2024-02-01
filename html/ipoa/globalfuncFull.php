<?php 
function _fieldName($dbase,$field)
{
	$rs1=@mysql_query("select * from  $dbase where '1'='0'");
	return  mysql_field_name($rs1,(int)$field);
}
function funcAccess($function)
{
		$dbase="sm_main_access";
		$unique="filename";
		$unique_value=$function;
		$unique1="userid";
		$unique_value1=@$_SESSION['userid'];			
		$access=fetchRecordCount1($dbase,$unique,$unique_value,$unique1,$unique_value1);
		if(@$_SESSION['member']=="99"){return $access>0;}else{return true;};
}
function cfunc_captureSummary()
	{
		//controlled function
		if(funcAccess("cfunc_captureSummary")==false){return 0;}
		//end of access
		
	echo "<div style=\"width:400px;\"  align=\"left\">Complaints Capture Summary </div>";
		$query="SELECT   * FROM `staff` where `level`='9' order by `names` asc";
		$rs1e=@mysql_query($query);
								if ($rs1e)
								{
									$rowse=@mysql_num_rows($rs1e);
									if($rowse>0)
									{
										for($e=0;$e<$rowse;$e++)
										{
											$datae=mysql_fetch_array($rs1e);
											$counte=fetchRecordCount1("sm_main_proclog","userid",$datae[0],"log","New complaint added to the system");
											echo "<div style=\"width:400px;\"><div style=\"float:left; width:200px;\" align=\"right\">$datae[3]:</div><div style=\"float:left; width:100px; margin-left:5px;\" align=\"left\">$counte </div></div>";
										}
										
										
									}
								}
								$query="SELECT `complaintid` FROM `sm_main_complaint` where `complaintid` not in (select `complaintid` from sm_main_proclog where `log`='New complaint added to the system') ";
										$rs2= mysql_query($query);
										$counte=@mysql_num_rows($rs2);
										//if($counte>0)
										{
										
											//echo "<div style=\"width:400px;\"><div style=\"float:left; width:200px;\" align=\"right\">Unkown Editors :</div><div style=\"float:left; width:100px; margin-left:5px;\" align=\"left\">$counte </div></div>";
										}
	}
function getUserLog($complaintid,$action,$searchstr)
{
	$editor="";	
					if($complaintid!="")
					{
						$user=  fetchValue1("sm_main_proclog","complaintid","$complaintid","log",$searchstr,4);	
						if($user!="")
						{	
							$editor="<div style=\"border:thin dotted; background:#FFAABC;\">$action $user</div>";
						}else
						{
							$user= fetchValue1("sm_main_proclog","complaintid","$data[0]","log",$searchstr,4);
							if($user!="")
							{
								$editor="<div style=\"border:thin dotted; background:#FFAABC;\">$action $user</div>";
							}else
							{
								$editor="<div style=\"border:thin dotted; background:#FFAABC;\">Error while fetching user Log</div>";
							}
						}
					}else
							{
								$editor="<div style=\"border:thin dotted; background:#FFAABC;\">Error while fetching user Log</div>";
							}
					return $editor;
}
/*function getLogSummary($searchstr)
{
	$temp=array();
								$query="SELECT   user,count( user ) FROM `sm_main_proclog` where `log`='$searchstr' GROUP BY user";
								$rs1e=@mysql_query($query);
								if ($rs1e)
								{
									$rowse=@mysql_num_rows($rs1e);
									if($rowse>0)
									{
										for($e=0;$e<$rowse;$e++)
										{
											$datae=mysql_fetch_array($rs1e);
											$temp[$x]=array();
											$temp[$x][0]=$datae[0];
											$temp[$x][1]=$datae[1];
										}
									}
								}
								return $temp;
}*/
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
function fetchValue1($dbase,$unique,$unique_value,$unique1,$unique_value1,$field)
{
	$value="";
	$rs1=@mysql_query("select * from  $dbase where `$unique`='$unique_value' and `$unique1`='$unique_value1'");
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
function fetchRecordCount_query($query)
{
	$rs1=@mysql_query($query);
			if ($rs1)
			{
				$rows=@mysql_num_rows($rs1);
			}
	return (int)@$rows;
}
function queryRecordCount($query)
{
	$rs1=@mysql_query($query);
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
function getDuration($end,$str)
{
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
function fetchV($dbase,$unique,$unique_value,$unique1,$unique_value1,$field)
{
	$value="";
	$rs1=@mysql_query("select * from  `$dbase` where `$unique`='$unique_value' and `$unique1`='$unique_value1'");
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
function fetchLevelName($level)
{
	$levelName="";
	
	if($level=="99"){$levelName="Undefined";}
	else if($level=="0"){$levelName="Director";}
	else if($level=="1"){$levelName="Deputy Director - Investigations";}
	else if($level=="2"){$levelName="Deputy Director - Complaints";}
	else  if($level=="3"){$levelName="Deputy Director - Inspections and Monitoring";}
	else if($level=="4"){$levelName="Head of Investigation";}
	else  if($level=="5"){$levelName="Head of Complaint";}
	else if($level=="6"){$levelName="Head of Legal";}
	else if($level=="7"){$levelName="Legal Officer";}
	else if($level=="8"){$levelName="Investigator";}
	else if($level=="9"){$levelName="Complaints Officer";}
	else if(@$datax[9]=="10"){$levelName="inspections and monitoring officer";}
		
	return $levelName;
}
function get_uniq_idno($prefix,$variable,$table,$idfield,$db,$pref)
{
	if(@$prefix==""){$prefix="TMP-00";}

	$query="CREATE TABLE IF NOT EXISTS `sm_main_tracker` ( `varname` varchar(255) NOT NULL,  `value` varchar(50) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
	$rs=mysql_query($query);

	$valDat=fetchValue($pref."tracker","varname",$variable,1);
	do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('$variable','$valDat')";
				
				$rs=@mysql_query($query);
			}
			$idx="$prefix".$valDat;
			$rs1=@mysql_query("select * from $table where `$idfield`='$idx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);
	$query="update ".$pref."tracker set value='$valDat' where `varname`='$variable'";
	$rs=@mysql_query($query);
	return $idx;
}
function get_uniq_complaintno($prefix,$variable,$table,$idfield,$db,$pref)
{
	if(@$prefix==""){$prefix="COMP/";}

	$query="CREATE TABLE IF NOT EXISTS `".$pref."tracker` ( `varname` varchar(255) NOT NULL,  `value` varchar(50) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
	$rs=mysql_query($query);

	$valDat=fetchValue($pref."tracker","varname",$variable,1);
	do
	{
			//strDat=(string)$valDat;
			if((int)$valDat==0)
			{
				$valDat=1;
				$query="insert into  ".$pref."tracker values('$variable','$valDat')";
				
				$rs=@mysql_query($query);
			}
			$idx="$prefix".$valDat."/".date("Y");
			$rs1=@mysql_query("select * from $table where `$idfield`='$idx'");
			if ($rs1)
			{
				$dup=@mysql_num_rows($rs1);
			}else
			{
				$dup=0;
			}
			$valDat=(int)$valDat+1;
	}while($dup!=0);
	$query="update ".$pref."tracker set value='$valDat' where `varname`='$variable'";
	$rs=@mysql_query($query);
	return $idx;
}

$temp=explode("/",$_SERVER['SCRIPT_FILENAME']);
$filename=@$temp[sizeof(@$temp)-2]."/".@$temp[sizeof(@$temp)-1];

$user_clearance="";
if(@$controlled_file=="99" && @$_SESSION['member']=="99")
{ 

		if($wr_file!="")
		{
			$filename=$wr_file;
		}
		$dbase="sm_main_access";
		$unique="filename";
		$unique_value=$filename;
		$field="3";
		$dbase="sm_main_access";
		$unique1="userid";
		$unique_value1=$_SESSION['userid'];			
		$access=fetchV($dbase,$unique,$unique_value,$unique1,$unique_value1,$field);	
		$$user_clearance=$access;		
		if((int)@$access<(int)$IO_access)
		{
			header("location:/ipoa/noclearance.php");
			exit;
		}
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
<script language="javascript">
 
 
var path = window.parent.document.location.pathname;
if(path.indexOf("mainpage.php")!=-1)
{
	if("<?php echo @$_SESSION["names"]?>"=="")
	{
		<?php 		
		$fpath=$_SERVER['SCRIPT_NAME'];
		$temp=array();
		$temp=explode("cpanel/",$fpath);
		$path=$temp[0]."cpanel/controlpanel.php";
		//echo "alert('session expired or you signed out from another window');window.parent.document.location=\"".$path."\"";		
		?>
	}
}
</script>
