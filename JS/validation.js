//#################################################################################
// this function receive date  with their type the check their validation
//#################################################################################
function validate(input) {

    console.log("validate() receive this -> ", input);
    var arrayLength = input.length;
    var i;
    var invalidList = [];
    var checked;


    for (i = 0; i < arrayLength; i++) {
        if (input[i].type === "firstName" || input[i].type === "lastName") {
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


        if (!checked) {
            invalidList.push(input[i].type);
        }

    }
    if (invalidList.length === 0) {
        return true;
    } else {
        displayRegisterError(invalidList);
        return invalidList;
    }
}

//#################################################################################
// checking validation of names
//#################################################################################
function validateName(name) {
    var alphaExp = /^[a-z ]+$/i;
    return alphaExp.test(name); // this function will return true or false
}

//#################################################################################
// checking validation of user names
//#################################################################################
function validateUrsName(username) {
    var alphaExp = /^[a-zA-z]+[0-9a-zA-z_]+[0-9a-zA-Z]$/;
    return alphaExp.test(username); // this function will return true or false
}

//#################################################################################
// checking validation of emails 
//#################################################################################
function validateEmail(email) {
    var alphaExp = /^[a-z][a-z0-9._-]+@(\w+\.)+[a-z]{2,6}$/;
    return alphaExp.test(email); // this function will return true or false
}

//#################################################################################
// checking validation of passwords 
//#################################################################################
function validatePassword(password) {
    var alphaExp = /^[0-9a-zA-Z]+[0-9a-zA-Z@._-]+[0-9a-zA-Z]$/;
    return alphaExp.test(password); // this function will return true or false
}

//#################################################################################
// checking validation of numbers
//#################################################################################
function validateNumber(number) {
    var alphaExp = /^[0-9]+$/;
    return alphaExp.test(number); // this function will return true or false
}

//#################################################################################
// checking validation of postal code 
//#################################################################################
function validatePostalCode(pCode) {
    var alphaExp = /^\d{5}(-\d{5})$/;
    return alphaExp.test(pCode); // this function will return true or false
}
