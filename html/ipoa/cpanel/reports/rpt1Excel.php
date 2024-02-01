<?php
	session_start();
	$con=NULL;
	include "../../config.php";
	$con=@mysql_connect("",$username,$password);
	if ($con)
	{
		//$conn=mysql_select_db("foscience");
		$conn=@mysql_select_db($db);
		if(!$conn)
		{
			echo "<b>Error connecting database</b><br />Contact System administrator";
			exit;
		}
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
	
	date_default_timezone_set("Africa/Nairobi");
	//include "globalfunc.php";
	$date1=@$_GET['date1'];
	$date2=@$_GET['date2'];
		if($date1=="" || $date2=="" )
		{
 			$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");
		}else
		{
			$rs=@mysql_query("select EXTRACT(YEAR FROM `incident date`) from sm_main_complaint where EXTRACT(YEAR FROM `incident date`)>='$date1' and  EXTRACT(YEAR FROM `incident date`)<='$date2' group by EXTRACT(YEAR FROM `incident date`) order by EXTRACT(YEAR FROM `incident date`) asc");		
		}
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				//open the excel
				//$filename=@$_SESSION['sesfname'];
				//$objXLApp = new COM( "excel.application" ) or die( "unable to start MSExcel" );
				//$objXLApp->Workbooks->Add();
				//$objXLSheet = $objXLApp->ActiveWorkBook->WorkSheets(1);
				//$objXLSheet->Name="Complaints statistics";
				require_once '../../Classes/PHPExcel.php';
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
				$x=2;
				//****
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$x","Year")
					->setCellValue("B$x",fetchValue("sm_main_complaintnature","natureid","NTR001",1))
					->setCellValue("C$x",fetchValue("sm_main_complaintnature","natureid","NTR002",1))
					->setCellValue("D$x",fetchValue("sm_main_complaintnature","natureid","NTR003",1))
					->setCellValue("E$x",fetchValue("sm_main_complaintnature","natureid","NTR004",1))
					->setCellValue("F$x",fetchValue("sm_main_complaintnature","natureid","NTR005",1))
					->setCellValue("G$x","Total");

				for($x=3;$x<$counts+3;$x++)
				{
					$datax=mysql_fetch_array($rs);
					$dat1=queryRecordCount("select  complaintid  from sm_main_complaint where natureid='NTR001' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat2=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR002' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat3=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR003' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat4=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR004' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$dat5=queryRecordCount("select  complaintid from sm_main_complaint where natureid='NTR005' and EXTRACT(YEAR FROM `incident date`)='$datax[0]'");
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue("A$x",$datax[0])
						->setCellValue("B$x",$dat1."")
						->setCellValue("C$x",$dat2)
						->setCellValue("D$x",$dat3)
						->setCellValue("E$x",$dat4)
						->setCellValue("F$x",$dat5)
						->setCellValue("G$x",(int)$dat1+(int)$dat2+(int)$dat3+(int)$dat4+(int)$dat5);
        			        
				}
				/*
				 	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				  	header("Cache-Control: no-store, no-cache, must-revalidate");
				  	header("Cache-Control: post-check=0, pre-check=0", false);
				  	header("Pragma: no-cache");
				 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				  	header('Content-Disposition: attachment;filename="Complaints report.xlsx"');
					*/
					//Save document
				$objPHPExcel->getActiveSheet()->setTitle('Complaints summary report');
				$objPHPExcel->setActiveSheetIndex(0);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Complaints report.xls"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				//header('Cache-Control: max-age=1');
				
				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}
		
		

		
		
		?>



