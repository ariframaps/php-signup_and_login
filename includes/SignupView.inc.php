<?php

declare(strict_types=1);

if (isset($_SESSION['user_input']['username'])) {
    // var_dump($_SESSION['user_input']['username']);
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