//######################################################################################
//receive all the data for login and send them to server
//######################################################################################

function login() {


    /**
     * @param answer.email            email received from server.
     * @param answer.accessLevel      user access level.
     */
    var email = document.getElementById("inputEmail").value;
    var password = document.getElementById("inputPassword").value;

    var dataList = [{
        'type': 'email',
        'value': email
    }, {
        'type': 'password',
        'value': password
    }];
    var answer = validate(dataList);
    console.log("validation answer -> " + answer);

    if (answer === true) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                emailPacket: email,
                passwordPacket: password
            },
            url: "php/logIn.php",
            success: function (answer) {
                console.log(answer);
                if (answer.email === email && answer.accessLevel === "1") {
                    window.location.href = "html/adminPanel.php";
                } else if (answer.email === email && answer.accessLevel === "0") {
                    window.location.href = "html/dashboard.php";
                } else {
                    alert("server Answer : " + answer);
                }
            }
        });
    } else {
        displayRegisterError(answer)
    }
}

//######################################################################################
//this function will display all the validation Error
//######################################################################################

function displayRegisterError(answer) {
    var i, count = answer.length;

    var email = document.getElementById("inputEmail");
    var password = document.getElementById("inputPassword");

    if (count > 0) {
        for (i = 0; i < count; i++) {

            if (answer[i] === "email") {
                email.setAttribute("class", "form-control warning");
            }
            if (answer[i] === "password") {
                password.setAttribute("class", "form-control warning");
            }
        }
    }
}

//######################################################################################
//bootstrap plugins
//######################################################################################


$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
});


// this code will reset color of text boxes to white
$('.form-control').focus(function () {
    this.setAttribute("class", "form-control");
    console.log("hello");

});
