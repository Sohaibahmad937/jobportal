// JavaScript Document

	var xmlHttp = false;

	//-----------------------------------------------------------------------------------------------------------------------------
	
	// 	get_data()
	
	// 	page			= the script that you want to run in the background
	//		element_id	= the id of the element that the process with return to
	
	//-----------------------------------------------------------------------------------------------------------------------------
	
	function get_data(page, element_id) {
		var xmlHttp;
		try {
			// Firefox, Opera 8.0+, Safari
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			// Internet Explorer
			try {
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					alert("Sorry, your browser does not support Ajax. Please upgrade!");
					return false;
				}
			}
		}	
		
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById(element_id).innerHTML = xmlHttp.responseText;
			}
		}
		
		xmlHttp.open("GET", page, true);
		xmlHttp.send(null);
	
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------
	
	// 	post_data()
	
	// 	page			= the script that you want to run in the background
	//		form_name	= the 'name' of the form that the data will retrieve
	//		element_id	= the id of the element that the process with return to
	
	//-----------------------------------------------------------------------------------------------------------------------------

	function post_data(page, form_name, element_id) {
	
		function return_post_data() {

			if (xmlHttp.readyState == 4) {
				if (xmlHttp.status == 200) {
					result = xmlHttp.responseText;
					document.getElementById(element_id).innerHTML = result;            
				} else {
					alert("There was a problem with the request.");
				}
			}
		}
		
		// Proper start of the function (builds up the POST string - looking at all the fields)
		var parameters = "";
		
		for (i = 0; i < document.forms[form_name].elements.length; i++) {
			key = document.forms[form_name].elements[i].name;
			value = document.forms[form_name].elements[i].value;
			value = encodeURI(value);
			
			if(typeof key != 'undefined'){
				// If its an unchecked checkbox, get rid of it
				if(document.forms[form_name].elements[i].type == "checkbox") {
					if(document.forms[form_name].elements[i].checked) {
						parameters += "&" + key + "=" + value;
					}
				} 
				// If its a radio button
				else if (document.forms[form_name].elements[i].type == "radio") {
					if(document.forms[form_name].elements[i].checked) {
						parameters += "&" + key + "=" + value;
					}
				} else {
					parameters += "&" + key + "=" + value;
				}
			}			
		}
		
		try {
			// Firefox, Opera 8.0+, Safari
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			// Internet Explorer
			try {
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					alert("Sorry, your browser does not support Ajax. Please upgrade!");
					return false;
				}
			}
		}	
		
		xmlHttp.onreadystatechange = return_post_data;
		xmlHttp.open("POST", page, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", parameters.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.send(parameters);
		
	}	
// JavaScript Document