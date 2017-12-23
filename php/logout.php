<?php
require 'dataBaseClass.php';
session_start();

logout();
function logout()
{
    $db = DBManager::getInstance();
    $email = $_SESSION["email"];
    $logoutResult = $db->deActiveSession($email);
    session_destroy();
    echo json_encode($logoutResult);
}
