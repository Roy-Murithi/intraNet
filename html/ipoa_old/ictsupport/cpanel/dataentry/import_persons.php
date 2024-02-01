<?php
session_start();
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";

	$fileName = $_FILES['file']['name'];
	$tmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileType = $_FILES['file']['type'];
	
	$uploadDir="temp/";
	
	if (is_dir($uploadDir)==false){mkdir($uploadDir,0777);}
	$filePath = $uploadDir.$fileName;		
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
		$filePath = addslashes($filePath);		
	} 
			
	$fileP=strtoupper($filePath);
	if (strpos($fileP,".XLS")==strlen($fileP)-4 || strpos($fileP,".XLSX")==strlen($fileP)-5 )
	{
		if(file_exists($filePath)==TRUE)
		{
			chmod($filePath,0777);
			unlink($filePath);
		}				
		$result = move_uploaded_file($tmpName, $filePath);
		$filename=$filePath;
		$param="filename=$filename";
		//include "genEmail.php";
		
	}	
	else
	{
		?>
		<script language="javascript">	
			alert("Invalid contact file, please use excel files only");
			document.location="upload.php?sessid=smetsysmocmas";
		</script>	
		<?php
		
	}

?>
<script src="../scripts/counterajax.js" ></script>

<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="saveimport_persons.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="644" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td height="22" colspan="5" valign="top">Upload persons</td>
    </tr>
  <tr>
    <td height="5" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
  </tr>
  <tr>
    <td width="36" height="7"></td>
    <td width="151"></td>
    <td width="13"></td>
    <td width="169"></td>
    <td width="331"></td>
    </tr>
  <tr>
    <td height="25"></td>
    <td valign="top"><div align="right">Names:</div></td>
    <td></td>
    <td colspan="2" valign="top">
	<select name="txtDat1">
	  <option value="none">Select excel column to read from</option>
	  <?php
		$path= str_replace("import_persons.php","",$_SERVER['SCRIPT_FILENAME']);
		$filename=$path.$filename;
		$filename=str_replace("/","\\",$filename);
		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$_SESSION['sesfname']=$filename;
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
		$Col=array();
		$Col[0]="A";$Col[1]="B";$Col[2]="C";$Col[3]="D";$Col[4]="E";$Col[5]="F";$Col[6]="G";
		for($x=0;$x<=6;$x++)
		{
			if($objXLSheet->Range($Col[$x]."1")->Value()!="")
			{
				echo "<option value=\"$Col[$x]\">Column ".$Col[$x]."</option>\n";
			}
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );
	?>
	  </select>
	
	&nbsp;</td>
  </tr>
  
  <tr>
    <td height="5"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">Emails:</div></td>
    <td></td>
    <td colspan="2" valign="top"><select name="txtDat2" id="txtDat2">
          <option value="none">Select excel column to read from</option>
          <?php

		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
		$Col=array();
		$Col[0]="A";$Col[1]="B";$Col[2]="C";$Col[3]="D";$Col[4]="E";$Col[5]="F";$Col[6]="G";
		for($x=0;$x<=6;$x++)
		{
			if($objXLSheet->Range($Col[$x]."1")->Value()!="")
			{
				echo "<option value=\"$Col[$x]\">Column ".$Col[$x]."</option>\n";
			}
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );
	?>
                            </select></td>
    </tr>
  
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">Post:</div></td>
    <td></td>
    <td colspan="2" valign="top"><select name="txtDat3" id="txtDat3">
          <option value="none">Select excel column to read from</option>
          <?php
		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
		$Col=array();
		$Col[0]="A";$Col[1]="B";$Col[2]="C";$Col[3]="D";$Col[4]="E";$Col[5]="F";$Col[6]="G";
		for($x=0;$x<=6;$x++)
		{
			if($objXLSheet->Range($Col[$x]."1")->Value()!="")
			{
				echo "<option value=\"$Col[$x]\">Column ".$Col[$x]."</option>\n";
			}
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );
	?>
                            </select></td>
    </tr>
  
  
  <tr>
    <td height="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  
  
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">Extension:</div></td>
    <td></td>
    <td colspan="2" valign="top"><select name="txtDat4" id="txtDat4">
        <option value="none">Select excel column to read from</option>
        <?php
		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
		$Col=array();
		$Col[0]="A";$Col[1]="B";$Col[2]="C";$Col[3]="D";$Col[4]="E";$Col[5]="F";$Col[6]="G";
		for($x=0;$x<=6;$x++)
		{
			if($objXLSheet->Range($Col[$x]."1")->Value()!="")
			{
				echo "<option value=\"$Col[$x]\">Column ".$Col[$x]."</option>\n";
			}
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );
	?>
        </select></td>
    </tr>
  <tr>
    <td height="6"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr>
    <td height="22"></td>
    <td valign="top"><div align="right">Office:</div></td>
    <td></td>
    <td colspan="2" valign="top"><select name="txtDat5" id="txtDat5">
          <option value="none">Select excel column to read from</option>
          <?php

		//echo $filename;
		$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
		$objXLApp->Workbooks->Open($filename);
		$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
		$Col=array();
		$Col[0]="A";$Col[1]="B";$Col[2]="C";$Col[3]="D";$Col[4]="E";$Col[5]="F";$Col[6]="G";
		for($x=0;$x<=6;$x++)
		{
			if($objXLSheet->Range($Col[$x]."1")->Value()!="")
			{
				echo "<option value=\"$Col[$x]\">Column ".$Col[$x]."</option>\n";
			}
		}
		unset( $objXLSheet );
		
		$objXLApp->ActiveWorkBook->Close();
		$objXLApp->Quit();
		
		unset( $objXLApp );
	?>
                            </select></td>
    </tr>
  
  <tr>
    <td height="28"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="23"></td>
    <td></td>
    <td></td>
    <td valign="top"><div align="left">
      <input name="Submit" type="submit" class="BTN" value="    Unpack    " />
    </div></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="16"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
</form>

