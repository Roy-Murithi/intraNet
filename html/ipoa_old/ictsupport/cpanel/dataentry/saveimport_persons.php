<?php
session_start();
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$dat1=removeTag(@$_POST["txtDat1"]);
$dat2=removeTag(@$_POST["txtDat2"]);
$dat3=removeTag(@$_POST["txtDat3"]);
$dat4=removeTag(@$_POST["txtDat4"]);
$dat5=removeTag(@$_POST["txtDat5"]);

if($dat1=="none" && $dat2=="none" && $dat3=="none" && $dat4=="none" && $dat5=="none" )
{
?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	alert("Select a valid excel column to import data from");
	document.location="upload.php?sessid=smetsysmocmas";
</script>
</html>
<?php
exit;
}
		$filename=@$_SESSION['sesfname'];
/*		$path= str_replace("import_persons.php","",$_SERVER['SCRIPT_FILENAME']);
		$filename=$path.$filename;
		$filename=str_replace("/","\\",$filename);*/
		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);

		$x=1;
		
			$strCol1=$objXLSheet->Range($dat1."$x")->Value();
			$strCol2=$objXLSheet->Range($dat2."$x")->Value();
			$strCol3=$objXLSheet->Range($dat3."$x")->Value();
			$strCol4=$objXLSheet->Range($dat4."$x")->Value();
			$strCol5=$objXLSheet->Range($dat5."$x")->Value();
			$strCols=$strCol1.$strCol2.$strCol3.$strCol4.$strCol5;
		while($strCols!="")
		{
			$strCol1=$objXLSheet->Range($dat1."$x")->Value();
			$strCol2=$objXLSheet->Range($dat2."$x")->Value();
			$strCol3=$objXLSheet->Range($dat3."$x")->Value();
			$strCol4=$objXLSheet->Range($dat4."$x")->Value();
			$strCol5=$objXLSheet->Range($dat5."$x")->Value();			
			if($strCol1.$strCol2.$strCol3.$strCol4.$strCol5!="")
			{
				$where="";
				if((int)fetchRecordCount("person","email",$strCol2)>0)
				{
					$where=" where `email`='$strCol2' ";
				}
				if($where=="")
				{
					$personidx=get_uniq_idno("PSN-00","person","person","personid",$db,$pref);
					$query="insert into person values('$personidx','$strCol1','$strCol2','$strCol3','$strCol4','$strCol5','','','0')";
					$rs=@mysql_query($query);
				}else
				{
					$query="update `person` set email='$strCol2', post='$strCol3',`extension`='$strCol4', office='$strCol5' where `email`='$strCol2'";
					$rs=@mysql_query($query);
				}
				
			}
			$x=$x+1;
			$strCol1=$objXLSheet->Range($dat1."$x")->Value();
			$strCol2=$objXLSheet->Range($dat2."$x")->Value();
			$strCol3=$objXLSheet->Range($dat3."$x")->Value();
			$strCol4=$objXLSheet->Range($dat4."$x")->Value();
			$strCol5=$objXLSheet->Range($dat5."$x")->Value();
			$strCols=$strCol1.$strCol2.$strCol3.$strCol4.$strCol5;
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );		
	

?>
<html>
<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
	getPage("person.php","content","");
</script>
</html>
