function getPage(url,container,param)
{			
		var ajaxRequest;  // The variable that makes Ajax possible!
		var ajaxDisplay = document.getElementById(container);

		//var pic;
		//var ajaxDisplay = document.getElementById(container);
		//ajaxDisplay.innerHTML = "<div align=center><img src="+ doc.loading.src +"></div>";			
		ajaxDisplay.src=url+"?sessid=smetsysmocmas&"+param;
		return 0;
}
function ajaxgetPage(url,container,param)
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
				ajaxDisplay.innerHTML = ajaxRequest.responseText;				
			}
			
		}
		ajaxRequest.open("GET", url+"?sessid=smetsysmocmas&"+param, true);
		
		ajaxRequest.send(null);
		return 0;
}
function ajaxpostPage(url,container,param)
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
				ajaxDisplay.innerHTML = ajaxRequest.responseText;	
			}
			
		}
		
		ajaxRequest.open("POST", url, true);
		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxRequest.send("brwsd=yes&"+param);
		
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
				else
				{
					ajaxDisplay.value = ajaxRequest.responseText;
				}
			}
			
		}
		
		ajaxRequest.open("GET", "getValue.php?sessid=smetsysmocmas&idfield="+idfield+"&id="+id+"&database="+database+"&field="+fetchfield, true);		
		ajaxRequest.send(null);
		return 0;
}