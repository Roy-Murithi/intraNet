<?php 
include "conn.php";
?>
<div id="lsidebar" >
	<div class="lsideinnerbar"><a href="album.php" target="_self">Gallery</a></div>
	<div  id="lsidebarinner">
	<ul id="link1">
	Top albums
	<?php
	$rs=@mysql_query("select * from `".$pref."album`  order by `index` desc,`title` asc");
		if($rs)
		{
			$counts=@@mysql_num_rows($rs);
			if ($counts>0)
			{
				if($counts>4)
				{
					$max=4;
				}else
				{
					$max=$counts;
				}
				for($x=0;$x<$max;$x++)
				{	
					$data=mysql_fetch_array($rs)
	?>
	<li id="link1" style=" padding-left:10px;"><a href="gallery.php?albumid=<?php echo $data[0]; ?>"><?php echo "$data[1]"; ?></a></li>
	<?
				}
			}
		}
	?>
	 </ul>
	 </div>
	 <div style="height:5px;" ></div>
</div>