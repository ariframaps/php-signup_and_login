<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];

    try {
        require_once 'dbh.inc.php';
        require_once 'SignupContr.inc.php';

        // User input error handler
        if (is_input_empty()) {

        }
        if (is_username_taken()) {

        }
        if (is_email_registered()) {

        }
        if (is_email_invalid) {

        }
    } catch (PDOException $e) {
        Die('Query failed ' . $e->getMessage());
    }

} else {
    header('Location:../index.php');
    die();
}