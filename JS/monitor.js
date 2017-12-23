//######################################################################################
//
//######################################################################################
function displayData(input) {
    clearDashboard(); //this function will clear dashboard for new data .
    /**
     * Description.
     * @param input.public      is the type of the task.
     * @param input.createDate  is the time of task creation.
     * @param input.subject     is the subject of task.
     * @param input.doneDate    is the time of that user finished the task.
     * @param input.dLine       is the dead line of the task and it should be done by then.
     * @param input.warning     important tasks
     */

    var i,
        temp = "",
        text_1 = "",
        text_2 = "",
        text_3 = "",
        taskType,
        tagColor,
        tabColor,
        warningDemo,
        arrayLength = input.length;


    for (i = 0; i < arrayLength; i++) {
        warningDemo = "";

        if (input[i].public === '0') {
            taskType = "Private";
            tagColor = "badge-danger";
            tabColor = "light-red";
        } else {
            taskType = "public";
            tagColor = "badge-primary";
            tabColor = "light-blue";
        }
        if (input[i].warning === "1") {
            warningDemo = '<span class="mdi mdi-bell-ring text-danger mdi-24px move-right"></span>';
        }

        if (input[i].done === "0") {
            temp =
                '<div class="card mb-2">' +
                '<div class="card-header p-1 ' + tabColor + '">' +
                '<span class="badge text-wight-3 ' + tagColor + '">' + taskType + '</span>' +
                '</div>' +
                '<div class="card-body p-2">' +
                '<h4 class="card-title text-wight-3">' + input[i].subject + warningDemo + '</h4>' +

                '<p class="card-text p-0">' +
                input[i].content +
                '</p>' +
                '<div class="text-right">' +
                '<span class="badge badge-primary mr-2 text-wight-3">' + input[i].createDate + '</span>' +
                '<span class="badge badge-warning mr-2 text-wight-3"><span class="mdi mdi-alarm-check"></span>' + input[i].dLine + '</span>' +
                '</div>' +
                '<div class="dropdown-divider"></div>' +
                '<button class="btn btn-warning btn-sm mr-2">Edit</button>' +
                '<button class="btn btn-danger btn-sm mr-2" onclick="checkAsDone(' + input[i].id + ',1)">' +
                '<span class="mdi mdi-checkbox-marked-circle-outline" ></span> Done' +
                '</button>' +
                '</div>' +
                '</div>';

            if (taskType === "Private") {
                text_1 += temp;
            } else {
                text_2 += temp;
            }
        } else if (input[i].done === "1") {
            text_3 +=
                '<div class="card mb-2">' +
                '<div class="card-header p-1 light-green">' +
                '<span class="badge text-wight-3 ' + tagColor + '">' + taskType + '</span>' +
                '</div>' +
                '<div class="card-body p-2">' +
                '<h4 class="card-title text-wight-3">' + input[i].subject + '</h4>' +
                '<p class="card-text p-0">' +
                input[i].content +
                '</p>' +
                '<div class="text-right">' +
                '<span class="badge badge-primary mr-2 text-wight-3">' + input[i].createDate + '</span>' +
                '<span class="badge badge-success mr-2 text-wight-3"><span class="mdi mdi-alarm-check"></span>' + input[i].doneDate + '</span>' +
                '</div>' +
                '<div class="dropdown-divider"></div>' +
                '<button class="btn btn-primary btn-sm" onclick="checkAsDone(' + input[i].id + ',2)">' +
                '<span class="mdi mdi-arrow-left-bold-circle"></span>' +
                'Go Back To Process' +
                '</button>' +
                '</div>' +
                '</div>';
        }
    }
    if (text_1 !== "") {
        $("#displayPrivateTasks").html(text_1);
    }
    if (text_2 !== "") {
        $("#displayPublicTasks").html(text_2);
    }
    if (text_3 !== "") {
        $("#displayFinishedTasks").html(text_3);
    }
}

//######################################################################################
// this function will clear dashboard for new data .
//######################################################################################
function clearDashboard() {
    document.getElementById("displayPrivateTasks").innerHTML = "";
    document.getElementById("displayPublicTasks").innerHTML = "";
    document.getElementById("displayFinishedTasks").innerHTML = "";
}
