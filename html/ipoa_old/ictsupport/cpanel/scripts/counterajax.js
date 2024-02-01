

/***********************************************
* IFrame SSI script- © Dynamic Drive DHTML code library (http://www.dynamicdrive.com)
* Visit DynamicDrive.com for hundreds of original DHTML scripts
* This notice must stay intact for legal use
***********************************************/

//Input the IDs of the IFRAMES you wish to dynamically resize to match its content height:
//Separate each ID with a comma. Examples: ["myframe1", "myframe2"] or ["myframe"] or [] for none:
var iframeids=["content"]

//Should script hide iframe from browsers that don't support this script (non IE5+/NS6+ browsers. Recommended):
var iframehide="yes"

var getFFVersion=navigator.userAgent.substring(navigator.userAgent.indexOf("Firefox")).split("/")[1]
var FFextraHeight=parseFloat(getFFVersion)>=0.1? 16 : 0 //extra height in px to add to iframe in FireFox 1.0+ browsers

function dyniframesize() 
{
	var iframeids=["content"]

//Should script hide iframe from browsers that don't support this script (non IE5+/NS6+ browsers. Recommended):
var iframehide="yes"

var getFFVersion=navigator.userAgent.substring(navigator.userAgent.indexOf("Firefox")).split("/")[1]
var FFextraHeight=parseFloat(getFFVersion)>=0.1? 16 : 0 //extra height in px to add to iframe in FireFox 1.0+ browsers
	var dyniframe=new Array()
	for (i=0; i<iframeids.length; i++)
	{
		if (window.parent.document.getElementById)
		{ //begin resizing iframe procedure
			dyniframe[dyniframe.length] = window.parent.document.getElementById(iframeids[i]);
			if (dyniframe[i] && !window.opera)
			{
				dyniframe[i].style.display="block";
					
					if (dyniframe[i].contentDocument && dyniframe[i].contentDocument.body.offsetHeight)
					{ //ns6 syntax
						dyniframe[i].height = dyniframe[i].contentDocument.body.offsetHeight+FFextraHeight + 20; 
					}
					else if (dyniframe[i].Document && dyniframe[i].Document.body.scrollHeight)
					{ //ie5+ syntax
						dyniframe[i].height = dyniframe[i].Document.body.scrollHeight + 20;
					}
					else
					{
						setTimeout("dyniframesize("+defaultHeight+")",1)
					}
			}
			//reveal iframe for lower end browsers? (see var above):
			if ((window.parent.document.all || window.parent.document.getElementById) && iframehide=="no"){
			var tempobj=window.parent.document.all? window.parent.document.all[iframeids[i]] : window.parent.document.getElementById(iframeids[i])
			tempobj.style.display="block"
			}
		}
	}
}

if (window.addEventListener)
window.addEventListener("load", dyniframesize, false)
else if (window.attachEvent)
window.attachEvent("onload", dyniframesize)
else
window.onload=dyniframesize
function getPage(url,container,param)
{			
		//var pic;
		//var ajaxDisplay = document.getElementById(container);
		//ajaxDisplay.innerHTML = "<div align=center><img src="+ doc.loading.src +"></div>";			
		window.location=url+"?sessid=smetsysmocmas&"+param;
		return 0;
}

function getValue(container,idfield,id,database,fetchfield,option)
{	
		var ajaxRequest;  // The variable that makes Ajax possible!
		var ajaxDisplay = document.getElementById(container);
		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser cannot support this functionality!");
					return false;
				}
			}
		}
		
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				
				var ajaxDisplay = document.getElementById(container);
				if (option==0)
				{
					ajaxDisplay.innerHTML = ajaxRequest.responseText;	
				}
				else if (option==1)
				{
					ajaxDisplay.value = ajaxRequest.responseText;
				}
				else
				{
					return ajaxRequest.responseText;
				}
			}
			
		}
		
		ajaxRequest.open("GET", "getValue.php?sessid=smetsysmocmas&idfield="+idfield+"&id="+id+"&database="+database+"&field="+fetchfield, true);		
		ajaxRequest.send(null);
		return 0;
}
