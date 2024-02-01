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
<title>Jomo Kenyatta University of Agriculture and Technology</title>
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
	html, body{ height:100%}
	.film{
	background:#000000;
	}
	div.film:hover{
	background:#004400;
	cursor:pointer;
	
	}
</style>
<body style="background-image:url(images/topback.png); background-repeat:repeat-x; background-position:top; margin:0px" onload="init();">
<center>


<?php
	include "theme/header.php";
?><table width="995" border="0" cellpadding="0" cellspacing="0" style="width:1024px; background-image:url(images/tbback.png); background-position:top; background-repeat:repeat-x;">
  <!--DWLayoutTable-->
  <tr>
    <td width="154" rowspan="2" valign="top" class="Black_Header_Text">
	  <?php include "functions/highlights.php"; ?>	</td>
	  <td width="6" height="252">&nbsp;</td>
	  <td colspan="2" align="left" valign="top" style=" background-image:url(slider/imgbg.png); background-position:left top; background-repeat:no-repeat; vertical-align:top; background-color:#000000">
	    <div id="bg" style="position:relative; height:249px; width:<?php echo $dispWidth; ?>px; overflow:hidden">
	      <div id="sec" style=" width:<?php echo $dispWidth; ?>px; height:248px; position:absolute; top:0px; left:0px;">
          <img id="imgbuff" src="<?php echo $datad[1];?>" style="left:0px; top:0px; border:thin solid #000000; height:248px; width:<?php echo $dispWidth; ?>px;"  alt="<?php echo $datad[2];?>" />		</div>
          <div id="prim" style=" width:1px; height:248px; position:absolute; top:-252px; left:-1px;">
          <img id="imgprim" src="<?php echo $datad[1];?>" style="left:0px; top:0px; border:thin solid #000000; height:248px; width:<?php echo $dispWidth; ?>px;" alt="<?php echo $datad[2];?>" />		</div>
          <div id="txtDisplay" style=" width:<?php echo $dispWidth; ?>px; height:71px; position:absolute; top:307px; left:8px; background-image:url(slider/sliderbg.png); background-position:center top; background-repeat:no-repeat; vertical-align:middle" align="center" class="Black_Header_Text">
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
    <td height="53" colspan="6" valign="top" ><div align="center"><img src="images/button1.png" width="179" height="48" /><img src="images/button2.png" width="179" height="48" /><img src="images/button3.png" width="179" height="48" /><img src="images/button4.png" width="179" height="48" /></div></td>
    </tr>
  
  <tr>
    <td height="195" valign="top" class="Black_Header_Text">
	  <?php include "theme/leftsidebar.php"; ?>	  </td>
    <td>&nbsp;</td>
    <td valign="top"><div align="left" class="News">
      <?php $called="xtreme coding";
	  include "functions/posts.php"; ?>
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
