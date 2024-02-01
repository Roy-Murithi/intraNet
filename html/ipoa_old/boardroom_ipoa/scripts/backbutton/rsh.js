//window.dhtmlHistory.create({ toJSON: JSON.encode, fromJSON: JSON.decode });
window.dhtmlHistory.create({
		toJSON: JSON.encode,
		fromJSON: JSON.decode
});


window.addEvent("load", function() {
    window.dhtmlHistory.initialize();
    window.dhtmlHistory.addListener($listener);
    
    $$(".post-internal").addEvent("click", function(ev) {
	
	window.dhtmlHistory.add("change-background:" + this.getProperty("rel"));
	
	//--- Event Code
	changeBgColor(this.getProperty("rel"));
	
	//--- Don't go to the HREF address.
	new Event(ev).preventDefault();
    });
});

    
function $listener(newLocation, historyData) {
    //--- If not the url event we are looking for, escape.
    if(newLocation.indexOf("change-background:") == -1) return;
    
    
    //--- Set the background of our HTML element to the color specified in the URL.
    changeBgColor(newLocation.replace("change-background:", ""));
}

function changeBgColor(newBgColor) {
    $(document.body).setStyle("background", "#" + newBgColor);
}