<?php
	include "conn.php";
	include ("globalfunc.php");
	$index=@$_GET["index"];
	$search=@$_GET['txtMainSearch'];
	/*
	anti hack code here
	sam2002com@yahoo.com
	burning the whole house is just an expensive way of killing a rat
	*/
?>
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />


<script language="javascript" src="../scripts/counterajax.js"></script>


<link href="../css/newstyle.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style14 {color: #000000}
.style15 {color: #FF0000}
.loader{
background:#FFFFFF;
}
div.loader:hover{
background:#EDF8ED;
cursor:pointer;
}
-->
</style>
<body onLoad="">
<center>

<table width="755" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td height="21" colspan="2" valign="top"> Search results for "
                <?php
			
			  ?>
             " </td>
            <tr>
                <td height="21" colspan="2" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <tr>
                  <td height="182" colspan="2" align="left" valign="top">

		            <?php
				   $where="";
				   $First="First";
				   $Previous="Previous";
				   $Next="Next";
				   $Last="Last";
				   $limit="";
				   $counts="0";
				  

		$rs=@mysql_query("select * from `".$pref."gallery` where `category`='gallery' and `album` like '%$albumid%' order by `index` desc");
		
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=20;
				$max=$maxi;
				if($index>$counts)
				{
					$offset=0;
				}
				else
				{
					$offset=$index;
				}
				if($offset+$max>$counts-1)
				{
					$max=($counts)-$offset;
				}
				if($offset>0)
				{
					$First="<a href=\"#\" onclick=\"getPage('gallery.php','content','index=0&pageid=$pageid')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('gallery.php','content','index=$prev&pageid=$pageid')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('gallery.php','content','index=$Las&staffids='+document.staffids)\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('gallery.php','content','index=$nex&pageid=$pageid')\">Next</a>";
				}else
				{
					$Last="Last";
					$Next="Next";
				}
				if($offset+$max>$counts)
				{
					$limit=$counts-1;
				}else
				{
					$limit=$offset+$max;
				}
				
				
				
				for($x=(int)$offset;$x<$limit;$x++)
				{	@mysql_data_seek($rs,$x);
					$data=@mysql_fetch_array($rs);
					$pic="$data[1]";
					

					echo "
					
					<div class=\"loader\" align=\"left\" style=\"width:142px;height:160px;float:left;display:block;\" onClick=\"getPage('display.php','','galleryid=$data[0]')\">
						<div style=\"width:140px; height:140px;float:left;border:thin #bbbbbb dotted; vertical-align:middle;\" align=\"center\" >
							<img src=\"$data[1]\" height=\"". getPicH($pic,140)."\" width=\"". getPicW($pic,140)."\">
						</div>
						<div style=\"width:140px;float:left;\" align=\"center\">
							". ($x + 1) ."
						</div>
					</div><div style=\"width:5px;height:160px;float:left;display:block;\"></div>
					
					";
					
				}
			}
		}
	?>				  </td> 
    <tr>
                      <td width="401" height="28" valign="top" style=""><div align="right">Pictures <? 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?>
                      </div>                        
                        </div></td>
                      <td width="338" valign="top"><div align="center"><? echo"$First | $Previous | $Next | $Last "; ?></div></td>
    <tr>
    <td height="1"></td>
    <td></td>
    </table>
</center>
</body>
