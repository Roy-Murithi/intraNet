<?php
	include "conn.php";
	include ("globalfunc.php");

$index=@$_GET["index"];
if(@$_GET["sliderid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("select * from `".$pref."slider` where `sliderid`='".@$_GET["sliderid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
				if(file_exists("../../".$datax[1])==TRUE)
				{
					unlink("../../".$datax[1]);
				}	
			}
		}
		$rs=@mysql_query("delete from `".$pref."slider` where `sliderid`='".@$_GET['sliderid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `".$pref."slider` where `sliderid`='".@$_GET["sliderid"]."'");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datax=@mysql_fetch_array($rs);
			}
		}
	}
}

?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<head>

<script language="javascript" src="../scripts/counterajax.js"></script>

<script type="text/javascript">
        function ShowDialog() {
            var rtvalue = window.showModalDialog("uploader.php?sessid=smetsysmocmas","","dialogHeight:300;dialogWidth:750;center:yes");
			if(rtvalue=="ok")
			{
            	document.location="slider.php?sessid=smetsysmocmas";
			}
        }
    </script>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
-->
</style>
</head>
<body>
<table width="800" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td width="628" height="27" valign="top">Slide images </td>
  <td width="155" valign="top"><input name="Button" type="button" class="BTN" value="Add slider image" onClick="ShowDialog()" /></td>
  <tr>
                <td height="20" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
                  <td height="233" colspan="2" valign="top" class="Black_Header_Text" style="font-size:9px">
				  
                    <?php
				   
				   $where="";
				  
				   $counts="0";
				   
		$rs=@mysql_query("select * from ".$pref."slider order by `index` ASC");

		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				
				for($x=0;$x<$counts;$x++)
				{	
					$data=@mysql_fetch_array($rs);
					echo "
					<div style=\"width:790px; height:90px;float:left;\">
					<div style=\"border:thin dotted; background:#BFE5BF;  width:780px; height:80px;float:left;\">
				  		<div  style=\" width:200px; height:70px;margin:5px;float:left;\" align=\"left\">";
							?>
							<img src="<?php 
				if(is_file("../../".$data[1]))
				{
		  			echo "../../".$data[1];
				}
				else
				{
					echo "";
				}
				$pic="../../".$data[1];
		  ?>" border="1" style="border-color:B2D1B2" height="70" width="200"  />	
                    <?
							echo "
						</div>
						<div  style=\" width:470px; height:70px;margin:5px;float:left;display:block; overflow:auto;\" align=\"left\">
						Alt text<br />
						&nbsp;&nbsp;$data[2]<br /><br />
						Image Desciption<br />
						&nbsp;&nbsp;$data[3]<br />
						
					</div>	
					<div  style=\" width:70px;float:right\" align=\"right\"><a href=\"#\" onclick=\"getPage('uploader.php','content','sliderid=$data[0]')\">Edit</a> | <a href=\"#\" onclick=\"getPage('slider.php','content','sliderid=$data[0]&del=99')\">Delete</a> </div>
					</div>			  
					</div>
					";
				}
			}
		}
	?>				  </td>
  <tr >
    <td height="16"></td>
    <td></td>
  </table>
  </body>
