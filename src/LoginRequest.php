<?php

include 'Config/Database.php';
include 'Model/LoginModel.php';
include 'Controller/LoginController.php';

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $signin = new LoginController($name, $pass);

    $signin->signInUser();

    header("location: ../profile.php");
}