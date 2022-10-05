<?php

class SignUpController extends SignUpModel
{
    private $name;
    private $email;
    private $pass;
    private $rePass;
    private $checkbox;

    public function __construct($name, $email, $pass, $rePass, $checkbox)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->rePass = $rePass;
        $this->checkbox = $checkbox;
    }

    public function signUpUser()
    {
        if($this->emptyInput() == false)
        {
           // header('location: ../registration.html');
            echo '<h1>Some Fields are empty!</h1>';
            exit();
        }
        if($this->invalidEmail() == false)
        {
          //  header('location: ../registration.html');
            echo '<h1>Invalid email!</h1>';
            exit();
        }
        if($this->isPassMatch() == false)
        {
          //  header('location: ../registration.html');
            echo '<h1>Passwords do not match!</h1>';
            exit();
        }

        if($this->isCheckboxChecked() == false)
        {
            echo "<h1>Please agreed the terms!<h1/>";
            exit;
        }
        if($this->isEmail() == false)
        {
      //      header('location: ../registration.html');
            echo '<h1>This email is already registered!</h1>';
            exit();
        }
        $this->createUser($this->name, $this->email, $this->pass);
    }

    private function emptyInput()
    {
        $result = NULL;
        if(empty($this->name) || empty($this->email) || empty($this->pass) || empty($this->rePass))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = NULL;
        $regex = '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,3}$/';
        if(!preg_match($regex, $this->email))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }

        return $result;
    }

    private function isPassMatch()
    {
        $result = NULL;
        if($this->pass !== $this->rePass)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }

        return $result;
    }

    private function isCheckboxChecked()
    {
        $result = NULL;
        if($this->checkbox == false)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function isEmail()
    {
        $result = null;
        if(!$this->email)
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