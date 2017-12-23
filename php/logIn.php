<?php
session_start();
require 'dataBaseClass.php';
require 'validation.php';

//######################################################################################

login();

//######################################################################################
//
//######################################################################################

function login()
{
    $db = DBManager::getInstance();
    $validation = new validator();

    $email = new data();
    $email->value = $_POST['emailPacket'];
    $email->type = 'email';

    $password = new data();
    $password->value = $_POST['passwordPacket'];
    $password->type = 'password';

    // import all objected data in an array to send for validation
    $dataList = array($email, $password);

    $validationAnswer = $validation->checkValidation($dataList);

    if ($validationAnswer === true) {
        $result = $db->collectUsersData();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $passwordDB = $row['password'];
                $emailDB = $row['email'];
                $adminDB = $row['admin'];

                if (password_verify($password->value, $passwordDB) && $emailDB === $email->value) {
                    $db->activeSession(session_id(), $emailDB);
                    $_SESSION['email'] = $emailDB;
                    $_SESSION['admin'] = $adminDB;
                    $userLoginData = new userData();
                    $userLoginData->email = $_SESSION['email'];
                    $userLoginData->accessLevel = $_SESSION['admin'];

                    echo json_encode($userLoginData);
                    die();
                }
            }
            echo json_encode(" server didn't found the matching data !!");
        }
    } else {
        echo json_encode("check your Email and Password !");
    }
}
//######################################################################################
//
//######################################################################################

class userData{
    public $email;
    public $accessLevel;
}
