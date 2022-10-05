<?php

include 'Config/Database.php';
include 'Model/SignUpModel.php';
include 'Controller/SignUpController.php';

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $rePass = $_POST['re_pass'];
    $checkbox = $_POST['checkbox'];

    $signup = new SignUpController($name, $email, $pass, $rePass, $checkbox);

    $signup->signUpUser();

    header("location: ../index.html");
}