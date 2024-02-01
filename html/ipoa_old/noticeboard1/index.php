<?php 
include "conn.php";
include "globalfunc.php";

//loads first image
		$rs=@mysql_query("select * from `".$pref."slider` order by `index` ASC");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$datad=@mysql_fetch_array($rs);
			}
		}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IPOA - Notice Board</title>
<link rel="shortcut icon" href="./images/linklogo.bmp" label="IPOA">
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript">
	/*//animating the main image
	//declare variables to hold image offline
	document.sliderImage=new Array();
	document.sliderImage[0]=new Image;
	document.sliderImage[0].src="slider/img1.png";
	document.sliderImage[1]=new Image;
	document.sliderImage[1].src="slider/img2.png";
	function loadImage1(nextImage)
	{
		
	}
	
	function swapImage()
	{
		
	}
	
	function animate(index)
	{	
		if(index>1)
		{
			index=0;
		}
		var animslider=document.getElementById("sliderx");
		//animslider.src=document.sliderImage[index].src;
		index=index+1;
		setTimeout("animate("+index+")",5000)
	}	*/
	document.picarray=Array();
	document.picDetails=Array();
	document.picAlttext=Array();
	//picarray[3]="mainpics/mainpic4.png";
	<?php
		$rs=@mysql_query("select * from `".$pref."slider` order by `index` ASC");
		if($rs)
		{
			$counts=@mysql_num_rows($rs);
			if ($counts>0)
			{
				$xx=0;
				for($x=0;$x<$counts;$x++)
				{
					$datax=@mysql_fetch_array($rs);
					if($datax[1] !="")
					{
						if(is_file($datax[1])==true)
						{
							echo "
							document.picarray[$xx]=new Image;\n
							document.picarray[$xx].src=\"$datax[1]\";\n
							document.picAlttext[$xx]=\"$datax[2]\";\n
							 document.picDetails[$xx]=\"$datax[3]\";\n
							";
							$xx=$xx+1;
						}
					}
				}
				echo "document.maxc=$xx;";
			}
		}
	?>
	document.imgStatus=1;
	document.imgCount=0;
	document.delay=3000;
	document.bypass=false;
	function display()
	{
		var div2= document.getElementById("txtDisplay");
		if(typeof div2.style.opacity=="string")
		{
			div2.style.opacity=0.75;
		}else
		{
					
			div2.style.filter ='alpha(opacity=' + 75 + ')';
		}
		var divText= document.getElementById("txtDetails");
		divText.innerHTML=document.picDetails[document.imgCount];
		var temp=new Array();
		temp=document.picDetails[document.imgCount].split(" ");
		if(temp.length>10)
		{
			var delay=temp.length*300;
		}else
		{
			var delay=3000;
		}
		document.delay=delay;
		pandishaText(261);
			
	}
	function pandishaText(top)
	{
		var div1= document.getElementById("txtDisplay");
		div1.style.top=top+"px";				
		if(top>190)
		{
			top=top-1;
			setTimeout("pandishaText("+ top +")",20);
		}else
		{
			
			setTimeout("shukishaText(190)",document.delay);
		}			
	}
	function loadImage(index)
	{
		document.bypass=true;
		document.imgCount=Number(index);
		var div2= document.getElementById("imgc"+document.imgCount);
				if(typeof div2.style.opacity=="string")
				{
					div2.style.opacity=0;
				}else
				{
							
					div2.style.filter ='alpha(opacity=' + 0 + ')';
				}
	}
	function swapImage()
	{
		
		var img="";
		if(document.bypass==true)
		{
			document.bypass=false;
		}else
		{
			document.imgCount=document.imgCount+1;
		}		
		if(document.imgCount>=document.maxc)
		{
			document.imgCount=0;
		}
		if(document.imgStatus==1)
		{
			img= document.getElementById("imgprim");
			document.imgStatus=2;
		}else
		{
			img= document.getElementById("imgbuff");	
			document.imgStatus=1;
		}
		img.src=document.picarray[document.imgCount].src;
		img.alt=document.picAlttext[document.imgCount];
		
	}	
	function shukishaText(top)
	{
		var div1= document.getElementById("txtDisplay");
		div1.style.top=top+"px";				
		if(top<=261)
		{
			top=top+1;
			setTimeout("shukishaText("+ top +")",20);
		}else
		{
				var test=swapImage();
				for(x=0;x<document.maxc;x++)
				{
					var div2= document.getElementById("imgc"+x);
					if(typeof div2.style.opacity=="string")
					{
						div2.style.opacity=0.40;
					}else
					{
								
						div2.style.filter ='alpha(opacity=' + 40 + ')';
					}
				}
				
				var div2= document.getElementById("imgc"+document.imgCount);
				if(typeof div2.style.opacity=="string")
				{
					div2.style.opacity=0;
				}else
				{
							
					div2.style.filter ='alpha(opacity=' + 0 + ')';
				}
				
				if(getValfromPX(div2.style.top)+getValfromPX(div2.style.height)>200)
				{					
					scrollup();
				}else
				{
					animate(0);
				}
		}			
	}
	
	function scrollup()
	{
		var divc= document.getElementById("img"+document.imgCount);
		var divcc= document.getElementById("imgc"+document.imgCount);
		
		if(getValfromPX(divc.style.top)+getValfromPX(divc.style.height)>240)
		{	
			for(x=0;x<document.maxc;x++)
			{
				var div2= document.getElementById("img"+x);
				var div3= document.getElementById("imgc"+x);
				div2.style.top=(getValfromPX(div2.style.top)-1)+"px";
				div3.style.top=(getValfromPX(div3.style.top)-1)+"px";
				if(getValfromPX(div2.style.top)+getValfromPX(div2.style.height)<-2)
				{
					div2.style.top=((document.maxc-1)*30)+"px";
					div3.style.top=((document.maxc-1)*30)+"px";
				}
			}
			setTimeout("scrollup()",1);
		}else
		{
			animate(0);
		}
	}
	
	function getValfromPX(str)
		{
			
			str=str.replace("px","");
			return Number(str);
		}
	
	function animate(x)
	{
		x=Number(x);
		var div1= document.getElementById("prim");
		
		x+=0.05;		
		if(x<1)
		{
			if(document.imgStatus==2)
			{
				if(typeof div1.style.opacity=="string")
				{
					div1.style.opacity=x;
				}else
				{
					
					div1.style.filter ='alpha(opacity=' + Number(x)*100 + ')';
				}
			}else
			{
				y=1-x;			
				if(typeof div1.style.opacity=="string")
				{	
					div1.style.opacity=y;
				}else
				{
					div1.style.filter ='alpha(opacity=' + Number(y)*100 + ')';
				}
			}
			setTimeout("animate("+ x +")",20);
		}else
		{
			
			display();
		}
		
	}
	function init()
	{
		
		for(x=1;x<document.maxc;x++)
		{
			var div2= document.getElementById("imgc"+x);
			if(typeof div2.style.opacity=="string")
			{
				div2.style.opacity=0.40;
			}else
			{
						
				div2.style.filter ='alpha(opacity=' + 40 + ')';
			}
		}
		var div2= document.getElementById("imgc0");
				if(typeof div2.style.opacity=="string")
				{
					div2.style.opacity=0;
				}else
				{
							
					div2.style.filter ='alpha(opacity=' + 0 + ')';
				}
		document.imgStatus=2;
		pandishaText(261);
	}
