<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/newstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript">
document.extensions=new Array();
document.extensions[0]='123';
document.extensions[1]='276';
document.extensions[2]='269';
document.extensions[3]='263';
document.extensions[4]='213';
document.extensions[5]='271';
document.extensions[6]='136';
document.extensions[7]='147';

document.extensionsNum="";

document.email=new Array();
document.email[0]="complaint"+Math.floor(Math.random()*100) + "@domain.com";
document.email[1]="complaint"+Math.floor(Math.random()*100) + "@domain.com";
document.email[2]="test"+Math.floor(Math.random()*100)+ "@domain.com";
document.email[3]="test"+Math.floor(Math.random()*100)+ "@domain.com";
document.email[4]="test"+Math.floor(Math.random()*100) + "@domain.com";
document.email[5]="anonymous"+Math.floor(Math.random()*100) + "@domain.com";
document.email[6]="anonymous"+Math.floor(Math.random()*100) + "@domain.com";
document.email[7]="anonymous"+Math.floor(Math.random()*100)+ "@domain.com";
document.email[8]="anonymous"+Math.floor(Math.random()*100) + "@domain.com";
document.email[9]="anonymous"+Math.floor(Math.random()*100) + "@domain.com";



document.scene=new Array();
document.sceneNum=0;
	for(x=0;x<100;x++)
	{
		document.scene[x]=new Array();
		z=Math.floor(Math.random()*10);
		if(z>=9)
		{
			document.scene[x][0]="E-mail";
			document.scene[x][1]=document.email[Math.floor(Math.random()*10)];
			document.scene[x][2]="";
			document.scene[x][6]=Math.floor(Math.random()*10)*10000;
			document.scene[x][7]=0;
			
		}else
		{
			document.scene[x][0]="Call";
			i=Math.floor(Math.random()*10);
			if(i<2){strPhone="02";}else if(i<4){strPhone="0722";}else if(i<6){strPhone="073";}else if(i<8){strPhone="+254722";}else {strPhone="0711";}
			document.scene[x][1]=strPhone+ Math.floor(Math.random()*1000000);
			document.scene[x][2]="";
			document.scene[x][3]=1000;
			document.scene[x][4]=Math.floor(Math.random()*10000);
			document.scene[x][5]=Math.floor(Math.random()*10);
			document.scene[x][6]=Math.floor(Math.random()*1000);
			document.scene[x][7]=0;
			
		}		
		
		
		//document.extensionsNum=document.extensionsNum+1;
		//if(document.extensionsNum>7){document.extensionsNum=0;}
	}
	

function display()
{	

	if(document.display.length>0)
	{
		for(x=0;x<document.display.length;x++)
		{
			if(x>34){setTimeout("display()",1);return 0;}

			
			z=(document.display.length-1)-x;
			//calculations
			if(document.display[z][0]=="Call")
			{
				//calls
				if(Number(document.display[z][7])==0)
				{
					document.display[z][3]=document.display[z][3]-1;
					document.display[z][6]=document.display[z][6]-1;
					if(document.display[z][3]==0)
					{						
						if(Number(document.display[z][5])==1)
						{
							document.display[z][7]=98;
							document.extensionsNum=document.extensionsNum.replace("!~!"+document.display[z][2]+"!~!","");
						}else
						{
							if(document.display[z][6]==0){document.display[z][7]=1;}
							document.display[z][7]=1;
						}
					}
				}
				
				if(Number(document.display[z][7])==1)
				{
					document.display[z][4]=document.display[z][4]-1;
					if(document.display[z][4]==0)
					{						
						document.display[z][7]=99;
						document.extensionsNum=document.extensionsNum.replace("!~!"+document.display[z][2]+"!~!","");
					}
				}
			}
			else
			{
				//emails
					document.display[z][3]=document.display[z][3]-1;
					if(document.display[z][3]==0)
					{						
						document.display[z][7]=99;
						document.extensionsNum=document.extensionsNum.replace("!~!"+document.display[z][2]+"!~!","");
					}
			}
			
			//displays		
			var colDiv=document.getElementById("Col1Row"+x);
			if(document.display[z][0]=="Call")
			{
				strCall="--> Ext."+document.display[z][2];
			}else
			{
				strCall="";
			}
			colDiv.innerHTML=document.display[z][0]+strCall;
			var colDiv=document.getElementById("Col2Row"+x);
			colDiv.innerHTML=document.display[z][1];
			if(x>document.display.length){setTimeout("display()",10);return 0;}
			
			//colors
			if(Number(document.display[z][7])==0)
			{
				
				setDisp("Col3Row"+x,"","#00FF33");
				setDisp("Col4Row"+x,"","");
				setDisp("Col5Row"+x,"","");
				setDisp("Col6Row"+x,"","");
				setDisp("Col7Row"+x,"Incoming","");
				setDisp("Col8Row"+x,"","");
			}else if(document.display[z][7]==1)
			{
				document.display[z][9]=document.display[z][9]+1;
				setDisp("Col3Row"+x,"","#AAAAAA");
				setDisp("Col4Row"+x,"","#00FF33");
				setDisp("Col5Row"+x,"","#00FF33");
				setDisp("Col6Row"+x,Math.floor(Number(document.display[z][9])/100)+" Seconds","");
				setDisp("Col7Row"+x,"No","");
				setDisp("Col8Row"+x,"","");
								
			}else if(document.display[z][7]==98)
			{
				setDisp("Col3Row"+x,"","#AAAAAA");
				setDisp("Col4Row"+x,"","#AAAAAA");
				setDisp("Col5Row"+x,"","#AAAAAA");
				setDisp("Col6Row"+x,"0","");
				setDisp("Col7Row"+x,"Yes","");
				setDisp("Col8Row"+x,"Missed call","");
			}else if(document.display[z][7]==99)
			{
				setDisp("Col3Row"+x,"","#AAAAAA");
				setDisp("Col4Row"+x,"","#AAAAAA");
				setDisp("Col5Row"+x,"","#AAAAAA");
				if(document.display[z][0] =="Call")
				{
					setDisp("Col6Row"+x,Math.floor(Number(document.display[z][9])/100)+" Seconds","");
				}else
				{
					setDisp("Col6Row"+x,"","");
				}
				setDisp("Col7Row"+x,"Yes","");
				setDisp("Col8Row"+x,"Yes","");
			}
			
			//
		}
	}
	setTimeout("display()",1);
}

