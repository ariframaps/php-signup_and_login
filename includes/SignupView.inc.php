<?php

declare(strict_types=1);

function show_signup_input()
{
    if (isset($_SESSION['user_input']['username'])) {
        echo '<input type="text" name="username" id="username" placeholder="username" value=' . $_SESSION['user_input']['username'] . '>';
    } else {
        echo '<input type="text" name="username" id="username" placeholder="username">';
    }

    echo '<input type="password" name="password" id="password" placeholder="password">';

    if (isset($_SESSION['user_input']['email'])) {
        echo '<input type="text" name="email" id="email" placeholder="email" value=' . $_SESSION['user_input']['email'] . '>';
    } else {
        echo '<input type="text" name="email" id="email" placeholder="email">';
    }

    unset($_SESSION['user_input']);
}

function show_signup_status()
{
    if (isset($_SESSION['signup_errors'])) {
        foreach ($_SESSION['signup_errors'] as $error => $message) {
            echo '<p class="failed">' . $message . '</p>';
        }
        unset($_SESSION['signup_errors']);
    }
}
