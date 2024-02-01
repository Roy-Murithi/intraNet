
<div id="lsidebar">
	<div class="lsideinnerbar"><a href="downloads.php" target="_self">Downloads</a></div>
	<div  id="lsidebarinner">
	<?php	
		$rs=@mysql_query("select * from `downloadcat` where `active`='99'");
		if($rs)
		{	
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$max=$counts>4?4:$counts;
				?>
	<ul id="link1">
		Top downloads
				<?
				for($x=0;$x<$max;$x++)
				{
					$data=@mysql_fetch_array($rs);
					?>
		<li id="link1" style=" padding-left:10px;"><a href="spec_downloads.php?downloadcatid=<?php echo $data[0]; ?>"><?php echo $data[1]; ?></a></li>
					<?
				}
			}
		}
?>
	 </ul>
	 </div>
	 <div style="height:5px;" ></div>
</div>