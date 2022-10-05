<?php

class SignUpModel extends Database
{

    protected function createUser($name, $email, $password)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (name, email, password) VALUES (?, ? , ?);');
        $hashPass = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($name, $email, $hashPass)))
        {
            $stmt = NULL;
            header('location ../index.html');
            exit();
        }

        $stmt = null;
    }

    protected function ifEmailExist($email)
    {
        $stmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ?;');

        if(!$stmt->execute(array($email)))
        {
            $stmt = NULL;
            header("location: ../index.html");
            exit();
        }

        $resultCheck = NULL;
        if($stmt->rowCount() > 0)
        {
            $resultCheck = false;
        }
        else
        {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}