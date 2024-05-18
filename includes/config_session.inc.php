<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([ // set session cookie parameters
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start(); // start the session

if (isset($_SESSION['user_id'])) {
    /* if the loggedin user session id is not set then set it, 
    else check if it is still under session time interval. 
    if yes then regenerate loggedin user session id again*/
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id_loggin();
    } else {
        $interval = 60 * 30; // 30 minutes

        if ($_SESSION['last_regeneration'] > $interval) {
            regenerate_session_id_loggin();
        }
    }
} else {
    /* if the session id is not set, then set it.
    else check if it is still under session time interval.
    if not, then regenerate session id again*/
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 30; // 30 minutes

        if ($_SESSION['last_regeneration'] > $interval) {
            regenerate_session_id();
        }
    }
}

// logged in session regenerate function
function regenerate_session_id_loggin()
{
    session_regenerate_id(true);

    $newSessionId = session_create_id();
    $sessionId = $newSessionId . '_' . $_SESSION['user_id'];
    session_id($sessionId);

    $_SESSION['last_regeneration'] = time();
}

// logged in session regenerate function
function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}