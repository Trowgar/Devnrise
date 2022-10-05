<?php

class Database
{
    protected function connect()
    {
        try
        {
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "devnrise";

            $dbh = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
            return $dbh;
        }
        catch (PDOException $e)
        {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}