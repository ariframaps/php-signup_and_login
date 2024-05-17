<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];

    try {
        require_once 'dbh.inc.php';
        require_once 'SignupModel.inc.php';
        require_once 'SignupContr.inc.php';

        // User input error handler
        if (is_input_empty($username, $pwd, $email)) {
            echo 'input empty';
            die();
        }
        if (is_username_taken($pdo, $username)) {
            echo 'username taken';
            die();
        }
        if (is_email_invalid($email)) {
            echo 'email invalid';
            die();
        }
        if (is_email_registered($pdo, $email)) {
            echo 'email registered';
            die();
        }
    } catch (PDOException $e) {
        Die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}