<?php
session_start();
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		header("location:../index.php?pid=0");
	}
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
//include "globalfunc.php";
?>
<script src="../scripts/counterajax.js" ></script>
<script language="javascript">
	
	
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<form action="savecomplaint.php" method="post" enctype="multipart/form-data" name="frmUsers">

<table width="800" border="0" cellpadding="0" cellspacing="0" class="Black_Header_Text">
  <!--DWLayoutTable-->

  
  
  <tr>
    <td width="398" height="23" valign="top">Contacts</td>
    <td colspan="2" valign="top"><div style="float:left">Search by names:
        <input name="txtSearch" type="text" id="txtSearch" value="<?php $search=@$_GET['search'];echo @$search; ?>" />
    </div>      <div style="float:left">
        <?php 
	  $script="getPage('contact.php','content','sessid=smetsysmocmas&index=".(int)@$_GET['index']."&search=' +document.frmUsers.txtSearch.value)";
	  echo classBTN("btnApprove","Search","#","","$script"); ?>
      </div></td>
    </tr>
  <tr>
    <td height="21" colspan="3" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>
    </tr>
  <tr>
    <td height="44" colspan="3" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="1" class="Black_Header_Text"  >
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="36" height="20" valign="top" style="border-bottom:thin dotted;"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="225" valign="top" style="border-bottom:thin dotted;">Persons<u></u> </td>
            <td width="122" valign="top" style="border-bottom:thin dotted;">Identity</td>
            <td width="151" valign="top" style="border-bottom:thin dotted;">Summary</td>
            <td width="260" valign="top" style="border-bottom:thin dotted;">Complaints</td>
          </tr>
	    <tr>
	      <td height="16"></td>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td></td>
	    </tr>
	    
	    
	    
	    <?php
		$max=50;
		$start=(int)@$_GET['index'];
		$first="First";
		$last="Last";
		$next="Next";
		$prev="Previous";
		$url="investigation.php";
		$index=0;		
					
		$rs=@mysql_query("select * from ".$pref."persons where `surname` like '%$search%' or `firstname` like '%$search%' or `lastname` like '%$search%' order by `surname` asc");
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
					if($color=="#FFFFFF")
					{
						$color="#ABD8DA";
					}else
					{
						$color="#FFFFFF";
					}
					$data=@mysql_fetch_array($rs);
					if(@$data[20]=="99")
					{
						$names= @$data[3];
						$idd="Anonymous";
						$url="un_persons.php";
					}else
					{
						$names=@$data[2].". ".@$data[3]." ".@$data[4]." ".@$data[5];
						if($data[12]=="Yes")
						{
							if(@$data[21]!="")
							{
								$strPT= " (".$data[21].")";
							}else
							{
								$strPT= "";
							}
							$idd="Police officer".$strPT;
							$field=3;
						}else
						{
							$idd="Civilian";
							$field=2;
						}
						$url="persons.php";
					}
					$cases="&nbsp;";
					$casesdet="&nbsp;";
					$strCases="&nbsp;";
					$query="select * from ".$pref."complaint where `complainant` like '". $data[0]."!~!'";
					$rs1=mysql_query($query);
										
					$countVal=mysql_num_rows($rs1);
					if($countVal>0)
					{
						
						if($strCases=="&nbsp;")
						{
							$strCases= $countVal. " Case(s) as a Complainant";
						}else
						{
							$strCases=$strCases ."<br />".$countVal. " Case(s) as a Complainant";
						}
						for($z=0;$z<$countVal;$z++)
						{
							$datad=mysql_fetch_array($rs1);
							$query="select * from ".$pref."investigation where `complaintid`='". $datad[0]."'";
							$rs2=mysql_query($query);
							$strInv="";
							if(@mysql_num_rows($rs2)>0){$datainv=mysql_fetch_array($rs2);$strInv=" (<a href=\"investigationdetails.php?complaintid=$datainv[1]&sessid=smetsysmocmas&url1=contact\">$datainv[0]</a>)";}
							if($casesdet=="&nbsp;"){
								$casesdet="<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Complainant<br />";
							}else
							{
								$casesdet=$casesdet."<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Complainant<br />";
							}
						}
					}$countVal=0;
					
					$query="select * from ".$pref."complaint where `againist` like '". $data[0]."!~!'";
					$rs1=mysql_query($query);
					
					$countVal=mysql_num_rows($rs1);
					if($countVal>0)
					{
						
						if($strCases=="&nbsp;")
						{
							$strCases= $countVal. " Case(s) as a Defedant";
						}else
						{
							$strCases=$strCases ."<br />". $countVal. " Case(s) as a Defedant";
						}
						for($z=0;$z<$countVal;$z++)
						{
							$datad=mysql_fetch_array($rs1);
							$query="select * from ".$pref."investigation where `complaintid`='". $datad[0]."'";
							$rs2=mysql_query($query);
							$strInv="";
							if(@mysql_num_rows($rs2)>0){$datainv=mysql_fetch_array($rs2);$strInv=" (<a href=\"investigationdetails.php?complaintid=$datainv[1]&sessid=smetsysmocmas&url1=contact\">$datainv[0]</a>)";}
							if($casesdet=="&nbsp;"){
								$casesdet="<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Defedant<br />";
							}else
							{
								$casesdet=$casesdet."<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Defedant<br />";
							}

						}
					}$countVal=0;
					
					$query="select * from ".$pref."complaint where `witnesses` like '". $data[0]."!~!'";
					$rs1=mysql_query($query);
					
					$countVal=mysql_num_rows($rs1);
					if($countVal>0)
					{
						
						if($strCases=="&nbsp;")
						{
							$strCases= $countVal. " Case(s) as a Witness";
						}else
						{
							$strCases=$strCases ."<br />".$countVal. " Case(s) as a Witness";
						}
						for($z=0;$z<$countVal;$z++)
						{
							$datad=mysql_fetch_array($rs1);
							$query="select * from ".$pref."investigation where `complaintid`='". $datad[0]."'";
							$rs2=mysql_query($query);
							$strInv="";
							if(@mysql_num_rows($rs2)>0){$datainv=mysql_fetch_array($rs2);$strInv=" (<a href=\"investigationdetails.php?complaintid=$datainv[1]&sessid=smetsysmocmas&url1=contact\">$datainv[0]</a>)";}
							if($casesdet=="&nbsp;"){
								$casesdet="<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Witness<br />";
							}else
							{
								$casesdet=$casesdet."<a href=\"../complaint/apcomplaintdetails.php?complaintid=$datad[0]&sessid=smetsysmocmas&url1=contact\">$datad[0]</a>".$strInv." - Witness<br />";
							}
						}
					}$countVal=0;
					
					
					
					echo "
					<tr style=\"background:$color; border-bottom:thin dotted;\"><td valign=\"top\" style=\"border-bottom:thin dotted;\">".($x+1)."</td><td  valign=\"top\" style=\"border-bottom:thin dotted;\"><a href=\"#\" onclick=\"getPage('$url','content','fld=$field&personsid=$data[0]')\">$names</a></td><td  valign=\"top\" style=\"border-bottom:thin dotted;\">$idd</td><td valign=\"top\" style=\"border-bottom:thin dotted;\">$strCases</td>
					<td valign=\"top\" style=\"border-bottom:thin dotted;\">$casesdet
					</td>
					
					</tr>
					";
				}
			}
		}
	?>
      </table></td>
    </tr>
  <tr>
    <td height="27" colspan="2"  valign="top"><div align="right"><?php if(@$counts>0){$alpha=(int)$start+1;}else{$alpha=0;$max=0;$start=0;}echo "Displaying $alpha to ". ((int)$start + $max) ." of $counts records"; ?></div></td>
    <td width="342" align="right" valign="top"><?php echo "$first | $prev | $next | $last"; ?></td>
    </tr>
  <tr>
    <td height="0"></td>
    <td width="60"></td>
    <td></td>
    </tr>
</table>
</form>

