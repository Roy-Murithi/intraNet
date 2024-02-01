<?php
	$temp=array();
	include "conn.php";
	include ("globalfunc.php");
	
	$keyword=@$_GET['txtSearch'];
	$keyword=stripTags(strip_tags($keyword));
?>
<style type="text/css">
<!--
.style14 {color: #000000}
-->
</style>
<body>
<table width="637">
	      <!--DWLayoutTable-->
		 
            
    <tr><td width="321" height="26" valign="top"><strong>
	<?php
	if($keyword!="")
	{
	 	echo"Search result for <i><font color=\"blue\">\"". $keyword."\"</font></i> in the posts";
	 }
	 else
	 {
		echo"All posts";
	 }
	  ?>
	
	</strong>	</td>
  <td width="251" valign="top" ><div style="float:left;">
        <form name="frmSearch" action="posts.php" method="get" style="width:250px" >
          <div align="right">
            <input  type="text" name="txtSearch" class="STR1" style="width:150px" value="<?php echo @$keyword;?>" />
            <input name="button" type="button" class="BTN" value="Search"  onClick="searchCourse('')"/>
            <input type="hidden" name="sessid" value="<? echo $_GET['sessid']; ?>">
          </div>
        </form>
    </div></td>
  <td width="42" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <tr>
    <td height="211" colspan="3" valign="top">
	
      <?php
	  $where2="";
	  $errorc="";
	  $first_t="First"; 
	  $prev_t="Previous"; 
	  $next_t="Next";
	  $last_t="Last";
	  
	  if($keyword!="")
	  {
	  	
	  	$temp=@split(" ",$keyword);
		$where="";
		for($x=0;$x<sizeof($temp);$x++)
		{
			if($temp[$x]!="" && strlen($temp[$x])>2)
			{
				if( $where=="")
				{
					$where="`name` like '%".$temp[$x]."%' ";
				}else
				{
					$where=$where." and `name` like '%".$temp[$x]."%' ";
				}
			}else
			{
				if (strlen($temp[$x])<=2)
				{
					$errorc=", System ignored searching single keyword ";
					$where="`name` like '!!!!!!!!' ";
				}
			}
			
		}
		$where2=" and ".$where;
		$where=" where ".$where;
	  }
	  
	
		$rs=mysql_query("select * from ".$pref."post ".@$where. " order by `others` desc ");
	
		if($rs)
		{
			
			
			$counts=@mysql_num_rows($rs);
			$next=0;
			$next=@(int)$_GET["next"];
			$max=0;
			$n=15;
			if($next+$n>$counts)
			{
				$last_n=$counts;
				$last_nx=$last_n;
			}else
			{
				$last_n=$next+$n;
				$last_nx=$last_n;
			}
			
			if ($counts>0)
			{
				
				//set displayable items
				if($counts<$next+$n)
				{
					$lastitem=$counts;
				}else
				{
					$lastitem=$next+$n;
				}
				
				//body for navigating
				{
					//navigate to first n items
					if($next>0)
					{
						$first_t="<a href=\"posts.php?next=0\">First</a>";
					}else
					{
						$first_t="First";
					}
					//navigate to last n items
					if($next+$n<$counts)
					{
						$last_n=$counts-$n;
						if($last_n<0)
						{
							$last_n=0;
						}
						$last_t="<a href=\"posts.php?next=$last_n\">Last</a>";
					}else
					{
						$last_t="Last";
					}
					//navigate to previous item
					if($next>0)
					{
						$prev_n=$next-$n;
						if($prev_n<0)
						{
							$prev_n=0;
						}
						$prev_t="<a href=\"posts.php?next=$prev_n\">Previous</a>";
					}else
					{
						$prev_t="Previous";
					}
					
					//navigate to next item
					if($next+$n<$counts)
					{
						$next_n=$next+$n;
						$next_t="<a href=\"posts.php?next=$next_n\">Next</a>";
					}else
					{
						$next_t="Next";
					}
				}
				$color="#FFFFFF";?>
				<div id="container<?php echo $x;?>" class="Black_Header_Text"  style="float:left; width:580px;border-bottom: thin dotted #CFCFCF"><?php echo "<div style=\"width:300px; float:left;\" class=\"Black_Header_Text\">Displaying ".($next+1)." to ".$last_nx." out of $counts posts $errorc</div>";?><div align="right"  style="width:200px; float:right;"><?php echo "$first_t | $prev_t | $next_t | $last_t";?></div></div>
				<?
				for($x=$next;$x<$lastitem;$x++)
				{
					mysql_data_seek($rs,$x);
					$datap=mysql_fetch_array($rs);
					echo "
					<div style=\"width:535px;float:left\">
						<div style=\"width:30px;float:left;margin-top:4px;\"><img src=\"images/pointer.gif\"/></div>
						<div style=\"width:505px;float:left;font-size:12px;\"><b><a href=\"$datap[4]?postid=$datap[0]\">$datap[1]</a></b><font style=\"font-size:10px;\"> - Posted on $datap[5]</font></div>				
					</div>";			
				}
			}else
			{
				echo "<div  class=\"Content_Text\">No record found for posts with keywords <i>\"$keyword\"</i></div>";
			}
	
		}
	?>	  </td>
  <tr>
      <td height="20" colspan="3" align="left" valign="top" class="Black_Header_Text"><div style="width:580px; float:left"><?php if(@$counts==0){$items="0"; }else{$items=$next+1;} echo "<div style=\"width:300px; float:left;\" class=\"Black_Header_Text\">Displaying ".$items." to ".(int)@$last_nx." out of ".(int)@$counts." posts  $errorc</div>";?><div align="right"  style="width:200px; float:right;"><?php echo "$first_t | $prev_t | $next_t | $last_t";?></div></div></td>
  <tr>
        <td height="1"></td>
        <td></td>
        <td></td>
  </table>
</body>
