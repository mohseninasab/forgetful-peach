
function collectData() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var dataList = [{
        'type': 'email',
        'value': email
    }, {
        'type': 'password',
        'value': password
    }];

    var answer = validate(dataList);
    //alert(" email:" + email + "\n password:" + password + "\n validation:" + answer);

    if (answer === "valid") {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                emailPacket: email,
                passwordPacket: password
            },
            url: "php/logIn.php",
            success: function (answer) {
                if (answer === "valid") {
                    window.location.href = "dashboard.php";
                } else {
                    alert("server Answer : " + answer);
                }
            }
        });
    }
}
