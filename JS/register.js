//######################################################################################
//this function will receive all the register data from user and validate data
//######################################################################################

function collectRegData() {
    var firstName = document.getElementById("registerFirstName").value;
    var lastName = document.getElementById("registerLastName").value;
    var email = document.getElementById("RegisterEmail").value;
    var password = document.getElementById("password").value;
    var rePassword = document.getElementById("confirmPassword").value;

    // First we create a list of objects that contains data type and value
    var dataList = [{
        'type': 'firstName',
        'value': firstName
    }, {
        'type': 'lastName',
        'value': lastName
    }, {
        'type': 'email',
        'value': email
    }, {
        'type': 'password',
        'value': password
    }, {
        'type': 'password',
        'value': rePassword
    }];

    // send data to the validation function to validate and receive answer
    var answer = validate(dataList);
    console.log("validation.js answer:", answer);

    if (password === rePassword && answer === true) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                emailPacket: email,
                passwordPacket: password,
                rePasswordPacket: rePassword,
                firstNamePacket: firstName,
                lastNamePacket: lastName
            },
            url: "../php/register.php",
            success: function (answer) {
                if (answer) {
                    window.location.href = "../html/dashboard.php";
                } else {
                    alert("there are some server internal error !!");
                }
            }, error: function (answer) {
                console.log(answer);
            }
        });
    }else{
        displayRegisterError(answer)
    }
}

//######################################################################################
//this function will display all the validation Error
//######################################################################################

function displayRegisterError(answer) {
    var i, count = answer.length;
    var firstName = document.getElementById("registerFirstName");
    var lastName = document.getElementById("registerLastName");
    var email = document.getElementById("RegisterEmail");
    var password = document.getElementById("password");
    var rePassword = document.getElementById("confirmPassword");

    if (count > 0) {
        for (i = 0; i < count; i++) {
            if (answer[i] === "firstName") {
                firstName.setAttribute("class", "form-control warning");
            }
            if (answer[i] === "lastName") {
                lastName.setAttribute("class", "form-control warning");
            }
            if (answer[i] === "email") {
                email.setAttribute("class", "form-control warning");
            }
            if (answer[i] === "password") {
                password.setAttribute("class", "form-control warning");
                rePassword.setAttribute("class", "form-control warning");
            }
        }
    }
}
$('.form-control').focus(function () {
    this.setAttribute("class","form-control");
    console.log("hello");

});