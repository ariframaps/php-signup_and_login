<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd)
{
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

function get_user_info(object $pdo, string $username)
{
    return get_user($pdo, $username);
}

function is_username_exists(bool|array $user)
{
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function is_password_incorrect(string $pwd, string $hashedPwd)
{
    if (password_verify($pwd, $hashedPwd)) {
        return false;
    } else {
        return true;
    }

}