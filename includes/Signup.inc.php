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
        $errors = [];
        if (is_input_empty($username, $pwd, $email)) {
            $errors['empty_input'] = 'Fill all fields!';
        }
        if (is_username_taken($pdo, $username)) {
            $errors['taken_username'] = 'Username is already taken!';
        }
        if (is_email_invalid($email)) {
            $errors['invalid_email'] = 'Use a valid email!';
        }
        if (is_email_registered($pdo, $email)) {
            $errors['registered_email'] = 'Email is already registered!';
        }
        // var_dump($errors);

        //check if there are any errors occured
        if (!empty($errors)) {
            require_once 'config_session.inc.php';
            $_SESSION['signup_errors'] = $errors;
            header('Location:../index.php');
            die();
        }

        // create a new user if no user input exists
        create_user($pdo, $username, $pwd, $email);

        // set pdo and statement to null
        $pdo = null;
        $stmt = null;

        // redirecting into homepage
        header('Location:../index.php?signup=success');
        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}