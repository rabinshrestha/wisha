// Author:       Jezweb PTY LTD
// Revision:     0.01
// Description:  Tonnes of landfill deposited since last visit
$(document).ready(function(){
	// Check if cookie is set. If not, set it
	if($.cookie('initial_time') == null){
		// Define time for initial visit
		var timeInitial = new Date().getTime() / 1000;
	
		// Create the cookie to store the initial time in seconds
		var cookieName = 'initial_time';
		var cookieOptions = {path: '/'};
		$.cookie(cookieName, timeInitial, cookieOptions);
	}
	
	// Dynamically update the tonnes since initial visit
	var update = setInterval(function(){
		// Find the number of seconds since initial visit
		var timeCurrent = new Date().getTime() / 1000;
		var seconds = timeCurrent - $.cookie('initial_time');

		// Find the number of tonnes since initial visit
		var tonnes = 1.7 * seconds;
		
		// Output tonnes to 2 decimla place
		$("#counter").text(tonnes.toFixed(2));
		
		// Check if we have reached limit of 10 hours (61,200 tonnes)
		if(tonnes >= 61200){
			clearInterval(update);
			$("#counter").text('61200+');
		}
	}, 50);
});
