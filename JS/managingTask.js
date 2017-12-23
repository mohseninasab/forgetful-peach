//public variables 

var publicTask = 0;
var noteInputState = 0;

//######################################################################################
//
//######################################################################################
window.onload = function () {
    collectData();

};

//######################################################################################
//download all the users public and private task 
//######################################################################################

function collectData() {

    $.ajax({
        url: "../php/managingTask.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "showAllData"
        }, success: function (answer) {
            if (answer.length > 0) {
                console.log("Data has Been received !!");
                displayData(answer);
            } else {
                console.log("There is no data for you !!");
            }
        }, error: function (msg) {
            console.log(msg);
        }

    });


}

//######################################################################################
// sends request to server to check target task as done
//######################################################################################

function checkAsDone(input, status) {
    var reqValue;

    if (status === 1) {
        reqValue = "markAsDone"
    } else if (status === 2) {
        reqValue = "markAsUndone"
    }

    console.log("request -->", reqValue);
    console.log("task id ->", input);


    $.ajax({
        url: "../php/managingTask.php",
        type: "POST",
        dataType: "json",
        data: {
            requestType: reqValue,
            data: "none",
            id: input
        },
        success: function (answer) {
            console.log(answer);
            setTimeout(collectData, 300);
        }, error: function (answer) {
            console.log(answer);
        }
    });
}

//######################################################################################
// upload new task
//######################################################################################

function assignTask() {

    var noteData = {
        requestFrom: "user",
        subject: document.getElementById("subject").value,
        date: document.getElementById("deadLine").value,
        note: document.getElementById("note").value,
        taskType: publicTask
    };

    if (noteData.subject !== "" && noteData.date !== "" && noteData.note !== "") {

        $.ajax({
            url: "../php/managingTask.php",
            type: "POST",
            dataType: "json",
            data: {
                requestType: "addTask",
                data: noteData,
                targetUser: "none"
            },
            success: function (answer) {
                console.log(answer);
                setTimeout(collectData, 300);
                clearForm();
            }, error: function (answer) {
                console.log(answer);
            }
        });
    } else {
        alert("please fill up all of Inputs !!")
    }
}

//######################################################################################
// change "publicTask" variable
//######################################################################################

function setTaskType(input) {
    publicTask = input;
}

//######################################################################################
//clear html form to insert new update
//######################################################################################

function clearForm() {
    document.getElementById("subject").value = "";
    document.getElementById("deadLine").value = "";
    document.getElementById("note").value = "";
}

//######################################################################################
// send request to server to logout the user
//######################################################################################
function logout() {
    $.ajax({
        url: "../php/logout.php",
        type: "POST",
        dataType: "json",
        data: {
            requestType: "logout",
            data: "none",
            id: -1
        },

        success: function (answer) {
            if (answer) {
                window.location.href = "../index.html";
            }
        }
    });
}