</script>
</head>
<style>
	
	#mnu2.nonbtne div{background-image:url(images/preve.png)}#mnu2.nonbtne div:hover{background-image:url(images/preveh.png)}
	#mnu2.nonbtnd div{background-image:url(images/prevd.png)}#mnu2.nonbtnd div:hover{background-image:url(images/prevdh.png)}
	#mnu3.nonbtne div{background-image:url(images/nexte.png)}#mnu3.nonbtne div:hover{background-image:url(images/nexteh.png)}
	#mnu3.nonbtnd div{background-image:url(images/nextd.png)}#mnu3.nonbtnd div:hover{background-image:url(images/nextdh.png)}
	
	html, body{ height:100%}
	.film{
	background:#000000;
	}
	div.film:hover{
	background:#004400;
	cursor:pointer;
	
	}
	
	.nonbtne{
	height:25px;
	width:30px;
	padding-top:10px;
	font-weight:bold;
	}
	
	
	.nonbtnd{
	height:25px;
	width:30px;
	padding-top:10px;
	font-weight:bold;
	}
	.clickedBTN{
	background-image:url(images/index1BTN.png);
	background-position:top;
	background-repeat:no-repeat;
	height:30px;
	padding-top:10px;
	font-weight:bold;
	}
	
	.unclickedBTN{
	background-image:url(images/index1BTN1.png);
	background-position:top;
	background-repeat:no-repeat;
	height:30px;
	padding-top:10px;
	font-weight:bold;	
	}
	.clickedBTNx{
	background-image:url(images/index1BTNx.png);
	background-position:top;
	background-repeat:no-repeat;
	height:30px;
	padding-top:10px;
	font-weight:bold;
	}.unclickedBTNx{
	background-image:url(images/index1BTN1x.png);
	background-position:top;
	background-repeat:no-repeat;
	height:30px;
	padding-top:10px;
	font-weight:bold;	
	}
	.nonclickedBTN{
	background-image:url(images/index1BTN2.png);
	background-position:top;
	background-repeat:repeat-x;
	height:40px;	
	}
	.indexD{
	width:563px;
	padding:10px;
	float:left; 
	border-bottom:thin solid #0166CC; 
	border-left:thin solid #0166CC; 
	border-right:thin solid #0166CC; 
	}
	#mnu1.unclickedBTN:hover {
	background-image:url(images/index1BTN1a.png);
	}
	#mnu1.unclickedBTNx:hover {
	background-image:url(images/index1BTN1ax.png);
	}
