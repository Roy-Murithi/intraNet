<style>
	.pinned{
	 background-repeat:no-repeat;background-image:url(images/pin2.gif);background-position:left;padding-left:12px;	
	}
	li.pinned:hover{
	}
</style>
<div id="lsidebar" style="width:209px;height:264px">
	<div class="lsideinnerbar"><a href="staff.php" target="_self">Highlights</a></div>
	<div  id="lsidebarinner">
	<ul id="link1" style="border:none;">
	 <?php
	$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='2' order by zorder asc");
	$strMNU="";
	if($rsTopmnu)
	{
		$rowsmnu=mysql_num_rows($rsTopmnu);
		if($rowsmnu>0)
		{
			//$strMNU="<ul style=\"list-style:none;margin:0px; padding:0px;; font-size:10px\">\n";
			for($x=0;$x<$rowsmnu;$x++)
			{
				$data=mysql_fetch_array($rsTopmnu);
				$strMNU=$strMNU . "<li id=\"link12\" class=\"pinned\"><a href=\"$data[3]\" >$data[1]</a></li>\n";	
			}
			//$strMNU=$strMNU . "</ul>\n";
		}
	}
	echo $strMNU;
	?>
	</ul>
	</div>
	 <div style="height:5px;" ></div>
</div>