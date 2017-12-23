<?php
session_start();


class DBManager
{
    private $db;
    private $queryResult;

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new DBManager();
        }
        return $inst;
    }


    private function __construct()
    {
        $this->db = mysqli_connect('localhost', "root", "tighen", "taskData");
        if (mysqli_connect_errno()) {
            echo "can not connect to dataBase !";
            die();
        } else {
            mysqli_query($this->db, "SET NAMES UTF8");
        }
    }

    public function __destruct()
    {
        mysqli_close($this->db);
    }


    public function runQuery($query)
    {
        $this->queryResult = mysqli_query($this->db, $query);
        return $this->queryResult;
    }

    public function getLastQueryResult()
    {
        return $this->queryResult;
    }

    public function collectUsersData()
    {
        $query = "SELECT * FROM taskData.users;";
        $this->queryResult = mysqli_query($this->db, $query);
        return $this->queryResult;
    }

    public function activeSession($sessionId, $email)
    {
        $query = "UPDATE taskData.users SET `active`='$sessionId' WHERE `email`='$email';";
        $this->queryResult = mysqli_query($this->db, $query);
        return $this->queryResult;
    }

    public function deActiveSession($email)
    {
        $query = "UPDATE taskData.users SET `active`='' WHERE `email`='$email';";
        $this->queryResult = mysqli_query($this->db, $query);
        return $this->queryResult;
    }

    public function resetPassword($defaultPassword, $email)
    {
        $query = "UPDATE taskData.users SET `password`='$defaultPassword' WHERE `email`='$email';";
        $this->queryResult = mysqli_query($this->db, $query);
        return $this->queryResult;
    }

    public function collectUserPublicTasks($email)
    {
        $allTask = [];
        $adminEmail = $_SESSION['email'];
        $query = "SELECT uid FROM taskData.users WHERE email = '$adminEmail';";
        $queryResult = mysqli_query($this->db, $query);
        $adminIdRow = $queryResult->fetch_assoc();
        $adminId = $adminIdRow['uid'];


        $query = "SELECT uid FROM taskData.users WHERE email = '$email';";
        $queryResult = mysqli_query($this->db, $query);
        $userIdRow = $queryResult->fetch_assoc();
        $userId = $userIdRow['uid'];

        $query = "SELECT * FROM taskData.taskNote WHERE (users_id = '$userId' AND public = '1') OR (users_id ='$userId' AND ownerId = '$adminId');";
        $queryResult = mysqli_query($this->db, $query);
        if ($queryResult->num_rows > 0) {
            while ($row = $queryResult->fetch_assoc()) {
                array_push($allTask, $row);
            }
        }
        return $allTask;

    }

    public function importUserData($input)
    {
        $query01 = "INSERT ";
        $query01 .= "INTO `taskData`.`users` (`admin`,";
        $query02 = " VALUES ('0',";
        $count = count($input);


        for ($i = 0; $i < $count; $i++) {
            $temp = $input[$i];
            if ($temp->type === 'firstName') {
                if ($i === ($count - 1)) {
                    $query01 .= " `firstName`)";
                    $query02 .= " '$temp->value')";
                } else {
                    $query01 .= " `firstName`,";
                    $query02 .= " '$temp->value',";
                }
            } else if ($temp->type === 'lastName') {
                if ($i === ($count - 1)) {
                    $query01 .= " `lastName`)";
                    $query02 .= " '$temp->value')";
                } else {
                    $query01 .= " `lastName`,";
                    $query02 .= " '$temp->value',";
                }
            } else if ($temp->type === 'email') {
                if ($i === ($count - 1)) {
                    $query01 .= " `email`)";
                    $query02 .= "'$temp->value')";
                } else {
                    $query01 .= " `email`,";
                    $query02 .= " '$temp->value',";
                }
            } else if ($temp->type === 'password') {
                if ($i === ($count - 1)) {
                    $query01 .= " `password`)";
                    $query02 .= " '$temp->value')";
                } else {
                    $query01 .= " `password`,";
                    $query02 .= " '$temp->value',";
                }
            } else if ($temp->type === 'socialNumber') {
                if ($i === ($count - 1)) {
                    $query01 .= " `socialNumber`)";
                    $query02 .= " '$temp->value')";
                } else {
                    $query01 .= " `socialNumber`,";
                    $query02 .= " '$temp->value',";
                }
            } else if ($temp->type === 'phoneNumber') {
                if ($i === ($count - 1)) {
                    $query01 .= " `phoneNumber`)";
                    $query02 .= " '$temp->value')";
                } else {
                    $query01 .= " `phoneNumber`,";
                    $query02 .= " '$temp->value',";
                }
            }

        }

        $query01 .= $query02;
        $this->queryResult = mysqli_query($this->db, $query01);
        return $this->queryResult;

    }
}


class taskData
{
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