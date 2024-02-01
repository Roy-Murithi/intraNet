// JavaScript Document
function getX(angle,length)
{
	return Math.cos(angle/57.3)*length;
}			
function getY(angle,length)
{
	return Math.sin(angle/57.3)*length;
}	
function setDisp(hrs,mins,sec,container)
{
	var Hangle;
	Hangle=(hrs*(360/12))+(mins*(30/60));
	var Mangle;
	Mangle=mins*(360/60);//+(sec*(30/60));
	var Sangle;
	Sangle=sec*(360/60);
	
	var htmlCode="";
	var num="",num1="";
	var x,centerX=56;
	var y,centerY=40;
	var z;


//Shadow of time sticks
	//Hours
	for(z=-5;z<18;z++)
	{
	x=parseInt(getX(Hangle-90,z)+centerX+3);
	y=parseInt(getY(Hangle-90,z)+centerY);
	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:3px; height:3px; clip:rect(0, 3px, 3px, 0); background:#999999; overflow:hidden \"></div>";
	
	}
	
	//munites
	for(z=-7;z<23;z++)
	{
	x=parseInt(getX(Mangle-90,z)+centerX+3);
	y=parseInt(getY(Mangle-90,z)+centerY);
	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:2px; height:2px; clip:rect(0, 2px, 2px, 0); background:#999999; overflow:hidden  \"></div>";
	
	}	

		for(z=-10;z<28;z++)
	{
	x=parseInt(getX(Sangle-90,z)+centerX+3);
	y=parseInt(getY(Sangle-90,z)+centerY);	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:1px; height:1px;  clip:rect(0, 1px, 1px, 0); background:#999999; overflow:hidden   \"></div>";	
	}
//end if Shadow
	//Hours
	for(z=-5;z<18;z++)
	{
	x=parseInt(getX(Hangle-90,z)+centerX);
	y=parseInt(getY(Hangle-90,z)+centerY);
	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:3px; height:3px; clip:rect(0, 3px, 3px, 0); background:#000000; overflow:hidden \"></div>";
	
	}
	
	//munites
	for(z=-7;z<23;z++)
	{
	x=parseInt(getX(Mangle-90,z)+centerX);
	y=parseInt(getY(Mangle-90,z)+centerY);
	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:2px; height:2px; clip:rect(0, 2px, 2px, 0); background:#00FF00; overflow:hidden  \"></div>";
	
	}	

	//seconds
	for(z=-10;z<28;z++)
	{
	x=parseInt(getX(Sangle-90,z)+centerX);
	y=parseInt(getY(Sangle-90,z)+centerY);	
	htmlCode=htmlCode + "<div style=\"position:absolute; top:"+y + "px; left:"+ x +"px; width:1px; height:1px;  clip:rect(0, 1px, 1px, 0); background:#FF0000; overflow:hidden   \"></div>";	
	}
	
	var display=document.getElementById(container);
	display.innerHTML=htmlCode;
}

