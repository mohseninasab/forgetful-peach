<?php

class DBManager{
    private $db;
    private $queryResult;

    public static function getInstance(){
     static $inst = null;
     if($inst === null){
         $inst = new DBManager();
     }
      return $inst;
    }


    private function __construct(){
        $this->db = mysqli_connect('localhost',"root","tighen","taskData");
        if (mysqli_connect_errno()){
            echo "can not connect to dataBase !";
            die;
        }else{
            mysqli_query($this->db ,"SET NAMES UTF8");
        }
    }

    public function  __destruct() {
        
            mysqli_close($this->db);
        }


    public function  runQuery($query){
        $this->quryResult = mysqli_query($this->db , $query);
        return $this->quryResult;
    }

    public function getLastQueryResult(){
        return $this->quryResult;
    }
}