</style>
<body style="background-image:url(images/topback.png); background-repeat:repeat-x; background-position:top; margin:0px" <?php if(@$datad[1]!=""){?>onload="init();"<?php } ?>>
<center>


<?php
	include "theme/header.php";
	$dispWidth=711;
?><table width="995" border="0" cellpadding="0" cellspacing="0" style="width:1024px; background-image:url(images/tbback.png); background-position:top; background-repeat:repeat-x;">
  <!--DWLayoutTable-->
  <tr>
    <td width="154" rowspan="2" valign="top" class="Black_Header_Text">
	  <?php include "functions/highlights.php";?>	</td>
	  <td width="6" height="252">&nbsp;</td>
	  <td colspan="2" align="left" valign="top" style=" background-image:url(slider/imgbg.png); background-position:left top; background-repeat:no-repeat; vertical-align:top; background-color:#000000">
	    <div id="bg" style="position:relative; height:249px; overflow:hidden">
	      <div id="sec" style=" width:<?php echo $dispWidth; ?>px; height:248px; position:absolute; top:0px; left:0px;">
		  	<?php if(@$datad[1]!=""){?>
          	<img id="imgbuff" src="<?php echo $datad[1];?>" style="left:0px; top:0px; border:thin solid #000000; height:248px; width:<?php echo $dispWidth; ?>px;"  alt="<?php echo $datad[2];?>" />
		  </div>
          <div id="prim" style=" width:<?php echo $dispWidth; ?>px; height:248px; position:absolute; top:-252px; left:-1px;">
          	<img id="imgprim" src="<?php echo $datad[1];?>" style="left:0px; top:0px; border:thin solid #000000; height:248px; width:<?php echo $dispWidth; ?>px;" alt="<?php echo $datad[2];?>" />
			<?php
			}
			?>
		  </div>
          <div id="txtDisplay" style=" width:<?php echo $dispWidth-25; ?>px; height:71px; position:absolute; top:307px; left:8px; background-image:url(slider/sliderbg.png); background-position:center top; background-repeat:no-repeat; vertical-align:middle" align="center" class="Black_Header_Text">
            <div id="txtSpacer" style="width:578px; height:12px;">            </div>
            <div id="txtDetails" style="width:578px; height:35px;" align="center">
              <?php echo $datad[3];?>	        </div>
          </div>	
      </div></td>
    <td width="78" valign="top" style="background:#000000">
	            <div id="fil" >
              <div style="width:78px; height:250px; position:relative; overflow:hidden" id="film">
                <?php
	$rsr=@mysql_query("select * from `".$pref."slider` order by `index` ASC");
		if($rsr)
		{
			$countsr=@mysql_num_rows($rsr);
			if ($countsr>0)
			{
				$xr=0;
				for($x=0;$x<$countsr;$x++)
				{
					$datar=@mysql_fetch_array($rsr);
					if($datar[1] !="")
					{
						if(is_file($datar[1])==true)
						{
							?>
                <div id="img<?php echo $xr;?>" style="position:absolute; display:block; top:<? echo ($xr*30)?>px; left:0px; width:78px; height:27px; float:left;">
                <img  src="<?php echo $datar[1];?>" height="27" width="78" /></div>
                              <div id="imgc<?php echo $xr;?>" style="position:absolute; display:block; top:<? echo ($xr*30)?>px; left:0px; width:78px; height:27px; float:left;" class="film" onclick="loadImage(<?php echo $xr;?>)"></div>
                              <?
							$xr=$xr+1;
						}
					}
				}
			}
		}
	
	?>
              </div>
          </div></td>
  <td width="31">&nbsp;</td>
    <?
	  $dispWidth=700;
	  ?>
      </tr>
  
  <tr>
    <td height="22">&nbsp;</td>
    <td width="621">&nbsp;</td>
    <td width="120"></td>
    <td></td>
    <td></td>
  </tr>
  
 
  <tr>
    <td height="195" valign="top" class="Black_Header_Text">
	  <?php include "theme/leftsidebar.php"; ?>	  </td>
    <td>&nbsp;</td>
    <td valign="top" style="width:586px;"><div id="homecanvas" style="width:585px;">
	    <div class="nonclickedBTN" style="float:left;width:585px;">	      
		  	<a href="index.php?ipid=0"><div id="mnu1"  style="width:130px;float:left" class="<?php if((int)@$_GET['ipid']==0){echo "clickedBTN";}else{echo "unclickedBTN";}?> Black_Header_Text" align="center">News Update</div></a>		  
			<?

			$rsTopmnu=mysql_query("select * from ".$pref."menu where `type`='7' order by `ZOrder` ASC");
			$strMNU="";
			if($rsTopmnu)
			{
				$rowsmnu=mysql_num_rows($rsTopmnu);
				if($rowsmnu>0)
				{
					$nextm=(int)@$_GET['nextm'];
					
					if($nextm>0)
					{	
						$nextmm=$nextm-1;
						$img="images/preve.png";
						?>
						<?php echo "<a href=\"index.php?nextm=$nextmm&ipid=".($nextm+2)."\">"; ?>
						<div id="mnu2"  style="float:left" class="nonbtne Black_Header_Text" align="center">
							<div style="width:30px; height:25px; "></div>
						</div>
						</a>
					<?
					}else
					{
						$nextmm=0;
						$img="images/prevd.png";
						?>
						<div id="mnu2"  style="float:left" class="nonbtnd Black_Header_Text" align="center">
							<div style="width:30px; height:25px;"></div>
						</div>
					<?
					}
					
					$maxm=$nextm+2;					
					if($maxm+$nextm>$rowsmnu)
					{
						$maxm=$rowsmnu;
					}
					$intpageid="";
					for($x=$nextm;$x<$maxm;$x++)
					{
						mysql_data_seek($rsTopmnu,$x);
						$data=mysql_fetch_array($rsTopmnu);
						$num=$x+3;
						$pageid=str_replace("pg_template1.php?pageid=","",$data[3]);
						$pageid=str_replace("pg_template2.php?pageid=","",$data[3]);
						if($intpageid=="" && $num==@$_GET["ipid"])
						{
							$intpageid=$pageid;
						}
						?>
		    			<?php echo "<a href=\"index.php?ipid=$num&pageid=$pageid&nextm=$nextm\">"; ?><div id="mnu1"  style="width:130px;float:left" class="<?php if((int)@$_GET['ipid']==$num){echo "clickedBTNx";}else{echo "unclickedBTNx";}?> Black_Header_Text" align="center"><?php echo "$data[1]"; ?></div></a>
			
			<?
					}
					if(2+$nextm<$rowsmnu)
					{
						$nextmm=$nextm+1;
						$img="images/nexte.png";?>
						<?php echo "<a href=\"index.php?nextm=$nextmm&ipid=".($nextm+5)."\">"; ?>
						<div id="mnu3"  style="float:left" class="nonbtne Black_Header_Text" align="center">
							<div style="width:30px; height:25px;"></div>
						</div>
						</a>
						<?
					}else
					{
						$img="images/nextd.png";
						?>
						<div id="mnu3"  style="float:left" class="nonbtnd Black_Header_Text" align="center">
							<div style="width:30px; height:25px;"></div>
						</div>
						<?
					}
					
				}
			}
			?>
		    
		</div>
	      <div id="index1" class="indexD" align="left">
	        <?php  
			if((int)@$_GET['ipid']==0)
			{
				//gets news posts
				$called="xtreme coding";
	  			include "functions/posts.php"; 
			}elseif((int)@$_GET['ipid']==1)
			{
				//gets VC's word
				$called="xtreme coding";
				include "functions/index1.php";
			}else
			{
				//fetches other pages
				$pageid="";
				$pageid=@$_GET["pageid"];
				if($pageid=="")
				{
					$pageid=$intpageid;
				}
				if($pageid!="")
				{
					$rsData=mysql_query("select * from `".$pref."page` where `pageid`='$pageid';");
					if($rsData)
					{
						$rows=mysql_num_rows($rsData);
						if($rows>0)
						{
							$datap=mysql_fetch_array($rsData);												
						}
					}
				}else
				{
					echo "Error in the tab, system will redirect page...";
				}
				
				$strData=str_replace("\n","<br/>",@$datap[2]);
				$strData=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$strData);
				$strData=str_replace("../../","",$strData);
				if($strData!="")
				{
					echo $strData;
				}else
				{
					echo "<div class=\"Black_Header_Text\"><b>This page was moved or the link is broken, report this error to ictdept@ipoa.go.ke</b></div>";
				}
			}
			?>
          </div>	
      </div></td>
    <td colspan="3" valign="top"><span class="Black_Header_Text">
		<?php include "theme/rightsidebar.php"; ?>
    </span></td>
    </tr>
  
  
  
  <tr>
    <td height="8"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<?php
	include  "theme/tail.php";
?>
</center></body>

</html>
