<?php

if(isset($_POST['submit'])){
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pswd'];
    $repeatpassword = $_POST['repeat_password'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyUserSignup($firstname, $middlename, $lastname, $email, $username, $password, $repeatpassword)!==false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(InvalidUsername($username)!==false){
        header("location: ../signup.php?error=invalidusername");
        exit();
    }
    if(InvalidEmail($email)!==false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(PasswordMismatch($password, $repeatpassword)!==false){
        header("location: ../signup.php?error=passwordsnotmatch");
        exit();
    }
    if(UsernameExist($conn, $username, $email)!==false){
        header("location: ../signup.php?error=usernamealreadytaken");
        exit();
    }
    createUser($conn, $firstname, $middlename, $lastname, $email, $username, $password);
}
else{
    header('location: ../signup.php');
    exit();
}
