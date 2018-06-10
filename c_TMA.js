//set up the objects that contain the validation data for regex. These values must use the same name as the id of the form input.
	var myreg = new Object();// set up the object containing the regex expressions to be used.
	//myreg.telephone = /^\(?(?:(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?\(?(?:0\)?[\s-]?\(?)?|0)(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}|\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}|\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3})|\d{5}\)?[\s-]?\d{4,5}|8(?:00[\s-]?11[\s-]?11|45[\s-]?46[\s-]?4\d))(?:(?:[\s-]?(?:x|ext\.?\s?|\#)\d+)?)$/g;//https://www.aa-asterisk.org.uk/Regular_Expressions_for_Validating_and_Formatting_GB_Telephone_Numbers#Validating_GB_telephone_numbers
	//myreg.telmobile = /^\(?(?:(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?\(?(?:0\)?[\s-]?\(?)?|0)(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}|\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}|\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3})|\d{5}\)?[\s-]?\d{4,5}|8(?:00[\s-]?11[\s-]?11|45[\s-]?46[\s-]?4\d))(?:(?:[\s-]?(?:x|ext\.?\s?|\#)\d+)?)$/g;
	//myreg.postcode = /^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/g; // see the section on Regex Reference for further details
	myreg.email = /^.+?\@.*?$/;
	myreg.lastname = /\||\~/; //client-side validation of the last name input to use an HTML pattern that rejects characters '~' and '|'

	var truefeedback = new Object(); // set up the object containing the success messages to be used.
	//truefeedback.telephone = 'Valid: ';
	//truefeedback.telmobile = 'Valid: ';
	//truefeedback.postcode = 'That should be a valid post code';
	truefeedback.email = 'Valid: ';
	truefeedback.lastname = 'Valid: '; //client-side validation of the last name input to use an HTML pattern that rejects characters '~' and '|'

	var falsefeedback = new Object();// set up the object containing the failed validation messages to be used.
	//falsefeedback.telephone = "Not a valid UK landline : ";
 //falsefeedback.telmobile = 'Not a valid UK mobile : ';
	//falsefeedback.postcode = 'That is not a valid post code : ';
	falsefeedback.email = 'X : ';
	falsefeedback.comments = 'X: ';

	//set up an object to contain a record of ids of form inputs for checking before form submission
	var formcheck = new Object();
	//formcheck.agreement = 'e'; // all unchecked initially given the value "e" for error. When a valid entry confirmed changed to "", or if invalid changed back to "e"
	formcheck.firstname = 'e';
	//formcheck.surname = 'e';
	formcheck.lastname = 'e';
	formcheck.comments = 'e';
	//formcheck.dateofbirth = 'e';
	//formcheck.house = "e";
	//formcheck.add2 = "e"; // these are not going to be required fields - they don't have to be filled in so we won't include them in our list for checking before submission
	//formcheck.add3 = "e";
	//formcheck.town = "e";
	//formcheck.postcode = "e";
	//formcheck.telephone = "e";
	//formcheck.telmobile = "e";
	formcheck.email = "e";

	var validationtype = new Object();
	validationtype.firstname= "as";
	validationtype.comments= "as";
	validationtype.lastname= "lnamereg"; //client-side validation of the last name input to use an HTML pattern that rejects characters '~' and '|'
	validationtype.email= "reg";
	//validationtype.telephone= "reg";
	var formresult = '';

function myFunction(myid,myvalue,valid_type){ //the input passes its id and the value it contains to the function
	//alert( valid_type );
	myvalue=myvalue.trim(); // trim any leading and trailing whitespace
	result ="";  //create an empty variable to hold the result of the test
	fb = "fb"+ myid;  //global create the id of the feedback element - adding "fb" to the front of the input id



if (valid_type == "as" ){ anystring(myid,myvalue);}
else if (valid_type== "reg") { myregexcheck(myid,myvalue);}
else if (valid_type== "lnamereg") { lname_myregexcheck(myid,myvalue);} //client-side validation of the last name input to use an HTML pattern that rejects characters '~' and '|'
else if (valid_type== "dt") { mydatestring(myid,myvalue);}
checkform();
};
 //client-side validation of the last name input to use an HTML pattern that rejects characters '~' and '|'
function lname_myregexcheck(myid,myvalue){
	//alert ( "values" + myid + myvalue);
	var myregex= myreg[myid];  // the value from the myreg object identified by the id from the form
	if ( result = myregex.test( myvalue ) ){  // this is how we test the string against the regex. We want a true or false answer.
		document.getElementById(fb).style.backgroundColor="red";
		document.getElementById(myid).style.backgroundColor="#F2F6D7";
		document.getElementById(fb).innerHTML= " X";
		formcheck[myid] = "e";
		return false;
}else if ( myvalue ){ // there has not been a match and there is string
	document.getElementById(fb).style.backgroundColor="lightgreen"; // change the feedback span to green
	document.getElementById(myid).style.backgroundColor="lightgreen"; // change the input to green
	document.getElementById(fb).innerHTML= " ✓ " + myvalue; // add a message to the feedback span
	formcheck[myid] = "";
	return true;
}else { // there has not been a match and no string
	document.getElementById(fb).style.backgroundColor="red";
	document.getElementById(myid).style.backgroundColor="#F2F6D7";
	document.getElementById(fb).innerHTML= " X";
	formcheck[myid] = "e";
	return false;
}
};

