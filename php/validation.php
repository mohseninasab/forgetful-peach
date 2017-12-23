<?php

class data
{
    public $type;
    public $value;
}

class validator
{

    public function checkValidation($input)
    {
        $answer = "";
        $count = count($input);


        $invalidList = array();
        for ($i = 0; $i < $count; $i++) {
            if ($input[$i]->type === 'name') {
                $answer = $this->checkName($input[$i]->value);
            } else if ($input[$i]->type === 'usrName') {
                $answer = $this->checkUsrName($input[$i]->value);
            } else if ($input[$i]->type === 'email') {
                $answer = $this->checkEmail($input[$i]->value);
            } else if ($input[$i]->type === 'password') {
                $answer = $this->checkPassword($input[$i]->value);
            } else if ($input[$i]->type === 'number') {
                $answer = $this->checkNumber($input[$i]->value);
            } else if ($input[$i]->type === 'socialNumber') {
                $answer = $this->checkSocialNumber($input[$i]->value);
            } else if ($input[$i]->type === 'phoneNumber') {
                $answer = $this->checkPhoneNumber($input[$i]->value);
            }


            if ($answer === false) {

                array_push($invalidList, $input[$i]);
            }

        }
        if (count($invalidList) > 0) {
            return $invalidList;
        } else {
            return true;
        }
    }

    private function checkName($name)
    {
        $regex = '/^[a-z]+$/i';
        return preg_match($regex, $name);
    }

    private function checkUsrName($usrName)
    {
        $regex = '/^[a-zA-z]+[0-9a-zA-z_]+[0-9a-zA-Z]$/';
        return preg_match($regex, $usrName);
    }

    private function checkEmail($email)
    {
        $regex = '/^[a-z][a-z0-9._-]+@(\w+\.)+[a-z]{2,6}$/';
        return preg_match($regex, $email);
    }

    private function checkPassword($password)
    {
        $regex = '/^[0-9a-zA-Z]+[0-9a-zA-Z@._-]+[0-9a-zA-Z]$/';
        return preg_match($regex, $password);
    }

    private function checkNumber($number)
    {
        $regex = '/^[0-9]+$/';
        return preg_match($regex, $number);
    }

    private function checkSocialNumber($sNumber)
    {
        $regex = '/^\d{10}$/';
        return preg_match($regex, $sNumber);
    }

    private function checkPhoneNumber($pNumber)
    {
        $regex = '/^[+]+\d{12}$|^[0]+\d{10}$/';
        return preg_match($regex, $pNumber);
    }
}
