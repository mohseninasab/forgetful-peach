<?php
require 'dataBaseClass.php';
$db = DBManager::getInstance();

session_start();
$userId = $_SESSION["userId"];

$query = "SELECT * FROM taskData.users WHERE uid =$userId;";
$accessResult = $db->runQuery($query);
$row = $accessResult->fetch_assoc();
$accessLevel = $row['admin'];

class taskData{
    public $id;
    public $subject;
    public $content;
    public $public;
    public $done;
    public $ownerId;
    public $dLine;
    public $doneDate;
    public $user_id;
    public $createDate;
}

$clientRequst = $_POST['request'];
$targetID = $_POST['id'];
$clientData = $_POST['data'];

//######################################################################################
//
//######################################################################################

if(isset($_SESSION["userId"]) && $clientRequst === 'showAllData'){
    $query = "SELECT * FROM taskData.taskNote WHERE users_id = '$userId' ;";
    $result = $db->runQuery($query);
    $i = 0;
    while($row = $result->fetch_assoc()){
        $dataList[$i] =  new taskData();
        $dataList[$i]->id =  $row['id'];
        $dataList[$i]->subject = $row['subject'];
        $dataList[$i]->content = $row['content'];
        $dataList[$i]->public = $row['public'];
        $dataList[$i]->done = $row['done'];
        $dataList[$i]->ownerId = $row['ownerId'];
        $dataList[$i]->createDate = $row['createDate'];
        $dataList[$i]->dLine = $row['dLine'];
        $dataList[$i]->doneDate = $row['doneDate'];
        $dataList[$i]->user_id = $row['users_id'];
        $i++; 
     }
       echo json_encode($dataList);
  }
//######################################################################################
//
//######################################################################################

  if(isset($_SESSION["userId"]) && $clientRequst === 'markAsDone'){
   $time = date("Y/m/d H:i"). substr((string)microtime());
   $query =  "UPDATE `taskData`.`taskNote` SET `done`='1', `doneDate`='$time' WHERE `id`='$targetID';";
   $db->runQuery($query);
   echo json_encode($time);
  }

//######################################################################################
//
//######################################################################################

  if(isset($_SESSION["userId"]) && $clientRequst === 'markAsUndone'){
    
       $query =  "UPDATE `taskData`.`taskNote` SET `done`='0', `doneDate`='0' WHERE `id`='$targetID';";
       $db->runQuery($query);
       echo json_encode("its Done !!!");
  }

//######################################################################################
//
//######################################################################################
if(isset($_SESSION["userId"]) && $clientRequst === 'addTask'){
    $time = date("Y/m/d H:i"). substr((string)microtime());


    if($clientData[taskType] === '0'){
    $query =  "INSERT INTO `taskData`.`taskNote` (`subject`, `content`, `public`, `done`, `ownerId`, `createDate`, `dLine`, `doneDate`, `users_id`) VALUES ('$clientData[subject]', '$clientData[note]', '$clientData[taskType]', '0', '$userId', '$time', '$clientData[date]', '0', '$userId');";
    $db->runQuery($query);
    }
    
    else if($clientData[taskType] === '1'){

        $query = "SELECT * FROM taskData.users;";
        $result = $db->runQuery($query);
    
        if($result ->num_rows > 0){
            while($row = $result->fetch_assoc()){
       
                 $userToAssign = $row['uid'];
                 $query ="INSERT INTO `taskData`.`taskNote` (`subject`, `content`, `public`, `done`, `ownerId`, `createDate`, `dLine`, `doneDate`, `users_id`) VALUES ('$clientData[subject]', '$clientData[note]', '$clientData[taskType]', '0', '$userId', '$time', '$clientData[date]', '0', '$userToAssign');";
                 $db->runQuery($query);
           }
           
       }

    }
    echo json_encode($clientData[subject]);
}
//######################################################################################
//
//######################################################################################
if(isset($_SESSION["userId"]) && $clientRequst === 'logout'){
    echo json_encode("logout");
    session_destroy();

}