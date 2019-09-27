//set cookie
function DCAS_setCookie(name, value, maxAgeSeconds) {
	var maxAgeSegment = "; max-age=" + maxAgeSeconds;
	document.cookie = encodeURI(name) + "=" + encodeURI(value) + maxAgeSegment + "; path=/";
}

//check unique
function onlyUnique(value, index, self) { 
	return self.indexOf(value) === index;
}

//add category

function categoryRun(IDType, defaultID, readyID, cookieTime, idLimit) {
	
	if(IDType == 2) {
		var IDName = "DCAS_Tags";
	} else {
		var IDName= "DCAS_Categories";
	}
	
	if(readyID == null) {
		var resCookie = JSON.stringify(defaultID);
		DCAS_setCookie(IDName, resCookie, cookieTime);
		
	} else {
		
		//get using cookie
		var resCookie = readyID;
		//get wp default
		var newreCookie = defaultID;
		
		newreCookie = newreCookie.concat(resCookie);
		newreCookie = newreCookie.filter(onlyUnique);
		//display first <x> id
		if (newreCookie.length > idLimit) newreCookie = newreCookie.slice(0, idLimit);
		DCAS_setCookie(IDName, JSON.stringify(newreCookie), cookieTime);
	
	}
}