// global variables ####################################################################

var userList = [];
var selectedUser;
var publicTask = 0;
var targetUser;

//######################################################################################
//executes on page load
//######################################################################################

window.onload = function () {
    collectUserData();
};

//######################################################################################
//download all the users data
//######################################################################################

function collectUserData() {

    // this function will make a list of all the users information
    // the list of data shown in the displayList() function down bellow

    $.ajax({
        url: "../php/adminServerSide.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "collectUserData"
        }, success: function (answer) {
            userList = answer;
            if (answer.length > 0) {
                console.log("Data has Been received !!");
                displayList(answer);
            } else {
                console.log("There is no data for you !!");
            }
        }, error: function (msg) {
            console.log(msg);
        }

    });
}

//######################################################################################
//download all the users data
//######################################################################################


function displayList(user) {

    /**
     * description:
     * @param user.firstName user data
     * @param user.lastName  user data
     * @param user.phoneNumber user contact data
     * @param user.socialNumber user id data
     * @param user.birthDate user data
     * @param user.email users email
     */

    var i, text = "", count = user.length;
    document.getElementById("tableBody").innerHTML = "";


    for (i = 0; i < count; i++) {
        text += '<tr>' +
            '<th scope="row">' + i + '</th>' +
            '<td>' + user[i].firstName + '</td>' +
            '<td>' + user[i].lastName + '</td>' +
            '<td>' + user[i].email + '</td>' +
            '<td>' + user[i].phoneNumber + '</td>' +
            '<td>' + user[i].socialNumber + '</td>' +
            '<td>' + user[i].birthDate + '</td>' +
            '<td><div class="btn-group" role="group" aria-label="Basic example">' +
            '<button class="btn btn-info btn-sm" onclick="userDetails(' + i + ')">Display Tasks</button>' +
            '<button class="btn btn-danger btn-sm" onclick="ResetPassword(' + i + ')">Reset Password</button>' +
            '</div>' +
            '</td>' +
            '</tr>';

    }
    document.getElementById("tableBody").innerHTML = text;
}

//######################################################################################
//download all the users data
//######################################################################################

function ResetPassword(input) {
    var email = userList[input].email;

    $.ajax({
        url: "../php/adminServerSide.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "ResetPassword",
            email: email

        }, success: function (answer) {
            if (answer === true) {
                alert("Reset Password Was successful !");
            } else {
                console.log("There is no data for you !!");
            }
        }, error: function (msg) {
            console.log(msg);
        }

    });
}

//######################################################################################
//download all the users data
//######################################################################################

function userDetails(input) {

    var email = userList[input].email;
    selectedUser = input;
    $.ajax({
        url: "../php/adminServerSide.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "collectUserTasks",
            email: email

        }, success: function (answer) {
            console.log(answer);
            displayTaskList(answer);

        }, error: function (msg) {
            console.log(msg);
        }
    });

}

//######################################################################################
//download all the users data
//######################################################################################

