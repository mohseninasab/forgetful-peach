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
//
//######################################################################################

function collectData() {

    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            request: "showAllData",
            data: "none",
            id: -1
        },
        url: "php/managingTask.php",
        success: function (answer) {
            console.log(answer);
            displayData(answer);

        }
    });
}

//######################################################################################
//
//######################################################################################

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
});
//######################################################################################
//
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
        type: "POST",
        dataType: "json",
        data: {
            request: reqValue,
            data: "none",
            id: input
        },
        url: "php/managingTask.php",
        success: function (answer) {
            console.log(answer);
            setTimeout(collectData, 300);
        }
    });
}

//######################################################################################
//
//######################################################################################

function assignTask() {

    var noteData = {
        subject: document.getElementById("subject").value,
        date: document.getElementById("date").value,
        note: document.getElementById("note").value,
        taskType: publicTask
    }
    if (noteData.subject != "" && noteData.date != "" && noteData.note != "") {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                request: "addTask",
                data: noteData,
                id: -1
            },
            url: "php/managingTask.php",
            success: function (answer) {
                console.log(answer);
                setTimeout(collectData, 300);
                clearForm();
            }
        });
    }
}
//######################################################################################
//
//######################################################################################

function setTaskType() {

    if (publicTask === 0) {
        publicTask = 1;
    } else {
        publicTask = 0;
    }
}

//######################################################################################
//
//######################################################################################

function clearForm() {
    document.getElementById("subject").value = "";
    document.getElementById("date").value = "";
    document.getElementById("note").value = "";
}
//######################################################################################
//
//######################################################################################
function logout() {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            request: "logout",
            data: "none",
            id: -1
        },
        url: "php/managingTask.php",
        success: function (answer) {
            window.location.href = "index.html";

        }
    });

}
//######################################################################################
// Animation
//######################################################################################
function display() {
    if (noteInputState === 0) {
        moveDown("noteFrame");
        noteInputState = 1;
    } else if (noteInputState === 1) {
        moveUp("noteFrame");
        setTimeout(hide,500,"noteFrame");
        noteInputState = 0;
    }
}

function moveUp(input) {
    document.getElementById(input).setAttribute("class", "row frame show moveTop")
}

function moveDown(input) {
    document.getElementById(input).setAttribute("class", "row frame show moveMiddle")
}

function hide(input) {
    document.getElementById(input).setAttribute("class", "row frame hide")

}