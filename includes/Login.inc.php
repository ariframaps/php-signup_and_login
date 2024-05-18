<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    try {
        require_once 'dbh.inc.php';
        require_once 'LoginModel.inc.php';
        require_once 'LoginContr.inc.php';

        // get user from database
        $user = get_user_info($pdo, $username);

        // User input error handler
        $errors = [];
        if (is_input_empty($username, $pwd)) {
            $errors['empty_input'] = 'Fill in all fields!';
        }
        // check if username is correct
        if (!is_username_exists($user)) {
            $errors['invalid_login'] = 'Invalid login info username!';
        }
        // check if password is correct
        if ($user && is_password_incorrect($pwd, $user['pwd'])) {
            $errors['invalid_login'] = 'Invalid login info password!';
        }

        require_once 'config_session.inc.php';

        //check if there are any errors occured
        if (!empty($errors)) {
            // storing the errors
            $_SESSION['login_errors'] = $errors;

            // redirect to home page
            header('Location:../index.php');
            die();
        }

        // create new session id with with the unique user id
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . '_' . $user['id'];
        session_id($sessionId);
        $_SESSION['last_regeneration'] = time(); // reset the session timestamp

        // store user information on the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_username'] = htmlspecialchars($user['username']);

        // set pdo and statement to null
        $pdo = null;
        $stmt = null;

        // redirecting into homepage with login status
        header('Location:../index.php?login=success');
        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}