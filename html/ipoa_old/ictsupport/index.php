<?php
session_start();
$ignore_login=true;
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
include "globalfunc.php";
$search=removeTag(@$_GET['txtSearch']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ICT Support - IPOA</title>
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="./images/logo1.png" label="JKUAT">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
.boxed {
     -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    -khtml-border-radius: 8px;
	box-shadow:2px 2px 2px #000000;
    border-radius: 8px;
	background-color:#008B91;
	color:#FFFFFF;
	cursor:pointer;
}
div.boxed:hover{
background-color:#F3AA49;
color:#000000;
}
.style14 {font-size: 16px}
</style>
<script src="scripts/counterajax.js" ></script>
</head>

<body><center>
<form name="frmOfficers" method="get" enctype="multipart/form-data" action="index.php">
	<table width="638" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
	  <!--DWLayoutTable-->
	  <tr>
		<td height="22" colspan="2" valign="top"><a href="../ipoa/index.php">&lt;&lt;Back</a></td>
		<td width="388">&nbsp;</td>
		<td width="4">&nbsp;</td>
		<td width="58">&nbsp;</td>
		<td width="140">&nbsp;</td>
		<td colspan="3" valign="top"><div align="right"><a href="cpanel/controlpanel.php">Admin</a></div></td>
	  </tr>
	  <tr>
		<td height="150" colspan="9" valign="top"><img name="header" src="images/header.jpg" width="700" height="150" border="0" id="header" alt="" /></td>
	  </tr>

	  
	  <tr>
		<td height="24" colspan="5" valign="top"><div align="right" class="style14">Click or search your name, office, extension or post:</div></td>
		<td colspan="2" valign="top"><input name="txtSearch" type="text" class="STR1" id="txtSearch" value="<?php echo @$search;?>" /></td>
		<td colspan="2" valign="top"><input name="Search" type="button" class="BTN" id="Search" value="Search" onclick="document.frmOfficers.submit();" /></td>
	  </tr>
	  <tr>
		<td width="32" height="156">&nbsp;</td>
		<td colspan="7" valign="top">
		
		  <?php
		$max=3;
		$start=(int)@$_GET['index']; 
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="index.php";
		$index=0;
		$counts=0;
		$rs=@mysql_query("select * from person where `names` like '%$search%' or  `email` like '%$search%'  or  `post` like '%$search%'  or  `extension` like '%$search%' or  `office` like '%$search%' order by `names`  asc");
			if($rs)
			{
				$counts=@@mysql_num_rows($rs);
				if ($counts>0)
				{
					if($start>0)
					{	
						$index=0;			
						$first="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">First</a>";
						$index=$start-$max;
						if($index<0){$index=0;}			
						$prev="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Previous</a>";
					}				
					if($counts>$start+$max)
					{	
						$index=$counts-$max;			
						$last="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Last</a>";
						$index=$start+$max;			
						$next="<a href=\"#\" onclick=\"getPage('$url','content','index=$index')\">Next</a>";
					}else
					{
						$max=$counts-$start;
					}
	
					$color="#FFFFFF";
					$end=$start+$max;
					for($x=$start;$x<$end;$x++)
					{
						mysql_data_seek($rs,$x);
						$data=@mysql_fetch_array($rs);
/*						$strSearch="<mark>".$search."</mark>";
						$data[1]=str_replace($search,"$strSearch",$data[1]);
						$data[2]=str_replace($search,"$strSearch",$data[2]);
						$data[3]=str_replace($search,"$strSearch",$data[3]);
						$data[4]=str_replace($search,"$strSearch",$data[4]);
						$data[5]=str_replace($search,"$strSearch",$data[5]);*/
						$data[1]=toSentenceCase($data[1]);
						
						echo "
						<div class=\"boxed\" style=\"padding:10px; margin:10px;float:left;width:610px;\" onclick=\"getPage('cpanel/controlpanel.php','content','userid=$data[0]')\">
							 <div  style=\"width:450px;float:left\">
								<div><span style=\"font-size:34px;\">$data[1] </span></div>
								<div><span style=\"font-size:25px;\">Extension: $data[4]</span></div>
								<div><span style=\"font-size:20px;\">Email: $data[2]</span></div>
								<div><span style=\"font-size:14px;\">Office: $data[5]</span></div>					
								<div><span style=\"font-size:14px;\">Post: $data[3]</span></div>
							</div>
							<div  style=\"width:120px;float:right;border:thin solid #B2D1B2;background-color:#FFFFFF;\" align=\"center\">";
								?>
								<img src="<?php if(@$data[0]!="")
								{
									if($data[8]!="99")
									{
										if(is_file("cpanel/".$data[6]))
										{
											echo "cpanel/".$data[6];
											$pic="cpanel/".$data[6];
										}
										else
										{
											echo "cpanel/photo/avator.png";
											$pic="cpanel/photo/avator.png";
										}
									}else
									{
										echo "cpanel/photo/group.png";
									}
								}
							  else
								{
									echo "cpanel/photo/avator.png";
									$pic="cpanel/photo/avator.png";
								}
							  ?>"  height="<?php echo getPicH($pic,120); ?>" width="<?php echo getPicW($pic,120); ?>"  />
								<?php
								echo "
							</div>
						</div>"; 
					}
				}
			}
		?>	</td>
		<td width="52">&nbsp;</td>
	  </tr>
	  <tr>
	    <td height="6"></td>
	    <td width="8"></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td width="6"></td>
	    <td width="13"></td>
	    <td></td>
      </tr>
	  <tr>
	    <td height="18"></td>
	    <td colspan="2" valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?>
        </div></td>
	    <td></td>
	    <td colspan="4" valign="top"><div align="left"><?php echo "$first | $prev | $next | $last";  ?></div></td>
	    <td></td>
      </tr>
	  
	
	  <tr>
		<td height="180" colspan="9" valign="top"><img src="images/tail.jpg" width="700" height="180" /></td>
	  </tr>
	</table>
</form>
</center>
</body>
</html>