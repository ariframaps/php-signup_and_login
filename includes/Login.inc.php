<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    try {
        require_once 'dbh.inc.php';
        require_once 'LoginModel.inc.php';
        require_once 'LoginContr.inc.php';

        // User input error handler
        $errors = [];
        if (is_input_empty($username, $pwd, $email)) {
            $errors['empty_input'] = 'Fill in all fields!';
        }
        // get user from database
        $user = get_user_info($username, $pwd);
        // check if username or password is correct
        if (!is_username_exists($user) && is_password_incorrect($pwd)) {
            $errors['invalid_login'] = 'Invalid login info!';
        }

        // start a session
        require_once 'config_session.inc.php';

        //check if there are any errors occured
        if (!empty($errors)) {
            // storing the errors
            $_SESSION['login_errors'] = $errors;

            // redirect to home page
            header('Location:../index.php');
            die();
        }

        // logging in user if no user error exists
        user_login($pdo, $username, $pwd);

        // set pdo and statement to null
        $pdo = null;
        $stmt = null;

        // redirecting into homepage
        header('Location:../index.php?login=success');
        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}