<?php


class LoginModel extends Database
{
    protected function getUser($name, $pass)
    {
        $stmt = $this->connect()->prepare("SELECT password FROM users WHERE name = ? OR email = ?;");

        if(!$stmt->execute(array($name, $pass)))
        {
            $stmt = NULL;
            header("location: ../fail.html");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            // User not found
            $stmt = NULL;
           // header("location: ../error.php");
            echo '<h1>User not found!<h1/>';
            exit();
        }

        $passHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPass = password_verify($pass, $passHashed[0]['password']);

        if($checkPass == false)
        {
            // wrong pass
            $stmt = NULL;
            echo '<h1>WRONG PASS!<h1/>';
            exit();
        }
        elseif($checkPass == true)
        {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE name = ? OR email = ? AND password = ?;");

            if(!$stmt->execute(array($name, $name, $pass)))
            {
                $stmt = NULL;
              //  header("location: ../index.html");
                echo '<h1>stmt failed!</h1>';
                exit();
            }

            if($stmt->rowCount() == 0)
            {
                $stmt = NULL;
              //  header("location: ../index.html");
                echo '<h1>User not found!</h1>';
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['id'] = $user[0]["id"];
            $_SESSION['name'] = $user[0]["name"];

            $stmt = NULL;
        }

        $stmt = NULL;
    }
}