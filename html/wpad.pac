
// PROXY AUTHENTICATION CODE DEVELOPED BY NJERU 2017// 

function FindProxyForURL(url, host)
{
// Variable declarations	
    var Proxysvr = "PROXY proxy.ipoa.go.ke:8080;";
    var Noproxy = "DIRECT";

// If you want to allow a specific IP range to go direct, use the line below
 	if (isInNet(host, "197.156.138.150", "255.255.0.0")||
	    isInNet(host, "10.200.0.0", "255.255.255.0")) 
		{return Noproxy;} 


// If the hostname matches, send direct i.e bypass local domain.
    if (dnsDomainIs(host, "intranet.ipoa.go.ke") ||
        shExpMatch(host, "(*.ipoa.go.ke|ipoa.go.ke)"))
        {return Noproxy;}	


// Always bypass for localhost, local domain i.e IPOA.GO.KE - make sure these 3 lines remain
	if (shExpMatch(host, "localhost*") || shExpMatch(host, "127.0.0.1*")||shExpMatch(host, "*.ipoa.go.ke*")) 
		{return Noproxy;}
	
	else 
	{
      		if (shExpMatch(url, "http:*")) 
        		return Proxysvr;
      		
		if (shExpMatch(url, "https:*"))
        	 	return Proxysvr;
     		
		if (shExpMatch(url, "ftp:*"))
        	 	return Proxysvr;

// DEFAULT RULE: All other traffic, use below proxies, in fail-over order. 
		  return Proxysvr;
	

  	 }
}