function setDisp(div,text,color)
{
	if(color==""){color="#FFFFFF";}
	var colDiv=document.getElementById(div);
	colDiv.innerHTML=text;
	colDiv.style.backgroundColor=color;
}

document.display=new Array();
document.currentSimulation=0;
function simulate()
{	
	exNum="";
	for(x=0;x<=7;x++)
	{
		if(document.extensionsNum.indexOf(document.extensions[x])>0)
		{
			//lenga hiyo story
		}else
		{
			exNum=document.extensions[x];
		}
	}
	if(exNum!="")
	{
		document.display[document.currentSimulation]=new Array();
		document.display[document.currentSimulation][0]=document.scene[document.currentSimulation][0]
		document.display[document.currentSimulation][1]=document.scene[document.currentSimulation][1]
		
		document.display[document.currentSimulation][2]=exNum;
		document.extensionsNum=document.extensionsNum+"!~!"+exNum+"!~!";
		document.display[document.currentSimulation][3]=document.scene[document.currentSimulation][3]
		document.display[document.currentSimulation][4]=document.scene[document.currentSimulation][4]
		document.display[document.currentSimulation][5]=document.scene[document.currentSimulation][5]
		document.display[document.currentSimulation][6]=document.scene[document.currentSimulation][6]
		document.display[document.currentSimulation][7]=0
		document.display[document.currentSimulation][8]=0
		document.display[document.currentSimulation][9]=0
		
		document.currentSimulation=document.currentSimulation+1;
		if(document.currentSimulation>100){document.currentSimulation=0;}
	}else
	{
		//code incoming call but busy system
	}
	z=Number(Math.floor(Math.random()*10000));
	setTimeout("simulate()",z);
}

</script></head>

<body onload="simulate();display()">

<div style="position:relative;" >
<div class="Black_Header_Text" style="float:left; width:1400px; margin-left:100px;" >
	<div  style="font-size:12px; float:left; width:100px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Incoming</div>
	<div  style="font-size:12px; float:left; width:200px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Contact</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Waiting</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Connected</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Recording</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Duration</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Disconnected</div>
	<div  style="font-size:12px; float:left; width:150px; border-bottom:thin dotted; background-color:#008B91;color:#FFFFFF;">Attended</div>
</div>
<?php
for($x=0;$x<35;$x++)
{
echo "<div id=\"Row$x\" class=\"Black_Header_Text\" style=\"float:left;width:1400px;margin-left:100px;\">
	<div id=\"Col1Row$x\"  style=\"font-size:12px; float:left; width:100px; border-bottom:thin dotted;height:15px; \"> </div>
	<div id=\"Col2Row$x\"   style=\"font-size:12px; float:left; width:200px; border-bottom:thin dotted;height:15px;\"> </div>
	<div id=\"Col3Row$x\"   style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px;\"> </div>
	<div id=\"Col4Row$x\"   style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px;\"> </div>
	<div id=\"Col5Row$x\"  style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px; \"> </div>
	<div id=\"Col6Row$x\"   style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px; \"> </div>
	<div id=\"Col7Row$x\"   style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px; \"> </div>
	<div id=\"Col8Row$x\"   style=\"font-size:12px; float:left; width:150px; border-bottom:thin dotted;height:15px; \"> </div>
</div>";
}
?>

</div>

</body>
</html>
