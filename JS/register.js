
function collectRegData() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var userName = document.getElementById("user_name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var rePassword = document.getElementById("rePassword").value;


    var dataList = [{
        'type': 'name',
        'value': firstName
    }, {
        'type': 'name',
        'value': lastName
    }, {
        'type': 'usrName',
        'value': userName
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
    console.log("password->",email);

    var answer = validate(dataList);
    console.log("validation.js answer:", answer);

    if (password === rePassword && answer === "valid") {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                emailPacket: email,
                passwordPacket: password,
                rePasswordPacket: rePassword,
                firstNamePacket: firstName,
                lastNamePacket: lastName,
                userNamePacket: userName
            },
            url: "php/register.php",
            success: function (answer) {
                console.log("server answer :", answer);

            }
        });
    } else {
        console.log("rigister.js fail check your information !");
    }
}