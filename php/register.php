<?php
 require 'dataBaseClass.php';
 require 'validation.php';
 $db = DBManager::getInstance();
 $validation = new validator();


 $email = new data();
 $email->value = $_POST['emailPacket'];
 $email->type  = 'email';

 $password = new data();
 $password->value = $_POST['passwordPacket'];
 $password->type  = 'password'; 

 $rePassword = new data();
 $rePassword->value = $_POST['rePasswordPacket'];
 $rePassword->type  = 'password';

 $firstName = new data();
 $firstName->value = $_POST['firstNamePacket'];
 $firstName->type = 'name';

 $lastName = new data();
 $lastName->value = $_POST['lastNamePacket'];
 $lastName->type = 'name';

 $userName = new data();
 $userName->value = $_POST['userNamePacket'];
 $userName->type = 'usrName';
 
 $dataList = array($firstName, $lastName,  $userName, $email, $password);

 //the line below will call class "validation" to check if all the data are valid or not
 $validationaAnswer = $validation->checkValidation($dataList);

if( $password->value === $rePassword->value && $validationaAnswer === 'valid'){

    $query = 'SELECT * FROM taskData.users;';
    $result = $db->runQuery($query);
   
    if($result ->num_rows > 0){
       while($row = $result->fetch_assoc()){
             $userNameDB =  $row['userName'];
             $emailDB = $row['email'];
             if($userNameDB === $userName || $emailDB ===  $email){
                echo json_encode("the user has already used !!!");
               die;
          }
       }
       $query = "INSERT INTO `taskData`.`users` (`name`, `lastName` ,`userName`, `email`, `password`) VALUES ( '$firstName->value', '$lastName->value', ' $userName->value', '$email->value', ' $password->value')";
       $result = $db->runQuery($query);
       echo json_encode("(inside loop) you regist seccusfuly !!!");
   }
   else{
       $query = "INSERT INTO `taskData`.`users` (`name`, `lastName` ,`userName`, `email`, `password`) VALUES ( '$firstName->value', '$lastName->value', ' $userName->value', '$email->value', ' $password->value')";
       $result = $db->runQuery($query);
       echo json_encode("(else)you regist seccusfuly !!!");
   }
}
else{

    echo json_encode($validationaAnswer);
}