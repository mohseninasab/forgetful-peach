<?php

class data{
    public $type;
    public $value;
}

class validator{
    private $j=0;


    public function checkValidation($input){
        $count  = count($input);

        $invalidList = array();
        for($i=0 ; $i < $count ; $i++){
            if($input[$i]->type === 'name'){
               $answer = $this->checkName($input[$i]->value);
            }else if($input[$i]->type === 'usrName'){
                $answer = $this->checkUsrName($input[$i]->value);
            }else if($input[$i]->type === 'email'){
                $answer = $this->checkEmail($input[$i]->value);
            }else if($input[$i]->type === 'password'){
                $answer = $this->checkPassword($input[$i]->value);
            }else if($input[$i]->type === 'number'){
                $answer = $this->checkNumber($input[$i]->value);    
            }else if($input[$i]->type === 'socialNumber'){
                $answer = $this->checkSocialNumber($input[$i]->value);    
            } else if($input[$i]->type === 'phoneNumber'){
                $answer = $this->checkPhoneNumber($input[$i]->value);    
            }


            if($answer === 'invalid'){

                 array_push($invalidList,$input[$i]);
            }

        }
        if( count($invalidList) > 0 ){
            return $invalidList;
        }else{
            return true;
        }
   }

    private function checkName($name){
        $regex =  '/^[a-z]+$/i';
       if(preg_match($regex, $name)){
        return 'valid';
       }else{
        return 'invalid';
       }
    }
    private function checkUsrName($usrName){
        $regex =  '/^[a-zA-z]+[0-9a-zA-z_]+[0-9a-zA-Z]$/';
        if(preg_match( $regex, $usrName)){
            return 'valid';
           }else{
            return 'invalid';
           }
    }
    private function checkEmail($email){
        $regex =  '/^[a-z][a-z0-9._-]+@(\w+\.)+[a-z]{2,6}$/';
        if(preg_match( $regex, $email)){
            return 'valid';
           }else{
            return 'invalid';
           }
    }
    private function checkPassword($password){
        $regex =  '/^[0-9a-zA-Z]+[0-9a-zA-Z@._-]+[0-9a-zA-Z]$/';
        if(preg_match($regex, $password)){
            return 'valid';
           }else{
            return 'invalid';
           }
    }
    private function checkNumber($number){
        $regex =  '/^[0-9]+$/';
        if(preg_match( $regex, $number)){
            return 'valid';
           }else{
            return 'invalid';
           }
    }
    private function checkSocialNumber($sNumber){
        $regex =  '/^\d{10}$/';
        if(preg_match( $regex, $sNumber)){
            return 'valid';
           }else{
            return 'invalid';
           }

    }
    private function checkPhoneNumber($pNumber){
        $regex =  '/^[+]+\d{12}$|^[0]+\d{10}$/';
        if(preg_match( $regex, $pNumber)){
            return 'valid';
           }else{
            return 'invalid';
           }

    }
}
