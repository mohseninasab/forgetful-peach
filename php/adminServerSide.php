<?php
session_start();
require 'dataBaseClass.php';

postBox();

//######################################################################################
//
//######################################################################################

function postBox()
{

    if ($_SESSION["admin"] === "1") {
        if ($_POST["requestType"] === "collectUserData") {
            collectUsers();
        }
        else if ($_POST["requestType"] === "ResetPassword") {
            resetPassword();
        }else if($_POST["requestType"] === "collectUserTasks"){
            collectUserTasks();
        }else if($_POST["requestType"] === "taskWarning"){
            taskWarning();
        }else if($_POST["requestType"] === "deleteTask"){
            deleteTask();
        }
    } else {
        echo json_encode($_SESSION);
    }
}

//######################################################################################
//
//######################################################################################

function collectUsers()
{
    $i = 0;
    $userDetail = [];
    $db = DBManager::getInstance();


    $usersData = $db->collectUsersData();
    if ($usersData->num_rows > 0) {
        while ($row = $usersData->fetch_assoc()) {
            if($row['admin'] === "0") {
                $userDetail[$i] = new userFullData();
                $userDetail[$i]->firstName = $row['firstName'];
                $userDetail[$i]->lastName = $row['lastName'];
                $userDetail[$i]->email = $row['email'];
                $userDetail[$i]->phoneNumber = $row['phoneNumber'];
                $userDetail[$i]->socialNumber = $row['socialNumber'];
                $userDetail[$i]->birthDate = $row['birthDate'];
                $i++;
            }
        }
    }
    echo json_encode($userDetail);
}

//######################################################################################
//
//######################################################################################

function resetPassword()
{
    $db = DBManager::getInstance();
    $email = $_POST['email'];
    $password = password_hash($email, PASSWORD_DEFAULT);
    $result = $db->resetPassword($password, $email);
    echo json_encode($result);
}

//######################################################################################
//
//######################################################################################

function collectUserTasks(){
    $db = DBManager::getInstance();
    $email = $_POST['email'];
    $result = $db->collectUserPublicTasks($email);
    echo json_encode($result);

}

//######################################################################################
//
//######################################################################################
function taskWarning(){
    $db = DBManager::getInstance();
    $taskId = $_POST['taskId'];

    $query = "UPDATE taskData.taskNote SET `warning` = 1 WHERE id = '$taskId';";
    $queryResult = $db->runQuery($query);
    echo json_encode($queryResult);

}

//######################################################################################
//
//######################################################################################
function deleteTask(){
    $db = DBManager::getInstance();
    $taskId = $_POST['taskId'];
    $query = "DELETE FROM taskData.taskNote WHERE id = '$taskId';";
    $queryResult = $db->runQuery($query);
    echo json_encode($queryResult);
}



//######################################################################################
//
//######################################################################################


class userFullData
{
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $socialNumber;
    public $birthDate;
}