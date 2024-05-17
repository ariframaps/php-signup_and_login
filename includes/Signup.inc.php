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

        // create a new user if no user input exists
        create_user($pdo, $username, $pwd, $email);

        // set pdo and statement to null
        $pdo = null;
        $stmt = null;

        // redirecting into homepage
        header('Location:../index.php');
        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}