function displayTaskList(answer) {

    /**
     * Description:
     * @param answer.subject   subject of every task
     * @param answer.content   content of every task
     * @param answer.done      when task is done
     * @param answer.public    access to te task
     * @param answer.deadLine  time to finish the task
     * @param answer.id        id of the task
     * @param answer.warning   dead line warning
     */
    var i,
        count = answer.length,
        text = "",
        taskType = "",
        tagColor,
        doneDateDemo,
        done,
        doneColor,
        warningBadge;


    for (i = 0; i < count; i++) {
        if (answer[i].public === "1") {
            taskType = "public";
            tagColor = "badge-success";
        } else {
            taskType = "private";
            tagColor = "badge-danger";
        }

        if (answer[i].doneDate === "0") {
            doneDateDemo = "---"
        } else {
            doneDateDemo = answer[i].doneDate;
        }

        if (answer[i].done === "1") {
            done = "Finished";
            doneColor = "badge-success";
        } else {
            done = "Not Finished";
            doneColor = "badge-danger";
        }

        if (answer[i].warning === "1") {
            warningBadge = '<span class="mdi mdi-alert-decagram text-danger mdi-24px"></span>';
        }else{
            warningBadge = '<span class="mdi mdi-approval text-success mdi-24px"></span>';
        }

        text += '<tr>' +
            '<th scope="row">' + i + '</th>' +
            '<td>' + answer[i].subject + '</td>' +
            '<td>' + answer[i].content + '</td>' +
            '<td>' + answer[i].createDate + '</td>' +
            '<td>' + answer[i].deadLine + '</td>' +
            '<td>' + doneDateDemo + '</td>' +
            '<td><span class="badge text-wight-3 ' + tagColor + '">' + taskType + '</span></td>' +
            '<td><span class="badge text-wight-3 ' + doneColor + '">' + done + '</span></td>' +
            '<td>' + warningBadge + '</td>' +
            '<td><div class="btn-group" role="group" aria-label="Basic example">' +
            "<button class='btn btn-secondary btn-sm' onclick='editTask(" + answer[i].id + ")' >Edit</button>" +
            '<button class="btn btn-warning btn-sm" onclick="taskWarning(' + answer[i].id + ')">Hurry</button>' +
            '<button class="btn btn-danger btn-sm" onclick="deleteTask(' + answer[i].id + ')">Delete !</button>' +
            '</div>' +
            '</td>' +
            '</tr>';
    }


    document.getElementById("userList").style.display = "none";
    document.getElementById("taskList").style.display = "block";
    document.getElementById("taskListBody").innerHTML = text;
    document.getElementById("firstName").innerHTML = userList[selectedUser].firstName + "&emsp;";
    document.getElementById("lastName").innerHTML = userList[selectedUser].lastName + "&emsp;&emsp;";
    document.getElementById("email").innerHTML = userList[selectedUser].email;
    console.log(userList[selectedUser]);
}

//######################################################################################
//download all the users data
//######################################################################################


function taskWarning(taskId) {
    $.ajax({
        url: "../php/adminServerSide.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "taskWarning",
            taskId: taskId

        }, success: function (answer) {
            console.log(answer);
            if(answer === true){
                userDetails(selectedUser);
            }

        }, error: function (msg) {
            console.log(msg);
        }
    });
}

//######################################################################################
//download all the users data
//######################################################################################
function closeTaskList() {
    document.getElementById("taskList").style.display = "none";
    document.getElementById("taskListBody").innerHTML = "";
    document.getElementById("userList").style.display = "block";

}

//######################################################################################
//download all the users data
//######################################################################################

function deleteTask(taskId) {

    $.ajax({
        url: "../php/adminServerSide.php",
        type: "POST",
        dataType: "json",
        cache: false,
        data: {
            requestType: "deleteTask",
            taskId: taskId

        }, success: function (answer) {
            console.log(answer);

        }, error: function (msg) {
            console.log(msg);
        }
    });
    userDetails(selectedUser);
}

//######################################################################################
//download all the users data
//######################################################################################

function assignTask() {
    var targetUser = "";

    var noteData = {
        requestFrom: "admin",
        subject: document.getElementById("subject").value,
        date: document.getElementById("deadLine").value,
        note: document.getElementById("note").value,
        taskType: publicTask
    };


    if (publicTask === 0) {
        targetUser = userList[selectedUser].email;
    }


    if (noteData.subject !== "" && noteData.date !== "" && noteData.note !== "") {

        $.ajax({
            url: "../php/managingTask.php",
            type: "POST",
            dataType: "json",
            data: {
                requestType: "addTask",
                data: noteData,
                targetUser: targetUser
            },
            success: function (answer) {
                console.log(answer);
                if (answer === true && publicTask === 0) {
                    userDetails(selectedUser);
                }
            }, error: function (answer) {
                console.log(answer);
            }
        });
    } else {
        alert("please fill up all of Inputs !!")
    }
}

//######################################################################################
//download all the users data
//######################################################################################

function displayModal(taskType) {
    publicTask = taskType;

    if (taskType === 1) {
        document.getElementById('taskTitle').innerHTML = "Public Task";
        document.getElementById('taskTitle').className = "badge badge-success text-wight-3";
    } else {
        document.getElementById('taskTitle').innerHTML = "Private Task";
        document.getElementById('taskTitle').className = "badge badge-danger text-wight-3";
        targetUser = selectedUser;
    }
}

//######################################################################################
//download all the users data
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

//######################################################################################
//download all the users data
//######################################################################################

function editTask(){

   return true;
}