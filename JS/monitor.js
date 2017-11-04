//######################################################################################
//
//######################################################################################
function displayData(input) {
    if (input === null) {
        return;
    }
    var i,
        text_1 = "",
        text_2 = "",
        text_3 = "";

    document.getElementById("displayPrivateTasks").innerHTML = "";
    document.getElementById("displayPublicTasks").innerHTML = "";
    document.getElementById("displayFinishedTasks").innerHTML = "";

    console.log("check the display input -->",input);

    var openTag = "<ul class='collapsible ul-frame' data-collapsible='accordion'>";
    var closeTag = "</ul>";
    var arrlegnth = input.length;

    for (i = 0; i < arrlegnth; i++) {
        if (input[i].public === "0" && input[i].done === "0") {
            text_1 +=
                "<li class='right-align'>" +
                "<div class='collapsible-header no-border'>" +
                " <p class='clear-margin'>" +
                "<input type='checkbox' id='test00" + i + "' onclick='checkAsDone(" + input[i].id + ",1)' />" +
                "<label for='test00" + i + "'></label>" +
                "</p>" +
                "<div class='right margin-left-auto'>" + input[i].subject +
                "</div>" +
                "</div>" +
                "<div class='collapsible-body'><p>" + input[i].content + "</p></div>" +
                "</li>";
        } else if (input[i].public === "1" && input[i].done === "0") {
            text_2 +=
                "<li class='right-align'>" +
                "<div class='collapsible-header no-border'>" +
                " <p class='clear-margin'>" +
                "<input type='checkbox' id='test00" + i + "' onclick='checkAsDone(" + input[i].id + ",1)' />" +
                "<label for='test00" + i + "'></label>" +
                "</p>" +
                "<div class='right margin-left-auto'>" + input[i].subject +
                "</div>" +
                "</div>" +
                "<div class='collapsible-body'><p>" + input[i].content + "</p></div>" +
                "</li>";
        } else if (input[i].done === "1") {
            text_3 +=
                "<li class='right-align '>" +
                "<div class='collapsible-header cyan accent-4 no-border'>" +
                " <p class='clear-margin'>" +
                "<input type='checkbox' id='test00" + i + "' checked='checked' onclick='checkAsDone(" + input[i].id + ",2)'/>" +
                "<label for='test00" + i + "'></label>" +
                "</p>" +
                "<div class='right margin-left-auto white-text'>" + input[i].subject +
                "</div>" +
                "</div>" +
                "<div class='collapsible-body'><p>" + input[i].content + "</p></div>" +
                "</li>";

        }
    }
    if (text_1 != "") {
        text_1 = openTag + text_1 + closeTag;
        $("#displayPrivateTasks").html(text_1);
    }
    if (text_2 != "") {
        text_2 = openTag + text_2 + closeTag;
        $("#displayPublicTasks").html(text_2);
    }

    if (text_3 != "") {
        text_3 = openTag + text_3 + closeTag;
        $("#displayFinishedTasks").html(text_3);
    }
    setTimeout(scanThePage, 100);
}

function scanThePage() {
    $('.collapsible').collapsible();

}