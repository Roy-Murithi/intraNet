<?php
	if(@$_GET['sessid']!='smetsysmocmas')
	{
		echo "here";exit;
		header("location:../index.php?pid=0");
	}
	
	include "conn.php";
date_default_timezone_set("Africa/Nairobi");
	//include ("../globalfunc.php");
	$txtSearch=str_replace("'","\'",@$_GET['txtSearch']);
$index=@$_GET["index"];
if(@$_GET["staffid"]!="")
{
	if(@$_GET["del"]=="99")
	{
		$rs=@mysql_query("delete from `staff` where `staffid`='".@$_GET['staffid']."'");
	}
	else
	{
		$rs=@mysql_query("select * from `staff` where `staffid`='".@$_GET["staffid"]."'");
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


<script language="javascript" src="../scripts/counterajax.js"></script>
<script language="javascript">
function getJob()
	{
		frmUsers.txtDat10.value=frmUsers.txtDat9.options[frmUsers.txtDat9.selectedIndex].text;
	}
	function delPage(url,container,param)
	{
		var choice
		choice=confirm("Are you sure you want to delete this Staff member?");
		
		if (choice==true)
		{
			getPage(url,container,param)
		}
	}
	function addUser()
	{ 

			if ( document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value==""  |  document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid staff information");
			}
			else
			{
				if ( document.frmUsers.txtDat2.value != document.frmUsers.txtConfirm.value)
				{
					alert("Password confirmation did not match, please re-enter password");
					return 0;
				}
				if ( document.frmUsers.txtDat2.value.length<6)
				{
					alert("Enter password with atleast 6 characters");
					return 0;
				}				
				//save user
				document.frmUsers.submit()				
			}
	}
	function saveUser(staffid)
	{
			if(staffid!="")
		{		if (document.frmUsers.txtDat1.value=="" | document.frmUsers.txtDat2.value=="" |  document.frmUsers.txtDat3.value=="" |  document.frmUsers.txtDat4.value==""  |  document.frmUsers.txtDat5.value=="")
			{
				alert("Enter valid staff information");
			}
			else
			{
				if ( document.frmUsers.txtDat2.value != document.frmUsers.txtConfirm.value)
				{
					alert("Password confirmation did not match, please re-enter password");
					return 0;
				}
				if ( document.frmUsers.txtDat2.value.length<6)
				{
					alert("Enter password with atleast 6 characters");
					return 0;
				}				
				//save user
				document.frmUsers.submit()				
			}
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
<table width="794" class="Black_Header_Text">
	      <!--DWLayoutTable-->
            <tr>
              <td width="352" height="31" valign="top">Investigators</td>
              <td colspan="3" valign="top"><div align="right"> <form name="frmSearch" enctype="multipart/form-data" method="get" style="width:300px;"  action="staff.php">Search: <input type="text" class="STR1" name="txtSearch" value="<?php echo @$_GET['txtSearch'];?>" /><input type="submit" name="btnSearch" class="BTN" value="Search" />
			  <input type="hidden" name="sessid" value="smetsysmocmas" />
			  </form>
              </div></td>
              <td width="118" valign="top"><div align="right"><?php
		$script="";
		echo classBTN("btnReturn","Add Investigator","editstaff.php","sessid=smetsysmocmas","$script","#FF0000"); 
		?></div></td>
  <tr>
              <td height="20" colspan="5" valign="top"><img src="../images/phead.png" width="700" height="5" /></td>

  <tr>
                  <td height="281" colspan="5" valign="top" class="Black_Header_Text">
				  
				   <?php
				   
				   $where="";
				   $First="First";
				   $Previous="Previous";
				   $Next="Next";
				   $Last="Last";
				   $limit="0";
				   $counts="0";
				   if($txtSearch!="")
				   {
				   	$where="where `names` like '%".$txtSearch."%'";
				   }else
				   {
				   	$where="";
				   }
				   
		$rs=@mysql_query("select * from staff $where order by `names` ASC");

		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				$maxi=12;
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
					$First="<a href=\"#\" onclick=\"getPage('staff.php','content','index=0')\">First</a>";
					if($offset-$maxi<0)
					{
						$prev=0;
					}else
					{
						$prev=$offset-$maxi;
					}
					$Previous="<a href=\"#\" onclick=\"getPage('staff.php','content','index=$prev')\">Previous</a>";
				}else
				{
					$First="First";
					$Previous="Previous";
				}
				
				if($offset+$max<$counts)
				{
					$Las=($counts)-$max;
					$Last="<a  href=\"#\" onclick=\"getPage('staff.php','content','index=$Las')\">Last</a>";
					
					$nex=$offset+$max;
					$Next="<a href=\"#\" onclick=\"getPage('staff.php','content','index=$nex')\">Next</a>";
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
				
				for($x=$offset;$x<$limit;$x++)
				{	@mysql_data_seek($rs,$x);
					$data=@mysql_fetch_array($rs);
					echo "
					<div style=\"width:190px; height:210px;float:left\">
					<div style=\"border:thin dotted; background:#BFE5BF;  width:180px; height:200px;float:left;\">
				  		<div  style=\" width:180px; height:100px;margin:5px;\" align=\"center\">";
							?>
							<img src="<?php 
				if(is_file("../../".$data[6]))
				{
		  			echo "../../".$data[6];
				}
				else
				{
					echo "../../staff/photo/avator.png";
				}
				$pic="../../".$data[6];
				
				if(@$data[9]=="99"){$levelName="Undefined";}
		   		elseif(@$data[9]=="0"){$levelName="Director";}
		 		elseif(@$data[9]=="1"){$levelName="Director - Investigations";}
		  		elseif(@$data[9]=="2"){$levelName="Deputy Director - Complaints";}
		   		elseif(@$data[9]=="3"){$levelName="Deputy Director - Research";}
		  		elseif(@$data[9]=="4"){$levelName="Deputy Director - Monitoring and Evaluation";}
           		elseif(@$data[9]=="5"){$levelName="Head of Complaint";}
		   		elseif(@$data[9]=="6"){$levelName="Head of Legal";}
		   		elseif(@$data[9]=="7"){$levelName="Legal Officer";}
		   		elseif(@$data[9]=="8"){$levelName="Investigator";}	
		   		elseif(@$data[9]=="9"){$levelName="Complaints Officer";}
		  		elseif(@$data[9]=="10"){$levelName="Complaints Committee";}
				else{$levelName="Unknown";}		  
				
				
		  ?>" border="1" style="border-color:B2D1B2" height="<?php echo getPicH($pic,100); ?>" width="<?php echo getPicW($pic,100); ?>"  />	
							<?php
							echo "
						</div>
						<div  style=\" width:180px; height:100px;\"  align=\"center\">
							$levelName<br/>
							$data[3]<br/>
							$data[5]<br/> 
							<a href=\"#\" onclick=\"getPage('editstaff.php','content','staffid=$data[0]')\">Edit</a> | 
							<a href=\"#\" onclick=\"delPage('staff.php','content','staffid=$data[0]&del=99&index=$offset')\">Delete</a>
						</div>
					</div>				  
				  	</div>
					";
				}
			}
		}
	?>				  </td>
  <tr>
    <td height="21" colspan="5" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <tr>
    <td height="34" colspan="2" valign="top"><div align="right" class="PlainContent_Box">Staff <?php 
	if($limit==0){$index=0;}else{$index=(int)@$offset+1;}
	echo "$index to $limit of $counts"; ?></div></td>
  <td width="151">&nbsp;</td>
    <td colspan="2" valign="top" class="PlainContent_Box"><div align="center"><?php echo"$First | $Previous | $Next | $Last "; ?></div></td>
  <tr>
    <td height="5"></td>
    <td width="16"></td>
    <td></td>
    <td width="121"></td>
    <td></td>
  </tr>
</table>
