<?php
session_start();

 require 'dataBaseClass.php';
 require 'validation.php';
 $db = DBManager::getInstance();
 $validation = new validator();


 $email = new data();
 $email->value = $_POST['emailPacket'];
 $email->type  = 'email';

 $password = new Data();
 $password->value = $_POST['passwordPacket'];
 $password->type  = 'password';

 $dataList = array($email, $password);
 $validationaAnswer = $validation->checkValidation($dataList);

if($validationaAnswer === true){ 

    $query = "SELECT * FROM taskData.users;";
    $result = $db->runQuery($query);

    if($result ->num_rows > 0){
        while($row = $result->fetch_assoc()){
   
             $passwordDB =  $row['password'];
             $emailDB = $row['email'];
             $userId = $row['uid'];
             $accessLevel = $row['admin'];
             
             if($password->value === $passwordDB && $email->value ===  $emailDB){
                $_SESSION["userId"] = $userId ;
                $_SESSION["email"] = $emailDB;
                $_SESSION["accessLevle"] = $accessLevel;

                echo json_encode('valid');
                die();   
          }
       }
       $list = array('you enter wrong password or email !');
       echo json_encode($list);
   }
}
else{
    echo json_encode("check your Email and Password !");
}