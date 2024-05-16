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

/* if the session id is not set then set it, else check if it is still under session time interval. if yes then regenerate session id again*/
if (!isset($_SESSION['last_regeneration'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30; // 30 minutes

    if ($_SESSION['last_regeneration'] > $interval) {
        regenerate_session_id();
    }
}

// session regenerate function
function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}