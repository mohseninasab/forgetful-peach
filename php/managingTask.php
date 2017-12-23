<?php
require 'dataBaseClass.php';
require 'checkAccess.php';
session_start();
postBox();

function postBox()
{

    $userId = returnId($_SESSION["email"]);
    $clientRequest = $_POST['requestType'];

    if ($userId !== false) {
        if ($clientRequest === "showAllData") {
            collectAllTask($userId);
        } else if ($clientRequest === 'markAsDone') {
            markAsDone();
        } else if ($clientRequest === 'addTask') {
            addTask($userId);
        } else if ($clientRequest === "markAsUndone") {
            markAsUndone();
        }
    }
}

//######################################################################################
//
//######################################################################################
function collectAllTask($userId)
{
    $dataList = [];
    $db = DBManager::getInstance();
    $query = "SELECT * FROM taskData.taskNote WHERE users_id = '$userId' ;";
    $result = $db->runQuery($query);
    $i = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $dataList[$i] = new taskData();
            $dataList[$i]->id = $row['id'];
            $dataList[$i]->subject = $row['subject'];
            $dataList[$i]->content = $row['content'];
            $dataList[$i]->public = $row['public'];
            $dataList[$i]->done = $row['done'];
            $dataList[$i]->ownerId = $row['ownerId'];
            $dataList[$i]->createDate = $row['createDate'];
            $dataList[$i]->dLine = $row['deadLine'];
            $dataList[$i]->doneDate = $row['doneDate'];
            $dataList[$i]->user_id = $row['users_id'];
            $dataList[$i]->warning = $row['warning'];
            $i++;
        }
        echo json_encode($dataList);
    } else {
        echo json_encode("sorry There is no data For you");
    }
}

//######################################################################################
//
//######################################################################################

function markAsDone()
{
    $db = DBManager::getInstance();
    $taskId = $_POST['id'];

    $time = date("Y/m/d H:i");
    $query = "UPDATE `taskData`.`taskNote` SET `done`='1', `doneDate`='$time' WHERE `id`='$taskId';";
    $db->runQuery($query);
    echo json_encode($time);
}

//######################################################################################
//
//######################################################################################

function markAsUndone()
{
    $db = DBManager::getInstance();
    $targetID = $_POST['id'];
    $query = "UPDATE `taskData`.`taskNote` SET `done`='0', `doneDate`='0' WHERE `id`='$targetID';";
    $db->runQuery($query);
    echo json_encode("its Done !!!");
}

//######################################################################################
//
//######################################################################################
function addTask($userId)
{
    $targetId = $userId;
    $db = DBManager::getInstance();
    $queryResult = "empty";
    $clientData = $_POST['data'];
    $clientType = $clientData->requestFrom;
    if ($clientType === "admin") {
        $targetId = returnId($_POST['targetUser']);

    }

    $taskType = filter_var($clientData['taskType'], FILTER_VALIDATE_INT);
    $time = date("Y-m-d H:i");

    if ($taskType === 0) {

        $query = "INSERT INTO `taskData`.`taskNote` (`subject`, `content`, `public`, `done`, `ownerId`, `createDate`, `deadLine`, `doneDate`, `users_id`)" .
            " VALUES ('$clientData[subject]', '$clientData[note]', '$taskType', '0', '$userId', '$time', '$clientData[date]', '0', '$targetId');";
        $queryResult = $db->runQuery($query);

    } else if ($taskType === 1) {

        $query = "SELECT * FROM taskData.users;";
        $result = $db->runQuery($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['admin'] === "0") {
                    $userToAssign = $row['uid'];
                    $query = "INSERT INTO `taskData`.`taskNote` (`subject`, `content`, `public`, `done`, `ownerId`, `createDate`, `deadLine`, `doneDate`, `users_id`)" .
                        " VALUES ('$clientData[subject]', '$clientData[note]', '$taskType', '0', '$userId', '$time', '$clientData[date]', '0', '$userToAssign');";
                    $queryResult = $db->runQuery($query);
                }
            }
        }
    }
    echo json_encode($queryResult);
}

//######################################################################################
//
//######################################################################################

function returnId($email)
{

    $db = DBManager::getInstance();

    $query = "SELECT * FROM taskData.users WHERE email = '$email';";
    $accessResult = $db->runQuery($query);
    $row = $accessResult->fetch_assoc();

    if ($accessResult->num_rows === 1) {
        $userId = $row['uid'];
        return $userId;
    }
    return false;
}