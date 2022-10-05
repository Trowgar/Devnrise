<?php

class LoginController extends LoginModel
{
    private $name;
    private $pass;

    public function __construct($name, $pass)
    {
        $this->name = $name;
        $this->pass = $pass;
    }

    public function signInUser()
    {
        if($this->emptyFields() == false)
        {
            header("location: ../index.html");
            exit();
        }

        $this->getUser($this->name, $this->pass);
    }


    private function emptyFields()
    {
        $result = NULL;
        if(empty($this->name) || empty($this->pass))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }

        return $result;
    }
}