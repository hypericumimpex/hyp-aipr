//set cookie
function DCAS_resetMyShortcode() {
	document.getElementById("dcas-get-shortcode").innerHTML = "";
	document.getElementById("dcas-submit").innerHTML = "";
}

//get shortcode
function DCAS_getMyShortcode(text1, text2) {
	//getSuggest
	var suggestID = document.getElementById("dcas-style");
	var suggestStyle = suggestID.options[suggestID.selectedIndex].value;
	var suggestTEXT = "style=&quot;"+suggestStyle+"&quot;";
	//
	
	//getRating
	if (document.getElementById("dcas-rating").checked)
		var ratingID = 1;
	else
		var ratingID = 0;
	
	var ratingText = "rating=&quot;"+ratingID+"&quot;";
	//
	
	//get Post per Page
	var pppID = document.getElementById("dcas-number").value;
	
	if (pppID == "")
		pppID = 5;
	
	var pppText = "postsperpage=&quot;"+pppID+"&quot;";	
	
	//get columns
	var colID = document.getElementById("dcas-columns").value;
	
	if (colID == "")
		colID = 1;
	
	var colText = "columns=&quot;"+colID+"&quot;";
	
	//apply
	document.getElementById("dcas-get-shortcode").innerHTML = '<div id="shortcodeBox" class="shortcodeBox"><br><br><h2><strong>'+text1+'</strong></h2><p>'+text2+'</p><input type="text" onfocus="this.select();" readonly="readonly" class="large-text code" value="[DCAS_shortcode '+suggestTEXT+' '+ratingText+' '+pppText+' '+colText+']"><br><br><br></div>';
	
	document.getElementById("dcas-submit").innerHTML = '<a onclick="DCAS_resetMyShortcode()" class="button button-primary boxMarginSet">Reset</a>';
	document.getElementById('dcas-get-shortcode').scrollIntoView();
}