function myregexcheck(myid,myvalue){
	//alert ( "values" + myid + myvalue);
	var myregex= myreg[myid];  // the value from the myreg object identified by the id from the form
	if ( result = myregex.test( myvalue )){  // this is how we test the string against the regex. We want a true or false answer.
	document.getElementById(fb).style.backgroundColor="lightgreen"; // change the feedback span to green
	document.getElementById(myid).style.backgroundColor="lightgreen"; // change the input to green
	document.getElementById(fb).innerHTML= (truefeedback[myid]) + myvalue; // add a message to the feedback span
	formcheck[myid] = "";
	return true;
}else{ // there has not been a match
	document.getElementById(fb).style.backgroundColor="red";
	document.getElementById(myid).style.backgroundColor="#F2F6D7";
	document.getElementById(fb).innerHTML= (falsefeedback[myid]) + myvalue;
	formcheck[myid] = "e";
	return false;
}
};

function anystring(myid,myvalue){
	if ( myvalue ){  // this is how we test the string has some sort of value and is not null, empty, undefined. We want a true or false answer.
	document.getElementById(fb).style.backgroundColor="lightgreen"; // change the feedback span to green
	document.getElementById(myid).style.backgroundColor="lightgreen"; // change the input to green
	document.getElementById(fb).innerHTML= " ✓ " + myvalue; // add a message to the feedback span
	formcheck[myid] = "";
	return true;
}else{ // there has not been a match
	document.getElementById(fb).style.backgroundColor="red";
	document.getElementById(myid).style.backgroundColor="#F2F6D7"
	document.getElementById(fb).innerHTML= " X";
	formcheck[myid] = "e";
	return false;
}
};

function mydatestring(myid,myvalue){
		var myDate = new Date(myvalue);
	var jsonDate = myDate.toJSON();
	if ( !isNaN( jsonDate ) ){// value won't convert to date so is not a valid date
		document.getElementById(fb).style.backgroundColor="red";
		document.getElementById(myid).style.backgroundColor="#F2F6D7"
		document.getElementById(fb).innerHTML= " This is not a valid date or time";
		formcheck[myid] = "e";
		return false;
		 }
	var mytesttime = jsonDate.substr(0, 16);//get the first 16 characters of this date time string
	var mytestdate = jsonDate.substr(0, 10);// get the first 10 characters of this date
	tstr= myvalue.substr(0, 16);//get the first 16 characters of this date time string
	dstr= myvalue.substr(0, 10);// get the first 10 characters of this date



	if(tstr == mytesttime ){// we have a valid date and time
	document.getElementById(fb).style.backgroundColor="lightgreen"; // change the feedback span to green
	document.getElementById(myid).style.backgroundColor="lightgreen"; // change the input to green
	document.getElementById(fb).innerHTML= "This is a valid date and time:  " + myvalue; // add a message to the feedback span
	formcheck[myid] = "";
	return true;
	} else if ( dstr == mytestdate ) {// we have a valid date
		document.getElementById(fb).style.backgroundColor="lightgreen"; // change the feedback span to green
		document.getElementById(myid).style.backgroundColor="lightgreen"; // change the input to green
		document.getElementById(fb).innerHTML= "This is a valid date:  " + myvalue; // add a message to the feedback span
		formcheck[myid] = "";
		return true;
	}else {//not a valid date time
		document.getElementById(fb).style.backgroundColor="red";
		document.getElementById(myid).style.backgroundColor="#F2F6D7"
		document.getElementById(fb).innerHTML= " This is not a valid date or time:  ";
		formcheck[myid] = "e";
		return false;
	}

};

function validate(){
	return checkform();
}

function checkform(){
	//because we have kept a record of the state of all inputs in our formcheck[myid] object, we can quickly see if they have all been filled in.

	for (var key in formcheck ){


		 if (formcheck.hasOwnProperty(key)) {
      formresult = formresult +  formcheck[key] ;
     //alert(key + " validate called" + formresult );
    }
	}

	if( formresult ){
	document.getElementById("submit").style.backgroundColor="#F2F6D7"; // change the feedback p to red
	document.getElementById("submit").value= "Not ready to submit. Please check the form inputs that are not green above"; // add a message to the feedback span
	formresult = '';
	return false;
	}else{
		document.getElementById("submit").style.backgroundColor="green"; // change the feedback p to green
		document.getElementById("submit").value= "Ready to Submit. "; // add a message to the feedback span
		formresult = '';
	}
	return true;
};

function validateall() {
	for (var key in validationtype ){
		//alert (key);
		var myvalue = document.getElementById(key).value;
		myFunction(key,myvalue,validationtype[key]);
	}

};
