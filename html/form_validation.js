function validate_null(field, alerttxt) {
	with (field) {
		if (value == null || value == "") {
			alert(alerttxt); return false;
		}
		else {
			return true;
		}
	}
}

function validate_email(field,alerttxt) {
	with (field) {
		apos=value.indexOf("@");
		dotpos=value.lastIndexOf(".");
		if (apos<1||dotpos-apos<2) {
			alert(alerttxt);
			return false;
		}
		else {
			return true;
		}
	}
}

function validate_psw(field,alerttxt) {
	with (field) {
		if(field.value.length < 6) {
			alert(alerttxt);
			return false;
		}
		else {
			return true;
		}
	}
}

function validate_space(field,alerttxt){
	with (field) {
		if(field.value.indexOf(" ") > -1 ) {
			alert(alerttxt); return false;
		}
		else {
			return true;
		}
	}
}

function validate_both_ps(field, alerttxt) {
	with (field) {
		var ps1 = form.password.value;
		var ps2 = form.password2.value;
		if(ps1 != ps2) {
			alert(alerttxt);
			return false;
		}
		else {
			return true;
		}
	}
}


function validate_form(thisform) {
	with (thisform) {
		if (validate_email(email,"Invalid email address!, check it carefully.") == false) {
			email.focus();
			return false;
		}
		if (validate_psw(password, "Invalid password. It should be more than 6 chracters.") == false ) {
			password.focus();
			return false;
		}
		if (validate_space(password, "Spaces are not allowed.") == false ) {
			password.focus();
			return false;
		}
		if (validate_both_ps(password2, "Passwords you submitted didn't match. Try again!") == false ) {
			password2.focus();
			return false;
		}
		if (validate_null(name_of_organisation, "Invalid Organization name.") == false) {
			name_of_organisation.focus();
			return false;
		}
		if (validate_null(contact_person, "Invalid name.") == false) {
			contact_person.focus();
			return false;
		}
		if (validate_null(Address, "Address invalid.") == false)  {
			Address.focus();
			return false;
		}
		if (validate_null(Phone, "Invalid Phone number.") == false) {
			Phone.focus();
			return false;
		}
	}
}
