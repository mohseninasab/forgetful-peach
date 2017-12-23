<?php
require 'dataBaseClass.php';
require 'validation.php';

getData();


//######################################################################################
//this function will receive all the register data from user and validate data
//######################################################################################
function getData()
{
    $validation = new validator();
    $db = DBManager::getInstance();

    $email = new data();
    $email->value = $_POST["emailPacket"];
    $email->type = 'email';

    $password = new data();
    $password->value = $_POST["passwordPacket"];
    $password->type = 'password';

    $rePassword = new data();
    $rePassword->value = $_POST['rePasswordPacket'];
    $rePassword->type = 'password';

    $firstName = new data();
    $firstName->value = $_POST["firstNamePacket"];
    $firstName->type = 'firstName';

    $lastName = new data();
    $lastName->value = $_POST["lastNamePacket"];
    $lastName->type = 'lastName';


    // import all objected data in an array to send for validation
    $dataList = array($firstName, $lastName, $email, $password);

    // validate data by calling the "checkValidation()" method in class "validator"
    $answer = $validation->checkValidation($dataList);


    if ($answer && $password->value === $rePassword->value) {
        hashPassword($dataList);

        if (checkDataBase($email)) {
            $query = $db->importUserData($dataList);
            session_start();
            $_SESSION['email'] = $email->value;
            $db->activeSession(session_id(), $email->value);
            echo json_encode($query);

        } else {
            echo json_encode("This Email or Phone number or Social number already Signed Up !!!");
        }

    } else {
        echo json_encode("you entered invalid Data !!");
    }
}

//######################################################################################
// this function will checks if there is a user with same email or phone number or
// social number
//######################################################################################

function checkDataBase($email)
{
    $db = DBManager::getInstance();
    $result = $db->collectUsersData();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $emailDB = $row['email'];

            if ($email->value === $emailDB) {
                return false;
            }
        }
    }
        return true;
}

//######################################################################################
// this function will find and hash the password in the " $dataList " array
//######################################################################################
function hashPassword($input)
{
    $count = count($input);
    for ($i = 0; $i < $count; $i++) {
        if ($input[$i]->type === 'password') {
            $input[$i]->value = password_hash($input[$i]->value, PASSWORD_DEFAULT);
        }
    }
}
