//#################################################################################
// this function recive date  with their type the check their validation  
//#################################################################################
function validate(input) {

    console.log("validate() recived this -> ", input);
    var arrlength = input.length;
    var i;
    var invalidList = [];
    var checked;


    for (i = 0; i < arrlength; i++) {
        if (input[i].type === "name") {
            checked = validateName(input[i].value);
        } else if (input[i].type === 'usrName') {
            checked = validateUrsName(input[i].value);
        } else if (input[i].type === 'email') {
            checked = validateEmail(input[i].value);
        } else if (input[i].type === 'password') {
            checked = validatePassword(input[i].value);
        } else if (input[i].type === 'number') {
            checked = validateNumber(input[i].value);
        } else if (input[i].type === 'postalCode') {
            checked = validatePostalCode(input[i].value);
        }


        if (checked === "invalid") {
            invalidList.push(input[i].type);
        }

    }
    if (invalidList.length === 0) {
        return "valid";
    } else {
        return invalidList;
    }
}
//#################################################################################
// checking validation of names
//#################################################################################
function validateName(name) {
    var alphaExp = /^[a-z]+$/i;
    if (alphaExp.test(name)) {
        return "valid";
    } else {
        return "invalid";
    }

}
//#################################################################################
// checking validation of user names
//#################################################################################
function validateUrsName(usrname) {
    var alphaExp = /^[0-9a-z]+$/i;
    if (alphaExp.test(usrname)) {
        return "valid";
    } else {
        return "invalid";
    }
}
//#################################################################################
// checking validation of emails 
//#################################################################################
function validateEmail(email) {
    var alphaExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (alphaExp.test(email)) {
        return "valid";
    } else {
        return "invalid";
    }
}
//#################################################################################
// checking validation of passwords 
//#################################################################################
function validatePassword(password) {
    var alphaExp = /^[a-z0-9][0-9a-z._-][0-9a-z]+$/i;
    if (alphaExp.test(password)) {
        return "valid";
    } else {
        return "invalid";
    }
}
//#################################################################################
// checking validation of numbers
//#################################################################################
function validateNumber(number) {
    var alphaExp = /^[0-9]+$/;
    if (alphaExp.test(number)) {
        return "valid";
    } else {
        return "invalid";
    }
}
//#################################################################################
// checking validation of postal code 
//#################################################################################
function validatePostalCode(pCode) {
    var alphaExp = /^\d{5}(-\d{5})$/;
    if (alphaExp.test(pCode)) {
        return "valid";
    } else {
        return "invalid";
    }
}